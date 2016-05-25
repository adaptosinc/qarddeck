<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SearchBlock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="block-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'block_id') ?>

    <?= $form->field($model, 'qard_id') ?>

    <?= $form->field($model, 'theme_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'is_title') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'extra_text') ?>

    <?php // echo $form->field($model, 'link_url') ?>

    <?php // echo $form->field($model, 'link_image') ?>

    <?php // echo $form->field($model, 'link_document') ?>

    <?php // echo $form->field($model, 'link_title') ?>

    <?php // echo $form->field($model, 'link_description') ?>

    <?php // echo $form->field($model, 'block_priority') ?>

    <?php // echo $form->field($model, 'block_name') ?>

    <?php // echo $form->field($model, 'placeholder_text') ?>

    <?php // echo $form->field($model, 'help_text') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
