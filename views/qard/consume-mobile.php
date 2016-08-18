<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\QardComments;
use yii\db\Query;


/* @var $this yii\web\View */
/* @var $model app\models\Qard */
$this->title = 'Consume Qard';
//$this->meta_image = Yii::$app->homeUrl.'uploads/qards/'.$model['qard_id'].".png";


?>    

 <?php
		if(isset($model['qard_id'])){
		    echo '<input type="hidden" name="qard_id" id="qard_id" value="'.$model['qard_id'].'"><input type="hidden" name="user_id" id="user_id" value="'.$model['user_id'].'">';
		}
		?>
		
			<?php
						$qard_id = $model['qard_id'];			
						$userid = \Yii::$app->user->id;
					//*************  like check ***********//
						$query = new Query;
						$hquery = $query->select('*')
							->from('qard_user_activity')
							->where(['user_id'=>$userid,'qard_id'=>$qard_id,'activity_type'=>'like']);
						$command = $hquery->createCommand();
						$data = $command->queryAll();
						$hact = "";
						if(empty($data)){
							$himg = '<img id="like-img" src="'.Yii::$app->request->baseUrl.'/images/heart_icon.png" class="image-activity" alt="">';
						}else{
							$hact ="active";
							$himg = '<img id="like-img" src="'.Yii::$app->request->baseUrl.'/images/heart_icon_light.png" class="image-activity" alt="">';
						}
						
						//*************  bookmark check ***********//
						
						$bkquery = $query->select('*')
							->from('qard_user_activity')
							->where(['user_id'=>$userid,'qard_id'=>$qard_id,'activity_type'=>'bookmark']);
						$command = $bkquery->createCommand();
						$data = $command->queryAll();
						$bkact = "";
						if(empty($data)){
							$bkimg = '<img id="book-img" style="width:15px;margin:0 auto;" src="'.Yii::$app->request->baseUrl.'/images/bookmark_icon.png" class="image-activity" alt="" style="width:15px;">';
						}else{
							$bkact ="active";
							$bkimg = '<img id="book-img"  style="width:15px;margin:0 auto;" src="'.Yii::$app->request->baseUrl.'/images/bookmark_icon_light.png" class="image-activity" alt="">';
						}
						
					//*************  share count check ***********//
					
					$shquery = $query->select('count(*) as sharecount ')
							->from('qard_user_activity')
							->where(['user_id'=>$userid,'qard_id'=>$qard_id,'activity_type'=>'share']);
						$command = $shquery->createCommand();
						$data = $command->queryOne();
						$count = $data;
					;
						
						
		?>
		
	<section class="consume-main content">
                    <div class="consume-header">
                       <span class="pull-left col-xs-2"><button type="button" class="close"><span aria-hidden="true">&times;</span></button></span>
                       <h4 class="col-xs-8"> <?=$model->title?> </h4>
                       <span class="pull-right col-xs-2"><a  data-toggle="collapse" href="#collapseUser" aria-expanded="false" aria-controls="collapseUser"><i class="fa fa-chevron-down"></i></a></span>
                    </div>
                    <div class="collapse" id="collapseUser">
                        <h4><?=$model->title?></h4>
                        <div class="row">
                            <div id="cardtabs " class="right-block col-xs-12 col-sm-6 col-md-6">
                                <ul class="nav-tabs deck-list" role="tablist">
                                    <li id="shareclick" role="presentation" ><a id="img-span" ><img  src="<?=Yii::$app->request->baseUrl?>/images/share_icon.png" alt=""></a><button style="display:none" id="x-span" class="close" type="button">
