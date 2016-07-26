<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\QardTags;
/* @var $this yii\web\View */
/* @var $model app\models\Qard */
$this->title = 'Edit Qard';
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
	<style>
	.qard-bottom{
		display: none;
	}
	.grid-item { 
		overflow : hidden;
	}
	</style>
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

    <section class="create-card">
        <div id="wait" class="waiting_logo"><img src='<?=Yii::$app->request->baseUrl?>/img/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
		<div class="row">

				<div class="col-sm-6 col-md-6">
					<h2>
						<input type="text" name="qard_title" id="qard_title" value="<?php echo $model->title;?>" placeholder="Enter a Title for this Qard">
					</h2>                            
				</div>
		</div>
				</br>
				<div class="row">
						<div class="col-sm-6 col-md-6" style="padding: 0;">
							<select class="js-example-basic-multiple form-control" id="tags" name="tags[]" multiple="multiple" placeholder="Add some tags">
							<?php 		
								$selected_tags = [];
								$saved_tags = QardTags::find()->where(['qard_id'=>$model->qard_id])->all();
								foreach($saved_tags as $saved_tag){
									$selected_tags[$saved_tag->tag_id] = $saved_tag->tag_id;
								}
								//print_r($selected_tags);exit;
								foreach($tags as $tag){
									if(array_key_exists($tag->tag_id,$selected_tags))
										echo '<option value="'.$tag->tag_id.'" selected>'.$tag->name.'</option>';
									else
										echo '<option value="'.$tag->tag_id.'">'.$tag->name.'</option>';
								}
							?>
							</select>
						</div>  
                        <div class="col-sm-6 col-md-6">
                            <ul class="pull-right">
							<?php 
								$qard_deck = $model->qardDecks;
								if($qard_deck && $qard_deck->deck_id){
									echo '<li><button id="add_to_deck" class="btn btn-default" href="'.\Yii::$app->request->baseUrl.'/deck/select-deck" >Change Deck</button></li>';						
									echo '<li><button id="remove_from_deck" onClick="removeFromDeck()" class="btn btn-default">Remove From Deck</button></li>';
								}

								else
									echo '<li><button class="btn btn-default" id="add_to_deck" href="'.\Yii::$app->request->baseUrl.'/deck/select-deck" >Add to Deck</button></li>';	
									
								
							?>
                                <li><button class="btn qard" data-toggle="modal" data-target="#qard-style">Qard Style</button></li>
                            </ul>
                        </div>   						
				</div>

		
		</br>
        <div class="row">

            <div class="col-sm-3 col-md-3 add-block">
                <div id="add-block" class="qard-div add-block-qard" style="overflow:hidden">
						<?php
						if(isset($model['qard_id'])){
							echo '<input type="hidden" id="qard_id" name="qard_id" value="'.$model['qard_id'].'">';
						}
						?>
						<input type="hidden" name="theme_id" value="<?=$theme['theme_id']?>">
		
						<?php 
						//get theme properties
						$theme_properties = unserialize($theme['theme_properties']);
						//print_r($theme_properties);
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
					//get theme properties
					$theme_properties = unserialize($theme['theme_properties']);
					//print_r($theme_properties);
					$blocks = $model->blocks;
					$str = '';
					$i = 1;
					foreach($blocks as $block){
						////get the inline styles///						
						$img_block_style = '';
						$overlay_block_style = '';
						$text_block_style = '';
						$theme = $block->theme->theme_properties;
						$theme = unserialize($theme);
						$height_in_BU = $theme['height']/37.5;
						if(isset($theme)){
							//img block styles
								$img_block_style .= 'opacity:'.$theme['image_opacity'].';';
								if($block->link_image != ''){
										
										$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
										$img_block_style .= 'background-size: cover;';
								}
								if($switch_theme){
									//echo $theme['data_bgcolor_id'];
									if(isset($theme['data_bgcolor_id']) && $theme['data_bgcolor_id'] != '0' ){
										$property = $theme['data_bgcolor_id'];
										$bg_colour = $theme_properties[$property];
									}else{
										$property = 'theme_color_2';
										$bg_colour = $theme_properties[$property];
									}
											
									$img_block_style .= 'background-color:'.$bg_colour.';';	
								}else{
									if($theme['div_bgcolor'] != '')
										$img_block_style .= 'background-color:'.$theme['div_bgcolor'].';';									
								}	
								$img_block_style .= 'height:'.$theme['height'].'px;';
								//$img_block_style .= 'height:auto;';
								
							//overlay block styles
								$overlay_block_style .= 'opacity:'.$theme['div_opacity'].';';
								if(isset($theme['div_overlaycolor']) && $theme['div_overlaycolor']!='')
									$overlay_block_style .= 'background-color:'.$theme['div_overlaycolor'].';';
								$overlay_block_style .= 'height:'.$theme['height'].'px;';
								//$overlay_block_style .='height:auto;';
								
								$text_block_style .= 'height:'.$theme['height'].'px;';
								$text_block_style .='overflow:hidden;';
								//$text_block_style .='height:auto;';
						}
						///////////////////////////
					if(!isset($theme['data_style_qard']))
						$theme['data_style_qard'] = "line";
					if($i == 1)
						$str .= '<div id="working_div" class="working_div block active">';
						
						$str .= '<div id="blk_'.$i.'" data-style-qard="'.$model['qard_style'].'" data-bgcolor-id="'.$theme['data_bgcolor_id'].'" class="bgimg-block parent_current_blk ui-resizable '.$model['qard_style'].'" style="'.$img_block_style.'" >
						<div class="bgoverlay-block" style="'.$overlay_block_style.'">';
					if($i == 1)
						$str .= '<div data-height="'.$height_in_BU.'" class="text-block current_blk working_div" contenteditable="true" unselectable="off" data-block_priority="'.$i.'" data-theme_id="'.$block->theme->theme_id.'" data-block_id="'.$block->block_id.'" style="overflow:hidden" style="'.$text_block_style.'">';
					else
						$str .= '<div data-height="'.$height_in_BU.'" class="text-block current_blk" data-block_priority="'.$i.'" data-theme_id="'.$block->theme->theme_id.'" data-block_id="'.$block->block_id.'" style="'.$text_block_style.'">';
						$str .= $block->text;
						$str .= '</div>';
						
						$str .= '</div></div>';	
						if($i == 1)
							$str .= '</div>';
						$i = $i+1;;
					}
					echo $str;
					?>
                        <!--<div id="working_div" class="working_div block active">
                            <div id="blk_1" class="bgimg-block parent_current_blk">
                                <div class="bgoverlay-block">
                                    <div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off" data-block_priority="1" style="overflow:hidden;margin:10px"></div>
                                </div>
                            </div>
                        </div>-->
                        <h5 class="add-another" onclick="add_block(event,true)"><i class="fa fa-plus"></i>Add another block </h5>
                </div>
            </div>
            <div class="col-sm-9 col-md-9">
                <div id="cardtabs">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs col-sm-1 col-md-1" role="tablist">
					
                        <li role="presentation" class="active"><a href="#cardblock" aria-controls="cardblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/text_icon.png" alt="" class="dark" style="width:15px;margin:0 auto;"><img src="<?=Yii::$app->homeUrl?>images/text_icon_light.png" class="light" alt="" style="width:15px;margin:5px auto;"></a></li>
						
                        <li role="presentation"><a href="#linkblock" class="pasteBlock" aria-controls="linkblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/link_icon.png" class="dark" alt=""><img src="<?=Yii::$app->homeUrl?>images/link_icon_light.png" class="light" alt="" style="margin:5px auto;"></a></li>
						
                        <li role="presentation"><a id="imgblock_tab" href="#imgblock" aria-controls="imgblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/image_icon.png" class="dark" alt=""><img src="<?=Yii::$app->homeUrl?>images/image_icon_light.png" class="light" alt="" style="margin:5px auto;"></a></li>
						
                        <li role="presentation"><a href="#linkblock" class="embedBlock" aria-controls="linkblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/video_icon.png" class="dark" alt=""><img src="<?=Yii::$app->homeUrl?>images/video_icon_light.png" class="light" alt=""></a></li>
						
						<li role="presentation"><a href="#fileblock" aria-controls="fileblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/file_icon.png" class="dark" alt="" style="width:15px;margin:0px auto;"><img src="<?=Yii::$app->homeUrl?>images/file_icon_light.png" class="light" alt="" style="width:15px;margin:5px auto;"></a></li>
						
                        <li role="presentation"><a href="#copyblock" aria-controls="copyblock" role="tab" data-toggle="tab"><hr class="divider"></hr><img src="<?=Yii::$app->homeUrl?>images/duplicate_icon.png" class="dark" alt=""><img src="<?=Yii::$app->homeUrl?>images/duplicate_icon_light.png" class="light" alt=""></a></li>

						
                        <li role="presentation" id="deleteblock"><a href="#deleteblock" aria-controls="deleteblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/delete_icon.png" class="dark" alt=""><img src="<?=Yii::$app->homeUrl?>images/delete_icon_light.png" class="light" alt=""></a></li>
						
                    </ul>
                    <!--added by vijay-->


                    <!-- Tab panes -->
                    <div class="tab-content col-sm-11 col-md-11">
					<!-- Start of header-->
						<div class="cardblock-header">
							<h4>Edit Block</h4>
							<ul class="editable-elements">
								<li class="size-element">
									<label>Text Size</label>
									<select id="text_size" class="form-control">
										<option value="3">Small</option>
										<option value="5">Medium</option>
										<option value="8">Large</option>
									</select>
								</li>
								<li id="text_bold"><a href="#"><i class="fa fa-bold"></i></a></li>
								<li id="text_italic"><a href="#"><i class="fa fa-italic"></i></li>
								<li id="text_underline"><a href="#"><i class="fa fa-underline"></i></a></li>
								<li>
									<div class="dropdown">
									  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										<img src="<?=Yii::$app->homeUrl?>images/icon-left.png" alt="">
										<span class="caret"></span>
									  </button>										
									  <ul class="dropdown-menu" id="alignment_select" aria-labelledby="dropdownMenu2">
										<li><a href="#" data-align="justifyLeft"><i class="fa fa-align-left"></i></a></li>
										<li><a href="#" data-align="justifyRight"><i class="fa fa-align-right"></i></a></li>
										<li><a href="#" data-align="justifyCenter"><i class="fa fa-align-center"></i></a></li>
										<li><a href="#" data-align="justifyFull"><i class="fa fa-align-justify"></i></a></li>
									  </ul>
									</div>                                                        
								</li>
								<li><a href="#"><img src="<?=Yii::$app->homeUrl?>images/type-align-top_icon.png" alt="" style="padding: 5px;"></a><span class="caret"></span></li>
								<li><a href="#"><img src="<?=Yii::$app->homeUrl?>images/link_icon.png" alt="" style="padding: 8px;"></a></li>
								<li class="color-elements">
									<label>Text Color</label>
									<div class="dropdown">
									  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									  </button>
									  <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
										<li><a href="#" class="color" style="background:<?php echo $theme_properties['theme_color_1'];?>;display: block;height: 20px;width: 20px;padding: 0px;border-radius: 2px" data-fontcolor-id="theme_color_1" data-color="<?php echo $theme_properties['theme_color_1'];?>" onClick="setForeColor(this);"></a></li>
										<li><a href="#" class="color" style="background:<?php echo $theme_properties['theme_color_2'];?>;display:block;height: 20px;width: 20px;padding:0px;border-radius: 2px" data-fontcolor-id="theme_color_2" data-color="<?php echo $theme_properties['theme_color_2'];?>"  onClick="setForeColor(this);"></a></li>
										<li><a href="#" class="color" style="background:<?php echo $theme_properties['theme_color_3'];?>;display:block;height: 20px;width: 20px;padding:0px;border-radius: 2px" data-fontcolor-id="theme_color_3" data-color="<?php echo $theme_properties['theme_color_3'];?>"  onClick="setForeColor(this);"></a></li>
										<li><a href="#" class="color" style="background:<?php echo $theme_properties['theme_color_4'];?>;display:block;height: 20px;width: 20px;padding:0px;border-radius: 2px" data-fontcolor-id="theme_color_4" data-color="<?php echo $theme_properties['theme_color_4'];?>"  onClick="setForeColor(this);"></a></li>
										<li><a href="#" class="color" style="background:<?php echo $theme_properties['theme_color_5'];?>;display:block;height: 20px;width: 20px;padding:0px;border-radius: 2px" data-fontcolor-id="theme_color_5" data-color="<?php echo $theme_properties['theme_color_5'];?>"  onClick="setForeColor(this);"></a></li>
									  </ul>
									</div>
								</li>
								<li class="color-elements">
									<label>Block Color</label>
									<div class="dropdown">
									  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									  </button>
									  <ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
										<li class="color" style="background:<?php echo $theme_properties['theme_color_1'] ?>" data-bgcolor-id="theme_color_1" data-color="<?php echo $theme_properties['theme_color_1'] ?>" onclick="setBGColor(this);"></li>
                                        <li class="color" style="background:<?php echo $theme_properties['theme_color_2'] ?>" data-bgcolor-id="theme_color_2" data-color="<?php echo $theme_properties['theme_color_2'] ?>" onclick="setBGColor(this);"></li>
										<li class="color" style="background:<?php echo $theme_properties['theme_color_3'] ?>" data-bgcolor-id="theme_color_3" data-color="<?php echo $theme_properties['theme_color_3'] ?>" onclick="setBGColor(this);"></li>
										<li class="color" style="background:<?php echo $theme_properties['theme_color_4'] ?>" data-bgcolor-id="theme_color_4" data-color="<?php echo $theme_properties['theme_color_4'] ?>" onclick="setBGColor(this);"></li>
										
										<li class="color" style="background:<?php echo $theme_properties['theme_color_5'] ?>" data-bgcolor-id="theme_color_5" data-color="<?php echo $theme_properties['theme_color_5'] ?>" onclick="setBGColor(this);"></li>
									  </ul>
									</div>
								</li>                                                                                            
							</ul>
						</div> <!-- End of header-->
						<div role="tabpanel" class="tab-pane active" id="cardblock">
							<div id="descfield">
								<h4>Add Extra text <span class="trash pull-right"><i class="fa fa-trash"></i>&nbsp;Remove Extra Text</span></h4>
								<input type="text" name="extra-text" placeholder="Enter an optional text" class="form-control">
								<ul class="editable-elements">
									<li id="text_area_bold"><a href="#"><i class="fa fa-bold"></i></a></li>
									<li id="text_area_italics"><a href="#"><i class="fa fa-italic"></i></li>
									<li id="text_area_underline"><a href="#"><i class="fa fa-underline"></i></a></li>
									<li><a id="extra_text_link" href="#"><img src="<?=Yii::$app->homeUrl?>images/link_icon.png" alt="" style="padding: 8px;"></a></li>
								</ul>
							</div>
							<div id="extrafield">
								<div id="extra_text" name="desc" placeholder="Enter The Text" contenteditable="true"></div>
							</div>
						</div>

                        <div role="tabpanel" class="tab-pane" id="imgblock">
                            <!--<form  class="dropzone" id="imageupload" enctype="multipart/form-data" >-->

                            <div class="drop-image">
                                <form action="" id="image_upload" method="post" enctype="multipart/form-data">
                                    <div class="dropzone" id="for_image" data-width="960" data-ajax="false" data-height="540" style="width: 100%;">
                                        <input type="text" name="vijay" value="hello">
                                        <input type="file" name="thumb" required="required" />
                                    </div>
                                </form>
                            </div>
                            <!--		    </form>-->
                            <div class="form-group image-elements">
                                <div class="col-sm-3 col-md-3">
                                    <input type="text" id="image_opc" class="form-control" placeholder="Image Opacity (%)">
                                </div>
                                <div class="col-sm-3 col-md-3">
                                    <input type="text" id="overlay_color" class="form-control" placeholder="Overlay Color (#fff)">
                                </div>
                                <div class="col-sm-3 col-md-3">
                                    <input type="text" id="overlay_opc" class="form-control" placeholder="Overlay Opacity (%)">
                                </div>
                                <div class="col-sm-3 col-md-3">
                                    <ul>
                                        <li><a href="#"><img src="<?=Yii::$app->request->baseUrl?>/images/place.png" alt=""></a></li>
                                        <li id="reset_image"><a href="#"><img src="<?=Yii::$app->request->baseUrl?>/images/refresh.png" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                            <ul class="on-off pull-right">
                                <li>
                                    <div class="switch">
                                        <input id="cmn-toggle-3" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                        <label for="cmn-toggle-3"></label>
                                    </div> <span>Display as Background Image</span>
                                </li>
                            </ul>
                        </div>
						
                        <div role="tabpanel" class="tab-pane" id="linkblock">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#paste" aria-controls="paste" role="tab" data-toggle="tab"><button class="btn btn-warning">Paste URL</button></a></li>
								<li role="presentation"><a href="#embed" aria-controls="embed" role="tab" data-toggle="tab"><button class="btn btn-grey">Embed Code</button></a></li>
								<li class="pull-right"><span class="trash pull-right" id="url_reset_link"><i class="fa fa-trash"></i>&nbsp;Remove Url/Embed Code</span></li>                                        
							</ul>
							<h4>&nbsp;</h4>
							<div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="paste">
									<div class="form-group" id="showlinkUrl">
										<input type="text" name="url" id="link_url" class="form-control pasteUrl" placeholder="Paste Url (Another qard deck,website,youtube video, images etc)">
										<p style="color: orange;">Link directly to another Qard or Deck by using its QardDech share URL</p>
									</div>
									<div id="link_div" style="padding-bottom: 10px;">
										<div class="preview-image">                                       
										</div>  
									</div>	
									<div class="form-group toggle-btn">
										<div class="col-sm-4 col-md-4 on-off">
											<div class="switch">
												<input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox">
												<label for="cmn-toggle-4"></label>
											</div>  <span>Display URL</span>                                                  
										</div>                                            
										<div class="col-sm-4 col-md-4 on-off">
											<div class="switch">
												<input id="cmn-toggle-6" class="cmn-toggle cmn-toggle-round" type="checkbox">
												<label for="cmn-toggle-6"></label>
											</div>  <span>Open Link in New Tab</span>                                                 
										</div>
									</div>
									<div class="form-group extra-content">
										<input type="text" name="url-title" class="col-sm-5 col-md-5" placeholder="Enter Title">
										<input type="text" name="url-desc" class="col-sm-5 col-md-5 col-md-offset-1" placeholder="Add a description">
									</div>
								</div>
								<div role="tabpanel" class="tab-pane" id="embed">
									<div class="form-group" id="embedCode">
										<input type="text" name="embed_code" id="embed_code" class="form-control pasteUrl" placeholder="Paste your embed code (Youtube, Vimeo etc)">
									</div>
									<div id="embed_div">
										<div class="preview-image">                                       
										</div>  
									</div>	
								</div>  

							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="fileblock">
							<h4 id="reflink" >Add File<span class="trash pull-right" ><i class="fa fa-trash"></i>&nbsp;Remove File</span></h4>
                            
							<form method="post" action="" id="qard-url-upload" enctype="multipart/form-data" novalidate class="box">
								<div class="add-new-file">
									<div class="drop-file form-group" id="drop-file-bg">
										<img src="<?=Yii::$app->request->baseUrl?>/images/browse_light.png" alt="">
										<h3>Drop files/click to Browse</h3>
									</div>
									<div class="fileSwitch">
										<input id="qard-url-upload-click" name="image" class="hidden" type="file">
										<div class="box__input">
											<input type="file" name="files[]" id="file" class="box__file hidden" data-multiple-caption="{count} files selected" multiple />
										</div>
									</div>								
									<div class="drop-file form-group" id="drop-file">
										<img src="<?=Yii::$app->request->baseUrl?>/images/browse.png" alt="">
										<h3 id="fileTitle">FileName.psd</h3>
									</div>
									<div class="fileSwitch">
										<input id="qard-url-upload-click" name="image" class="hidden" type="file">
										<div class="box__input">
											<input type="file" name="files[]" id="file" class="box__file hidden" data-multiple-caption="{count} files selected" multiple />
										</div>
									</div>
								</div>
								
								<div class="form-group toggle-btn">
									<div class="col-sm-6 col-md-6 on-off">
											<div class="switch">
												<input id="cmn-toggle-7" class="cmn-toggle cmn-toggle-round" type="checkbox">
												<label for="cmn-toggle-7" class="victim"></label>
											</div>  <span>Open in New Tab</span> 
									</div>                                      
								</div>

								<div class="form-group extra-content" id="drop-image">
									<input type="text" name="filename" class="filename fileName col-sm-5 col-md-5" placeholder="Enter Title">
									<input type="text" name="desc" class="col-sm-5 col-md-5 col-md-offset-1 desc" placeholder="Add a description">
								</div>
							</form>	
                        </div>
						
                        <div role="tabpanel" class="tab-pane" id="paintblock">
                            <fieldset>
                                <div class="form-group col-sm-6 col-md-6">
                                    <h4>Block Size</h4>
                                    <input type="text" name="blk_size" id="blk_size" pattern="^\d{2}$" class="form-control" placeholder="Number of block units(2)" maxlength="2" min="1">
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <h4>Block Background Color</h4>
                                    <input type="text" name="blk_color" id="bg_color" class="form-control" placeholder="Background color (#0000)">
									<ul>
                                        ##taken							
									</ul>
                                </div>

                            </fieldset>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="copyblock">..</div>
                        <div role="tabpanel" class="tab-pane" id="deleteblock">.</div>
						<?php /* Style card starts Here */ ?>
						<div role="tabpanel" class="tab-pane" id="styleblock">.
							<h3 style="text-align: center;">Customize The Look & Feel of Your Qard</h3>
							<button class="btn btn-default">Back</button>
                            <h4>Style</h4>
                            <div class="theme-content">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="flat col-sm-3 col-md-3">
                                            <div class="qard-content">
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>                                
                                            </div>
                
                                        </div>
                                        <div class="line col-sm-3 col-md-3">
                                            <div class="qard-content">
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>                                
                                            </div>
                                        </div>                                        
                                        <div class="gap col-sm-3 col-md-3">
                                            <div class="qard-content">
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>                                
                                            </div>
                                        </div>
                                        <div class="shadow col-sm-3 col-md-3">
                                            <div class="qard-content">
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>
                                                <div class="block-style"></div>                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4>Qard Theme</h4>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <ul class="theme-bglist">
                                                <li class="bglist" style="background:<?=$theme_properties['theme_color_1']?>;"></li>
                                                <li class="bglist" style="background:<?=$theme_properties['theme_color_2']?>;"></li>
                                                <li class="bglist" style="background:<?=$theme_properties['theme_color_3']?>;"></li>
                                                <li class="bglist" style="background:<?=$theme_properties['theme_color_4']?>;"></li>
												<li class="bglist" style="background:<?=$theme_properties['theme_color_5']?>;"></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <button class="btn btn-default"><a id="qardid-link" href="<?=Yii::$app->request->baseUrl?>/theme/select-theme">Change Theme</a></button>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
						</div>
						<?php /* Style card Ends Here */ ?>
                    </div>

                </div>

            </div>
        </div>
		<div class="bottom-card row">
			<div class="col-sm-3 col-md-3">
                                  
			</div>
			<div class="col-sm-8 col-md-8 col-md-offset-1">
				<ul class="help-list"> 
					<li class="help-link"><a href=""><img src="<?=Yii::$app->homeUrl?>images/need-help_icon.png" width="30px" height="30px" style="margin-right:5px;" alt="">Need Help?</a></li>
					<li class="pull-right"><button class="btn btn-warning" name="preview" onclick="addSaveCard(event)">Preview Card</button></li>
					<!--<li><button class="btn btn-warning" name="preview">Save</button></li>-->
				</ul>
			</div>
		</div> 
    </section>
    <!-- block_error popup -->
	<div id="deck-style" class="fade modal in" role="dialog" tabindex="-1">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Select a Deck to Add Qard to :
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</h4>
				</div>
				<div class="modal-body"></div>
				<div class="grid">

				</div>
			</div>
		</div>
	</div>
	<!-- Qard style pop up -->
		<!-- Modal -->
		<div class="modal fade" id="qard-style" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            
			  </div>
			  <div class="modal-body">
				<h4 class="modal-title">Theme : Qard Deck</h4>
				<div class="themes-list">        <!-- qard list -->
					<div class="grid row" id="themeorder">
					<?php 
					use app\models\Theme;
					$themes = Theme::find()->where(['theme_type'=>1])->all();
						foreach($themes as $theme){
							$all_theme_properties = unserialize($theme->theme_properties);
							echo '<div class="grid-item qard-bg" id="'.$theme->theme_id.'" >     <!-- qard -->
							<div class="qard-content">
								<div class="themebg1">
									<div class="bgcolor" style="background:'.$all_theme_properties['theme_color_1'].'"></div>
								</div>
								<div class="themebg2">
									<div class="bgcolor" style="background:'.$all_theme_properties['theme_color_2'].'"></div>
								</div>
								<div class="themebg3">
									<div class="bgcolor" style="background:'.$all_theme_properties['theme_color_3'].'"></div>
								</div>
								<div class="themebg4">
									<div class="bgcolor" style="background:'.$all_theme_properties['theme_color_4'].'"></div>
								</div>
								<div class="themebg5">
									<div class="bgcolor" style="background:'.$all_theme_properties['theme_color_5'].'"></div>
								</div>                                      
							</div>
							<div class="qard-top">
								<h4>'.$theme->theme_name.'</h4>
							</div>
							';
							echo "</div>";
					
						}				
					?>
									
					</div>      <!-- row  -->
				</div>
					<h4 class="modal-title">Block Style : Flat</h4>
					<div class="row block-list">
						<div class="qrd-pattern col-sm-3 col-md-3" id="flat">
							<img src="<?=Yii::$app->homeUrl?>images/block-style_flat.png" alt="">
						</div>
						<div class="qrd-pattern col-sm-3 col-md-3" id="gap">
							<img src="<?=Yii::$app->homeUrl?>images/block-style_gap.png" alt="">
						</div>
						<div class="qrd-pattern col-sm-3 col-md-3" id="shadow">
							<img src="<?=Yii::$app->homeUrl?>images/block-style_shadow.png" alt="">
						</div>
						<div class=" qrd-pattern col-sm-3 col-md-3" id="line">
							<img src="<?=Yii::$app->homeUrl?>images/block-style_line.png" alt="">
						</div>                                    
					</div>  <!-- row -->                              
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-grey pull-left" data-dismiss="modal">CANCEL</button>
				<button type="button" class="btn btn-warning pull-right" id="qrdstyle-link" data-theme="<?=$theme['theme_id']?>" data-pattern="flat">APPLY STYLE</button>
			  </div>
			</div>
		  </div>
		</div>
	<!-- Qard style pop up -->

	<?php 
	$this->registerJs("$(function() {
	   $('#add_to_deck').click(function(e) {
		 e.preventDefault();
		 console.log($(this).attr('href'));
		 var qard_id = $('#qard_id').val(); 
/* 		 if(typeof qard_id == 'undefined' || qard_id == '' || qard_id == 0)
		 {
			 alert('You need to create atleast one block');
			 return;
		 } */
		 $('#deck-style').modal('show').find('.modal-body').load($(this).attr('href'));
	   });	   
	   adjustHeight();
	});");
	?>

    <div class="modal fade" tabindex="-1" id="Block_error" role="dialog" aria-labelledby="myModalLabel">
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

    <script type="text/javascript">
	$('#qard-style #themeorder .qard-content').click(function(){
		$('.qard-content').removeClass('active');
		$(this).addClass('active');
		var themeid = $(this).parent().attr('id');
		$('#qrdstyle-link').attr('data-theme',themeid);
	});
	
	$("#working_div .current_blk").focus();
	document.execCommand('styleWithCSS', false, true);
    document.execCommand('foreColor', false, '<?php echo $theme_properties['dark_text_color'];?>');
	
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
		//DECK FUNCTIONS
		
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
				 $("#ajaxDeckPreview").html('<img id="previewImg" height="100px" width="100px" src="'+e.target.result+'"></img>');		
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("body").on('change','#deck-bg_image',function(){	
			$("#deck-bg_image").css('min-height','20px'); 
			readURL(this);	 
		});
		
		function saveDeck(deck){
			 console.log("Handle the saving here");							
			 var formData = new FormData($(deck)[0]);
				$.ajax( {
				  url: '<?=Url::to(['deck/create-ajax'], true)?>',
				  type: 'POST',
				  data: formData,
				  processData: false,
				  contentType: false,
				  success:function(data){
					  
					var json = $.parseJSON(data);
					var img =json.url;
					var t=json.title; 
					
					//var html='';
				    var html='<div class="grid-item" id="6" onclick="addToDeck(this)"><div class="grid-img"><img src="'+img+'" alt=""></div><div class="grid-content"><h4>'+t+'</h4><div class="col-sm-4 col-md-4"><img src="/qarddeck/web/images/qards_icon.png" alt="">20</div> <div class="col-sm-8 col-md-8"> <button class="btn btn-grey"><img src="/qarddeck/web/images/preview_icon.png" alt="">Preview</button> </div></div></div>';
					$('#add_to_deck').trigger('click');
					//$(".grid").prepend(html);
					//$("#ajaxDeckPreview").html(''); // Clear the preview..	
					//$('form[name="ajaxDeck"]')[0].reset();	
 			  	  }				  
				}); 				
		}
 
		function addToDeck(deck){
			var deck_id = $(deck).attr('id');
			var qard_id = $('#qard_id').val()||0; 
			$.ajax({
				url : '<?=Url::to(['deck/add-qard'], true)?>',
				type : 'POST',
				data : {'qard_id':qard_id,'deck_id':deck_id},
				success : function(response){
					console.log(response);
					//load the a new create page with a deckid included request
					var red_url = "<?=Url::to(['qard/edit'], true)?>";
					red_url = red_url+"?id="+qard_id;
					console.log(red_url);
					window.location.replace(red_url);
					
				}				
			});
			console.log(deck_id);
		}
		function setBGColor(elem){
			color = $(elem).attr('data-color');
			$('#bg_color').val(color);
			$("#working_div .bgimg-block").attr('data-bgcolor-id',$(elem).attr('data-bgcolor-id'));
			$("#working_div .bgimg-block").css('background-color', color);
		}
         
    </script>
    <script src="<?= Yii::$app->request->baseUrl?>/js/select2.js" type="text/javascript"></script>


    <script src="<?= Yii::$app->request->baseUrl?>/js/html5imageupload.js" type="text/javascript"></script>
    <script src="<?= Yii::$app->request->baseUrl?>/js/jquery.caret.js" type="text/javascript"></script>

    <script src="<?= Yii::$app->request->baseUrl?>/js/jquery-ui.js" type="text/javascript"></script>
	<script>
	/**
	  * Script re-written by Dency G B 
	 **/
	 $(".js-example-basic-multiple").select2({
		 placeholder: "Add some tags",
	 });
	/**** Handle the main work space ******/
	/* 	
	  MAIN FUNCTION
	 */
	$(document).delegate("#working_div .current_blk", "input blur keyup keydown resize paste", function(event) {		
		//select color and apply span
		if (event.type === "input") {
			focusWorkspace();
		}
		if(event.type === "paste"){
			event.preventDefault();
			// get text representation of clipboard
			
			//console.log(event.originalEvent.clipboardData);
			if (event.clipboardData || event.originalEvent.clipboardData) {
				content = (event.originalEvent || event).clipboardData.getData('text/plain');

				document.execCommand('insertText', false, content);
			}
			else if (window.clipboardData) {
				content = window.clipboardData.getData('Text');

				document.selection.createRange().pasteHTML(content);
			}   

			//$(this).find( "span" ).contents().unwrap();
			//$(this).find( "p" ).contents().unwrap();
			//$(this).find( "div" ).contents().unwrap();
			//focusWorkspace();
			//$(this).html($(this).text());
			//$(this).contents().wrap('<span>');

	
		}
		
  /*  if (event.keyCode === 8) {
			$(this).find( "span" ).contents().unwrap();
			$(this).find( "p" ).contents().unwrap();
			$(this).find( "div" ).contents().unwrap();
			focusWorkspace();
			$(this).html($(this).text());
			$(this).contents().wrap('<span>');
    } */
		
		/*
		 * calculate the total height of the qard
		*/
		var qard_height= 0;
		$('.current_blk').each(function(i, obj) {
			var block_height = $(obj).attr('data-height');
			console.log('block-height:'+block_height);
			qard_height =  parseInt(qard_height)+parseInt(block_height);
		})
		console.log(qard_height);
		/*
		 *If qard is filled with 15,hide the add block button
		 */
		if(qard_height >=16){
			$('.add-another').hide();
		}else{
			$('.add-another').show();
		}

		/*
		 *if qard is complete,preveny anything other than backspace and delete
		 *and remove the last input or last child
		**/
		if(event.which != 8 && qard_height >= 17){
			event.preventDefault();
			console.log('stopped');
			var last = $(this).children(':last-child');
			var html = $(last).html();
			$('#extra_text').html(html);
			//pass this to extra text and remove from here
			$(last).remove();
			$('#extra_text').focus();
		}
 		if ($(this).attr("data-resized")=='true') {
			var scrollHeight = Math.ceil(parseInt($(this)[0].scrollHeight) / 37.5);
			var setHeight =  $(this).attr("data-height");
			if(scrollHeight > setHeight ){
				$("#working_div .current_blk").attr('data-resized','false');	
				setHeightBlock(this,scrollHeight);
			}
			else{
				console.log('resized'+scrollHeight);
				return;				
			}
		} 
		/*
		 * Or autoset the height of block
		 **/
		$(this).css("height", 'auto');
		var scrollHeight = Math.ceil(parseInt($(this)[0].scrollHeight) / 37.5);
		setHeightBlock(this,scrollHeight);
	});
	/* 	document.querySelector('[contenteditable=true]')
	  .addEventListener('DOMNodeInserted', function(event) {
		if (event.target.tagName == 'SPAN') {
		  event.target.outerHTML = event.target.innerHTML;
		}
	  }); */
	function focusWorkspace(){
			$("#working_div .current_blk").focus();
			//document.execCommand('styleWithCSS', false, true);
			//document.execCommand('foreColor', false, '<?php echo $theme_properties['dark_text_color'];?>');	
		
	}
	/*
	 * Double click to edit the block again
	 */
	$(document).delegate('.add-block-qard > div', "dblclick", function(event) {
		if ($(this).attr("id") !== 'working_div') {
			$('#working_div .current_blk').removeAttr("unselectable");
			$("#working_div .current_blk").removeAttr("contenteditable");
			$("#working_div .current_blk").removeClass("working_div");
			$("#working_div .parent_current_blk").unwrap();
			$(this).wrap('<div  id="working_div" class="working_div active"></div>');
			$(this).find(".current_blk").addClass("working_div");
			$(this).find(".current_blk").attr("unselectable", 'off');
			$(this).find(".current_blk").attr("contenteditable", 'true');
		}
	});	
	/**** End of the main work space******/
	////////////////////////////////////////////OTHER BLOCK OPERATIONS///////////////////////////////////////////////////////////
	/***  **/
        /**** for drag the block ******/
		$(document).delegate("#add-block .parent_current_blk", "mouseenter mouseleave", function(event) {
			if (event.type === "mouseleave") {
				$(this).find(".drag").remove();
			} else {
		
				if ($(this).find("div").hasClass("drag") === false) {
					$(this).find(".bgoverlay-block").after('<div class="drag"></div>');
				}
				$(this).resizable({ 
					handles: "s",
					delay: 200,
					resize: function(e, ui) {
						console.log(ui.size.height);
						var scrollHeight = Math.ceil(ui.size.height / 37.5);
						setHeightBlock($("#working_div .current_blk"),scrollHeight);
						$("#working_div .current_blk").attr('data-resized','true');	
						
						//ui.size.height = Math.ceil(ui.size.height / 37.5);			
				/* 		if (ui.size.width > (ui.originalSize.width + maxWidthOffset)) {
							$(this).resizable('widget').trigger('mouseup');
						} */
					}
				});				
			}
		});
	   
