<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Qard */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Qards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qard-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->qard_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->qard_id], [
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
            'qard_id',
            'user_id',
            'qard_theme',
            'qard_privacy',
            'status',
            'title:ntext',
            'url:ntext',
            'description:ntext',
            'bg_image:ntext',
        ],
    ]) ?>

</div>