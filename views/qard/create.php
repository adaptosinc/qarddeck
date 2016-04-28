<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Qard */

$this->title = 'Create Qard';
$this->params['breadcrumbs'][] = ['label' => 'Qards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qard-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