/* 	    var dragging = false;
		$(document).delegate('#working_div .current_blk','mousedown',function(event){
			dragging = true;});
		$(document).mouseup(function(event){
		if (dragging) {
			var percentage = Math.ceil((event.pageY-148)/37.5);
			console.log("percentage"+percentage);
			setHeightBlock(percentage);
			$(document).unbind('mousemove');
			dragging = false;
		}
		}); */
		
		$('#add-block').sortable({
			group: 'no-drop',
			handle: '.drag',
			onDragStart: function($item, container, _super) {
				if (!container.options.drop) $item.clone().insertAfter($item);
				_super($item, container);
			},
			update: function() {
				var postData = getNSetOrderOfBlocks();
				$.ajax({
					url: "<?=Url::to(['block/change-priority'], true)?>",
					type: "POST",
					data: postData,
					dataType: "json",
					success: function(data) {
						$("#working_div .current_blk").focus();
						document.execCommand('styleWithCSS', false, true);
						document.execCommand('foreColor', false, '<?php echo $theme_properties['dark_text_color'];?>');
					},
					error: function(data) {
						$("#working_div .current_blk").focus();
						document.execCommand('styleWithCSS', false, true);
						document.execCommand('foreColor', false, '<?php echo $theme_properties['dark_text_color'];?>');
					}
				});
			}
		});
