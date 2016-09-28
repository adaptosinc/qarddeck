<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use app\models\Deck;
use dosamigos\fileupload\FileUpload;
/* @var $this yii\web\View */
/* @var $model app\models\Qard */
$this->title = 'Preview Qard';
?>
    <!-- requiered for tag -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,400" />

    <!-- remove this if you use Modernizr -->
    <script>
        (function(e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);
    </script>
<!--for tags-->
    <link href="<?= Yii::$app->request->baseUrl?>/css/select2.css" rel="stylesheet">
    <!--<link href="<?= Yii::$app->request->baseUrl?>/css/bootstrap-tagsinput.css" rel="stylesheet">
<script src="<?= Yii::$app->request->baseUrl?>/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/typeahead.js" type="text/javascript"></script>-->
    <!--only for this page-->
    <link href="<?= Yii::$app->request->baseUrl?>/css/custom.css" rel="stylesheet">

    <!-- requiered for fore color of text -->
    <link href="<?= Yii::$app->request->baseUrl?>/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <!--for image crop-->
    <link href="<?= Yii::$app->request->baseUrl?>/css/html5imageupload.css" rel="stylesheet">
    <link href="<?= Yii::$app->request->baseUrl?>/css/custom.css" rel="stylesheet">

    <script src="<?= Yii::$app->request->baseUrl?>/js/bootstrap-colorpicker.js" type="text/javascript"></script>

    <!-- requiered for get selected fiels in text editing -->
    <script src="<?= Yii::$app->request->baseUrl?>/js/jquery.selection.js" type="text/javascript"></script>
    
    <!--for resize block-->
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- requiered for drop down of an image -->
    <!--<script src="<?= Yii::$app->request->baseUrl?>/js/dropzone.js" type="text/javascript"></script>-->

    <section class="consume-card save">
        <div id="wait" class="waiting_logo" >
			<style>
			.sk-cube-grid .sk-cube {
				background-color: white;
			}
			.sk-cube-grid {
				width: 100px;
				height: 100px;
				margin: 40px auto;
			}
			</style>
			<ul id="spinners">  
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
		</div>
		<div class="row">
			<div class="col-sm-8 col-md-8">
				<h3><span class="pull-left"><button class="btn btn-grey" onclick="location.href='<?=\Yii::$app->homeUrl?>qard/edit?id=<?=$model->qard_id?>';"><i class="fa fa-pencil"></i>&nbsp;Edit Qard</button>
				
				<button class="btn btn-grey conformdelete" ><i class="fa fa-trash"></i>&nbsp;Delete Qard</button>
				
				</span><?=$model->title?></h3>
				<div class="bottom-card col-sm-12 col-md-12">
					<ul>
						<li>
					
							   <div class="comment-img">
								   <img src="<?php if(isset($model->userProfile) && !empty($model->userProfile)){  echo $model->userProfile->profile_photo;  }
										else if(isset($user) && !empty($user)){  echo $user->profile_photo;  }

								   ?>" alt="">
							   </div>
							   <div class="comment-txt">
								   <h5><strong><?php if(isset($model->userProfile) && !empty($model->userProfile)){ echo $model->userProfile->fullname; }

									else if(isset($user) && !empty($user)){  echo $user->fullname;  }

								   ?></strong></h5>
								   
								   <?php 
								  $datetime = $model->last_updated_at;
								  $date = date('M j Y g:i A', strtotime($datetime));
								  $date = new DateTime($date);
								  $datetime1 = new DateTime("now"); 
								  $diff = $datetime1->diff($date)->format("%a");
								  if($diff == 0){
									  $diff = 'Today';
								  }else if($diff==1){
									  $diff = '1 day ago';
								  }else{
									  $diff = $diff.' days ago';
								  }
								  ?>
								  
								   <p class="post-date"><?=$diff?></p>
							   </div>
						</li>
						<?php 
							$qard_tags = $model->qardTags;
							foreach($qard_tags as $qard_tag){
								echo "<li class='tags-list'>#".$qard_tag->tag->name.'</li>';
							}		
						?>
					</ul>
				</div>                             
			</div>
			<div class="col-sm-4 col-md-4" > 
			<?php 
								if(!\Yii::$app->user->isGuest){						
							?>
				<ul class="pull-right">
					<li><button id="add_to_deck" class="btn btn-default" href="<?=Yii::$app->request->baseUrl?>/deck/select-deck" >Add to Deck</button></li>
				</ul>
			<?php } ?>
			</div>                       
		</div>
        <div class="row">

        <div class="add-block col-sm-3 col-md-3" id="qard<?=$model->qard_id?>" >

		
		<?php 
		//get theme properties
		$theme_properties = unserialize($theme['theme_properties']);
		//print_r($theme);die;
		?>
         <!--		<div id="blk_2"class="bgimg-block parent_current_blk" style="background-color: yellowgreen" style="height:75px;">
		    <div class="bgoverlay-block" style="height:75px;">
			<div class="text-block current_blk" data-height="2" style="height:75px;"></div>                                    
		    </div>                                
		</div>
		<div id="blk_2"class="bgimg-block parent_current_blk" style="background-color: #0055cc" style="height:150px;">
		    <div class="bgoverlay-block" style="height:150px;">
			<div class="text-block current_blk" data-height="4" style="height:150px;"></div>                                    
		    </div>                                
		</div>-->

		<?php 		
		
		$str = '<div id="add-block'.$model->qard_id.'" class="qard-content">';

			if(isset($blocks) && !empty($blocks)){
			//	print_R($blocks);die;
			foreach($blocks as $block){
				////get the inline styles///
				$img_block_style = '';
				$overlay_block_style = '';
				$text_block_style = '';
				$theme = $block->theme->theme_properties;
				$theme = unserialize($theme);
				if(isset($theme)){
						if(!isset($theme['data_img_type']))
							$theme['data_img_type'] = "preview";
					//img block styles
						//$img_block_style .= 'opacity:'.$theme['image_opacity'].';';
						if($block->link_image != '' && ($theme['data_img_type'] == 'background' || $theme['data_img_type'] == 'both')){
								
								$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
								$img_block_style .= 'background-size: cover;';
								$data_img_url = \Yii::$app->homeUrl.'uploads/block/'.$block->link_image;
						}
						if($theme['div_bgcolor'] != '')
							$img_block_style .= 'background-color:'.$theme['div_bgcolor'].';';	
						$img_block_style .= 'min-height:'.$theme['height'].'px;';
						$img_block_style .= 'height:auto;';
						
					//overlay block styles
						if($block->link_image != '' && ($theme['data_img_type'] == 'background' || $theme['data_img_type'] == 'both')){
							$opacity = $theme_properties['overlay_opacity']/100;
							//$overlay_block_style .= 'opacity:'.$opacity.';';
							//if(isset($theme['div_overlaycolor']) && $theme_properties['div_overlaycolor']!='')
								$overlay_block_style .= 'background-color:'.$theme_properties['overlay_color'].';';								
							
						}
						$overlay_block_style .= 'min-height:'.$theme['height'].'px;';
						$overlay_block_style .='height:auto;';
						
						$text_block_style .= 'min-height:'.$theme['height'].'px;';
						$text_block_style .='overflow:hidden;';
						$text_block_style .='height:auto;';
				}
				///////////////////////////
				if(!isset($theme['data_style_qard']))
					$theme['data_style_qard'] = 'line';
				$str .= '<div class="bgimg-block '.$theme['data_style_qard'].'" style="'.$img_block_style.'" >
				<div class="bgoverlay-block" style="'.$overlay_block_style.'">
				<div class="text-block" style="'.$text_block_style.'" data-block-id="'.$block->block_id.'">';
				$str .= $block->text;
				$str .= '</div></div></div>';

			}	}
		$str .= '		</div>
			';	
			echo $str;
			?>
               
            </div>
	<div class="col-sm-9 col-md-9">
		<div id="cardtabs">
	
	  <!-- Nav tabs -->
	  <!--<ul class="nav nav-tabs col-sm-1 col-md-1" role="tablist">
		<li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab"><img class="image-default" src="<?=Yii::$app->homeUrl;?>images/comments_icon.png" alt=""> <img class="image-close" src="<?=Yii::$app->homeUrl;?>images/close_icon_light.png" alt=""></a></li>                                
		<li role="presentation"><a href="#shareblock" aria-controls="shareblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl;?>images/share_icon.png" class="image-default" alt=""><img class="image-close" src="<?=Yii::$app->homeUrl;?>images/close_icon_light.png" alt=""></a></li>                                
		<li role="presentation" class="tootip" data-title="Qard was added to your bookmarks"><span class="arrow-left"></span><a href="#bookmarkblock" aria-controls="bookmarkblock" role="tab" data-toggle="tab" aria-expanded="true"><img src="<?=Yii::$app->homeUrl;?>images/bookmark_icon.png" class="image-default" alt="" style="width:15px;margin:0 auto;"><img class="image-close" src="<?=Yii::$app->homeUrl;?>images/bookmark_icon_light.png" alt=""></a></li>                              
		<li role="presentation" class="tootip" data-title="Qard was added to your favourites"><span class="arrow-left"></span><a href="#favblock" aria-controls="favblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl;?>images/heart_icon.png" class="image-default" alt=""><img class="image-close" src="<?=Yii::$app->homeUrl;?>images/heart_icon_light.png" alt=""></a></li>
		<!--<li role="presentation"><a href="#fileblock" aria-controls="fileblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl;?>images/pop-up_icon.png" class="image-default" alt=""><img class="image-close" src="<?=Yii::$app->homeUrl;?>images/close_icon_light.png" alt=""></a></li>-->
	  <!--</ul>-->
	
	  <!-- Tab panes -->
	<div class="col-sm-12 col-md-12">
		<div id="preview-tab" class="preview-tab" style="display: block;">
			<div class="bookmark-content">
				<img src="<?=Yii::$app->homeUrl;?>images/demo_icon.png" alt="">
				<h4>Explore the Qard Blocks by clicking the links on the qard</h4>
			</div>                                      
			<div class="active-text-preview" style="display: none;">        <!-- extra text preview block -->
				<h4><div id="extra_text_title"></div><span class="pull-right"><i class="fa fa-times-thin"></i></span></h4>
				<hr class="divider">
				<div class="active-preview-content" id="extra_text_content">
					<p></p>
				</div>
			</div>
			<div class="active-video-preview" style="display: none;">           <!-- video preview block -->
				<h4>Watch the video here<span class="pull-right"><!--<quote id="#video_url">http://youtube.com/ahsdgu</quote>--><i class="fa fa-times-thin"></i></span></h4>
				<hr class="divider">
				<div class="active-preview-content">
					<!--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.. <a href="">more</a> </p>-->
					<div id="video_frame"><iframe height="315" src="https://www.youtube.com/embed/cqNmVJk7Zyg" frameborder="0" allowfullscreen=""></iframe></div>
				</div>
			</div>
			<div class="active-link-preview" style="display: none;">        <!-- link preview block -->
				<h4 id="title_and_url">Link The Url <span class="pull-right"><!--<quote>http://youtube.com/ahsdgu</quote>--><i class="fa fa-times-thin"></i></span></h4>
				<hr class="divider">
				<div class="active-preview-content">
					<p id="url_desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. </p>
					<div id="url_data"><iframe height="315" src="https://www.youtube.com/embed/cqNmVJk7Zyg" frameborder="0" allowfullscreen=""></iframe></div>
				</div>
			</div>
			<div class="active-file-preview" style="display: none;">            <!-- file preview block -->
				<h4 id="file_title">FileName.zip <span class="pull-right"><i class="fa fa-times-thin"></i></span></h4>
				<hr class="divider">
				<div class="active-preview-content">
					
						<p id="file_desc">This is a description of file</p>
						<div id="file_controls">
							<div class="file-download">
								<img  src="<?=Yii::$app->homeUrl;?>images/download_icon.png" alt="" >                                                
							</div>
							<span id="f_name" > </span></br></br>
							<button id="file_image" class="bnt qard">Download File</button>
						</div>
						<div id="pdf_area"></div>
				</div>
			</div>
			<div class="active-image-preview" style="display: none;">       <!-- image preview block -->
				<h4 id="img_title">Attached Image Here <span class="pull-right"><i class="fa fa-times-thin"></i></span></h4>
				<hr class="divider">
				<div class="active-preview-content">
					<div class="image-show" id="img_show" >
						<img src="<?=Yii::$app->homeUrl;?>images/98.png" alt="">
					</div>
				</div>
			</div>                                    
		</div>                                 
		<div class="tab-content" style="display: none;">                               
		  <div role="tabpanel" class="tab-pane active" id="comments">
			  <div class="cardblock-header">
				  <h4>Comments(12) <span class="pull-right"><i class="fa fa-times-thin"></i></span></h4>
				  <h4 class="comment-input"><input type="text" name="comment-input" class="col-sm-10 col-md-10" placeholder="Share what you're thinking..."><button class="btn qard col-sm-2 col-md-2">POST</button></h4>
			  </div>
				  <ul class="comment-list">
					  <li>
						  <div class="comment-img col-sm-1 col-md-1">
							  <img src="<?=Yii::$app->homeUrl;?>images/deck-thumb.png" alt="">
						  </div>
						  <div class="comment-txt col-sm-11 col-md-11">
							  <p><strong>Tim Hatherly-Greene</strong>Tim Hatherley-Greene The following tips on creating a direct mail advertising campaign have been street-tested and will bring you huge returns in a short period of time.</p>
							  <p class="post-date">3 days ago</p>
						  </div>
					  </li>
					  <li>
							 <div class="comment-img col-sm-1 col-md-1">
								 <img src="<?=Yii::$app->homeUrl;?>images/deck-thumb.png" alt="">
							 </div>
							 <div class="comment-txt col-sm-11 col-md-11">
								 <p><strong>Tim Hatherly-Greene</strong>Tim Hatherley-Greene The following tips on creating a direct mail advertising campaign have been street-tested and will bring you huge returns in a short period of time.</p>
								 <p class="post-date">3 days ago</p>
							 </div>
					  </li>
					  <li>
							 <div class="comment-img col-sm-1 col-md-1">
								 <img src="<?=Yii::$app->homeUrl;?>images/deck-thumb.png" alt="">
							 </div>
							 <div class="comment-txt col-sm-11 col-md-11">
								 <p><strong>Tim Hatherly-Greene</strong>Tim Hatherley-Greene The following tips on creating a direct mail advertising campaign have been street-tested and will bring you huge returns in a short period of time.</p>
								 <p class="post-date">3 days ago</p>
							 </div>
					  </li>                                         
				  </ul>                                    
		  </div>
		  <div role="tabpanel" class="tab-pane" id="fileblock">
				<div class="fallback">
				  <input name="file" type="file" multiple="">
				</div>
				  <ul class="on-off pull-right">
					  <li>
						  <div class="switch">
							  <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox">
							  <label for="cmn-toggle-4"></label>
						  </div>  <span>Open file in new tab</span>                                          
					  </li>                                      
				  </ul>                                     
		  </div>

		  <div role="tabpanel" class="tab-pane" id="shareblock">                                                                  
			  <div class="cardblock-header">
				  <h4>Share <span class="pull-right"><i class="fa fa-times-thin"></i></span></h4>                                        
			  </div>
			  <div class="share-input">
				<h4>Share the link below in social media, in email, or whatever.</h4>
				<h4 class="share-input"><input type="text" name="share-input" class="col-sm-10 col-md-10" placeholder="http://www.google.com"><button class="btn qard col-sm-2 col-md-2">COPY LINK</button></h4>
				<div class="quick-share">
					<h4>Quick Share</h4>
					<ul>
						<li><a href=""><i class="fa fa-facebook"></i></a></li>
						<li><a href=""><i class="fa fa-twitter"></i></a></li>
						<li><a href=""><i class="fa fa-linkedin"></i></a></li>
					</ul>
				</div>
			  </div>
		  </div>

		  <div role="tabpanel" class="tab-pane" id="copyblock">
			  <div class="review-qard row">
				  <div class="img-preview col-sm-3 col-md-3">
					  <img src="<?=Yii::$app->homeUrl;?>images/Qard_Image.jpg" alt="">
				  </div>
				  <div class="col-sm-9 col-md-9">
					  <div class="url-content">
						  <h4>Title of Content</h4>
						  <div class="url-text">
							  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. </p>
						  </div>
					  </div>                                            
				  </div>
			  </div>                                    
		  </div>
		  <div role="tabpanel" class="tab-pane" id="deleteblock">.</div>
		</div>
	  
	  </div>
	</div>
</div>
        </div>
			<div class="bottom-card row"> <!--bottom row starts -->
				<div class="col-sm-8 col-md-8">
				   
				</div>
				<div class="col-sm-4 col-md-4">
					<ul class="help-list"> 
						<li><button class="btn qard saveqard" name="preview" id="preview_qard" <?php if(isset($user->role) && !empty($user->role) && ($user->role =="admin")){  echo "data-id='5'";  } else { echo "data-id='3'"; } ?> >Save as Template</button></li>
						<li><button class="btn btn-warning saveqard" name="share" id="share_qard" data-id='1'>Share Qard</button></li>
					</ul>
				</div>
				
				<!-- Modal Share -->
				<div class="modal fade" id="myModalshare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel">Awesome! Your Qard is live!</h4>
					  </div>
					  <div class="modal-body">
						<img src="<?=Yii::$app->homeUrl?>images/success_icon.png" alt="">
						<h4><?=Yii::$app->homeUrl?>qard/consume?qard_id=<?=$model->qard_id?></h4>
						<p>Share this link on social media, email, or whatever.</p>
						<button class="btn btn-warning" onClick="location.href='<?=Yii::$app->homeUrl?>qard/consume?qard_id=<?=$model->qard_id?>'">View Qard</button>
						<div class="row">
							<div class="col-sm-6 col-md-6">
								<h4><a href="">Add to a Deck</a></h4>
							</div>
							<div class="col-sm-6 col-md-6">
								<h4><a href="">Save as Template</a></h4>
							</div>                                            
						</div>
					  </div>
					  <div class="modal-footer">
						<h4><i class="fa fa-plus"></i>Create Qard</h4>
					  </div>
					</div>
				  </div>
				</div>          <!-- Modal Share -->                            
				
				
				<div class="modal fade" id="myTemplateshare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel">Your Qard Has Been Saved as a Template Succesfully !</h4>
					  </div>
					  <div class="modal-body">
						
					  </div>
					  <div class="modal-footer">
					
					  </div>
					</div>
				  </div>
				</div>     
				
			</div> <!--bottom row ends -->
    </section>
    <!-- block_error popup -->

	
	<?php 
	$this->registerJs("$(function() {
	   $('#add_to_deck').click(function(e) {
		 e.preventDefault();
		 //console.log($(this).attr('href'));
		 var qard_id = $('#qard_id').val(); 
		 if(typeof qard_id == 'undefined' || qard_id == '' || qard_id == 0)
		 {
			 //alert('You need to create atleast one block');
			 $('#working_div .current_blk').text('Add your content here');
			 $('.add-another').trigger('click');
			// return;
		 }
		 $('#deck-style').modal('show').find('.load-pre').load($(this).attr('href'));
	   });	 
   
	});");
	?>
	
	
    <div class="modal fade" tabindex="-1" id="asdasd" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 id="disp_error">Almost There...</h3>
                    <!--<p id="disp_error"></p>-->
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

	<!---------Pop Up-------------->
	<div id="deck-style" class="fade modal in" role="dialog" tabindex="-1">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Select a Deck to Add Qard to :
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</h4>
			</div>
			<div class="modal-body">
					<div class="grid">	
					
					
						<div class='load-pre'> </div>
						
					<div class="grid-item">				
					<div class="grid-img deck-img-pre col-sm-12 col-md-12">
								<?php $form = ActiveForm::begin([
									'id' => 'deck-form',
									]); ?>
								<?= FileUpload::widget([
									'model' => new Deck(),
									'attribute' => 'bg_image',
									
									'url' => ['deck/set-cover-image'], // your url, this is just for demo purposes,
									'options' => ['accept' => 'image/*','class'=>'class'],
									'clientOptions' => [
										'maxFileSize' => 2000000
									],
								
									'clientEvents' => [
										'fileuploaddone' => 'function(e, data) {
																var dat = JSON.parse(data.result);
																thumbnailUrl = dat.files[0].thumbnailUrl;
																var html = "<img width=200px height=200px src="+thumbnailUrl+" />";
																
																$(".deck-img-pre").css("background","#f1f1f1 url("+thumbnailUrl+")")
																$(".deck-img-pre").css("background-size", "cover");
															
																$("#bg_image").val(thumbnailUrl);
															
															}',
										'fileuploadfail' => 'function(e, data) {
																alert("Oops! Something wrong happended.Please try gain later!");
															}',
									],
								]);?>
								<p>click to select file</p>
								<div id="preview">
								</div>
								<?php ActiveForm::end(); ?>	
				</div>
				
				
				<div class="grid-content">
					<form onSubmit="saveDeck(this);return false;" enctype = "multipart/form-data"  method="POST" name="ajaxDeck">
					<input style="margin-top:10px"  type="text" name="title"  id="deck-title" placeholder="Untitle Deck"/>
					<div class="col-sm-4 col-md-4"></div>
					
					<div class="col-sm-8 col-md-8">
						<input type="hidden" id="bg_image" class="class" name="bg_image" />
						<div id="ajaxDeckPreview"></div>
						<button style="margin-top:10px" class="btn btn-grey">Add Deck</button>
					</div>			
				</form>		
				</div>
				

				</div>
				</div>
				
			</div>
			
				</div>
				
		</div>
	</div>
 <div id="wait" class="waiting_logo"><img src='<?=Yii::$app->request->baseUrl?>/img/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
 