<span aria-hidden="true">×</span>
</button><span id="share-count"><?=$model->shareCount?></span></li>
                                    <li  role="presentation" class="activity_card <?=$bkact;?>" id="book-msg" act-type="bookmark" act-id="<?=$model->qard_id?>"  for="" ><a href="" aria-controls="favblock" role="tab" data-toggle="tab" ><?=$bkimg?></a><span id="ch-book-count" ><?=$model->bookmarkCount?></span></li>
                                    <li  role="presentation" class="activity_card <?=$hact;?>"  id="like-msg" act-type="like" act-id="<?=$model->qard_id?>" for="" ><a href="" aria-controls="favblock" role="tab" data-toggle="tab" ><?=$himg?></a><span id="ch-like-count" ><?=$model->likeCount?></span></li>
                                </ul>
                            </div>
                        </div>  
						<div class="share-input" id="share-input" style="display:none">
                          <h4>Share the link below in social media, in email, or whatever.</h4>
                          <h4 class="share-input"><input type="text" readonly="readonly" name="share-input" id="share-link" value="<?= Yii::$app->request->absoluteUrl ?>"
						  class="col-xs-9 col-sm-10 col-md-10" ><button  for="copylink" act-type="share" act-id="<?=$model->qard_id?>" id="copy-link" class="btn qard col-xs-3 col-sm-2 col-md-2 activity_card ">COPY LINK</button></h4>
                          <div class="quick-share">
                              <h4>Quick Share</h4>
                              <ul>
                                 <li class="activity_card" act-type="share" act-id="<?=$model->qard_id?>" for="facebook" ><a style="display:block !important " href="https://www.facebook.com/sharer/sharer.php?u=<?= Yii::$app->request->absoluteUrl ?>" target="_blank" ><i class="fa fa-facebook"></i></a></li>
                                  <li class="activity_card" act-type="share" act-id="<?=$model->qard_id?>" for="twitter"  ><a href="https://twitter.com/home?status=<?= Yii::$app->request->absoluteUrl ?>" target="_blank" ><i class="fa fa-twitter"></i></a></li>
                                  <li class="activity_card" act-type="share" act-id="<?=$model->qard_id?>" for="linkedin" ><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= Yii::$app->request->absoluteUrl ?>&title=&summary=&source="><i class="fa fa-linkedin"></i></a></li>
                              </ul>
                          </div>
                        </div> 
						
						<div id="comment-view" >
						
                        <div class="user-info">
                            <img src="<?php if(isset($model->userProfile)){
								echo $model->userProfile->profile_photo;
							} ?>" alt="" width="50px" height="50px" style="border-radius: 50%;float: left;"><strong>
							<?php if(isset($model->userProfile)){
								echo $model->userProfile->fullname;
							} ?>
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
							<br /><span><?=$diff?></span></strong>                                
                        </div>                             
                        <ul class="deck-tags">
									<?php 
										$qard_tags = $model->qardTags;
										foreach($qard_tags as $qard_tag){
											echo "<li class='tags-list'>#".$qard_tag->tag->name.'</li>';
										}		
									?>
                        </ul>                       
                        <div class="comment-preview">
						<?php
						$comments = QardComments::find()->where(['qard_id'=>$model->qard_id])->orderBy('created_at DESC')->all();
						
						?>
                            <h4>Comments(<span id='comment-count'><?=count($comments)?></span>)</h4>                            
                            <ul class="comment-list">
							<?php 
							
							
							foreach($comments as $comment){
							$profile_photo = $comment->userProfile->profile_photo; 
							?>
                                <li>
                                    <div class="comment-img col-xs-1 col-sm-1 col-md-1">
                                        <img src="<?=$profile_photo?>" alt="">
                                    </div>
                                    <div class="comment-txt col-xs-11 col-sm-11 col-md-11">
                                        <p><strong><?=$comment->userProfile->fullname ?></strong><?=$comment->text?></p>
                                        <p class="post-date"><?=$comment->createdAgo?></p>
                                    </div>
                                </li>							
							<?php
							}
							?>
                                         
                            </ul>
                        </div>
                        <h4 class="comment-input"><input id="comment-input" name="comment-input" type="text"  class="col-sm-10 col-xs-10 col-md-10" placeholder="Share what you're thinking..."><button id="commentSubmit" class="btn qard col-xs-2 col-sm-2 col-md-2">POST</button></h4>
						
						</div>                            
                    </div>                    
                    <div class="add-block col-sm-12">
						<?php 
						//get theme properties
						$theme_properties = unserialize($theme['theme_properties']);

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
                    
                    <div class="preview-tab" style="display: none;">
						<div class="bookmark-content">
							<img src="<?=Yii::$app->homeUrl;?>images/demo_icon.png" alt="">
							<h4>Explore the Qard Blocks by clicking the links on the qard
							<span class="pull-right" onclick="closeTab();"><i class="fa fa-times-thin"></i></span>
							</h4>
						</div>                                      
						<div class="active-text-preview" style="display: none;">        <!-- extra text preview block -->
							<h4><div id="extra_text_title"></div><span class="pull-right" onclick="closeTab();"><i class="fa fa-times-thin"></i></span></h4>
							<div class="active-preview-content" id="extra_text_content">
								<p></p>
							</div>
						</div>
						<div class="active-video-preview" style="display: none;">           <!-- video preview block -->
							<h4>Watch the video here<span class="pull-right" onclick="closeTab();"><quote id="#video_url">http://youtube.com/ahsdgu</quote><i class="fa fa-times-thin"></i></span></h4>
							<hr class="divider">
							<div class="active-preview-content">
								<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.. <a href="">more</a> </p>
								<div id="video_frame"><iframe height="315" src="https://www.youtube.com/embed/cqNmVJk7Zyg" frameborder="0" allowfullscreen=""></iframe></div>
							</div>
						</div>
						<div class="active-link-preview" style="display: none;">        <!-- link preview block -->
							<h4 id="title_and_url">Dribble <span onclick="closeTab();" class="pull-right" ><quote>http://youtube.com/ahsdgu</quote><i class="fa fa-times-thin"></i></span></h4>
							<hr class="divider">
							<div class="active-preview-content">
								<p id="url_desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. </p>
								<div id="url_data"><iframe height="315" src="https://www.youtube.com/embed/cqNmVJk7Zyg" frameborder="0" allowfullscreen=""></iframe></div>
							</div>
						</div>
						<div class="active-file-preview" style="display: none;">            <!-- file preview block -->
							<h4 id="file_title">FileName.zip <span onclick="closeTab();" class="pull-right"><i class="fa fa-times-thin"></i></span></h4>
							<hr class="divider">
							<div class="active-preview-content">
								
									<p id="file_desc">This is a description of file</p>
									<div id="file_controls">
										<div class="file-download">
											<img  src="<?=Yii::$app->homeUrl;?>images/download_icon.png" alt="" >                                                
										</div>
										<button id="file_image" class="bnt qard">Download File</button>
									</div>
									<div id="pdf_area"></div>
							</div>
						</div>
						<div class="active-image-preview" style="display: none;">       <!-- image preview block -->
							<h4 id="img_title">Title Comes Here <span onclick="closeTab();" class="pull-right"><i class="fa fa-times-thin"></i></span></h4>
							<hr class="divider">
							<div class="active-preview-content">
								<div class="image-show" id="img_show" >
									<img src="<?=Yii::$app->homeUrl;?>images/98.png" alt="">
								</div>
							</div>
						</div>                                    
                    </div>                    
                    
                </section>                    
                   
                </div>
        </body>
        
        <!-- javascript -->

        <script type="text/javascript">

        $(document).ready(function(){
            var avalue = "active";
            if($('ul.nav.nav-tabs li').hasClass(avalue) === false) {
                $('.preview-tab').css('display','none');
                $('.tab-content').css('display','none');
            }
            $('ul.nav.nav-tabs li').click(function(){
                $('.preview-tab').css('display','none');
                $('.tab-content').css('display','block');            
            });
            $('#consume-preview .navbar-header button').click(function(){
            if($('#consume-preview').hasClass('col-sm-12 col-md-12') === true){
                $('#consume-preview').removeClass('col-sm-12 col-md-12');
                $('#consume-preview').addClass('col-sm-10 col-md-10');
            }else {
                $('#consume-preview').addClass('col-sm-12 col-md-12');
                $('#consume-preview').removeClass('col-sm-10 col-md-10');                
            }                
            });
            $('#decknavbar .add-block').click(function(){
                $('.add-block').removeClass('active');
                $(this).addClass('active');
            });            
        });
        function showExtraText() {
            $('.preview-tab').css('display','block');
            $('.tab-content').css('display','none');
            $('ul.nav.nav-tabs li').removeClass('active');
            if($('.active-text-preview').css('display')  == 'none') {
               $('.active-text-preview').css('display' ,'block');
               $('.bookmark-content').css('display' ,'none');
               $('.active-image-preview').css('display' ,'none');
               $('.active-link-preview').css('display' ,'none');
               $('.active-video-preview').css('display' ,'none');
               $('.active-file-preview').css('display' ,'none');
               $('.active-new-link-preview').css('display' ,'none');
            }else if($('.active-text-preview').css('display')  == 'block') {
                $('.active-text-preview').css('display' ,'none');
                $('.bookmark-content').css('display' ,'block');
            }
            
        }
        function showImage() {
            $('.preview-tab').css('display','block');
            $('.tab-content').css('display','none');
            $('ul.nav.nav-tabs li').removeClass('active');            
            if($('.active-image-preview').css('display')  == 'none') {
               $('.active-image-preview').css('display' ,'block');
               $('.bookmark-content').css('display' ,'none');
               $('.active-text-preview').css('display' ,'none');
               $('.active-link-preview').css('display' ,'none');
               $('.active-video-preview').css('display' ,'none');
               $('.active-file-preview').css('display' ,'none');
               $('.active-new-link-preview').css('display' ,'none');
            }else if($('.active-image-preview').css('display')  == 'block') {
                $('.active-image-preview').css('display' ,'none');
                $('.bookmark-content').css('display' ,'block');
            }
            
        }
        function showVideo() {
            $('.preview-tab').css('display','block');
            $('.tab-content').css('display','none');
            $('ul.nav.nav-tabs li').removeClass('active');            
            if($('.active-video-preview').css('display')  == 'none') {
               $('.active-video-preview').css('display' ,'block');
               $('.bookmark-content').css('display' ,'none');
               $('.active-image-preview').css('display' ,'none');
               $('.active-link-preview').css('display' ,'none');
               $('.active-text-preview').css('display' ,'none');
               $('.active-file-preview').css('display' ,'none');
               $('.active-new-link-preview').css('display' ,'none');
            }else if($('.active-video-preview').css('display')  == 'block') {
                $('.active-video-preview').css('display' ,'none');
                $('.bookmark-content').css('display' ,'block');
            }
            
        }
        function showLink() {
            $('.preview-tab').css('display','block');
            $('.tab-content').css('display','none');
            $('ul.nav.nav-tabs li').removeClass('active');            
            if($('.active-link-preview').css('display')  == 'none') {
               $('.active-link-preview').css('display' ,'block');
               $('.bookmark-content').css('display' ,'none');
               $('.active-image-preview').css('display' ,'none');
               $('.active-text-preview').css('display' ,'none');
               $('.active-video-preview').css('display' ,'none');
               $('.active-file-preview').css('display' ,'none');
               $('.active-new-link-preview').css('display' ,'none');
            }else if($('.active-link-preview').css('display')  == 'block') {
                $('.active-link-preview').css('display' ,'none');
                $('.bookmark-content').css('display' ,'block');
            }
            
        }
        function shownewLink() {
            $('.preview-tab').css('display','block');
            $('.tab-content').css('display','none');
            $('ul.nav.nav-tabs li').removeClass('active');            
            if($('.active-new-link-preview').css('display')  == 'none') {
               $('.active-new-link-preview').css('display' ,'block');
               $('.bookmark-content').css('display' ,'none');
               $('.active-image-preview').css('display' ,'none');
               $('.active-text-preview').css('display' ,'none');
               $('.active-video-preview').css('display' ,'none');
               $('.active-file-preview').css('display' ,'none');
               $('.active-link-preview').css('display' ,'none');               
            }else if($('.active-new-link-preview').css('display')  == 'block') {
                $('.active-new-link-preview').css('display' ,'none');
                $('.bookmark-content').css('display' ,'block');
            }
            
        }        
        function showFile() {
            $('.preview-tab').css('display','block');
            $('.tab-content').css('display','none');
            $('ul.nav.nav-tabs li').removeClass('active');            
            if($('.active-file-preview').css('display')  == 'none') {
               $('.active-file-preview').css('display' ,'block');
               $('.bookmark-content').css('display' ,'none');
               $('.active-image-preview').css('display' ,'none');
               $('.active-link-preview').css('display' ,'none');
               $('.active-video-preview').css('display' ,'none');
               $('.active-text-preview').css('display' ,'none');
               $('.active-new-link-preview').css('display' ,'none');
            }else if($('.active-file-preview').css('display')  == 'block') {
                $('.active-file-preview').css('display' ,'none');
                $('.bookmark-content').css('display' ,'block');
            }
            
        }
        function closeTab() {
            $('.preview-tab').css('display','none');
               $('.active-image-preview').css('display' ,'none');
               $('.active-link-preview').css('display' ,'none');
               $('.active-video-preview').css('display' ,'none');
               $('.active-text-preview').css('display' ,'none');
               $('.active-file-preview').css('display' ,'none');
               $('.active-new-link-preview').css('display' ,'none');
        }
		
		// Developer Scripts //
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
                    if (data.type == 'PDF' || data.type == 'pdf') {
                        <!--ADDED BY DENCY -->
                        $(".file_options").show();
                        $(".link_options").hide();
                        <!------------------->
                        $("#drop-file").hide();
                        $("#drop-image").show();
                        // $(".fileName").val(response.code);
                        $(".fileSwitch").hide();
                        $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/<?=Yii::$app->homeUrl;?>images/pdf.png');
                    }
                    if (data.type == 'DOC' || data.type == 'DOCX') {
                        <!--ADDED BY DENCY -->
                        $(".file_options").show();
                        $(".link_options").hide();
                        <!------------------->
                        $("#drop-file").hide();
                        $("#drop-image").show();
                        // $(".fileName").val(response.code);
                        $(".fileSwitch").hide();
                        $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/<?=Yii::$app->homeUrl;?>images/doc.png');
                    }
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
					var l = data.url_title+'<span class="pull-right"><quote>'+preview_url+'</quote><i class="fa fa-times-thin" onclick="closeTab();"></i></span>';
					$('#title_and_url').html(l);
					$('#url_desc').html(data.url_description);
					
					if(displayCheck!=1){
						adjustHeight();
					}

                    //showUrlPreview();
                    //setHeightBlock('', '');

                }
            });
        }
		/** File preview **/
         function showFilePrev(fileName){

			hideAll('active-file-preview');
			$('.active-preview-content').show();
			$('#file_title').html(fileName+'<span onclick="closeTab();" class="pull-right"><i class="fa fa-times-thin"></i></span>');
			$('#file_image').attr("file-name",fileName);
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
				data: { 'block_id': $(elem).attr('block_id') },
				success: function(data){
					data = $.parseJSON(data);
					$("#extra_text_content").html(data.extra_text);
					console.log(data.extra_text);
					$("#extra_text_title").html(data.title);

				}
			});			
		}
		/** Image Preview **/
		function showImage(elem){
			console.log($(elem).attr('data-url'));
			hideAll('active-image-preview');
			$('.active-preview-content').show();	
			var img = '<img style="width:100%" src="'+$(elem).attr('data-url')+'" alt="">';
			$("#img_show").html(img);
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
			$(".preview-tab").show();
			$('.'+except).show();
		}
	/***************************/
	
	
	//******************* Function for Add Comments **************//


	$(document).ready(function(){

		//******************* Function for Add Comments **************//
	
	$('#commentSubmit').click(function(e){
		e.preventDefault();
				var commentcount = $('#comment-count').html();					
				var qardid = $('#qard_id').val();
				var userid = $('#user_id').val();
				var qardcomment = $('#comment-input').val();				
				if(qardid!=''){
					$.ajax({
						url: '<?=Url::to(['comments/create'], true);?>',
						type: "POST",
						data: {
							'qardid': qardid,'userid':userid ,'qardcomment':qardcomment
						},
						success: function(data) {
							$('#comment-input').val('');
							var newcount = parseInt(commentcount) + parseInt(1);
							$('#comment-count').html(newcount);
							$('.comment-list').load(location.href +" .comment-list>*","");
						}
					});
				}

			});
			
			
			//******************* Function for Favourites **************//
			
			$('.activity_card').on('click',function(){
				var sharecount = $('#share-count').html();	
				var likecount = $('#ch-like-count').html();	
				var bookcount = $('#ch-book-count').html();	
				var check =$(this);
				console.log($(this).attr('act-type'));
				var sharetype = $(this).attr('for');
				$.ajax({
					url: '<?=Url::to(['qard/activity'], true);?>',
					dataType: 'html',
					type : 'GET',
					data: {'id':$(this).attr('act-id'),'type':$(this).attr('act-type'),'sharetype':sharetype},
					success: function(response) {							
						console.log(response);
						
						 if(response=='likeed'){	
							
							var newcount = parseInt(likecount) + parseInt(1);
							$('#ch-like-count').html(newcount);
							$("#like-img").attr('src','<?=Yii::$app->request->baseUrl?>/images/heart_icon_light.png');
						}else if(response=='Unlikeed'){
							var newcount = parseInt(likecount) - parseInt(1);
							$('#ch-like-count').html(newcount);
							$("#like-msg").removeClass('active');
							$("#like-img").attr('src','<?=Yii::$app->request->baseUrl?>/images/heart_icon.png');
						
						}else if(response=='bookmarked'){	
						
							var newcount = parseInt(bookcount) + parseInt(1);
							$('#ch-book-count').html(newcount);
												
							$("#book-img").attr('src','<?=Yii::$app->request->baseUrl?>/images/bookmark_icon_light.png');
						}else if(response=='Unbookmarked'){	
						var newcount = parseInt(bookcount) - parseInt(1);
							$('#ch-book-count').html(newcount);
							$("#like-msg").removeClass('active');
							$("#book-img").attr('src','<?=Yii::$app->request->baseUrl?>/images/bookmark_icon.png');
						}else if(response=='shareed'){	
							var newcount = parseInt(sharecount) + parseInt(1);
							$('#share-count').html(newcount);
						} 
					}
					
				}); 
			});
			
	$("#shareclick").click(function(){
        $("#share-input").toggle();
        $("#comment-view").toggle();
        $("#img-span").toggle();
        $("#x-span").toggle();
		$(this).toggleClass( "active" );
		$(this).toggleClass( "share-close" );
    });
	
	
	
	//******************* Function for Copy The URL Link **************//
				
			$("#copy-link").click(function(){
				
				 var copyTextarea = document.querySelector('#share-link');
			  copyTextarea.select();

			  try {
				var successful = document.execCommand('copy');
				var msg = successful ? 'successful' : 'unsuccessful';
				console.log('Text Copied ' + msg);
			  } catch (err) {
				console.log('Oops, unable to copy');
			  }
			});
			
			
	});	
        </script>
        
    </html>                