<?php

namespace app\controllers;

use Yii;
use app\models\Block;
use app\models\search\SearchBlock;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Qard;
use app\models\Theme;
use app\models\QardTags;
use app\models\Tag;
use yii\web\UploadedFile;

/**
 * BlockController implements the CRUD actions for Block model.
 */
class BlockController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Block models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchBlock();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Block model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Save call from create page.
     * If save is successful, the browser will be redirected to the 'preview' page.
     * @return mixed
     */
    public function actionSaveQard(){
        
			//print_r(Yii::$app->request->post());
			$data = Yii::$app->request->post()['data'];
			$data = json_decode($data,true);
			$all_blocks = $data[2];
			foreach($all_blocks['value'] as $block){
				$post = [];
				$post['qard_title'] = $data[0]['value'];
				$post['qard_theme_id'] = $data[1]['value'];
				foreach($block['value'] as $block_properties){
					$key = $block_properties['name'];
					$value = $block_properties['value'];
					$post[$key] = $value;
				}
				$theme=$this->createTheme($post);
				if(empty($theme->errors) && !is_array($theme)){ 
					$qard = $this->createQard($post, $post['qard_theme_id']);
					if(empty($qard->errors) && !is_array($qard)){
						$block=$this->createBlock($post,$qard->qard_id,$theme->theme_id);
						$tags=$this->createTagsQard($post,$qard->qard_id);
						
						if(empty($block->errors) && !is_array($block)){
							$text=(empty($block->text))?'':$block->text;
							echo json_encode(array('qard_id'=>$qard->qard_id,'theme_id'=>$theme->theme_id,'block_id'=>$block->block_id,'link_image'=>$block->link_image,"text"=>$text,"blk_id"=>$post['blk_id'],'div_bgcolor'=>$post['div_bgcolor'],'div_overlaycolor'=>$post['div_overlaycolor'],'div_opacity'=>$post['div_opacity'],'height'=>$post['height'],'edit_block'=>$post['block_id'],'block_priority'=>$block->block_priority, 'data_style_qard'=>$post['data_style_qard'],'div_bgimage_position'=>$post['div_bgimage_position']));
							
						}  else {
							echo "unable to create block";
							exit;
						}
					}					
				}
				
			}
			echo "Success";
    }
    /**
     * Creates a new Block model along with a qard and a block theme.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
		$post=Yii::$app->request->post();
			
		//to create theme for qard
		$theme=$this->createTheme($post);
	 
		if(empty($theme->errors) && !is_array($theme)){ 
	    
	    $qard = $this->createQard($post, $post['qard_theme_id']);
	   
	    
	    if(empty($qard->errors) && !is_array($qard)){
			//echo $qard->qard_id;die;
			$block=$this->createBlock($post,$qard->qard_id,$theme->theme_id);
			$tags=$this->createTagsQard($post,$qard->qard_id);
			
			if(empty($block->errors) && !is_array($block)){
				$text=(empty($block->text))?'':$block->text;
				echo json_encode(array('qard_id'=>$qard->qard_id,'theme_id'=>$theme->theme_id,'block_id'=>$block->block_id,'link_image'=>$block->link_image,"text"=>$text,"blk_id"=>$post['blk_id'],'div_bgcolor'=>$post['div_bgcolor'],'div_overlaycolor'=>$post['div_overlaycolor'],'div_opacity'=>$post['div_opacity'],'height'=>$post['height'],'edit_block'=>$post['block_id'],'block_priority'=>$block->block_priority, 'data_style_qard'=>$_POST['data_style_qard'],'div_bgimage_position'=>$_POST['div_bgimage_position']));
				exit;
				
			}  else {
				echo "unable to create block";
				//print_r($block->errors);
			}
		
	    }else{
			echo "unable to create qard";
		
			print_r($qard);
			echo Theme::findOne($theme->theme_id)->delete();
	    }
	    
		}else{
			echo "unable to create theme";
			print_r($theme);
		}
		
	//	$model->=\Yii::$app->request->post('tags');

		exit(0);

    }
	/**
	 * For adding extra text,ajax call from create qard page
	 * @param: Null
	 * return Json
	**/
    public function actionAddText(){
		$data = Yii::$app->request->post();
		if(isset($data['block_id']) && $data['block_id'] != "undefined"){
			$block = $this->findModel($data['block_id']);
			//print_r($data['extra_text']);die;
			if(isset($block)){

				$block->extra_text = $data['extra_text'];
				$block->extra_text_title = $data['title'];
				
				if($block->save(false)){
					
					$data['status'] = true;
					$data['link_data'] = "<span block_id='".$block->block_id."' class='icon-mark pull-right' onclick='showExtraText(this);'><img src='".Yii::$app->homeUrl."images/text_icon.png' alt=''></span>";
					return json_encode($data);
					die;
				}
			}
			
		}
		$data['status'] = false;
		return json_encode($data);
    }
    public function actionGetText($block_id){
		$block = $this->findModel($block_id);
		$data = [];
		if($block){
				$data['extra_text'] = $block->extra_text;
				$data['title'] = $block->extra_text_title;				
		}
		return json_encode($data);
	}
    /**
     * Updates an existing Block model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->block_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Block model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Block model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Block the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Block::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*
     * add theme properties in serialized data
     * @return unserielized data
     */
    public function addThemeProperties($param)
    {
	
	$theme_properties=array(
	    'name'=>$param['name'],
	    'font'=>$param['font'],
	    'text_size'=>$param['text_size'],
	    'text_color'=>$param['text_color'],
	    'text_align'=>$param['text_align'],
	   // 'text_varticalalign'=>$text_varticalaign,
	    'text_decoration'=>$param['text_decoration'],
	    'textbg_overlaycolour'=>$param['textbg_overlaycolour'],
	    'textbg_overlayopacity'=>$param['textbg_overlayopacity'],
	    'url_colour'=>$param['url_colour'],
	    'url_hovercolour'=>$param['url_hovercolour'],
	    'blockbg_colour'=>$param['blockbg_colour'],
//	    'displayimageasbg'=>displayimageasbg,
//	    'bg_imageopacity'=>$bg_imageopacity,
//	    'bg_imageoverlaycolour'=>$bg_imageoverlaycolour,
//	    'bg_imageoverlayopacity'=>$bg_imageoverlayopacity,
//	    'newwindowlink'=>$newwindowlink,
//	    'displaylink'=>$displaylink,
//	    'linkalign'=>$linkalign,
	    'blockunits'=>$param['blk_size'],
	    
	);
	
	return serialize($theme_properties);
    }
    
    /*
     * to create Qard if created then update the qard
     */
    public function createQard($post,$theme_id){
		
		$qard = false;
		if(!empty($post['qard_id'])){
			$qard = Qard::findOne($post['qard_id']);
		}else {
			$qard=new Qard();
		}
		
	//	print_r($qard);die;
		if(!empty($post['qard_title'])){
			$qard->title=$post['qard_title'];
		}
		
		//$qard->url='test url';
		if(\Yii::$app->user->id){
			$qard->user_id = Yii::$app->user->id;
		}
		$qard->qard_privacy=1;
		$qard->qard_theme=$theme_id;
		$qard->save(false);
		
		//if(!\Yii::$app->user->id)
			\Yii::$app->session['qard']= $qard->qard_id; //always save the current qard id to session
		return $qard;	
	
    }
    
    /*
     * create theme for qard
     */
    public function createTheme($post){
	
		$theme = false;
		if(!empty($post['theme_id'])){
			$theme = Theme::findOne($post['theme_id']);
		}else {
			$theme=new Theme();
		}
		
		$theme->theme_type=0; //theme type 1 define theme for qard o theme for block
		$theme->theme_properties='test'; // serialized data all theme details
		$serilized_arr['image_opacity'] = $post['image_opacity'];
		$serilized_arr['div_opacity'] = $post['div_opacity'];
		$serilized_arr['div_bgcolor'] = $post['div_bgcolor'];
		$serilized_arr['div_overlaycolor'] = $post['div_overlaycolor'];
		$serilized_arr['data_bgcolor_id'] = $post['data_bgcolor_id'];
		$serilized_arr['data_fontcolor_id'] = $post['data_fontcolor_id'];
		$serilized_arr['data_style_qard'] = $post['data_style_qard'];
		$serilized_arr['div_bgimage_position'] = $post['div_bgimage_position'];
		if(strpos('/',$post['div_bgimage'])){
			$url_split=  explode('/',$post['div_bgimage']);
			$serilized_arr['div_bgimage']=end($url_split);
		}else{
			$serilized_arr['div_bgimage']="";
		}
			
		$serilized_arr['height']=$post['height'];
		$theme->theme_properties=  serialize($serilized_arr);	
		
		$theme->save(false);
		return $theme;
    }
    /*
     * 
     */
    public function createTagsQard($post,$qard_id){
	$qardTags=new QardTags();
	$tags=new Tag();
	//checking whether tags are present or not
	//print_r($post);die;
	if(!empty($post['tags'])){
	    // tags are in string with comm format 
	    $tags =  $post['tags'];
		//print_r($tags);
		$tags = explode(',',$tags);
		//print_r($tags);die;
	    //deleting all records that are present with qard_id
	    QardTags::deleteAll(['qard_id'=>$qard_id]);
	    $tag_details='';
	    foreach ($tags as $tag) {
		// checking whether entered tags present in db or not if not then skip to insert
/* 		$tag_details=Tag::find()->where(['name'=>$tag])->one();
		
		if(!empty($tag_details)){ */
		    $qardTags=new QardTags();
		    $qardTags->qard_id=$qard_id;
		    $qardTags->tag_id=$tag;
		   // if($qardTags->validate()){
			$qardTags->save();
/* 		    }else{
			QardTags::deleteAll(['qard_id'=>$qard_id]);
			return $qardTags;
		    } */
		//}
		
	    }
	}else{
	    return array("empty tags!...");
	}
    }
    
    
    public function createBlock($post,$qard_id,$theme_id){
	
	$block = false;
	if(!empty($post['block_id'])){
	    $block = Block::findOne($post['block_id']);
	}else {
	    $block=new Block();
	}
	$is_true=true;
	$block->qard_id=$qard_id;
	$block->theme_id=$theme_id;
	// 0 for temp, 1 form active , 2 delete, 3 for template
	$block->status=0;
	// 0 for no and 1 for yes
	$block->is_title=$post['is_title'];
	// to arranging block in order
	$block->block_priority=$post['block_priority'];
	
	
	
	//for text
	if(!empty($post['text'])){
	    $block->text=$post['text'];
/* 	    $block->extra_text=$post['extra_text']; */
	    $is_true=true;
	}
	if(!empty($post['thumb_values'])){
	    
	    
	    //upload path for image
	    $file_path=Yii::$app->basePath.'/web/uploads/block/';
	    // TO Remove previous image
	    if(!empty($post['image_name'])){
		unlink($file_path.$post['image_name']);
		
	    }
	    
	    /*
	    * to upload image 
	    */
	    $image=  json_decode($post['thumb_values']);
	    $img = str_replace('data:image/jpeg;base64,', '', $image->data);
	    $img = str_replace(' ', '+', $img);
	    $image_data = base64_decode($img);
	    $image_name='rand_'.rand(0000,9999).'time_'.time().'qid_'.$qard_id.'.JPG';
	    $file = $file_path .$image_name;
	    $success = file_put_contents($file, $image_data);
	    if(!$success){
			Qard::findOne($qard->qard_id)->delete();
			Theme::findOne($theme->theme_id)->delete();
	    }
	    $post['link_image']=$image_name;
	    $block->link_image=$post['link_image'];
	    $is_true=true;
//	    echo "vijay";
//	    die;
	}
	
	
	if($is_true){
	    
	    //if($post['block_id']){
	    $block->save(false);
	    return $block;
	//	
	//	}else{
	//	    $block->block_id=$post['block_id'];
	//	    $block->udpate();
	//	}    
	}
	return array("empty block!...");;
	
	
	/*`block_id`, `qard_id`, `theme_id`, `status`, `is_title`, `text`, `extra_text`, `link_url`, `link_image`, `link_document`, `link_title`, `link_description`, `block_priority`, `block_name`, `placeholder_text`, `help_text`
	
	$block->link_url=$post['link_url'];
	$block->link_image=$post['link_image'];
	$block->link_document=$post['link_document'];
	$block->link_title=$post['link_title'];
	$block->link_description['link_description'];
	*/
	
	
    }    
    
    /**
    * @inheritdoc
    */
    public function beforeAction($action)
    {            
	if ($action->id == 'upload' || $action->id == 'deleteBlock' || $action->id=='change-priority') {
	    $this->enableCsrfValidation = false;
	}

	return parent::beforeAction($action);
    }
    
    
    public function actionDeleteBlock(){
	$id=Yii::$app->request->post('block_id');
	if($id){
	    $block=Block::findOne(['block_id'=>$id]);
	    Block::deleteAll(['block_id'=>$id]);
	    Theme::deleteAll(['theme_id'=>$block->theme_id]);
	    echo json_encode(array("status"=>"success","response"=>"Deleted Successfully"));
	    exit(0);
	}else{
	    echo json_encode(array("status"=>"failed","response"=>"Block id not present"));
	}
		
    }
    
    public function actionChangePriority() {
	
	$priority_arr=Yii::$app->request->post();
	foreach ($priority_arr as $value){
	    $block=Block::findOne(['block_id'=>$value[1]]);
	    $block->block_priority=$value[0];
	    $block->save(false);
	}
	
	
    }
    
}
