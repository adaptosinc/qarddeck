<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\QardComments */

$this->title = 'Create Qard Comments';
$this->params['breadcrumbs'][] = ['label' => 'Qard Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qard-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
