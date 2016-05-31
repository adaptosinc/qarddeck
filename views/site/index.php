
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\assets\AppAsset;
?>
<section class="home-main content">
    
    <h3>Share what you love,think and know. <strong>Easily.</strong></h3>
    <h5 class="text-success"><b><?= Yii::$app->session->getFlash('twitter-success');?></b></h5>
    <h5 class="text-success><b><?= Yii::$app->session->getFlash('fb-success');?></b?</h5>
    <div class="action-qard">
	<button class="btn btn-default qard">Qards in Action</button>
	<button class="btn btn-warning" onClick="window.location = '<?php echo \Yii::$app->homeUrl?>/qard/create';">Create a Qard</button>
	<button class="btn btn-default qard">Introductory Video</button>
    </div>
    <div class="qards-list">        <!-- qard list -->
	<div class="row">
	    <div class="col-sm-3 col-md-3">     <!-- qard -->
		<div class="qard-content">

		</div>
		<div class="qard-bottom">
		    <h4>Curate & Create</h4>
		</div>
	    </div>
	    <div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
		<div class="qard-content">

		</div>
		<div class="qard-bottom">
		    <h4>Share</h4>
		</div>
	    </div>
	    <div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
		<div class="qard-content">

		</div>
		<div class="qard-bottom">
		    <h4>Link</h4>
		</div>
	    </div>                            
	</div>      <!-- row  -->
    </div>      <!-- qard list -->
</section>
