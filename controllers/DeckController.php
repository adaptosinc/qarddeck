<?php

namespace app\controllers;

use Yii;
use app\models\Deck;
use app\models\QardDeck;
use \app\models\Tag;
use app\models\search\SearchDeck;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\db\Command;
use yii\db\Connection;

/**
 * DeckController implements the CRUD actions for Deck model.
 */
class DeckController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','my-decks'],
                'rules' => [
/*                  [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ], */
                    [
                        'allow' => true,
                        'actions' => ['create','my-decks'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Deck models.
     * @return mixed
     */
/*     public function actionIndex()
    {
        $searchModel = new SearchDeck();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } */
	
    /**
     * Lists all Deck of logged in user.
	 * @param intger $page
     * @return mixed
     */
	public function actionMyDecks($page=null)
	{
		$limit = 5;
		if(!$page)
			$page = 0;
		$offset = $page*$limit;
		$feed = $this->getDecksfeed($offset,$limit);
		if(!$page || $page == 0){
			return $this->render('my_decks',[
				'feed' => $feed
			]);
		}
		else{
			return $feed;		
		}
	}
	
	/**
	 * Deck feed function
	 * @param integer $offset,$limit
	 * @return html
	 */	
	public function getDecksfeed($offset,$limit){
		$feed = '';
		$Query = new Query;
		$Query->select(['*'])
			->from('deck')
			->where(['user_id'=>\Yii::$app->user->id])
			->limit($limit)
			->offset($offset)
			->orderBy(['created_at' => SORT_DESC]);	
		$command = $Query->createCommand();
		$decks = $command->queryAll();
		//get html feed
		foreach($decks as $deck){
			$model = Deck::findOne([$deck['deck_id']]);
			$modelFeed = $model->getDeckHtml();
			if( $modelFeed != '')
				$feed .= $modelFeed;
		}
		return	$feed;		
	}
	
	/**
	 * Deck selection screen for add-to-deck 
	 * @return html
	 */
	public function actionSelectDeck(){
		
		$decks = Deck::find()->where(['user_id'=>Yii::$app->user->id])->orderBy('created_at DESC')->all();
		$html = '';
		foreach($decks as $deck){
			//make html $html.='';
			
			$declqardcount = $deck->getDeckqardCount();	
			
			$html .= '<div class="grid-item" id="'.$deck->deck_id.'" onClick="addToDeck(this)">';
				$html.= '<div class="grid-img">'; //grif image
					$html.= '<img src="'.$deck->bg_image.'" alt="">';
				$html.= '</div>'; //grif image
				$html.='<div class="grid-content">'; //grid-content
					$html.='<h4>'.$deck->title.'</h4>';
					$html.='<div class="col-sm-4 col-md-4">
                                <img src="'.Yii::$app->request->baseUrl.'/images/qards_icon.png" alt="">
								'.$declqardcount.'
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <button class="btn btn-grey"><img src="'.Yii::$app->request->baseUrl.'/images/preview_icon.png" alt="">Preview</button>
                            </div>';
				$html.='</div>';//grid-content
			$html .= '</div>'; //grid item
		}
		
		
	
		return $html; 
	
	}


	/**
	 * Add qard to a Deck
	 * @param integer $deck_id,$qard_id
	 * @return boolean
	 */
	public function actionAddQard(){
		//print_r(Yii::$app->request->post());die;
		$qard_id = Yii::$app->request->post()['qard_id'];
		$deck_id = Yii::$app->request->post()['deck_id'];
		
		//since a qard can only for one deck at a time
		//delete all other mappings before you add one
		$existing_model = QardDeck::find()->where(['qard_id'=>$qard_id])->one();
		//print_r($existing_model);die;
		if(isset($existing_model))
			QardDeck::findOne($existing_model->qd_id)->delete();		
		$model = new QardDeck();
		$model->qard_id = $qard_id;
		$model->deck_id = $deck_id;
		if($qard_id != 0 && $deck_id != 0 ){
			$model->save();	
				echo "Success";			
		}
		else
				echo "Failed";		
	}
	/**
	 * Remove qard from Deck
	 * @return  boolean
	 */
	public function actionRemoveQard(){
		$qard_id = Yii::$app->request->post()['qard_id'];
		$existing_model = QardDeck::find()->where(['qard_id'=>$qard_id])->one();
		//print_r($existing_model);die;
		if(isset($existing_model))
			QardDeck::findOne($existing_model->qd_id)->delete();
		return true;
	}
    /**
     * Displays a single Deck model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	$model= $this->findModel($id);
	$count_bookmark  = $model->deckqardbookmarkCount;
	$count_share  = $model->deckqardshareCount;
	$count_liked  = $model->deckqardlikeCount;
	
	return $this->render('view', [
            'model' =>$model ,"count_bookmark" =>$count_bookmark,"count_share" =>$count_share,"count_liked" =>$count_liked
        ]);
    }
    /**
     * Displays a single Deck model.
     * @param integer $id
     * @return mixed
     */
    public function actionManage($id)
    {
        $model = $this->findModel($id);
		$model->cover_image = $model->bg_image;
		$tags = Tag::find()->all();

        if (Yii::$app->request->post()) {
			$model->title = Yii::$app->request->post()['title'];
			$model->description = Yii::$app->request->post()['description'];
			if($model->save()){
				if(isset(Yii::$app->request->post()['tags'])){
					//delete all tags first
					$command = \Yii::$app->db->createCommand()->delete('deck_tags', [
						'deck_id' => $model->deck_id,
					]);
					$command->execute();
					//then update
					$tags = Yii::$app->request->post()['tags'];
					foreach($tags as $tag){
						$command = \Yii::$app->db->createCommand()->insert('deck_tags', [
							'deck_id' => $model->deck_id,
							'tag_id'=> $tag,
						]);
						$command->execute();					
					}
				
				}				
			}
            //return $this->redirect(['view', 'id' => $model->deck_id]);
			return "Success";
        } else {
        return $this->render('manage', [
            'model' =>  $model,
			'tags' => $tags
        ]);
        }

    }
    /**
     * Creates a new Deck model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Deck();
		$tags = Tag::find()->all();
        if ($model->load(Yii::$app->request->post())) {
			//print_r(Yii::$app->request->post()['tags']);die;
			$model->bg_image = $model->cover_image;
			$model->user_id = \Yii::$app->user->id;
			if($model->save()){
				if(isset(Yii::$app->request->post()['tags'])){
					$tags = Yii::$app->request->post()['tags'];
					foreach($tags as $tag){
						$command = \Yii::$app->db->createCommand()->insert('deck_tags', [
							'deck_id' => $model->deck_id,
							'tag_id'=> $tag,
						]);
						$command->execute();					
					}
				
				}				
			}
            return $this->redirect(['manage','id'=>$model->deck_id]);
        } else {
            return $this->render('create_deck', [
                'model' => $model,
				'tags' => $tags,
            ]);
        }
    }
	
	/**
	 * Add a new deck from select deck pop up
	 * @param null
	 * @return Json
	 */	 
	public function actionCreateAjax(){
		  
		/*   $uploadFile = UploadedFile::getInstanceByName('bg_image');
		  
		  $directory = \Yii::getAlias('@app/web/uploads') . DIRECTORY_SEPARATOR . Yii::$app->session->id . DIRECTORY_SEPARATOR;
		
			if ($uploadFile) {
				$uid = uniqid(time(), true);
				$fileName = $uid . '.' . $uploadFile->extension;
				$filePath = $directory . $fileName;		
				$path = '../uploads/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
				
				if ($uploadFile->saveAs($filePath)){ */
				
				  $title = Yii::$app->request->post()['title'];		
				  $path = Yii::$app->request->post()['bg_image'];		
				  $model = new Deck();				
				  $model->user_id = Yii::$app->user->getId();//uid
				  $model->title = $title;//title				  
				  $model->bg_image = $model->cover_image=$path; //image
				  $model->save();				  
					
					return Json::encode([					
							'title'=> $title,
							"url" => $path								
					]);
				//}
			//} 
 
	 }
	 
	/**
	 * Upload file corresponding  to the cover image of a deck
	 * @param null
	 * @return Json
	 */		 
	public function actionSetCoverImage(){
		$imageFile = UploadedFile::getInstanceByName('Deck[bg_image]');
		$directory = \Yii::getAlias('@app/web/img/temp') . DIRECTORY_SEPARATOR . Yii::$app->session->id . DIRECTORY_SEPARATOR;
		if (!is_dir($directory)) {
			mkdir($directory);
		}
		if ($imageFile) {
			$uid = uniqid(time(), true);
			$fileName = $uid . '.' . $imageFile->extension;
			$filePath = $directory . $fileName;
			if ($imageFile->saveAs($filePath)) {
				$path = '../img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
				$thmbnail = stripslashes($path);
				return Json::encode([
					'files' => [[
						'name' => $fileName,
						'size' => $imageFile->size,
						"url" => $path,
						"thumbnailUrl" => $thmbnail,
						"deleteUrl" => 'image-delete?name=' . $fileName,
						"deleteType" => "POST"
					]]
				]);
			}
		}
		return '';		
	}
	
    /**
     * Updates an existing Deck model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->cover_image = $model->bg_image;
		$tags = Tag::find()->all();

        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
				if(isset(Yii::$app->request->post()['tags'])){
					//delete all tags first
					$command = \Yii::$app->db->createCommand()->delete('deck_tags', [
						'deck_id' => $model->deck_id,
					]);
					$command->execute();
					//then update
					$tags = Yii::$app->request->post()['tags'];
					foreach($tags as $tag){
						$command = \Yii::$app->db->createCommand()->insert('deck_tags', [
							'deck_id' => $model->deck_id,
							'tag_id'=> $tag,
						]);
						$command->execute();					
					}
				
				}				
			}
            //return $this->redirect(['view', 'id' => $model->deck_id]);
			return $this->redirect(['my-decks']);
        } else {
            return $this->render('update', [
                'model' => $model,
				'tags' => $tags,
            ]);
        }
    }

    /**
     * Deletes an existing Deck model.
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
     * Finds the Deck model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Deck the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deck::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
