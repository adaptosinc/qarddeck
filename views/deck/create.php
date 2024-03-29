<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Deck */

$this->title = 'Add Deck';
$this->params['breadcrumbs'][] = ['label' => 'Decks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deck-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
		'tags' => $tags,
    ]) ?>

</div>
