<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\QardComments;
use yii\db\Query;


/* @var $this yii\web\View */
/* @var $model app\models\Qard */
$this->title = 'Preview Qard';
//$this->meta_image = Yii::$app->homeUrl.'uploads/qards/'.$model['qard_id'].".png";
?>

 <?php
		if(isset($model['qard_id'])){
		    echo '<input type="hidden" name="qard_id" id="qard_id" value="'.$model['qard_id'].'"><input type="hidden" name="user_id" id="user_id" value="'.$model['user_id'].'">';
		}
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

    <section class="consume-card">
	
	
		<div class="profile-header">
			<div class="col-sm-3 col-md-3">
				<div class="left_nav">
					<img src="<?=Yii::$app->homeUrl?>images/arrow-left_icon.png" alt="" width="20px" height="30px">
					<span><strong>Prev. Qard</strong></span>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<ul class="view-list">
					<li class="edit-info"><img src="<?=Yii::$app->homeUrl?>images/deck-thumb.png" width="65px" height="65px" alt=""><span><strong>Tips and Tricks about Travelling</strong></span></li>
					<li><img src="<?=Yii::$app->homeUrl?>images/qards_icon.png" alt="">3/20</li>
					<li class="preview-button"><button class="btn btn-grey"><img src="<?=Yii::$app->homeUrl?>images/preview_icon.png" width="25px" height="15px" alt=""></button></li>
					<li class="preview-button"><button class="btn btn-grey"><i class="fa fa-pencil"></i></button></li>
				</ul>
			</div>
			<div class="col-sm-3 col-md-3">
				<div class="right_nav">                                
					<span><strong>Next. Qard</strong></span>
					<img src="<?=Yii::$app->homeUrl?>images/arrow-right_icon.png" alt="" width="20px" height="30px">
				</div>
			</div>                        
        </div>

		<div id="decknavbar" class="newdeck navbar-collapse collapse" aria-expanded="false" style="height: 0px;">
			<ul class="nav navbar-nav">
			  <li>
				  <div class="add-block">
					  <img src="<?=Yii::$app->homeUrl?>images/98.png" alt="">
				  </div>
			  </li>
			  <li>
				  <div class="add-block">
					  <img src="<?=Yii::$app->homeUrl?>images/98.png" alt="">
				  </div>
			  </li>
			  <li>
				  <div class="add-block">
					  <img src="<?=Yii::$app->homeUrl?>images/98.png" alt="">
				  </div>
			  </li>
			</ul>
		</div>
		<div class="col-sm-12 col-md-12" id="consume-preview">
                        <div class="row">
                            <nav class="deck navbar col-sm-1 col-md-1">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#decknavbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            </nav>                        
                            <h3><?=$model->title?></h3>
                            <div class="bottom-card col-sm-12 col-md-12">
                                <ul>
                                    <li>
                                           <div class="comment-img">
                                               <img src="<?=$model->userProfile->profile_photo?>" alt="">
                                           </div>
                                           <div class="comment-txt">
                                               <h5><strong><?=$model->userProfile->fullname?></strong></h5>
                                               <p class="post-date">3 days ago</p>
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

        <div class="row">

        <div class="add-block col-sm-3 col-md-3" id="qard<?=$model->qard_id?>" >

		
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
						//img block styles
							$img_block_style .= 'opacity:'.$theme['image_opacity'].';';
	/* 						if($block->link_image != ''){
									
									$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
									$img_block_style .= 'background-size: cover;';
							} */
							if($theme['div_bgcolor'] != '')
								$img_block_style .= 'background-color:'.$theme['div_bgcolor'].';';	
							$img_block_style .= 'min-height:'.$theme['height'].'px;';
							$img_block_style .= 'height:auto;';
							
						//overlay block styles
							$overlay_block_style .= 'opacity:'.$theme['div_opacity'].';';
							if(isset($theme['div_overlaycolor']) && $theme['div_overlaycolor']!='')
								$overlay_block_style .= 'background-color:'.$theme['div_overlaycolor'].';';
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
					<div class="text-block" style="'.$text_block_style.'">';
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
			<ul class="nav nav-tabs col-sm-1 col-md-1" role="tablist">
	  
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
		<?//=$count[0]['sharecount']?>
		<li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab"><img class="image-default" src="<?=Yii::$app->homeUrl;?>images/comments_icon.png" alt=""> <img class="image-close" src="<?=Yii::$app->homeUrl;?>images/close_icon_light.png" alt=""></a></li> 
		
		<li role="presentation"><span style="display:none;" id="share-count" class="cartdisplay" ><?=$count['sharecount']?></span><a href="#shareblock" aria-controls="shareblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl;?>images/share_icon.png" class="image-default" alt=""><img class="image-close" src="<?=Yii::$app->homeUrl;?>images/close_icon_light.png" alt=""></a></li>  
		
		<li role="presentation" class="activity_card <?=$bkact;?>" id="book-msg" act-type="bookmark" act-id="<?=$model->qard_id?>" for="" ><span class="arrow-left"></span><a  aria-controls="favblock" role="tab" data-toggle="tab" ><?=$bkimg?>
		

		
		</a></li>   
		
		<li role="presentation" class="activity_card <?=$hact;?>"  id="like-msg" act-type="like" act-id="<?=$model->qard_id?>" for="" ><span class="arrow-left"></span><a  aria-controls="favblock" role="tab" data-toggle="tab" ><?=$himg?>
		
	
		
		</a></li>
		
		
	  </ul>
	
	  <!-- Tab panes -->
	  
	 
		
	<div class="col-sm-11 col-md-11">
		<div id="preview-tab" class="preview-tab" style="display: block;">
			<div class="bookmark-content">
				<img src="<?=Yii::$app->homeUrl;?>images/demo_icon.png" alt="">
				<h4>Explore the Qard Blocks by clicking the links on the qard</h4>
			</div>                                      
			<div class="active-text-preview" style="display: none;">        <!-- extra text preview block -->
				<h4><div id="extra_text_title"></div><span class="pull-right"><i class="fa fa-times-thin"></i></span></h4>
				<div class="active-preview-content" id="extra_text_content">
					<p></p>
				</div>
			</div>
			<div class="active-video-preview" style="display: none;">           <!-- video preview block -->
				<h4>Watch the video here<span class="pull-right"><quote id="#video_url">http://youtube.com/ahsdgu</quote><i class="fa fa-times-thin"></i></span></h4>
				<hr class="divider">
				<div class="active-preview-content">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.. <a href="">more</a> </p>
					<div id="video_frame"><iframe height="315" src="https://www.youtube.com/embed/cqNmVJk7Zyg" frameborder="0" allowfullscreen=""></iframe></div>
				</div>
			</div>
			<div class="active-link-preview" style="display: none;">        <!-- link preview block -->
				<h4>Dribble <span class="pull-right"><quote>http://youtube.com/ahsdgu</quote><i class="fa fa-times-thin"></i></span></h4>
				<hr class="divider">
				<div class="active-preview-content">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. </p>
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
							<button id="file_image" class="bnt qard">Download File</button>
						</div>
						<div id="pdf_area"></div>
				</div>
			</div>
			<div class="active-image-preview" style="display: none;">       <!-- image preview block -->
				<h4 id="img_title">Title Comes Here <span class="pull-right"><i class="fa fa-times-thin"></i></span></h4>
				<hr class="divider">
				<div class="active-preview-content">
					<div class="image-show" id="img_show" >
						<img src="<?=Yii::$app->homeUrl;?>images/98.png" alt="">
					</div>
				</div>
			</div>                                   
		</div>                                 
		<div class="tab-content" style="display: none; ">                               
		  <div role="tabpanel" class="tab-pane active" id="comments">
			  <div class="cardblock-header">
			  
			  <?php 
			  $qard_id = $model->qard_id;
			  
						$comments = QardComments::find()->where(['qard_id'=>$qard_id])->orderBy('created_at DESC')->all();
						
							?>
							
				  <h4>Comments(<span id='comment-count'><?=count($comments)?></span>) <span class="pull-right"><i class="fa fa-times-thin"></i></span></h4>
				  <h4 class="comment-input"><input type="text" id="comment-input" name="comment-input" class="col-sm-10 col-md-10" placeholder="Share what you're thinking..."><button id="commentSubmit" class="btn qard col-sm-2 col-md-2">POST</button></h4>
			  </div>
			  

						
				  <ul class="comment-list" style=" overflow-y:scroll; height:500px;">
				  <?php foreach($comments as $comment){ 
						
							
						   $profile_photo = $comment->userProfile->profile_photo; 
				  ?>
					  <li class="col-sm-12 col-md-12">
					  
						  <div class="comment-img col-sm-1 col-md-1">
							  <img src="<?=$profile_photo?>" alt="">
						  </div>
						  <div class="comment-txt col-sm-11 col-md-11">
							  <p><strong><?=$comment->userProfile->fullname ?></strong><?=$comment['text']?></p>
							   <?php 
								  $datetime = $comment['created_at'];
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
 
				  <?php } ?>					  

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
			<div role="tabpanel" class="tab-pane " id="favblock" style="padding: 20px;">
			
		  	<div class="bookmark-content">
				<img src="<?=Yii::$app->homeUrl;?>images/demo_icon.png" alt="">
				<h4 style="padding-left: 20px;">Explore the Qard Blocks by clicking the links on the qard</h4>
			</div>
			
			</div>
			
		  <div role="tabpanel" class="tab-pane" id="shareblock">                                                                  
			  <div class="cardblock-header">
				  <h4>Share <span class="pull-right"><i class="fa fa-times-thin"></i></span></h4>                                        
			  </div>
			  <div class="share-input">
				<h4>Share the link below in social media, in email, or whatever.</h4>
				<h4 class="share-input"><input type="text" readonly="readonly" name="share-input" id="share-link" value="<?= Yii::$app->request->absoluteUrl ?>" class="col-sm-10 col-md-10" ><button for="copylink" act-type="share" act-id="<?=$model->qard_id?>" id="copy-link" class="btn qard col-sm-2 col-md-2 activity_card">COPY LINK</button></h4>
				<div class="quick-share">
					<h4>Quick Share</h4>
					<ul>
						<li class="activity_card" act-type="share" act-id="<?=$model->qard_id?>" for="facebook" ><a style="display:block !important " href="https://www.facebook.com/sharer/sharer.php?u=<?= Yii::$app->request->absoluteUrl ?>" target="_blank" ><i class="fa fa-facebook"></i></a></li>
						<li class="activity_card" act-type="share" act-id="<?=$model->qard_id?>" for="twitter"  ><a href="https://twitter.com/home?status=<?= Yii::$app->request->absoluteUrl ?>" target="_blank" ><i class="fa fa-twitter"></i></a></li>
						<li class="activity_card" act-type="share" act-id="<?=$model->qard_id?>" for="linkedin" ><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= Yii::$app->request->absoluteUrl ?>&title=&summary=&source="><i class="fa fa-linkedin"></i></a></li>

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
</div>
    </section>
    <!-- block_error popup -->


    <script type="text/javascript">
        $(document).ready(function(){
            var avalue = "active";
            if($('ul.nav.nav-tabs li').hasClass(avalue) === false) {
                $('.preview-tab').css('display','block');
                $('.tab-content').css('display','none');
            }
            $('ul.nav.nav-tabs li').click(function(){
				var id = $(this).attr('id');
				if( (id == "like-msg") ||(id == "book-msg") )
				{
				$('.preview-tab').css('display','block');
                $('.tab-content').css('display','none'); 
				}else{
				$('.preview-tab').css('display','none');
                $('.tab-content').css('display','block'); 
				}				
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
        });
	
		$('#cardtabs a').click(function (e) {

		//  e.preventDefault();

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
			callUrl(dataurl,displayCheck);
			$('#preview-tab').show();
			return false;
		}
		/*
		* Link block functions
		*/
        function callUrl(urlField,displayCheck) {
            //console.log($(urlField).val());
			
            var preview_url = urlField;
            var get_preview_url = "<?=Url::to(['qard/url-preview'], true);?>";
            $.ajax({
                url: get_preview_url,
                type: "GET",
				datatype : 'json',
                data: {
                    'url': preview_url
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
			$('#file_title').html(fileName);
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
			$("#preview-tab").show();
			$('.'+except).show();
		}
	/***************************/
	
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
							$("#like-msg").addClass( "tootip" );
							$("#like-msg").attr("data-title","Qard was added to your favourites");							 
							$("#like-img").attr('src','<?=Yii::$app->request->baseUrl?>/images/heart_icon_light.png');
						}else if(response=='Unlikeed'){
							$("#like-msg").removeClass('active');
							$("#like-img").attr('src','<?=Yii::$app->request->baseUrl?>/images/heart_icon.png');
						
						}else if(response=='bookmarked'){	
							$("#book-msg").addClass( "tootip" );
							$("#book-msg").attr("data-title","Qard was added to your bookmarks");						
							$("#book-img").attr('src','<?=Yii::$app->request->baseUrl?>/images/bookmark_icon_light.png');
						}else if(response=='Unbookmarked'){	
							$("#book-msg").removeClass('active');
							$("#book-img").attr('src','<?=Yii::$app->request->baseUrl?>/images/bookmark_icon.png');
						}else if(response=='shareed'){	
							var newcount = parseInt(sharecount) + parseInt(1);
							$('#share-count').html(newcount);
						} 
					}
					
				}); 
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
	<style>
	
	
.cartdisplay {
    background: #ff0c93 none repeat scroll 0 0;
    border-radius: 25px;
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    height: 25px;
    position: absolute;
    right: -13px;
    text-align: center;
    top: -7px;
    vertical-align: bottom;
    width: 25px;
}
	</style>
