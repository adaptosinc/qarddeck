<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SearchQard */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qards';
$this->params['breadcrumbs'][] = $this->title;
?>


 
<div class="qard-index">


 
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Qard', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'qard_id',
            'user_id',
            'qard_theme',
            'qard_privacy',
            'status',
            // 'title:ntext',
            // 'url:ntext',
            // 'description:ntext',
            // 'bg_image:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
