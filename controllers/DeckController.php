<?php

namespace app\controllers;

use Yii;
use app\models\Deck;
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
	 * 
	 */
	public function actionSelectDeck(){
		
		$decks = Deck::find()->where(['user_id'=>Yii::$app->user->id])->all();
		$html = '<div class="grid">';
		foreach($decks as $deck){
			//make html $html.='';
			$html .= '<div class="grid-item">';
				$html.= '<div class="grid-img">'; //grif image
					$html.= '<img src="'.$deck->bg_image.'" alt="">';
				$html.= '</div>'; //grif image
				$html.='<div class="grid-content">'; //grid-content
					$html.='<h4>'.$deck->title.'</h4>';
					$html.='<div class="col-sm-4 col-md-4">
                                <img src="'.Yii::$app->request->baseUrl.'/images/qards_icon.png" alt="">20
                            </div>
                            <div class="col-sm-8 col-md-8">
                                <button class="btn btn-grey"><img src="'.Yii::$app->request->baseUrl.'/images/preview_icon.png" alt="">Preview</button>
                            </div>';
				$html.='</div>';//grid-content
			$html .= '</div>'; //grid item
		}
		//add new form
		$html .= '<button id="add_new_deck" class="btn" data-toggle="modal" onClick="showModal(this)" >Add New</button>';
		$html .= '</div>';
		
		return $html; 
	}
    /**
     * Displays a single Deck model.
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
            return $this->redirect(['my-decks']);
        } else {
            return $this->render('create', [
                'model' => $model,
				'tags' => $tags,
            ]);
        }
    }
    /**
     * Creates a new Deck model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateAjax()
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
           // return $this->redirect(['my-decks']);
        } else {
            return $this->renderPartial('_form', [
                'model' => $model,
				'tags' => $tags,
            ]);
        }
    }
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
				return Json::encode([
					'files' => [[
						'name' => $fileName,
						'size' => $imageFile->size,
						"url" => $path,
						"thumbnailUrl" => $path,
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
