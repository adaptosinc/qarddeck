<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'Edit Profile', 'url' => ['profile']];
$this->params['breadcrumbs'][] = 'Edit';
?>      
<!-- Edit Account -->

<?php
use app\components\NewpwdWidget;
if(Yii::$app->user->id)
	  echo NewpwdWidget::widget();
?>

