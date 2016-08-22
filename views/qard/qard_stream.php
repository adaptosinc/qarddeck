<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<style>
.grid-item { width: 350px; }
</style>
	
    <?php 

	$all_class = $qard_class = $deck_class= '';
	if($type =="both")
		$all_class = 'active';
	if($type =="qards")
		$qard_class = 'active';	
	if($type =="decks")
		$deck_class = 'active';	
	?>         
<script src="<?= Yii::$app->request->baseUrl?>/js/masonry.js" type="text/javascript"></script>	
<script src="<?= Yii::$app->request->baseUrl?>/js/imagesloaded.js" type="text/javascript"></script>	

    
                <section class="main-stream">
                    <div id="tabs">
                    <div class="stream-cat">
                        <ul class="profile-title nav nav-tabs" role="tablist">
							
                            <li role="presentation" class="<?=$all_class ?>"><h4><a href="<?=Yii::$app->homeUrl?>qard/index?type=both">All</a></h4></li>
                            <li role="presentation" class="<?=$qard_class ?>"><h4><a href="<?=Yii::$app->homeUrl?>qard/index?type=qards" >Qards</a></h4></li>
                            <li role="presentation" class="<?=$deck_class ?>"><h4><a href="<?=Yii::$app->homeUrl?>qard/index?type=decks" >Deck</a></h4></li>
                        </ul>
                    </div>
                    <div class="main-content">
                        <div class="popular-qards profile tab-pane fade in active" role="tabpanel"  id="tab1">     <!-- popular qard list -->
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 350, "gutter": 40 }' >	
										<?php  
											echo $feed;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
<style>
.sk-cube-grid .sk-cube {
    background-color: teal;
}
</style>
<ul id="spinners" align="center">  
	<li class="sk-cube-grid selected">
		  <div class="sk-cube sk-cube1"></div>
		  <div class="sk-cube sk-cube2"></div>
		  <div class="sk-cube sk-cube3"></div>
		  <div class="sk-cube sk-cube4"></div>
		  <div class="sk-cube sk-cube5"></div>
		  <div class="sk-cube sk-cube6"></div>
		  <div class="sk-cube sk-cube7"></div>
		  <div class="sk-cube sk-cube8"></div>
		  <div class="sk-cube sk-cube9"></div>
	</li>
</ul>
<script>

$(window).load(function() {
	var win = $(window);
	var page = 1;
	
	
	var $container = $('.grid');
	$container.masonry();
	// Each time the user scrolls
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
			$('#spinners').show();

			var searchid = $("#searchid").val();	
			$.ajax({
				url: '<?=Url::to(['qard/index'], true);?>',
				dataType: 'html',
				data: {'page':page,'type':'<?=$type?>','search':searchid},
				success: function(html) {
					var el = jQuery(html);
					//$(".grid").append(el).masonry( 'appended', el, false );
					$('#spinners').hide();
					var $newElems = $( html ).css({ opacity: 0 });
					$newElems.imagesLoaded(function(){
						$newElems.animate({ opacity: 1 });
						$(".grid").append(el).masonry( 'appended', el, false );
					});
				},
				error:function(){
					$('#spinners').hide();
				}
			});
			//$container.masonry();
			page = page+1;
		}
	});
	$('.social-list li a').on('click',function(){
		console.log($(this).attr('act-type'));
			$.ajax({
				url: '<?=Url::to(['qard/activity'], true);?>',
				dataType: 'html',
				type : 'GET',
				data: {'id':$(this).attr('act-id'),'type':$(this).attr('act-type')},
				success: function(response) {
					console.log(response);
				}
			});
	});
});

$(document).on('click','.qardid',function(){
	var data_id = $(this).attr('id');
	var id = data_id.replace("qard", "");
	var url = '<?=Url::to(['qard/consume'], true);?>';
	window.location.href = url+"?qard_id="+id;
});

$(document).on('click','.deckid',function(){
	 var data_id = $(this).attr('id');
	var id = data_id.replace("deck", "");
	var url = '<?=Url::to(['deck/view'], true);?>';
	window.location.href = url+"?id="+id; 
});


</script>
