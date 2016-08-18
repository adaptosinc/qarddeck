<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */

$this->params['breadcrumbs'][] = ['label' => 'Edit Profile', 'url' => ['profile']];
$this->params['breadcrumbs'][] = 'Edit';


?> 
  
<?php
use app\components\ProfileWidget;
if(Yii::$app->user->id)
	  echo ProfileWidget::widget();
?>			
             