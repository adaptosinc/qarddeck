<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SearchBlock */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Block', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'block_id',
            'qard_id',
            'theme_id',
            'status',
            'is_title',
            // 'text:ntext',
            // 'extra_text:ntext',
            // 'link_url:ntext',
            // 'link_image:ntext',
            // 'link_document:ntext',
            // 'link_title:ntext',
            // 'link_description:ntext',
            // 'block_priority',
            // 'block_name',
            // 'placeholder_text:ntext',
            // 'help_text:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
