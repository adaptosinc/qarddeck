<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\QardComments */

$this->title = $model->qard_comment_id;
$this->params['breadcrumbs'][] = ['label' => 'Qard Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qard-comments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->qard_comment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->qard_comment_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'qard_comment_id',
            'parent_id',
            'qard_id',
            'user_id',
            'text:ntext',
            'status',
            'priority',
        ],
    ]) ?>

</div>
