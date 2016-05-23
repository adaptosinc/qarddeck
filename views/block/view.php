<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Block */

$this->title = $model->block_id;
$this->params['breadcrumbs'][] = ['label' => 'Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->block_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->block_id], [
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
            'block_id',
            'qard_id',
            'theme_id',
            'status',
            'is_title',
            'text:ntext',
            'extra_text:ntext',
            'link_url:ntext',
            'link_image:ntext',
            'link_document:ntext',
            'link_title:ntext',
            'link_description:ntext',
            'block_priority',
            'block_name',
            'placeholder_text:ntext',
            'help_text:ntext',
        ],
    ]) ?>

</div>
