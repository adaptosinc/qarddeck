<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container-fluid desktop-view">  
<?= $content ?>    
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>