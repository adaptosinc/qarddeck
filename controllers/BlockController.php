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
     * Creates a new Block model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
	$post=Yii::$app->request->post();
	echo "viay";	
	
	
	
	//to create theme for qard
	$theme=$this->createTheme($post);
	
	if(empty($theme->errors) && !is_array($theme)){
	    
	    $qard=$this->createQard($post, $theme->theme_id);
	    
	    if(empty($qard->errors) && !is_array($qard)){
		$block=$this->createBlock($post,$qard->qard_id,$theme->theme_id);
		$tags=$this->createTagsQard($post,$qard->qard_id);
		
		if(empty($block->errors) && !is_array($block)){
		   // echo json_encode(array('qard_id'=>$qard->qard_id,'theme_id'=>$theme->theme_id,'block_id'=>$block->block_id));
		    echo "vijay";
		    exit;
		    
		}  else {
		    echo "unable to create block";
		    print_r($block->errors);
		}
		
	    }else{
		echo "unable to create qard";
		
		print_r($qard);
		echo Theme::findOne($theme->theme_id)->delete();
	    }
	    
	}else{
	    echo "unable to create theme";
	    print_r($theme->errors);
	}
	
//	$model->=\Yii::$app->request->post('tags');

	exit(0);
	
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->block_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
	$qard=new Qard();
	if(!empty($post['qard_title']) && !empty(Yii::$app->user->id) && !empty($theme_id)){
	    $qard->title=$post['qard_title'];
	    $qard->url='test url';
	    $qard->user_id=Yii::$app->user->id;
	    $qard->status=0;
	    $qard->qard_privacy=1;
	    $qard->qard_theme=$theme_id;
	    if(empty($post['qard_id'])){
		$qard->validate();
		$qard->save();
		return $qard;
	    }else{
		$qard->qard_id=$post['qard_id'];
		$qard->validate();
		$qard->update();
		return $qard;
		
	    }
	    
	}else{
	    return array('error'=>"empty fields!...");
	}
	
	
    }
    
    /*
     * create theme for qard
     */
    public function createTheme($post){
	
	$theme=new Theme();
	$theme->theme_type=1; //theme type 1 define theme for qard o theme for block
	$theme->theme_properties='test'; // serialized data all theme details
	
	//checking whether id present then update or else insert 
	if(empty($post['theme_id'])){
	    $theme->validate();
	    $theme->save();
	    return $theme;
	}else{
	    $theme->validate();
	    $theme->update();
	    return $theme;
	}
    }
    /*
     * 
     */
    public function createTagsQard($post,$qard_id){
	$qardTags=new QardTags();
	$tags=new Tag();
	//checking whether tags are present or not
	if(!empty($post['tags'])){
	    // tags are in string with comm format 
	    $tags=  explode(',', $post['tags']);
	    //deleting all records that are present with qard_id
	    QardTags::deleteAll(['qard_id'=>$qard_id]);
	    $tag_details='';
	    foreach ($tags as $tag) {
		// checking whether entered tags present in db or not if not then skip to insert
		$tag_details=Tag::find()->where(['name'=>$tag])->one();
		
		if(!empty($tag_details)){
		    $qardTags=new QardTags();
		    $qardTags->qard_id=$qard_id;
		    $qardTags->tag_id=$tag_details->tag_id;
		    if($qardTags->validate()){
			$qardTags->save();
		    }else{
			QardTags::deleteAll(['qard_id'=>$qard_id]);
			return $qardTags;
		    }
		}
		
	    }
	}else{
	    return array("empty tags!...");
	}
    }
    
    public function createBlock($post,$qard_id,$theme_id){
	
	$block=new Block();
	
	$block->qard_id=$qard_id;
	$block->theme_id=$theme_id;
	// 0 for temp, 1 form active , 2 delete, 3 for template
	$block->status=0;
	// 0 for no and 1 for yes
	$block->is_title=$post['is_title'];
	
	//for text
	
	$block->text=$post['text'];
	$block->extra_text=$post['extra_text'];
	
	
	$block->validate();
	//if($post['block_id']){
	$block->save();
//	
//	}else{
//	    $block->block_id=$post['block_id'];
//	    $block->udpate();
//	}
	
	/*`block_id`, `qard_id`, `theme_id`, `status`, `is_title`, `text`, `extra_text`, `link_url`, `link_image`, `link_document`, `link_title`, `link_description`, `block_priority`, `block_name`, `placeholder_text`, `help_text`
	
	$block->link_url=$post['link_url'];
	$block->link_image=$post['link_image'];
	$block->link_document=$post['link_document'];
	$block->link_title=$post['link_title'];
	$block->link_description['link_description'];
	*/
	
	
    }
    
    /* 
     * for image
     */
    public function actionUpload(){
	echo "http://localhost/qarddeck/web/uploads/3.png";
	die;
	
    }
}
