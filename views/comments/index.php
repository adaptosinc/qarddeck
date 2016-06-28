<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\QardComments */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qard Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qard-comments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Qard Comments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'qard_comment_id',
            'parent_id',
            'qard_id',
            'user_id',
            'text:ntext',
            // 'status',
            // 'priority',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
