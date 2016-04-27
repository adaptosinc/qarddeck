<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Edit Profile: ' . $profile->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Edit Profile', 'url' => ['profile']];
$this->params['breadcrumbs'][] = 'Edit';

?>
<h1><?= Html::encode($this->title) ?></h1>

<?php
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'username')->textInput() ?>
<?= $form->field($profile, 'firstname')->textInput() ?>
<?= $form->field($profile, 'lastname')->textInput() ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'verify_password')->passwordInput() ?>
<?= $form->field($model, 'email')->textInput() ?>
<?= $form->field($profile, 'short_description')->textArea(['rows' => '6']); ?>
<?= $form->field($profile, 'profile_photo')->fileInput() ?>
<?= $form->field($profile, 'profile_bg_image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>