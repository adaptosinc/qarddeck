<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<section class="main-profile">
	<!--<ul class="profile-title desktop-view">
		<li><h4>Latest from QardDeck</h4></li>
	</ul>-->
	<ul class="profile-title mobile-page">
		<li><h4>Latest from QardDeck</h4></li>
		<li class="pull-right">
			<ul>
				<li><button class="btn btn-default signin">Qards</button></li>
				<li><button class="btn btn-default">Decks</button></li>
			</ul>
		</li>
	</ul>                    
	
	<div class="main-content">
		<div class="popular-qards">     <!-- popular qard list -->
			<div class="row">
				<div class="col-sm-9 col-md-9">
					<div class="row">
					<?php  
					foreach($qards as $qard){

						//if($qard->qard_id == 51){
						echo '<div class="col-sm-4 col-md-4" >
								<div class="qard-content">
									<div id="add-block" class="qard-div add-block">';
							$blocks = $qard->blocks;
						//	print_r($blocks);
							foreach($blocks as $block){
								////get the inline styles///
								$img_block_style = '';
								$overlay_block_style = '';
								$text_block_style = '';
								$theme = $block->theme->theme_properties;
								$theme = unserialize($theme);
								if(isset($theme)){
									//img block styles
										$img_block_style .= 'opacity:'.$theme['image_opacity'].';';
										if($block->link_image != ''){
											    
												$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
												$img_block_style .= 'background-size: cover;';
										}
											
										$img_block_style .= 'height:'.$theme['height'].'px;';
										
									//overlay block styles
										$overlay_block_style .= 'opacity:'.$theme['div_opacity'].';';
										$overlay_block_style .= 'background-color:'.$theme['div_bgcolor'].';';
										$overlay_block_style .= 'height:'.$theme['height'].'px;';
										
										$text_block_style .= 'height:'.$theme['height'].'px;';
								}
								///////////////////////////
								echo '<div class="bgimg-block" style="'.$img_block_style.'" >
								<div class="bgoverlay-block" style="'.$overlay_block_style.'">
								<div class="text-block" style="'.$text_block_style.'">';
								echo $block->text;
								echo '</div></div></div>';
							}						
						echo '		</div>
								</div>
							<div class="qard-bottom">
								<ul class="qard-tags">
									<li class="pull-left">#tag#tag#tag</li>
									<li class="pull-right">x days ago</li>
								</ul>
								<h4>Author Full name</h4>
								<ul class="social-list">
									<li><a href=""><img src="images/heart.png" alt=""><br />500</a></li>
									<li><a href=""><img src="images/comment-dark.png" alt=""><br />500</a></li>
									<li><a href=""><img src="images/certify.png" alt=""><br />500</a></li>
									<li><a href=""><img src="images/share.png" alt=""><br />500</a></li>
								</ul>
							</div>
							</div>';							
						//}

						//echo "<h4>Next</br>";
						//print_r($blocks);
					}
					?>

				</div>
				<!--<div class="col-sm-3 col-md-3">
					<div class="featured-tags">     <!--featured tags 
						<h4>Featured Tags</h4>
						<button class="btn btn-default">Tag</button>
					</div>
						<div class="sidebar-qard">     <!-- side qard 
							<div class="qard-content">
								
							</div>
							<div class="qard-bottom">
								<ul class="qard-tags">
									<li class="pull-left">#tag#tag#tag</li>
									<li class="pull-right">x days ago</li>
								</ul>
								<h4>Author Full name</h4>
								<ul class="social-list">
									<li><a href="">20<img src="images/newqard.png" height="50px" alt=""></a></li>
									<li><a href=""><img src="images/heart.png" alt=""><br />500</a></li>                                                    
									<li><a href=""><img src="images/certify.png" alt=""><br />500</a></li>
									<li><a href=""><img src="images/share.png" alt=""><br />500</a></li>
								</ul>
							</div>                                           
						</div>                                    
				</div>-->
				</div>
			</div>          <!-- row -->
		</div>
	</div>

</section>
<script>
$('#save').on('click',function(){
	var dataUrl = document.getElementById('save').toDataURL("image/png");
	console.log(dataUrl);
    html2canvas([document.getElementById('save')], {
		onrendered: function (canvas) {
		//document.getElementById('canvas').appendChild(canvas);
		var data = canvas.toDataURL('image/png');

		$.ajax({
		   url: "<?=Url::to(['qard/save-blob'], true);?>",
		   type: "POST",
		   data: { 
			 'img': data
		   },
		//   processData: false,
		 //  contentType: false,
		}).done(function(respond){
				console.log(respond);
			//$("#save").html("Uploaded Canvas image link: <a href="+respond+">"+respond+"</a>").hide().fadeIn("fast");
		});

	  }
	});
	
});


</script>