/* 		$( "#working_div .text-block" ).resizable({ handles: "s" });
		$(document).delegate("#working_div .current_blk", "input blur keyup keydown resize", function(event) {		
		
		});
		$('#working_div .text-block').bind('resize', function(){
            console.log('resized');
		}); */
		/** End of drag and drop ***/
		
		/** DELETE BLOCK **/
            // for deleting the block
		$(document).delegate("#deleteblock", "click", function() {
			var block_id = $("#working_div .current_blk").attr("data-block_id");
			if (typeof block_id !== 'undefined') {
				$.ajax({
					url: "<?=Url::to(['block/delete-block'], true)?>",
					type: "POST",
					dataType: 'json',
					data: {
						'block_id': block_id
					},
					success: function(data) {
						$("#working_div").remove();
						if ($("#add-block").find(".parent_current_blk")) {
							$("#add-block .parent_current_blk").last().wrap('<div  id="working_div" class="working_div active"></div>');
							$("#add-block .parent_current_blk").last().find(".current_blk").addClass("working_div");
							$("#add-block .parent_current_blk").last().find(".current_blk").attr("unselectable", 'off');
							$("#add-block .parent_current_blk").last().find(".current_blk").attr("contenteditable", 'true');
							if (data.status === 'success') {
								alert(data.response);
							} else {
								alert(data.response);
							}
						} else {
							var new_div = '<div id="blk_' + getNextBlockId() + '" class="bgimg-block parent_current_blk"><div class="bgoverlay-block"><div class="text-block current_blk" data-height="1"  contenteditable="true" unselectable="off"></div></div></div>';
							$("#working_div").html(new_div);
						}
					},
					error: function(data) {
						alert("unable to delete plz try again later!...")
					}
				});
			} else {
				alert("first select/create block first");
			}
		});
		/** End of delete block **/	
		
		/** Block height control **/
		$(document).delegate("#blk_size", "keyup keydown", function() {
			setHeightBlock($("#working_div .current_blk"),$(this).val());
		});
		
		/** Text operations **/
		$('.working_div').children('div').focus();
		/*
		 * to make text as bold
		 */
		$('#text_bold').click(function() {
			document.execCommand('bold', false, null);
			$('.working_div').focus();
			return false;
		});
		/*
		 * to make text as italic
		 */
		$('#text_italic').click(function() {
			document.execCommand('italic', false, null);
			$('.working_div').focus();
			return false;
		});
		/*
		 * to make undeline on text
		 */
		$('#text_underline').click(function() {
			document.execCommand('underline', false, null);
			$('.working_div').focus();
			return false;
		});
		
		/*
		 * to justify text
		 */
		$('#text_align').change(function() {
			document.execCommand($(this).val(), false, null);
			console.log($(this).val());
			$('.working_div').focus();
			return false;
		});
		//replaced by this
		$("#alignment_select li a").click(function(){
		  //console.log($(this).attr("data-align"));
		  	document.execCommand($(this).attr("data-align"), false, null);
			console.log($(this).val());
			$('.working_div').focus();
			return false;
		}); 
		
		/*
		 * to change the size of the text
		 */
		$('#text_size').change(function() {
			document.execCommand("fontSize", false, $(this).val());
			$('.working_div').focus();
			return false;
		});
		/*
		 * to change the font-family of text
		 */
		$('#text_family').change(function() {
			document.execCommand("fontName", false, $(this).val());
			$('.working_div').focus();
			return false;
		});
		
		/*
		 * to change to fore color of the text
		 */
		
		function setForeColor(inp) {
			$("#working_div .current_blk").focus();
			document.execCommand('styleWithCSS', false, true);
			document.execCommand('foreColor', false, $(inp).attr('data-color'));
			$("#working_div .current_blk").attr('data-fontcolor-id',$(inp).attr('data-fontcolor-id'));
		}
		/*
		 * to make text in indent
		 */
		$('#text_indent').click(function() {
			document.execCommand('indent', false, null);
			$('.working_div').children().focus();
			return false;
		});
	
 
		/********************/
		/** Extra Text Functions **/
		
		$('#text_area_bold').click(function() {
			$("#extra_text").focus();
			document.execCommand('bold', false, null);
			return false;
		});
		$('#text_area_italics').click(function() {
			$("#extra_text").focus();
			document.execCommand('italic', false, null);
			return false;
		});
		$('#text_area_underline').click(function() {
			$("#extra_text").focus();
			document.execCommand('underline', false, null);
			return false;
		});
		$('#extra_text_link').click(function(){
			//check selected block first
			//setTimeout("add_block(true,false);",1000);
			add_block(true,false);
			$.ajax({
				url : "<?=Url::to(['block/add-text'], true)?>",
				type: "POST",
				data: { 'extra_text':$("#extra_text").html(),
						'block_id':$("#working_div .current_blk").attr('data-block_id'),
						'title' : $("input[name=extra-text]").val(),
					  },
				success: function(data){
					console.log(data.link_data);
					data = $.parseJSON(data);
					var html = $("#working_div .current_blk").html();
					if(html == ''){
						var new_html = (data.extra_text).substring(0,30)+"...";
						$("#working_div .current_blk").html(new_html);
					}
					//see whether T icon is already there
					var icon = $("#working_div .current_blk").find(".icon-mark").length;
					if(icon == 0)
						$("#working_div .current_blk").append(data.link_data);
					$("#working_div .current_blk").attr("contenteditable","true");

				}
			});
			
			//save extra text
			//put the icon and functio to the block
		});
		$("#extra_text").on("paste",function(event){
			event.preventDefault();
				if (event.clipboardData || event.originalEvent.clipboardData) {
					content = (event.originalEvent || event).clipboardData.getData('text/plain');

					document.execCommand('insertText', false, content);
				}
				else if (window.clipboardData) {
					content = window.clipboardData.getData('Text');

					document.selection.createRange().pasteHTML(content);
				} 		
		});
 
		function showExtraText(elem){
			$.ajax({
				url : "<?=Url::to(['block/get-text'], true)?>",
				type: "GET",
				data: { 'block_id': $(elem).attr('block_id') },
				success: function(data){
					data = $.parseJSON(data);
					$("#extra_text").html(data.extra_text);
					$("input[name=extra-text]").val(data.title);

				}
			});			
		}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**** Link Block operations ******/
        $('input[id=link_url]').on('change', function() {
            callUrl(this,0);
        });
        $('body').on('change', $('input[name=url_title]', 'textarea[name=url_content]'), function() {
            showUrlPreview();
        });
