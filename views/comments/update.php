<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QardComments */

$this->title = 'Update Qard Comments: ' . $model->qard_comment_id;
$this->params['breadcrumbs'][] = ['label' => 'Qard Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->qard_comment_id, 'url' => ['view', 'id' => $model->qard_comment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qard-comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
