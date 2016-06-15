<?php

namespace app\controllers;

use Yii;
use app\models\Qard;
use app\models\Theme;
use app\models\search\SearchQard;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\Command;
/**
 * QardController implements the CRUD actions for Qard model.
 */
class QardController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Qard models.
     * @return mixed
     */
/*     public function actionIndex(){
        
        $searchModel = new SearchQard();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } */
	
    /**
     * Lists all Qard models.
     * @return mixed
     */
    public function actionIndex($page=null){ 
		$limit = 5;
		if(!$page)
			$page = 0;
		$offset = $page*$limit;
		$feed = $this->getQardsfeed($offset,$limit);
		//	print_r($feed);die;
		if(!$page || $page == 0){
			return $this->render('qard_stream',[
				'feed' => $feed,
			]);		
		}
		else{
			return $feed;		
		}

	 }

    public function getQardsfeed($offset,$limit){
		$feed = '';
		$Query = new Query;
		$Query->select(['*'])
		->from('qard')
		->limit($limit)
		->offset($offset)
		->orderBy(['last_updated_at' => SORT_DESC]);
		
		$command = $Query->createCommand();
		$qards = $command->queryAll();
		//get html feed
		foreach($qards as $qard){
			$model = Qard::findOne([$qard['qard_id']]);
			$modelFeed = $model->getQardHtml();
			if( $modelFeed != '')
				$feed .= $modelFeed;
		}
		return	$feed;
	}
	
    /**
     * Displays a single Qard model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$this->layout = "plain";
		$model = $this->findModel($id);
		$single = true;
		$modelFeed = $model->getQardHtml($single);	
		//print_r($modelFeed);die;
        return $this->render('view', [
            'model' => $modelFeed,
        ]);
    }

    /**
     * Creates a new Qard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($theme_id=null)
    {
        $model = new Qard();
		if(!$theme_id){
			//go and select a theme and then come back
			return $this->redirect(['theme/select-theme']);
		}
		else{
			$theme = Theme::findOne($theme_id);
			if(!$theme){
				\Yii::$app->getSession()->setFlash('error', 'Please select a theme');
				return $this->redirect(['theme/select-theme']);
			}
		}
        if ($model->load(Yii::$app->request->post())) {
			
			$model->save(false);
			if(!\Yii::$app->user->id){
				//save false here with out user id and status as draft
				//$model->save(false);
				//aftersave take the qard-id as a param and send to login page
				\Yii::$app->session['qard']= $model->qard_id;
				return $this->redirect(['user/login','qard_id'=>$q_id]);
				//at login/sign-up,check if qard-id is there,if yes assign the user to the same qard once logged in
			}
            return $this->redirect(['view', 'id' => $model->qard_id]);
        } else {
	    $tags=\app\models\Tag::find()->all();
            if(!$this->isMobile()){ 
                return $this->render('create', [
                    'model' => $theme->attributes,
		    'tags'=>$tags
                ]);
            }else{
                $this->layout = 'mobilelayout';
                return $this->render('mobile/create', [
                    'model' => $model,
                ]);                
            }
	    
        }
	
    }

    /**
     * Updates an existing Qard model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id){
        
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->qard_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        
    }

    /**
     * Deletes an existing Qard model.
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
	 * Fetch the h2 and image from a url 
	 * For url preview
	 * @param string $url
	 * @return mixed
	 */
	public function actionUrlPreview($url){
		
			//$url = $_POST['url'];		
			$c = curl_init($url);			
			$options = array(
				CURLOPT_RETURNTRANSFER => true,     // return web page
				CURLOPT_HEADER         => false,    // don't return headers
				CURLOPT_FOLLOWLOCATION => true,     // follow redirects
				CURLOPT_ENCODING       => "",       // handle all encodings
				CURLOPT_USERAGENT      => "spider", // who am i
				CURLOPT_AUTOREFERER    => true,     // set referer on redirect
				CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
				CURLOPT_TIMEOUT        => 120,      // timeout on response
				CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
				CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
			);
			curl_setopt_array( $c, $options );
			$html = curl_exec($c);
			$mimeType = curl_getinfo($c, CURLINFO_CONTENT_TYPE);
			if($mimeType == 'application/pdf') {
				echo "PDF";die;
			}
                        if($mimeType == 'application/msword') {
				echo "DOC";die;
			}
                        if($mimeType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
				echo "DOCX";die;
			}
                        
			//echo $html;
			/******************************/
			if (curl_error($c))
			$status = curl_getinfo($c, CURLINFO_HTTP_CODE);
			curl_close($c);	
			$doc = new \DOMDocument();
			@$doc->loadHTML($html);
			/******************************/
			$img_array = [];
			$content = false;
			$title =false;
			$image = false;
			/******************************/
			//h2's first
			$titles = $doc->getElementsByTagName('title');
			if($titles->length > 0){ 
				foreach($titles as $title){
					$title = $title->textContent;
				}
			}
			/******************************/
			//get image and content from meta
			$metas = $doc->getElementsByTagName('meta');
			if($metas->length > 0){
				foreach($metas as $meta){
					if($meta->getAttribute('property') == 'og:image' && $meta->getAttribute('content')!= '')
						$img_array[] = $meta->getAttribute('content');
					if($meta->getAttribute('name') && $meta->getAttribute('name')=='description')
						$content = $meta->getAttribute('content');
				}				
			}
			//if no image from meta
			if(count($img_array) == 0 ){
				$images = $doc->getElementsByTagName('img');
				if($images->length > 0){
					foreach($images as $img){
						if($img->getAttribute('src')!='')
							$img_array[] = $img->getAttribute('src');
					}
				}				
			}
			if(isset($img_array[0]))
				$image = $img_array[0];
			//if no content from meta
			if(!$content){
				$ps = $doc->getElementsByTagName('p');
				if($ps->length > 0)
					$i=0;
					foreach($ps as $p){
						//we need only the first P
						if($i==0)
							$content = $p->textContent;
						$i++;
					}
			}
			/******************************/
			$parse = parse_url($url);
			$domain = $parse['scheme'] . '://' . $parse['host'] . '/';
			$base_url = '';	
			// singlebyte strings
			$first =  substr($image, 0, 1);
			$result = substr($image, 0, 2);
			if($first == '/' && $result != '//')
				$image = $domain.$image;
			//echo $domain;echo $result;
			/******************************/
			//;die;
			/**
			echo '
			<div class="review-qard row">
				<div class="img-preview col-sm-3 col-md-3">
					<img src="'.$image.'" alt="">
				</div>
				<div class="col-sm-9 col-md-9">
					<div class="url-content">
						<h4>'.$title.'</h4>
						<div class="url-text">
							<p>'.$content.'</p>
						</div>
					</div>                                            
				</div>
			</div> 
			';
			**/
			echo '
			<div id="review-qard-id" class="review-qard row" id="">
				<div class="img-preview col-sm-3 col-md-3">';
			if($image)
				echo '<img src="'.$image.'" alt="">';
			else
				echo '<i class="fa fa-file-image-o" style="font-size: 12em;" aria-hidden="true"></i>';
			echo '<button id="url_img_remove" onClick="changePic(this)" class="btn btn-default btn-remove">Remove</button>
				</div>
				<div class="col-sm-9 col-md-9" id="title_desc_url">
					<div class="url-content">
						<h4><input name="url_title" type="text" class="form-control" value="'.$title.'" /></h4>
						<div class="url-text">
							<p><textarea name="url_content" class="form-control">'.$content.'</textarea></p>
						</div>
					</div>                                
				</div>
			</div> 
			';
			/**/
			echo '<div> <h3>Consume Preview</h3>';
			//echo "<div><h1>".$title."</h1>";
			//echo "<img src='".$image."' />";
			//echo "<p>".$content."</p>";
			if($this->isFrameAllowed($url))
				echo '<iframe sandbox="allow-scripts allow-forms" src="'.$url.'" style="border:none"  width="100%" height="500px" ></iframe></div>';
			else echo '<div style="color: red;">Framing is not allowed for this site. Please enable "Open Link in New Tab"</div>';
			//full content
			echo '</div>';

			//print_R($img_array);
	}
	public function actionRenderFrame($url){
		$parse = parse_url($url);
		$domain = $parse['scheme'] . '://' . $parse['host'] . '/';
		$content = file_get_contents($url);
		$base_url = '';
		$content = str_replace('', $base_url . '', $content);
		$content = str_replace('src="/', 'src="' . $domain, $content);
		$content = str_replace('href="/', 'href="' . $domain, $content);

		echo $content;
	}
	public function isFrameAllowed($url){
		$h = get_headers($url,1);
/* 		print_r($h);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FILETIME, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);	
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
		$headers = curl_exec($curl);	
		$info = curl_getinfo($curl);
		print_r($headers);
		print_r($info); */
		if(isset($h['X-Frame-Options'])){
			if($h['X-Frame-Options'] == "sameorigin" || $h['X-Frame-Options'] =="SAMEORIGIN" ||  $h['X-Frame-Options'] == "DENY" || $h['X-Frame-Options'] == "deny")
				return false;
			else
				return true;
		} 
		else
		 return true;
	}
	
	/**
	 * Save a screenshot of the qard
	 * Using html2canvas
	 * Saves to uploads/qards folder
	 * Returns filename or error
	 */
	public function actionSaveBlob(){

		define('UPLOAD_DIR', 'uploads/qards/');
		$post_body = file_get_contents('php://input');
		$img = $_POST['img'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = 'uploads/qards/' . uniqid() . '.png';
		$success = file_put_contents($file, $data);
		print $success ? $file : 'Unable to save the file.';
	
	}
	
    /**
     * Finds the Qard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Qard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Qard::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }     
    public function actionTest() {	
		return $this->render('test');	
    }
    public function actionWyiswyg() {	
		return $this->render('wyiswyg');	
    }
     public function isMobile(){
         return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    public function beforeAction($action)
    {            
	if ($action->id == 'url' ) {
	    $this->enableCsrfValidation = false;
	}

	return parent::beforeAction($action);
    }
    
 
    /**
     * Uploads the document
     * @return uploaded file name
     */    
        public function actionUrl(){
           
                if (Yii::$app->request->isAjax) {  
                     $uploaded = array(); 
                     if(isset($_FILES['files']['tmp_name'])){
                        
                        // Number of uploaded files
                        $num_files = count($_FILES['files']['tmp_name']);
                        $upload_dir = Yii::$app->basePath.'\web\uploads\docs\\';
                        /** loop through the array of files ***/
                        for($i=0; $i < $num_files;$i++)
                        {
                           
                           // copy the file to the specified dir 
                           if(move_uploaded_file($_FILES['filename']['tmp_name'],$upload_dir.'/'.$_FILES['filename']['name']))
                                {
                                     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                                        return [
                                           'code' => $_FILES['filename']['name'],
                                        ];
                                   
                                }
                               
                            
                        }
                    }                    
               }
        }
     /**
     * Uploads the document
     * @return uploaded file name
     */ 
        public function actionSimple(){
           if (Yii::$app->request->isAjax) {  
                  if($_FILES["file"]['name']){
                            $move = Yii::$app->basePath.'\web\uploads\docs\\';              
                            $moveto = $move.$_FILES["file"]['name'];
                            $_FILES["file"]['tmp_name'];
                            $_FILES["file"]['size'];
                            $_FILES['file']['error'];
                                 if(file_exists($move.$_FILES["file"]['name'])) {
                                      //chmod($move.$_FILES["file"]['name'],0755); //Change the file permissions if allowed
                                      unlink($move.$_FILES["file"]['name']); //remove the file
                                  }
                            move_uploaded_file($_FILES['file']['tmp_name'], $move.$_FILES["file"]['name']);
                            $prof_img_path =  $_FILES["file"]['name'];
//         //                   $profile->temp_image = "uploads/".$prof_img_path; 
//         //                   $profile->save(false);
                             \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                             return [
                                 'code' => $_FILES["file"]['name'],
                             ];
     }}
           }
     
}