/*         $(document).delegate('span.review-qard', 'dblclick', function() {
            //	e.preventDefault();
            console.log('Double clicked');
            $('.nav-tabs a[href="#linkblock"]').tab('show');
            //$('#linkblock').tab('show')
            //fill the area with this content
            var title = $(this).find('span.url-content >h4').html();
            var content = $(this).find('span.url-text >p').html();
            var image = $(this).find('span.img-preview').html();
            console.log(title);
            if (typeof image === 'undefined') {
                var html = "<div id='review-qard-id' class='review-qard row'>" +
                    "<div class='col-sm-12 col-md-12' id='title_desc_url'><div class='url-content'><h4><input name='url_title' type='text' class='form-control' value='" + title + "'></h4>" +
                    "<div class='url-text'><p><textarea name='url_content' class='form-control'>" + content + "</textarea></p>" +
                    "</div></div></div></div>";
            } else {
                var html = "<div id='review-qard-id' class='review-qard row'><div class='img-preview col-sm-3 col-md-3'>" + image + "<button id='url_img_remove' onclick='changePic(this)' class='btn btn-default btn-remove'>Remove</button></div>" +
                    "<div class='col-sm-9 col-md-9' id='title_desc_url'><div class='url-content'><h4><input name='url_title' type='text' class='form-control' value='" + title + "'></h4>" +
                    "<div class='url-text'><p><textarea name='url_content' class='form-control'>" + content + "</textarea></p>" +
                    "</div></div></div></div>";
            }
            $('#link_div').empty();
            //$('#link_div').html(html);
			//$('#link_div').hide();
            $('.link_options').show();
            $(".drop-file  , .file_options").hide();
        });  */
        $('#cmn-toggle-4').on('change', function() {
			if($(this).prop('checked')){
				if($("input[id=link_url]").val() != '')
				{
					var str = '<span id="show_url_span">'+$("input[id=link_url]").val()+'</span>';
					$("#working_div .current_blk").find('#previewLink').prepend(str);		
					$("#previewLink").attr("data-showurl","true");						
				}
			}else{
				if($("#working_div .current_blk").find('#show_url_span').length != 0 && $("input[id=link_url]").val() != '')
					$('#show_url_span').remove();
				$("#previewLink").attr("data-showurl","false");	
			}
        });
        $('#cmn-toggle-6').on('change', function() {
			if($(this).prop('checked')){
				if($("input[id=link_url]").val() != '')
				{
					$("#previewLink").attr("data-open","new");				
				}
			}else{
				$("#previewLink").attr("data-open","same");	
			}
        });
		/**** End of Link Block operations ******/
		
		
		/** Image block operations **/
		$('.dropzone').html5imageupload({
			ghost: false,
		});
		$(document).delegate("#reset_image", "click", function() {
			$(".dropzone .btn-cancel").trigger("click");
		});
		// on click image tab should increase block height
		$(document).delegate("#cmn-toggle-3", "click", function() {
			if ($(this).is(":checked")) {
				if (parseInt($("#working_div .current_blk").attr("data-height")) < 4) {
					setHeightBlock($("#working_div .current_blk"),4);
					console.log($("#working_div .current_blk").attr("data-height"));
				}
			} else {
				//removeBr();
			}
		});
            // for image
		$(document).delegate("#image_opc", "blur keydown keyup", function() {
			var per = parseInt($(this).val() || 1) / 100;
			console.log("image opc" + per);
			$("#working_div .bgimg-block").css('opacity', per);
		});
		$(document).delegate("#overlay_color", "blur", function() {
			var color = $(this).val();
			console.log(color);
			$("#working_div .bgoverlay-block").css('background-color', color);
		});
		$(document).delegate("#overlay_opc", "blur keydown  keyup", function() {
			var per = parseInt($(this).val()) / 100;
			console.log("image opc" + per);
			$("#working_div .bgoverlay-block").css('opacity', per);
		});
		$(document).delegate("#bg_color", "blur", function() {
			var color = $(this).val();
			$("#working_div .bgimg-block").css('background-color', color);
		});
		/** End of Image block operations **/
        ////////////////////////////////////	
	/** Functions : callable **/
	function adjustHeight(){
		var elem = $('#working_div .current_blk');
		$(elem).css("height", 'auto');
		var scrollHeight = Math.ceil(parseInt($(elem)[0].scrollHeight) / 37.5);
		setHeightBlock(elem,scrollHeight);		
	}
	function setHeightBlock(elem,offset){
		//check total block height before that
			var h = offset*37.5;
			$(elem).css("height", h);
			$(elem).attr('data-height',offset);	
			//set for other elements also
			$("#working_div .parent_current_blk").css("height", h);
			$("#working_div .bgoverlay-block").css("height", h);
			console.log(offset);
	}
	function add_block(event,new_block){
		//save block
            var data = $("#image_upload").serializeArray();
            // getting opacity for image-block div
            var image_opacity = parseFloat($("#working_div .bgimg-block").css("opacity")) || 0;
            data.push({
                name: 'image_opacity',
                value: image_opacity
            });
            var div_opacity = parseFloat($("#working_div .bgoverlay-block").css("opacity"));
            data.push({
                name: 'div_opacity',
                value: div_opacity
            });
			//overlay color
			var div_overlaycolor = $("#working_div .bgoverlay-block").css("background-color");
			if(typeof div_overlaycolor === 'undefined') {
				div_overlaycolor = 'transparent';
			}
			console.log(div_overlaycolor);
			data.push({
				name: 'div_overlaycolor',
				value: div_overlaycolor
			});	
/*             var div_bgcolor = $("#working_div .bgoverlay-block").css("background-color");
            data.push({
                name: 'div_bgcolor',
                value: div_bgcolor
            });
 */
			var div_bgcolor = $("#working_div .bgimg-block").css("background-color");
			console.log(div_bgcolor);
            data.push({
                name: 'div_bgcolor',
                value: div_bgcolor
            });
            var div_bgimage = $("#working_div .bgimg-block").css("background-image").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
			//console.log(div_bgimage);
			//return;
            data.push({
                name: 'div_bgimage',
                value: div_bgimage
            });
			//size is not getting applied right now
			var div_bgimage_size = $("#working_div .bgimg-block").css("background-size");
			var div_bgimage_position = $("#working_div .bgimg-block").css("background-position")||'null';
            data.push({
                name: 'div_bgimage_position',
                value: div_bgimage_position
            });
/*             var div_bg_color = $("#working_div .bgimg-block").css("background-color");
            data.push({
                name: 'div_bg_color',
                value: div_bg_color
            }); */
            var height = parseInt($("#working_div .current_blk").attr("data-height")) * 37.5;
            data.push({
                name: 'height',
                value: height
            });
            var text = $("#working_div .current_blk").html() || 0;
            data.push({
                name: 'text',
                value: text
            });
            var extra_text = $("#extra_text").html() || 0;
            data.push({
                name: 'extra_text',
                value: extra_text
            });
            var block_id = $("#working_div .current_blk").attr("data-block_id") || 0;
            data.push({
                name: 'block_id',
                value: block_id
            });
			var qard_theme_id = $('input[name=theme_id]').val();
            data.push({
                name: 'qard_theme_id',
                value: qard_theme_id 
            });
            var theme_id = $("#working_div .current_blk").attr("data-theme_id") || 0;
            data.push({
                name: 'theme_id',
                value: theme_id 
            });
            var qard_id = $("#qard_id").val() || 0;
            data.push({
                name: 'qard_id',
                value: qard_id
            });
            var qard_title = $("#qard_title").val() || 0;
            data.push({
                name: 'qard_title',
                value: qard_title
            });
            
            var tags = $("#tags").val();            
            data.push({
                name: 'tags',
                value: tags
            });
            var is_title = $("[name='is_title']:checked").val() || 0;
            data.push({
                name: 'is_title',
                value: is_title
            });
            var blk_id = $("#working_div .parent_current_blk").attr("id");
            data.push({
                name: 'blk_id',
                value: blk_id
            });
            // check whether theme is already preasent for qard or not
            var block_priority = $("#working_div .current_blk").attr("data-block_priority") || 0;
            data.push({
                name: 'block_priority',
                value: block_priority
            });		
			
			//addded data bgcolor id and font color id
			var data_bgcolor_id = $("#working_div .bgimg-block").attr("data-bgcolor-id") || 0;
            data.push({
                name: 'data_bgcolor_id',
                value: data_bgcolor_id
            });	
			var data_fontcolor_id = $("#working_div .current_blk").attr("data-fontcolor-id") || 0;
            data.push({
                name: 'data_fontcolor_id',
                value: data_fontcolor_id
            });	
			// add the block style also
			var data_style_qard = $("#working_div .bgimg-block").attr('data-style-qard') || 'line';
			//console.log("block_style:"+data_style_qard);return;
            data.push({
                name: 'data_style_qard',
                value: data_style_qard
            });	
			//var new_block = true;
			commanAjaxFun(data, 'add_block',new_block);
			$("#working_div .current_blk").attr("contenteditable","true");
			//create another working block(div)
                                //$("#working_div").remove();
/* 			var nextBlockPriority = getNextBlockPriority();
			$("#working_div .parent_current_blk").unwrap();
			var new_div = '<div  id="working_div" class="working_div active"><div id="blk_' + getNextBlockId() + '" class="bgimg-block parent_current_blk"><div class="bgoverlay-block"><div class="text-block current_blk" data-height="1"  contenteditable="true" unselectable="off" data-block_priority="' + nextBlockPriority + '"></div></div></div></div>';
			$("#add-block .parent_current_blk:last").after(new_div); */
         $("#dispIcon").hide();
            $(".drop-file , .drop-image , .file_options").show();
            $(".fileSwitch").show();
            $("input[id=link_url]").val('');
			$("input[id=embed_code]").val('');
            $('input[id=qard-url-upload-click]').val('');
            $("#showFile").hide();
            $("#showFilePreview").empty();
	}
	function addSaveCard() {
		//calculate the total height
		console.log("save here");
		var total_data_height = 0;
		$('.current_blk').each(function(obj) {
			console.log($(this).attr("data-height"));
			total_data_height = parseInt($(this).attr("data-height"))+parseInt(total_data_height);
		});
/* 		if(total_data_height != 16){
			alert("Ouch, please fill the qard!");
			return;
		} */
		
		$("#wait").show();
		// if storing image
		var data = $("#image_upload").serializeArray();
		var qard_title = $("#qard_title").val() || 0;
		data.push({
			name: 'qard_title',
			value: qard_title
		});
		//if qard title is empty
		if (qard_title === '') {
			alert("please enter qard title");
			return false;
		}
		var qard_theme_id = $('input[name=theme_id]').val();
		data.push({
			name: 'qard_theme_id',
			value: qard_theme_id 
		});
		$("#add-block .parent_current_blk").each(function(obj,index) {
			// getting opacity for image-block div
			var image_opacity = parseFloat($(this).css("opacity") || 0);
			data.push({
				name: 'image_opacity',
				value: image_opacity
			});
			//opacity for overlay-block
			var div_opacity = parseFloat($(this).find(".bgoverlay-block").css("opacity") || 0);
			data.push({
				name: 'div_opacity',
				value: div_opacity
			});
			//overlay color
			var div_overlaycolor = $(this).find(".bgoverlay-block").css("background-color");
			if(typeof div_overlaycolor === 'undefined') {
				div_overlaycolor = 'transparent';
			}
			//console.log('overlay'+div_overlaycolor);return;
			data.push({
				name: 'div_overlaycolor',
				value: div_overlaycolor
			});			
			//Background color for background block
			var div_bgcolor = $(this).css("background-color");
			//console.log(div_bgcolor);return;
			data.push({
				name: 'div_bgcolor',
				value: div_bgcolor
			});
			//if it contains background as image then true
			var div_bgimage = $(this).css("background-image");
			if (typeof div_bgimage === 'undefined') {
				var div_bgimage = $(this).css("background-image").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
			}
            var div_bgimage = $(this).css("background-image").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
			//console.log(div_bgimage);
			//return;
			data.push({
				name: 'div_bgimage',
				value: div_bgimage
			});
			
			var div_bgimage_position = $(this).css("background-position")||'null';
            data.push({
                name: 'div_bgimage_position',
                value: div_bgimage_position
            });
			//getting height of div
			var height = parseInt($(this).find(".current_blk").attr('data-height')) * 37.5;
			data.push({
				name: 'height',
				value: height
			});
			//getting text for the block
			var text = $(this).find(".current_blk").html() || 0;
			data.push({
				name: 'text',
				value: text
			});
			//if extra text is present
			var extra_text = $("#extra_text").html() || 0;
			data.push({
				name: 'extra_text',
				value: extra_text
			});
			//to check operation for edit a block or for add new block
			var block_id = $(this).find(".current_blk").attr("data-block_id") || 0;
			data.push({
				name: 'block_id',
				value: block_id
			});
			// check whether theme is already preasent for qard or not
			var theme_id = $(this).find(".current_blk").attr("data-theme_id") || 0;
			data.push({
				name: 'theme_id',
				value: theme_id
			});
			// check whether theme is already preasent for qard or not
			var calc_index = index + 1;
			//$(this).find(".current_blk").attr("data-block_priority", (index + 1));
			var block_priority = $(this).find(".current_blk").attr("data-block_priority") || calc_index;
			data.push({
				name: 'block_priority',
				value: block_priority
			});
			//check qard id is present to edit or add new qard
			var qard_id = $("#qard_id").val() || 0;
			data.push({
				name: 'qard_id',
				value: qard_id
			});
			// getting tags fot qard
            var tags = $("#tags").val();            
            data.push({
                name: 'tags',
                value: tags
            });
			var qard_title = $("#qard_title").val() || 0;
			data.push({
				name: 'qard_title',
				value: qard_title
			});
			//if block contains title for block then true
			var is_title = $("[name='is_title']:checked").val() || 0;
			data.push({
				name: 'is_title',
				value: is_title
			});
			//to get current block id
			var blk_id = $(this).attr("id");
			data.push({
				name: 'blk_id',
				value: blk_id
			});
			//addded data bgcolor id and font color id
			var data_bgcolor_id = $(this).attr("data-bgcolor-id") || 0;
            data.push({
                name: 'data_bgcolor_id',
                value: data_bgcolor_id
            });	
			var data_fontcolor_id = $(this).find(".current_blk").attr("data-fontcolor-id") || 0;
            data.push({
                name: 'data_fontcolor_id',
                value: data_fontcolor_id
            });	
			//add block style
			// add the block style also
			var data_style_qard = $(this).attr('data-style-qard') || 'line';
            data.push({
                name: 'data_style_qard',
                value: data_style_qard
            });	
			
			$(this).addClass("delete_blk");
			//	    if(typeof $(this).find(".current_blk").html() == typeof undefined && typeof data.div_bgimage==typeof undefined && typeof data.thumb_values== typeof undefined){
			//		alert("please enter block or image to save");
			//		return false;
			//	    }
			//
			//	    console.log(data);
			//	    return false;
			var new_block = true;
			commanAjaxFun(data, 'save_block',new_block);
		});
	}
	function getNextBlockId() {
		var blk_id = 0;
		$(".add-block-qard div").each(function() {
			var attr = $(this).attr('id');
			if (typeof attr !== typeof undefined && attr !== false && attr.search("_")) {
				new_blk_id = attr.split('_');
				if (blk_id < parseInt(new_blk_id[1])) {
					blk_id = parseInt(new_blk_id[1]);
				}
			}
		});
		return ++blk_id;
	}		
	function getNextBlockPriority() {
		var blk_pri = 0;
		$(".add-block-qard .parent_current_blk").each(function() {
			var attr = $(this).find(".current_blk").attr('data-block_priority');
			if (typeof attr !== typeof undefined) {
				if (blk_pri < parseInt(attr)) {
					blk_pri = parseInt(attr);
				}
			}
		});
		return ++blk_pri;
	}
	function commanAjaxFun(postData, callFrom, new_block) {
		//console.log(postData);return;
		$.ajax({
			url: "<?=Url::to(['block/create'], true)?>",
			type: "POST",
			data: postData,
			dataType: "json",
			async: false,
			success: function(data) {
				if (callFrom === "add_block") {
					$("#wait").hide();
					//var total_height = totalHeight();
					//	       checkHeight();
					var qard = '';
					var theme = '';
					//if qard is editing
					if (!$("#qard_id").attr("value")) {
						qard = '<input id="qard_id" type="hidden" value="' + data.qard_id + '">';
						$('#qardid-link').attr("href","<?=Yii::$app->request->baseUrl?>/theme/select-theme/?q_id="+ data.qard_id +"");
					}
					// if stored data contain image then true
					var img = '';
					if (data.link_image) {
						
						img = 'background-size:cover;background-image:url(<?=Yii::$app->request->baseUrl?>/uploads/block/' + data.link_image + ');';
/* 						if(data.div_bgimage_position != "null")
							img = img+'background-position:'+data.div_bgimage_position+';' */
					}
					//creating parent block or img-block
					var new_div = '<div data-style-qard = "'+data.data_style_qard+'" id="' + data.blk_id + '" class="bgimg-block parent_current_blk '+data.data_style_qard+'" style="background-color:' + data.div_bgcolor + '; height:' + data.height + 'px;' + img + '">';
					//creating overlay-block or middel block
					new_div += '<div class="bgoverlay-block" style="background-color:' + data.div_overlaycolor + ';opacity:' + data.div_opacity + ';height:' + data.height + 'px;">';
					//creating main block or text block
					new_div += '<div data-height="' + (data.height / 37.5) + '" style="height:' + data.height + 'px;" data-block_id="' + data.block_id + '" data-theme_id="' + data.theme_id + '" data-block_priority="' + data.block_priority + '" class="text-block current_blk">' + data.text + '</div></div></div>';
					
					/* Added by Dency */
					/* Image is added to the current block without adding a newblock */
					if(new_block == false){
						//alert("new_block:"+new_block);
						$("#working_div").before(qard);
						$("#working_div").html(theme + new_div);
						$("#reset_image").trigger("click");
						 return;
					}
					/*****************/
					
					$("#working_div").css("background-color","red");
					//adding before working block
					$("#working_div").before(qard + theme + new_div);
					var checkForNew = true;
					//checking whether block is editing or adding new block
					if (data.edit_block) {
						//for edit block
						$("#add-block .parent_current_blk").each(function() {
							if (typeof $(this).find(".current_blk").attr("data-block_id") === 'undefined' && data.blk_id !== $(this).attr("id")) {
								$("#working_div").remove();
								$(this).wrap('<div  id="working_div" class="working_div active"></div>');
								$(this).find(".current_blk").addClass("working_div");
								$(this).find(".current_blk").attr("unselectable", 'off');
								$(this).find(".current_blk").attr("contenteditable", 'true');
								console.log("wrap old block");
								checkForNew = false;
								return;
							}
						});
					}
					if (checkForNew) {
						    var nextBlockPriority = getNextBlockPriority();
							$("#working_div").remove();
							var new_div = '<div  id="working_div" class="working_div active"><div id="blk_' + getNextBlockId() + '" class="bgimg-block parent_current_blk '+data.data_style_qard+'" data-style-qard = "'+data.data_style_qard+'"><div class="bgoverlay-block"><div class="text-block current_blk" data-height="1"  contenteditable="true" unselectable="off" data-block_priority="' + nextBlockPriority + '"></div></div></div></div>';
							$("#add-block .parent_current_blk:last").after(new_div);
					}
				} 
				else {
				$("#" + data.blk_id).find(".current_blk").attr("data-block_id", data.block_id);
				$("#" + data.blk_id).find(".current_blk").attr("data-theme_id", data.theme_id);
				var url = '<?=Url::to(['qard/publish'], true);?>';
				window.location.replace(url);
				$("#wait").hide();
				}
				$("#working_div .current_blk").focus();
				document.execCommand('foreColor', false, '<?php echo $theme_properties['dark_text_color'];?>');
				//removing uneccessary created working block
				$("#add-block div").each(function() {
				if ($(this).attr('id') === "working_div" && $(this).html() === "") {
					$("#working_div").remove();
				}
				});
				//remove image after stored in db
				$(".dropzone .btn-del").trigger("click");                    
				$("#url_reset_link").trigger("click");
				return true;
				},
				error: function(data) {
					$("#wait").hide();
					console.log(data);
					return false;
				}
		});
		}
		/*
		* Link block functions
		*/
        function callUrl(urlField,displayCheck) {
            console.log($(urlField).val());
			//$('#link_div').hide();
            var preview_url = $(urlField).val();
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
                        $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/pdf.png');
                    }
                    if (data.type == 'DOC' || data.type == 'DOCX') {
                        $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/doc.png');
                    }
                    //$('.working_div div').html(data);
					if (data.type == 'web_page') {
						//added by kavitha
						//$('#link_div').show();
						if(displayCheck==1){
							
						}else{
							$("#working_div .current_blk").focus();
							document.execCommand('foreColor', false, '<?php echo $theme_properties['dark_text_color'];?>');	
							var work_space_text  = '<span style="color: <?php echo $theme_properties["dark_text_color"];?>;">'+data.work_space_text+'</span></br>';
							$("#working_div .current_blk").html(work_space_text);
							adjustHeight();
						}
                        $('#link_div').html(data.preview_html);
						//add here
						$('#cmn-toggle-6').prop("checked",true).trigger("change");
                    }
                    else {
                        $('#link_div').html(data);
                    }
                    //var title = $('input[name=url_title]').val();
                    //var link = '<h4 class="url-content"><a href="'+preview_url+'">'+title+'</a></h4>'
                    //$('.working_div div').html(link);
                    //showUrlPreview();
					if(displayCheck!=1){
						adjustHeight();
					}
                    //showUrlPreview();
                    //setHeightBlock('', '');
                }
            });
        }
		
        function changePic(v) {
            $(v).parent().remove();
            $('#working_div').find('span.img-preview').remove();
            $('#working_div').find('span.col-sm-9').addClass("col-sm-12 col-md-12");
            $('#working_div').find('span.col-sm-9').removeClass("col-sm-9 col-md-9");
            $('#title_desc_url').removeClass("col-sm-9 col-md-9");
            $('#title_desc_url').addClass("col-sm-12 col-md-12");
        }
        /**
        Whether is it required to clear the preview once it is toggled?
        or we need a mirror approach here?
        **/
        function showUrlPreview() {
            var title = $('input[name=url_title]').val();
            var content = $('textarea[name=url_content]').val();
            var image = $('#review-qard-id .img-preview > img').attr('src');
            if (typeof title === 'undefined')
                return false;
            //console.log(title);
            if (typeof image === 'undefined') {
                var str = '<span class="url-qard-block" id="url_parent' + $("#working_div div").attr("id") + '">' +
                    '<span class="col-sm-12 col-md-12" id="title_desc_url' + $("#working_div div").attr("id") + '">' +
                    '<span class="url-content"><p></p>' +
                    '<span class="url-text"><p>' + content.substring(0,125) + '...</p>' +
                    '</span></span></span></span>';
            } else {
                var str = '<span class="review-qard" id="url_parent' + $("#working_div div").attr("id") + '"><span class="img-preview col-sm-3 col-md-3"><img src="' + image + '" alt=""></span>' +
                    '<span class="col-sm-9 col-md-9" id="title_desc_url' + $("#working_div div").attr("id") + '">' +
                    '<span class="url-content"><p></p>' +
                    '<span class="url-text"><p>' + content.substring(0,125) + '...</p>' +
                    '</span></span></span></span>';
            }
            $("#working_div .current_blk").html(str);
			$("#working_div .current_blk")[0].css("height", 'auto');
			var scrollHeight = Math.ceil(parseInt($("#working_div .current_blk")[0].scrollHeight) / 37.5);
			setHeightBlock($("#working_div .current_blk"),scrollHeight);
        }
		/**
		 * Click on link icon to see the content
		**/
		function displayLink(identifier){
			var dataurl = $(identifier).attr('data-url');
			$('.nav-tabs a[href="#linkblock"]').tab('show');
			$('input[id=link_url]').val(dataurl);
			var dataopen = $(identifier).attr('data-open');
			var datashowurl = $(identifier).attr('data-showurl');
			if(datashowurl == "true")
				$('#cmn-toggle-4').prop("checked",true);
			if(dataopen == "new")
				$('#cmn-toggle-6').prop("checked",true);
			return false;
		}
		/**********************************/
        $('#url_reset_link').on('click', function() {
            $('#link_div').html("<div class='preview-image'></div>");
			$('#embed_div').html("<div class='preview-image'></div>");
            $("input[id=link_url]").val('');
			$("input[id=embed_code]").val('');
			$('#cmn-toggle-4').prop("checked",false);
			$('#cmn-toggle-6').prop("checked",false);
        });
        $('#qard_preview').on('click', function() {
        });
		/* end of link block functions */
		/** File upload functions **/
        //ADDED BY NANDHINI
        $(".dispFileName").on('click', function(e) {
           if($('.dispFileName').is(':checked')){
               var fileName = $(".fileName").val();   
               setLink($(this),fileName,2);
           }else{
               var fileName = $(".fileName").val();   
               setLink($(this),fileName,3); 
           }
        });
        function setLink(elem,fileName,id){     
            var click = 'showFilePrev("'+fileName+'")';
            if(id!=3 && id!=1){
                  var span = 'Add Your Description Here!<br><span class="icon-mark pull-right" onclick='+click+'>'+fileName+'<img src="<?=Yii::$app->homeUrl?>images/file_icon.png" alt=""></span>';
				  //'<span class="icon-mark pull-right" onclick="+click+"><img src="<?=Yii::$app->homeUrl?>images/file_icon.png" alt=""></span>';
              }else{
                  var span = 'Add Your Description Here!<br><span class="icon-mark pull-right" onclick='+click+'><img src="<?=Yii::$app->homeUrl?>images/file_icon.png" alt=""></span>';   
            }             
			$("#working_div .current_blk").focus();
			document.execCommand('foreColor', false, '<?php echo $theme_properties['dark_text_color'];?>');	
			span = '<span style="color: <?php echo $theme_properties["dark_text_color"];?>;">'+span+'</span></br>'
            $("#working_div .current_blk").html(span);
			adjustHeight();
		}
        //$("#showFile").hide();
        $('.drop-file').on('click', function(e) {
            $('#qard-url-upload-click').trigger('click');
            return false;
            //  $('#qard-url-upload').click();             
        });     
        $('input[id=qard-url-upload-click]').on('change',function(e) {
            // $('#profile-image-upload').click();
            var file_data = $('#qard-url-upload-click').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            var myfile = $(this).val();
            var ext = myfile.split('.').pop();
            if (ext == "pdf" || ext == "docx" || ext == "doc") {
                $("#extErr").hide();
                if (ext == "pdf") {
                    $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/pdf.png');
                }
                if (ext == "docx" || ext == "doc") {
                    $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/doc.png');
                }
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                $.ajax({
                    url: "<?=Url::to(['qard/simple'], true)?>",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    //data: form_data,
                    type: 'post',
                    success: function(response) {
                        $(".fileName").val(response.code);
						$(".victim").html('');
						$("#fileTitle").html(response.code);
                        setLink($(this),response.code,1);
                    }
                });
            } else {
                $(".drop-file").show();
                $("#extErr").show();
                $("#showFile").hide();
                $(".fileName").val('');
                $(".fileSwitch").show();
            }
        });
        $('#reflink').click(function(e) {
			$("#qard-url-upload").trigger('reset');
			$("#fileTitle").html('FileName.psd');
        });		
		/*** End of file upload functions **/
		/** Dragging functions **/
		function getNSetOrderOfBlocks() {
			var data = {};
			var i = 0;
			$("#add-block .parent_current_blk").each(function(index) {
				var blk_id = $(this).find(".current_blk").attr("data-block_id");
				if (typeof blk_id !== 'undefined') {
					$(this).find(".current_blk").attr("data-block_priority", (i + 1));
					data[i++] = [i, blk_id];
				}
			});
			return data;
		}
		/** End of dragging function **/
		
                
         function showFilePrev(fileName){
             $(".drop-file").hide();
                        $(".fileSwitch").hide();
           var ext = fileName.split('.').pop();
            if (ext == "pdf" ) {
                    var object = "<span id='spanob'><object id='obj' data=\"../uploads/docs/"+fileName+"\" type=\"application/pdf\" width=\"600px\" height=\"500px\">";
                    object += "</object>";       
                     $("#showFilePreview").html(object);$("#showFilePreview").show();  
          $("#dispIcon").hide();
          $("#showFile").hide();
          
                }
                if (ext == "doc" || ext == 'docx') {
                    var test = "<?= Yii::$app->request->baseUrl?>/uploads/docs/"+fileName;
                      var object = '<iframe style="width:600px;height:500px;" class="doc" src="'+test+'" &embedded=true"></iframe>';  
                        
                    object += "</object>";      
					$("#showFilePreview").html(object); $("#showFilePreview").hide();
                      console.log(object);
               }
         
          }
		//Embedd Video Starts
		$('input[id=embed_code]').on('change', function() {
            callEmbedUrl(this);
        });
		function callEmbedUrl(videoUrl){
			//$('#link_div').hide();
            var embedd_preview_url = $(videoUrl).val();
            var get_embed_url = "<?=Url::to(['qard/embed-url'], true);?>";
            $.ajax({
                url: get_embed_url,
                type: "POST",
				datatype : 'json',
                data: {
                    'embed_code': embedd_preview_url
                },
                success: function(data) {
					data = $.parseJSON(data);
                    console.log(data);
					$("#drop-file  , .file_options").hide();
					/*added by dency */
							$("#working_div .current_blk").focus();
							document.execCommand('foreColor', false, '<?php echo $theme_properties['dark_text_color'];?>');	
							var video_img  = '<span style="color: <?php echo $theme_properties["dark_text_color"];?>;">'+data.video_img+'</span></br>';
					/****************/
					$("#working_div .current_blk").html(video_img);
					adjustHeight();
					$('#embed_div').html(data.iframelink);
                }
            });
		}
		function calldisplayEmbedUrl(videoUrl){
			//$('#link_div').hide();
            var embedd_preview_url = $(videoUrl).val();
            var get_embed_url = "<?=Url::to(['qard/embeddisplay-url'], true);?>";
            $.ajax({
                url: get_embed_url,
                type: "GET",
				datatype : 'json',
                data: {
                    'embed_code': embedd_preview_url
                },
                success: function(data) {
					data = $.parseJSON(data);
                    console.log(data);
					$("#drop-file  , .file_options").hide();
					$('#link_div').html(data.iframelink);
					$('#link_div').show();
                }
            });
		}
		function embedCode(videoLink){
			var eUrl = $(videoLink).siblings('input[id=embedHide]');
			console.log(eUrl);
			calldisplayEmbedUrl(eUrl);
			$('#embed_code').val($(videoLink).attr('data-content-url'));
		}
		//Embedd Video ends
		$('.embedBlock').click(function(){
			$('a[href="#paste"]').parent().removeClass('active');
			$('a[href="#embed"]').parent().addClass('active');
			$('#paste').removeClass('active');
			$('#embed').addClass('active');
		});
		$('.pasteBlock').click(function(){
			$('a[href="#paste"]').parent().addClass('active');
			$('a[href="#embed"]').parent().removeClass('active');
			$('#paste').addClass('active');
			$('#embed').removeClass('active');
		});
		
		// Styling Card script starts
		$('.qrd-pattern').click(function(){
			$('.qrd-pattern').removeClass('active');
			$(this).addClass('active');
			var styleCard = $(this).attr('id');
			//$('.bgimg-block').removeClass('flat gap shadow line');
			//$('.bgimg-block').addClass(styleCard);
			//$('.bgimg-block').attr('data-style-qard',styleCard);
			
			$('#qrdstyle-link').attr("data-pattern",styleCard);
			//add_block(true,false);
		}); 

		$('#qrdstyle-link').click(function(e){
			e.preventDefault();
			//check total height			
			//$("h5[class=add-another]").trigger("click");
			
			var theme_id = $(this).attr('data-theme');
			var q_id = $('#qard_id').val();
			var block_style = $(this).attr('data-pattern');
			add_block(true,false);
			//changeBlockStyle(block_style);

			if(q_id){
				$.ajax({
					url :"<?=Url::to(['qard/change-style'], true);?>",
					data: {"qard_style":block_style,"qard_id":q_id},
					type: "GET",
					success: function(){
						window.location = '<?php echo \Yii::$app->homeUrl; ?>qard/edit?id='+q_id+'&theme_id='+theme_id;
					}
				});
				
			}else{
				window.location = '<?php echo \Yii::$app->homeUrl; ?>qard/create?theme_id='+theme_id;
			}
		});
