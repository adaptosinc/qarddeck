<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Block */

$this->title = 'Update Block: ' . $model->block_id;
$this->params['breadcrumbs'][] = ['label' => 'Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->block_id, 'url' => ['view', 'id' => $model->block_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="block-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
