<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'My Decks';
?>

<div class="row">
	<div class="col-sm-9 col-md-9" >
		<div class="grid">
			<?php  
				//infinite scroll+masonry
				echo $feed;
			?>
		</div>

	</div>
</div>
<p id="loading" align="center" >
	<img src="<?php echo \Yii::$app->homeUrl; ?>images/loading.gif" width="100px" height="100px" alt="Loading…" />
</p>
<div class="modal fade in" id="deck-style" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Select a Deck to Add Qard to :<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></h4>
                            
                          </div>
                          <div class="modal-body">
                            <div class="grid">
                                <div class="grid-item">
                                    <div class="grid-img">
                                        <img src="<?php echo \Yii::$app->homeUrl; ?>/images/deck-thumb.png" alt="">
                                    </div>
                                    <div class="grid-content">
                                        <h4>Tips and tricks of travelling</h4>
                                        <div class="col-sm-4 col-md-4">
                                            <img src="<?php echo \Yii::$app->homeUrl; ?>/images/qards_icon.png" alt="">20
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <button class="btn btn-grey"><img src="<?php echo \Yii::$app->homeUrl; ?>/images/preview_icon.png" alt="">Preview</button>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="grid-item">
                                    <div class="grid-img">
                                        <img src="<?php echo \Yii::$app->homeUrl; ?>/images/deck-thumb.png" alt="">
                                    </div>
                                    <div class="grid-content">
                                        <h4>How to succeed in Life</h4>
                                        <div class="col-sm-4 col-md-4">
                                            <img src="<?php echo \Yii::$app->homeUrl; ?>/images/qards_icon.png" alt="">20
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <button class="btn btn-grey"><img src="<?php echo \Yii::$app->homeUrl; ?>/images/preview_icon.png" alt="">Preview</button>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="grid-item">
                                    <div class="grid-img">
                                        <img src="<?php echo \Yii::$app->homeUrl; ?>/images/deck-thumb.png" alt="">
                                    </div>
                                    <div class="grid-content">
                                        <h4>Wedding</h4>
                                        <div class="col-sm-4 col-md-4">
                                            <img src="<?php echo \Yii::$app->homeUrl; ?>/images/qards_icon.png" alt="">20
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <button class="btn btn-grey"><img src="<?php echo \Yii::$app->homeUrl; ?>/images/preview_icon.png" alt="">Preview</button>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="grid-item">
                                    <div class="grid-img">
                                        <img src="<?php echo \Yii::$app->homeUrl; ?>/images/deck-thumb.png" alt="">
                                    </div>
                                    <div class="grid-content">
                                        <h4>Best Coffee In New York</h4>
                                        <div class="col-sm-4 col-md-4">
                                            <img src="<?php echo \Yii::$app->homeUrl; ?>/images/qards_icon.png" alt="">20
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <button class="btn btn-grey"><img src="<?php echo \Yii::$app->homeUrl; ?>/images/preview_icon.png" alt="">Preview</button>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="grid-item">
                                    <div class="grid-img">
                                        <img src="<?php echo \Yii::$app->homeUrl; ?>/images/image_icon_lg.png" alt="">
                                    </div>
                                    <div class="grid-content">
                                        <h4>Untitled Deck</h4>
                                        <div class="col-sm-4 col-md-4">
                                            <img src="<?php echo \Yii::$app->homeUrl; ?>/images/qards_icon.png" alt="">0
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <button class="btn btn-grey"><img src="<?php echo \Yii::$app->homeUrl; ?>/images/preview_icon.png" alt="">Preview</button>
                                        </div>                                        
                                    </div>
                                </div>                                 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
<script>
$(document).ready(function() {
	var win = $(window);
	var page = 1;
	// Each time the user scrolls
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
			$('#loading').show();
			$.ajax({
				url: '<?=Url::to(['deck/my-decks'], true);?>',
				dataType: 'html',
				data: {'page':page},
				success: function(html) {
					console.log(page);
					$('.grid').append(html);
					$('#loading').hide();
				}
			});
/* 			$.ajax({
				url: '<?=Url::to(['qard/index'], true);?>',
				dataType: 'html',
				data: {'page':page},
				success: function(html) {
					console.log(page);
					$('.grid').append(html);
					$('#loading').hide();
				}
			}); */
			page = page+1;
		}
	});
});
</script>