/* 		function changeBlockStyle(block_style){
			var q_id = $('#qard_id').val();
			if(q_id){

			}
		} */
		// Styling Card script Ends
	/***************************/
        </script>
    <script>
        'use strict';
        (function(document, window, index) {
            // feature detection for drag&drop upload
            var isAdvancedUpload = function() {
                var div = document.createElement('div');
                return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
            }();
            // applying the effect for every form
            var forms = document.querySelectorAll('.box');
            Array.prototype.forEach.call(forms, function(form) {
                var input = form.querySelector('input[type="file"]'),
                    label = form.querySelector('label'),
                    errorMsg = form.querySelector('.box__error span'),
                    restart = form.querySelectorAll('.box__restart'),
                    droppedFiles = false,
                    showFiles = function(files) {
                        label.textContent = files.length > 1 ? (input.getAttribute('data-multiple-caption') || '').replace('{count}', files.length) : files[0].name;
                    },
                    triggerFormSubmit = function() { return false;
                        var event = document.createEvent('HTMLEvents');
                        event.initEvent('submit', true, false);
                        form.dispatchEvent(event);
                    };
                // letting the server side to know we are going to make an Ajax request
                var ajaxFlag = document.createElement('input');
                ajaxFlag.setAttribute('type', 'hidden');
                ajaxFlag.setAttribute('name', 'ajax');
                ajaxFlag.setAttribute('value', 1);
                form.appendChild(ajaxFlag);
                // automatically submit the form on file select
                input.addEventListener('change', function(e) {
  
                    showFiles(e.target.files);
                    triggerFormSubmit();
                });
                // drag&drop files if the feature is available
                if (isAdvancedUpload) {
                    form.classList.add('has-advanced-upload'); // letting the CSS part to know drag&drop is supported by the browser
                    ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach(function(event) {
                        form.addEventListener(event, function(e) {
                            // preventing the unwanted behaviours
                            e.preventDefault();
                            e.stopPropagation();
                        });
                    });
                    ['dragover', 'dragenter'].forEach(function(event) {
                        form.addEventListener(event, function() {
                            form.classList.add('is-dragover');
                        });
                    });
                    ['dragleave', 'dragend', 'drop'].forEach(function(event) {
                        form.addEventListener(event, function() {
                            form.classList.remove('is-dragover');
                        });
                    });
                    form.addEventListener('drop', function(e) {
                        droppedFiles = e.dataTransfer.files; // the files that were dropped
                        showFiles(droppedFiles);
                        //            var file_data = $('#qard-url-upload').prop('files')[0];   
                        //console.log($("#qard-url-upload").serializeArray());
                        
                        var ajaxData = new FormData($('#qard-url-upload').get(0));
						
                        var fileType;
                        if (droppedFiles) {
                            $.each(droppedFiles, function(i, file) {
                                fileType = file.name;
                                ajaxData.append($('#qard-url-upload input[type=text]').attr('name'), file);
                            });
                        }
                        //console.log(ajaxData);
                        //return false;
                        var ext = fileType.split('.').pop();
                        if (ext == "pdf" || ext == "docx" || ext == "doc") {
                            $("#extErr").hide();
                           
                            if (ext == "pdf") {
                                $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/pdf.png');
                            }
                            if (ext == "docx" || ext == "doc") {
                                $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/doc.png');
                            }
                            $.ajax({
                                url: "<?=Url::to(['qard/url'], true)?>",
                                type: "post",
                                data: ajaxData,
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                complete: function() {
                                    $('#qard-url-upload').removeClass('is-uploading');
                                },
                                success: function(data) {
                                    setLink($(this),data.code,1);
                                    $(".fileName").val(data.code);
									$(".victim").html(''); //poor label
									$("#fileTitle").html(data.code); //for image area
                                },
                                error: function(data) {
                                    alert("Error! Please try again");
                                    // Log the error, show an alert, whatever works for you
                                }
                            });
                        } else {
                            $(".drop-file").show();
                            $("#extErr").show();
                            $("#showFile").hide();
                            $(".fileName").val('');
                            $(".fileSwitch").show();
                        }
                        return false;
                        var form_data = new FormData();
                        form_data.append('file', file_data);
                        var myfile = $(this).val();
                        var ext = myfile.split('.').pop();
                        if (ext == "pdf" || ext == "docx" || ext == "doc") {
                            $("#extErr").hide();
                            if (ext == "pdf") {
                                $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/pdf.png');
                            }
                            if (ext == "docx" || ext == "doc") {
                                $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/doc.png');
                            }
                            $.ajax({
                                url: "< ?=Url::to(['qard/url'], true)?>",
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',
                                success: function(response) {
                                    $(".drop-file").hide();
                                    $(".drop-image").show();
                                    $(".fileName").val(response.code);
                                    $(".fileSwitch").hide();
                                    // console.log(response);
                                    //count++;
                                }
                            });
                        }
                        //					triggerFormSubmit();
                    });
                }
                // if the form was submitted
                form.addEventListener('submit', function(e) {
                
                    // preventing the duplicate submissions if the current one is in progress
                    if (form.classList.contains('is-uploading')) return false;
                    form.classList.add('is-uploading');
                    form.classList.remove('is-error');
                    if (isAdvancedUpload) // ajax file upload for modern browsers
                    {
                        e.preventDefault();
                        // gathering the form data
                        var ajaxData = new FormData(form);
                        if (droppedFiles) {
                            Array.prototype.forEach.call(droppedFiles, function(file) {
                                ajaxData.append(input.getAttribute('name'), file);
                            });
                        }
                        // ajax request
                        var ajax = new XMLHttpRequest();
                        ajax.open(form.getAttribute('method'), form.getAttribute('action'), true);
                        ajax.onload = function() {
                            form.classList.remove('is-uploading');
                            if (ajax.status >= 200 && ajax.status < 400) {
                                var data = JSON.parse(ajax.responseText);
                                form.classList.add(data.success == true ? 'is-success' : 'is-error');
                                if (!data.success) errorMsg.textContent = data.error;
                            } //else //alert('Error. Please, contact the webmaster!');
                        }
                        ajax.onerror = function() {
                            form.classList.remove('is-uploading');
                            alert('Error. Please, try again!');
                        }
                        ajax.send(ajaxData);
                    } else // fallback Ajax solution upload for older browsers
                    {
                        var iframeName = 'uploadiframe' + new Date().getTime(),
                            iframe = document.createElement('iframe');
                        $iframe = $('<iframe name="' + iframeName + '" style="display: none;"></iframe>');
                        iframe.setAttribute('name', iframeName);
                        iframe.style.display = 'none';
                        document.body.appendChild(iframe);
                        form.setAttribute('target', iframeName);
                        iframe.addEventListener('load', function() {
                            var data = JSON.parse(iframe.contentDocument.body.innerHTML);
                            form.classList.remove('is-uploading')
                            form.classList.add(data.success == true ? 'is-success' : 'is-error')
                            form.removeAttribute('target');
                            if (!data.success) errorMsg.textContent = data.error;
                            iframe.parentNode.removeChild(iframe);
                        });
                    }
                });
                // restart the form if has a state of error/success
                Array.prototype.forEach.call(restart, function(entry) {
                    entry.addEventListener('click', function(e) {
                        e.preventDefault();
                        form.classList.remove('is-error', 'is-success');
                        input.click();
                    });
                });
                // Firefox focus bug fix for file input
                input.addEventListener('focus', function() {
                    input.classList.add('has-focus');
                });
                input.addEventListener('blur', function() {
                    input.classList.remove('has-focus');
                });
            });
        }(document, window, 0));
    </script>