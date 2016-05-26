<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Qard */

$this->title = 'Update Qard: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Qards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->qard_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qard-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
