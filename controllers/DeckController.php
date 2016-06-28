<?php

namespace app\controllers;

use Yii;
use app\models\Deck;
use app\models\search\SearchDeck;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;

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
        ];
    }

    /**
     * Lists all Deck models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchDeck();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

        if ($model->load(Yii::$app->request->post())) {
			$model->bg_image = $model->cover_image;
			$model->save();
            return $this->redirect(['view', 'id' => $model->deck_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->deck_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