<!----------------------------->
	
    <script type="text/javascript">
        $(document).ready(function(){
            var avalue = "active";
            if($('ul.nav.nav-tabs li').hasClass(avalue) === false) {
                $('.preview-tab').css('display','block');
                $('.tab-content').css('display','none');
            }
            $('ul.nav.nav-tabs li').click(function(){
                $('.preview-tab').css('display','none');
                $('.tab-content').css('display','block');            
            });
        });
		
		$(".saveqard").click(function(e){
			e.preventDefault();
			//save to public status here
			$("#wait").show();
			var status = $(this).attr('data-id');
			$.ajax({
				url : "<?=Url::to(['qard/publish'], true)?>",
				type : "GET",
				data : {'q_id' : '<?= $model->qard_id?>','status': status},
				success: function(response){
						$("#wait").hide();
						if(parseInt(status) == 1)
						  $('#myModalshare').modal('show');
						else
						 $('#myTemplateshare').modal('show');
				}
			});			
		});
		

		$('#cardtabs a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		});

        function showtext() {
            //code
            var s = document.getElementById('descfield');
            if (s.style.display == "none") {
                //code
                s.style.display = "block";
            } else {
                s.style.display = "none";
            }
        }
		function setBGColor(elem){
			color = $(elem).attr('data-color');
			$('#bg_color').val(color);
			$("#working_div .bgimg-block").css('background-color', color);
		}
    </script>
    <script src="<?= Yii::$app->request->baseUrl?>/js/select2.js" type="text/javascript"></script>


    <script src="<?= Yii::$app->request->baseUrl?>/js/html5imageupload.js" type="text/javascript"></script>
    <script src="<?= Yii::$app->request->baseUrl?>/js/jquery.caret.js" type="text/javascript"></script>

    <script src="<?= Yii::$app->request->baseUrl?>/js/jquery-ui.js" type="text/javascript"></script>
	<script>
	
		/** link preview **/
		function displayLink(identifier){
			var dataurl = $(identifier).attr('data-url');
			console.log(dataurl);
			var checkit = $(identifier).find('#hiddenUrl');
			var displayCheck = 1;
			callUrl(identifier,dataurl,displayCheck);
			$('#preview-tab').show();
			return false;
		}
		/*
		* Link block functions
		*/
        function callUrl(identifier,urlField,displayCheck) {
            //console.log($(urlField).val());
			console.log($(identifier).parent('.text-block').attr('data-block-id'));
			var block_id = $(identifier).parent('.text-block').attr('data-block-id');
            var preview_url = urlField;
            var get_preview_url = "<?=Url::to(['qard/url-preview'], true);?>";
				$("#wait").show();
            $.ajax({
                url: get_preview_url,
                type: "GET",
				datatype : 'json',
                data: {
                    'url': preview_url,
					'block_id': block_id
                },
                success: function(data) {
					data = $.parseJSON(data);
                    console.log(data);
                    //$('.working_div div').html(data);
					if (data.type == 'web_page') {
						//added by kavitha
						
						if(displayCheck==1){
							
						}else{
						$("#working_div .current_blk").html(data.work_space_text);
						adjustHeight();
                        $("#drop-file  , .file_options").hide();
                        //show link options
                        $(".link_options").show();
						}
                        var data_to_show = data.preview_html;
						
                    }
                    else {
                        //hide file options
                        $("#drop-file  , .file_options").hide();
                        //show link options
                        $(".link_options").show();
						var data_to_show = data;
                        
                    }
					hideAll('active-link-preview');
					$('.active-preview-content').show();
					$('#url_data').html(data_to_show);
					var l = data.url_title+'<span class="pull-right"><quote>'+preview_url+'</quote><i class="fa fa-times-thin"></i></span>';
					$('#title_and_url').html(l);
					$('#url_desc').html(data.url_description);
					$("#wait").hide();
                }
            });
        }
		/** File preview **/
         function showFilePrev(identifier,fileName){
			 
			var block_id = $(identifier).parent().parent('.text-block').attr('data-block-id');			
			
		 		$.ajax({									
				url : "<?=Url::to(['block/get-filedata'], true)?>",
				type: "GET",
				data: { 'block_id': block_id},
				success: function(data){				
					data1 = $.parseJSON(data);
					if($.trim(data1.file_title) !=="" )
						$('#file_title').html(data1.file_title);
					else
					$('#file_title').html(fileName);
					$('#file_desc').html(data1.file_description);
					
					}
				});  
				
			hideAll('active-file-preview');
			$('.active-preview-content').show();
			///$('#file_title').html(fileName);
			$('#file_image').attr("file-name",fileName);
			
			$('#f_name').text(fileName);
			$('#file_controls').show();
			$('#pdf_area').hide();
			
			
          }  
		$('#file_image').on("click",function(e){
			console.log("changed");
			downloadFile(e,$(this).attr("file-name"));
		});
		  function downloadFile(e,fileName){
            var ext = fileName.split('.').pop();
            if (ext == "pdf" ) {
				var object = "<span id='spanob'><object id='obj' data=\"../uploads/docs/"+fileName+"\" type=\"application/pdf\" width=\"100%\" height=\"600px\">";
				object += "</object>";  
				$('#file_controls').hide();
				$('#pdf_area').show();
				$("#pdf_area").html(object);   			
                }
            if (ext == "doc" || ext == 'docx') {
				$("#pdf_area").html('');
				var test = "<?= Yii::$app->request->baseUrl?>/uploads/docs/"+fileName;
				e.preventDefault();  //stop the browser from following
				window.location.href = test;	
               }			  
		  }
		/** Embed code preview **/
		function embedCode(videoLink){
			var eUrl = $(videoLink).attr('data-value');
			console.log(eUrl);
			var html = '<iframe src="'+eUrl+'" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			//calldisplayEmbedUrl(eUrl);
		
			hideAll('active-video-preview');
			$('.active-preview-content').show();
			$('#video_frame').html(html);
			$('#video_url').html(eUrl);
		}
		/** For extra text **/
		function showExtraText(elem){
			//active-text-preview
			hideAll('active-text-preview');
			$('.active-preview-content').show();			
			$.ajax({
				url : "<?=Url::to(['block/get-text'], true)?>",
				type: "GET",
				data: { 'block_id': $(elem).parent().attr('data-block-id') },
				success: function(data){
					data = $.parseJSON(data);
					$("#extra_text_content").html(data.extra_text);
					//console.log(data.extra_text);
					$("#extra_text_title").html(data.title);

				}
			});			
		}
		/** End of dragging function **/
		function hideAll(except){
			$('.tab-content').hide();
			$('.active-text-preview').hide();
			$('.bookmark-content').hide();
			$('.active-video-preview').hide();
			$('.active-preview-content').hide();
			$('.active-link-preview').hide();
			$('.active-file-preview').hide();
			$('.active-image-preview').hide();
			$("#preview-tab").show();
			$('.'+except).show();
		}
		/** Image Preview **/
		function showImage(elem){
			console.log($(elem).attr('data-url'));
			hideAll('active-image-preview');
			$('.active-preview-content').show();	
			var img = '<img style="width:100%" src="'+$(elem).attr('data-url')+'" alt="">';
			$("#img_show").html(img);
		}	
	/***************************/
	
	
	$(".conformdelete").click(function(){				
				 if (confirm("Are you sure to Delete this Qard?")) {
						window.location="<?=\Yii::$app->homeUrl?>qard/delete-qard?id=<?=$model->qard_id?>'";
					}				
			});
			
	</script>
