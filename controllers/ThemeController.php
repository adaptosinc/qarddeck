<?php

namespace app\controllers;

use Yii;
use app\models\Theme;
use app\models\search\SearchTheme;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * ThemeController implements the CRUD actions for Theme model.
 */
class ThemeController extends Controller
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
                'only' => ['create','update'],
                'rules' => [
/*                  [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ], */
                    [
                        'allow' => true,
                        'actions' => ['create','update'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Theme models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchTheme();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Theme models.
	 * Used for selecting the theme
     * @return mixed
     */	
	 public function actionSelectTheme($qard_id=null,$deck_id=null)
	 {		
		$models = Theme::find()->where(['theme_type'=>1])->all();
		return $this->render('index_theme',[
			'models' => $models,
			'qard_id' => $qard_id,
			'deck_id' => $deck_id,
		]);
	 }
	 
	 
    /**
     * Displays a single Theme model.
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
     * Creates a new Theme model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if( !\Yii::$app->user->identity->isAdmin()){
			//throw new NotFoundHttpException();
			throw new ForbiddenHttpException();
		}
        $model = new Theme();
		$model->scenario = 'qard_theme';

        if ($model->load(Yii::$app->request->post())) {
			//print_r($model);die;
			list($r, $g, $b) = sscanf('#'.$model->overlay_color, "#%02x%02x%02x");
			$opacity = $model->overlay_opacity/100;
			$model->overlay_color = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
			$theme_properties = [
				'theme_color_1' => '#'.$model->theme_color_1,
				'theme_color_2' => '#'.$model->theme_color_2,
				'theme_color_3' => '#'.$model->theme_color_3,
				'theme_color_4' => '#'.$model->theme_color_4,
				'theme_color_5' => '#'.$model->theme_color_5,
				'light_text_color' => '#'.$model->light_text_color,
				'dark_text_color' => '#'.$model->dark_text_color,
				'light_link_color' => '#'.$model->light_link_color,
				'dark_link_color' => '#'.$model->dark_link_color,
				'overlay_opacity' => $model->overlay_opacity,
				'overlay_color' => $model->overlay_color,
				'block_background_color' => '#'.$model->block_background_color,				
			];
			$model->theme_type = 1; //for qard
			$model->theme_properties = serialize($theme_properties);
			$model->save();
            return $this->redirect(['select-theme']);
        } else {
            return $this->render('create_theme', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Theme model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->scenario = 'qard_theme';
		$theme_properties = unserialize($model->theme_properties);
		$model->theme_color_1 = $theme_properties['theme_color_1'];
		$model->theme_color_2 = $theme_properties['theme_color_2'];
		$model->theme_color_3 = $theme_properties['theme_color_3'];
		$model->theme_color_4 = $theme_properties['theme_color_4'];
		$model->theme_color_5 = $theme_properties['theme_color_5'];
		$model->light_text_color = $theme_properties['light_text_color'];
		$model->dark_text_color = $theme_properties['dark_text_color'];
		$model->light_link_color = $theme_properties['light_link_color'];
		$model->dark_link_color = $theme_properties['dark_link_color'];
		$model->overlay_opacity = $theme_properties['overlay_opacity'];
		$model->overlay_color = $theme_properties['overlay_color'];
		$model->block_background_color = $theme_properties['block_background_color'];
	
        if ($model->load(Yii::$app->request->post())) {
			list($r, $g, $b) = sscanf('#'.$model->overlay_color, "#%02x%02x%02x");
			$opacity = $model->overlay_opacity/100;
			$model->overlay_color = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
			$theme_properties = [
				'theme_color_1' => '#'.$model->theme_color_1,
				'theme_color_2' => '#'.$model->theme_color_2,
				'theme_color_3' => '#'.$model->theme_color_3,
				'theme_color_4' => '#'.$model->theme_color_4,
				'theme_color_5' => '#'.$model->theme_color_5,
				'light_text_color' => '#'.$model->light_text_color,
				'dark_text_color' => '#'.$model->dark_text_color,
				'light_link_color' => '#'.$model->light_link_color,
				'dark_link_color' => '#'.$model->dark_link_color,
				'overlay_opacity' => $model->overlay_opacity,
				'overlay_color' => $model->overlay_color,
				'block_background_color' => $model->block_background_color,		
			];
			$model->theme_type = 1; //for qard
			$model->theme_properties = serialize($theme_properties);
			$model->save();
            return $this->redirect(['select-theme']);
        } else {
            return $this->render('create_theme', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Theme model.
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
     * Finds the Theme model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Theme the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Theme::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
