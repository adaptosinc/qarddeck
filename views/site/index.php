<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\assets\AppAsset;
if(isset($_GET['login']) && $_GET['login']=='true' && \Yii::$app->user->isGuest ){
?>
<script>
	$('.pull-right button[data-target="#myModal"]').trigger('click');	
</script>
<?php
}
?>

	<section class="home-main content">
		<h1>Share what you love, think, and know. Easily.</h1>
		<div class="action-qard">
			<button class="btn qard" onclick="location.href='<?php echo \Yii::$app->homeUrl;?>qard';">Qards in Action</button>
			<button class="btn btn-warning" onclick="location.href='<?php echo \Yii::$app->homeUrl;?>qard/create';">Create a Qard</button>
			<button class="btn btn-default">Watch the Video</button>
		</div>
		<div class="qards-list">        <!-- qard list -->
			<div class="row">
				<div class="col-sm-3 col-md-3">     <!-- qard -->
					<div class="qard-list-img">
						<img src="<?=\Yii::$app->homeUrl?>images/curate_illustration.png" alt="">
					</div>
						<h4>Curate & Create</h4>
				</div>
				<div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
					<div class="qard-list-img">
						<img src="<?=\Yii::$app->homeUrl?>images/share_illustration.png" alt="">
					</div>                            
						<h4>Share.</h4>
				</div>
				<div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
					<div class="qard-list-img">
						<img src="<?=\Yii::$app->homeUrl?>images/link_illustration.png" alt="">
					</div>                            
						<h4>Link.</h4>
				</div>                            
			</div>      <!-- row  -->
		</div>      <!-- qard list -->
	</section>
