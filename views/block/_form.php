<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Block */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="block-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'qard_id')->textInput() ?>

    <?= $form->field($model, 'theme_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'is_title')->textInput() ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'extra_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link_image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link_document')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link_title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'block_priority')->textInput() ?>

    <?= $form->field($model, 'block_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'placeholder_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'help_text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
