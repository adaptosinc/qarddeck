<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use app\models\Deck;
use dosamigos\fileupload\FileUpload;
/* @var $this yii\web\View */
/* @var $model app\models\Qard */
$this->title = 'Create Qard';


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

    <!--only for this page-->
    <link href="<?= Yii::$app->request->baseUrl?>/css/custom.css" rel="stylesheet">

    <!-- requiered for fore color of text -->
    <link href="<?= Yii::$app->request->baseUrl?>/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <!--for image crop-->
    <link href="<?= Yii::$app->request->baseUrl?>/css/html5imageupload.css" rel="stylesheet">
    <!--<link href="<?= Yii::$app->request->baseUrl?>/css/custom.css" rel="stylesheet">-->

    <script src="<?= Yii::$app->request->baseUrl?>/js/bootstrap-colorpicker.js" type="text/javascript"></script>

    <!-- requiered for get selected fiels in text editing -->
    <script src="<?= Yii::$app->request->baseUrl?>/js/jquery.selection.js" type="text/javascript"></script>
    
    <!--for resize block-->
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- requiered for drop down of an image -->
	
	<!--for quick tour-->
	<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl?>/css/joyride-2.1.css">

	<!----------------->
	  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	  <script>tinymce.init({ 
		selector:'#extra_text',
		plugins: "textcolor",
		menu: {
			file: false,
			edit: false,
			insert: false,
			view: false,
			formats: false
		},
		toolbar: ' bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist | forecolor | fontsizeselect',
	  });</script>	
    <section class="create-card">
        <div id="wait" class="waiting_logo"><img src='<?=Yii::$app->request->baseUrl?>/img/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
		
				<div class="row">

                        <div class="col-sm-6 col-md-6">
                            <h2>
                                <input type="text" name="qard_title" id="qard_title" style="width:100% !important" placeholder="Enter a Title for this Qard">
                            </h2>                            
                        </div>
				</div>
				</br>
				<div class="row">
						<div class="col-sm-8 col-md-8" style="padding: 0;">
							<select class="js-example-basic-multiple form-control" id="tags" name="tags[]" multiple="multiple" placeholder="Add some tags" style="display:none">
							<?php foreach($tags as $tag){
							echo '<option value="'.$tag->tag_id.'">'.$tag->name.'</option>';
							}?>
							</select>
						</div>  
                        <div class="col-sm-4 col-md-4">
                            <ul class="pull-right">
							<?php 
								if(!\Yii::$app->user->isGuest){
						
							?>
                                <li><button id="add_to_deck" class="btn btn-default" href="<?=Yii::$app->request->baseUrl?>/deck/select-deck">Add to Deck</button></li>
							<?php } ?>	
                                <li><button class="btn qard" data-toggle="modal" data-target="#qard-style">Qard Style</button></li>
                            </ul>
                        </div>   						
				</div>
        <div class="row">

            <div class="col-sm-3 col-md-3 add-block">
                <div id="add-block" class="qard-div add-block-qard" >
						<?php
						if(isset($model['qard_id'])){
							echo '<input type="text" name="qard_id" value="'.$model['qard_id'].'">';
						}
						?>
						<input type="hidden" name="theme_id" value="<?=$theme['theme_id']?>">
		
						<?php 
						//get theme properties
						$theme_properties = unserialize($theme['theme_properties']);
						//print_r($theme_properties);
						?>
                      

                        <div id="working_div" class="working_div block active">
                            <div id="blk_1" class="bgimg-block parent_current_blk">
                                <div class="bgoverlay-block">
                                    <div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off" data-block_priority="1" style="overflow:hidden;margin:10px"></div>
                                </div>
                            </div>
                        </div>
						<h5 class="add-another" onclick="add_block(event,true)"><i class="fa fa-plus"></i>Add another block </h5>
                </div>
				
            </div>
            <div class="col-sm-9 col-md-9">
                <div id="cardtabs">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs col-sm-1 col-md-1" role="tablist">
					
                        <li role="presentation" class="active"><a id="cardblock_li" href="#cardblock" aria-controls="cardblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/text_icon.png" alt="" class="dark" style="width:15px;margin:0 auto;"><img src="<?=Yii::$app->homeUrl?>images/text_icon_light.png" class="light" alt="" style="width:15px;margin:5px auto;"></a></li>
						
                        <li role="presentation"><a id="linkblock_li" href="#linkblock" aria-controls="linkblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/link_icon.png" class="dark" alt=""><img src="<?=Yii::$app->homeUrl?>images/link_icon_light.png" class="light" alt="" style="margin:5px auto;"></a></li>
						
                        <li role="presentation"><a id="imgblock_li" id="imgblock_tab" href="#imgblock" aria-controls="imgblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/image_icon.png" class="dark" alt=""><img src="<?=Yii::$app->homeUrl?>images/image_icon_light.png" class="light" alt="" style="margin:5px auto;"></a></li>
						
                        <li role="presentation"><a id="embedblock_li" href="#videoblock"  aria-controls="videoblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/video_icon.png" class="dark" alt=""><img src="<?=Yii::$app->homeUrl?>images/video_icon_light.png" class="light" alt=""></a></li>
						
						<li role="presentation"><a id="fileblock_li" href="#fileblock" aria-controls="fileblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/file_icon.png" class="dark" alt="" style="width:15px;margin:0px auto;"><img src="<?=Yii::$app->homeUrl?>images/file_icon_light.png" class="light" alt="" style="width:15px;margin:5px auto;"></a></li>
						
                        <li role="presentation"><a id="copyblock_li" onClick="copyBlock();" aria-controls="copyblock" role="tab" data-toggle="tab"><hr class="divider"></hr><img src="<?=Yii::$app->homeUrl?>images/duplicate_icon.png" class="dark" alt=""><img src="<?=Yii::$app->homeUrl?>images/duplicate_icon_light.png" class="light" alt=""></a></li>

						
                        <li role="presentation" id="deleteblock"><a id="deleteblock_li" href="#deleteblock" aria-controls="deleteblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->homeUrl?>images/delete_icon.png" class="dark" alt=""><img src="<?=Yii::$app->homeUrl?>images/delete_icon_light.png" class="light" alt=""></a></li>
						
						
                    </ul>
                    <!---->


                    <!-- Tab panes -->
                    <div class="tab-content col-sm-11 col-md-11">
				
					<!-- Start of header-->
						<div class="cardblock-header">
							<h4>Edit Block</h4>
							<ul class="editable-elements">
								<li class="size-element">
									<label>Text Size</label>
									<select id="text_size" class="form-control">
										<option value="">Select</option>
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
								<li class="color-elements" id="text_color_li">
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
								<li class="color-elements" id="block_color_li">
									<label>Block Color</label>
									<div class="dropdown">
									  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									  </button>
									  <ul class="dropdown-menu" aria-labelledby="dropdownMenu4" style="left: -50px;">
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
						<div class="row">
						<h4>
							<span id="remove_extra_text" class="trash pull-right" >
								<button  class="btn btn-warning" name="add_extra_text" id="add_extra_text" >Add Extra Text </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</span>
						</h4>	
						</div>
						 <div id="extra-word" style="pointer-events: none;opacity: 0.4;" >	
							<div id="descfield" >
								<h4>Add Extra text <span id="remove_extra_text" class="trash pull-right">
								
								
							<div class="col-sm-12 col-md-12 on-off" id="link-extra" style="display:none; "  >
								<div class="switch" id="sw-cmn-toggle-9" >
									<input id="cmn-toggle-9"  class="cmn-toggle cmn-toggle-round" type="checkbox">
									<label for="cmn-toggle-9"></label>
								</div>  <span>Link This Text</span> 
							</div>
								
								<!---<i class="fa fa-trash"></i>&nbsp;Remove Extra Text-->  </span></h4>
								<input type="textbox" name="extra-text" id="extra-list" disabled="disabled" placeholder="Enter an optional text" class="form-control extracheck">
								<ul class="editable-elements">
									<li id="text_area_bold"><a href="#"><i class="fa fa-bold"></i></a></li>
									<li id="text_area_italics"><a href="#"><i class="fa fa-italic"></i></li>
									<li id="text_area_underline"><a href="#"><i class="fa fa-underline"></i></a></li>
									<!--<li><a id="extra_text_link" href="#"><img src="<?=Yii::$app->homeUrl?>images/link_icon.png" alt="" style="padding: 8px;"></a></li>-->
								</ul>
							</div>
							<div id="extrafield">
								<div id="extra_text" name="desc" class="extracheck"  disabled="true"  placeholder="Enter The Text" contenteditable="true"></div>
							</div>
							<span class="extra_reset_link trash pull-right" style="padding-right:20px;cursor: pointer; cursor: hand; " ><i class="fa fa-trash"></i>&nbsp;Clear</span>
						 </div>
						
						</div>

                        <div role="tabpanel" class="tab-pane" id="imgblock">
                       	<h4 id="reflink" >Add Image <span class="trash pull-right" >
							<div class="col-sm-12 col-md-12 on-off">
							<div class="switch" id="sw-cmn-toggle-7">
											<input id="cmn-toggle-7" class="cmn-toggle cmn-toggle-round" type="checkbox">
											<label for="cmn-toggle-7"></label>
										</div>  <span>Display Preview Icon</span> 
							</div>
										</span></h4>
							<div class="img_preview" style="display:none"></div>
                            <div class="drop-image">
                                <form action="" id="image_upload" method="post" enctype="multipart/form-data">
                                    <div class="dropzone" data-smaller="true" data-originalsize="false" id="for_image" data-width="960" data-ajax="false" data-height="540" style="width: 100%;" >
                                        <input type="file" name="thumb" id="thumb" required="required" />
                                    </div>
										
                                </form>
                            </div>
                          
							<div class="form-group image-elements">
								<!--<div class="col-sm-3 col-md-3 on-off">
									<span>Fit</span>
										<div class="switch" id="sw-cmn-toggle-6">
											<input id="cmn-toggle-6" class="cmn-toggle cmn-toggle-round" type="checkbox">
											<label for="cmn-toggle-6"></label>
										</div>  <span>Crop</span> 
								</div>-->
								
								<div class="col-sm-5 col-md-5 on-off">
										<div class="switch" id="sw-cmn-toggle-3" >
											<input id="cmn-toggle-3" class="cmn-toggle cmn-toggle-round" type="checkbox">
											<label for="cmn-toggle-3"></label>
										</div>  <span>Display as background Image</span> 
								</div> 
									<span id="reset_image" style="cursor: pointer; cursor: hand;" class="trash pull-right" ><i class="fa fa-trash"></i>&nbsp;Clear</span>							
                            </div>
                           
                        </div>
						
                        <!--<div role="tabpanel" class="tab-pane" id="linkblock">
						
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active" style="display:none"><a href="#paste" aria-controls="paste" role="tab" data-toggle="tab"><button class="btn btn-warning">Paste URL</button></a></li>
								<li role="presentation" style="display:none"><a href="#embed" aria-controls="embed" role="tab" data-toggle="tab"><button class="btn btn-grey">Embed Code</button></a></li>                                       
							</ul>						
							<div class="tab-content">-->
							
                                <div role="tabpanel" class="tab-pane" id="linkblock">
									<h4 id="reflink">Add Url<span id="remove_extra_text" class="trash pull-right"><div class="col-sm-12 col-md-12 on-off">
											<div class="switch" id="sw-cmn-toggle-21">
												<input id="cmn-toggle-21" data-id="1" class="cmn-toggle cmn-toggle-round" type="checkbox">
												<label for="cmn-toggle-21" ></label>
											</div>  <span>Link URL</span> 
									</div></span></h4> 									
									<div class="form-group" id="showlinkUrl">
										<input type="text" name="url" id="link_url" class="form-control pasteUrl" placeholder="Paste Url (Another qard deck,website,youtube video, images etc)">
										<p style="color: orange;">Link directly to another Qard or Deck by using its QardDeck share URL</p>
									</div>
									<div class="form-group extra-content" style="margin-bottom: 60px;">
										<input type="text" data-check="off" name="url-title" class="col-sm-5 col-md-5" placeholder="Enter Title">
										<input type="text" data-check="off" name="url-desc" class="col-sm-6 col-md-6 col-md-offset-1" placeholder="Add a description">
									</div>
									<div id="link_div" style="padding-bottom: 10px;">
										<div class="preview-image">                                       
										</div> 
									</div>	
										<input type="hidden" id="work_space_text" />
										<input type="hidden" id="work_space_link_only" />
									<div class="form-group toggle-btn">
										<div class="col-sm-4 col-md-4 on-off">
											<div class="switch" id="sw-cmn-toggle-4">
												<input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox" data-toggle="toggle">
												<label for="cmn-toggle-4"></label>
											</div>  <span>Display URL</span>                                                  
										</div>                                            
										<div class="col-sm-4 col-md-4 on-off">
											<div class="switch" id="sw-cmn-toggle-8">
												<input id="cmn-toggle-8" class="cmn-toggle cmn-toggle-round" type="checkbox">
												<label for="cmn-toggle-8"></label>
											</div>  <span>Open Link in New Tab</span>                                                 
										</div>
										<span class="url_reset_link trash pull-right" style="cursor: pointer; cursor: hand; " for="samefield" data-id='create' ><i class="fa fa-trash"></i>&nbsp;Clear</span>
									</div>

								</div>
								
								<div role="tabpanel" class="tab-pane" id="videoblock">
								
									<h4 id="reflink">Add Embed Code
									<span class="trash pull-right">
								
								
							<div class="col-sm-12 col-md-12 on-off" id="link-ecode"   >
								<div class="switch" id="sw-cmn-toggle-57" >
								<input type="hidden" id="emcode_hid" name="emcode_hid" >
								<input type="hidden" id="emcode_hidimg" name="emcode_hidimg" >
									<input id="cmn-toggle-57" class="cmn-toggle cmn-toggle-round" type="checkbox">
									<label for="cmn-toggle-57"></label>
								</div>  <span>Link This Code</span> 
							</div>
								
								 </span>
									
									</h4>
									<div class="form-group" id="embedCode">
										<input type="text" name="embed_code" id="embed_code" class="form-control pasteUrl" placeholder="Paste your embed code (Youtube, Vimeo etc)">
									</div>
									<div id="embed_div">
										<div class="preview-image">                                       
										</div>  
									</div>	
									
									<span id="rmembed_code" style="cursor: pointer; cursor: hand; " class="trash pull-right" ><i class="fa fa-trash"></i>&nbsp;Clear</span>
									
								
								</div>  

							<!--</div>
						</div>-->
						<div role="tabpanel" class="tab-pane" id="fileblock">
						
						 <div id="showFilePreview" style="display:none"></div>
						 
						  <div id="editcheck" >
						 
							<h4 id="reflink" >Add File<span class="trash pull-right" >
							<div class="col-sm-12 col-md-12 on-off">
							<div class="switch" id="sw-cmn-toggle-56" >
												<input id="cmn-toggle-56" class="cmn-toggle cmn-toggle-round" type="checkbox">
												<label for="cmn-toggle-56" class="victim"></label>
							</div>  <span>Link this Document</span>
							</div>
										</span></h4>
                            
							<div class="form-group extra-content" id="drop-image23" style="margin-bottom: 60px;  padding-top: 10px;" >
									<input type="text" id="url-filename" name="filename" class="col-sm-5 col-md-5" placeholder="Enter Title">
									<input type="hidden"  class="filename fileName col-sm-5 col-md-5" >
									<input type="text" id="url-filedesc" name="filedesc" class="col-sm-6 col-md-6 col-md-offset-1 desc" placeholder="Add a description">
								</div>
								
							<form method="post" action="" id="qard-url-upload" enctype="multipart/form-data" novalidate class="box">
							
							
								<input type="hidden" name='file_att_name' id='file_att_name' />
								
								<div class="add-new-file" style="padding-bottom: 10px;" >
									<div class="drop-file form-group" id="drop-file-bg" >
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
								
						
								
								
							</form>	
							
						  </div>
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
					<li class="help-link"><a href=""><img src="<?=Yii::$app->homeUrl?>images/need-help_icon.png" width="30px" height="30px" style="margin-right:5px;" alt="">Need Help?</a>
					</li>

					<li class="pull-right"><button class="btn btn-warning" name="preview" id="previewclick" >Preview Qard</button></li>
					<!-- onclick="addSaveCard(event)"  check alert removed onclick function -->
				
				</ul>
			</div>
		</div> 

    </section>
    <!-- block_error popup -->
	
	
<div id="deck-style" class="fade modal in" role="dialog" tabindex="-1">
	
	<div class="modal-dialog ">
		 <button style="margin: -25px -25px 0px 0px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>	
		<div class="modal-content">		
			<div class="modal-header"> 			
				<h4 class="modal-title">Select a Deck to Add Qard to :				
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
				<!-- onSubmit="saveDeck(this);return false;" -->
				<form  id="ajaxDeck" enctype = "multipart/form-data"  method="POST" name="ajaxDeck">
					<input style="margin-top:10px"  type="text" name="title"  id="deck-title" autocomplete="off" placeholder="Untitle Deck"/>
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
</div>

<!-- Qard style pop up -->
	<!-- Modal -->
	<div class="modal fade" id="qard-style" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header" style="padding: 10px 0; width: 104%;">
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
			<button type="button" class="btn btn-warning pull-right" id="qrdstyle-link" data-theme="" data-pattern="">APPLY STYLE</button>
		  </div>
		</div>
	  </div>
	</div>
<!-- Qard style pop up -->


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
	
	<!-- MODALS -->
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
					<!--- Tutorial Starts Here-->

		<!-- Modal -->
		<div class="modal fade" id="myModaltut" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				<!-- carousel start -->
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					<li data-target="#carousel-example-generic" data-slide-to="3"></li>
					<li data-target="#carousel-example-generic" data-slide-to="4"></li>
					<li data-target="#carousel-example-generic" data-slide-to="5"></li>
				  </ol>
				
				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
					<div class="item active">
					  <img src="<?=Yii::$app->homeUrl?>images/tutorial_icon_01.png" alt="">
					  <div class="carousel-caption">
						<h4>Hi! I am <i>The</i> <strong>Block</strong></h4>
						<h4>I am the building element of a Qard</h4>                                            
					  </div>
					</div>
					<div class="item">
					  <img src="<?=Yii::$app->homeUrl?>images/tutorial_icon_02.png" alt="">
					  <div class="carousel-caption">
						<h4>I display you thoughts, comments and ideas in text form. You can type directly on my face.</h4>
					  </div>
					</div>
					<div class="item">
					  <img src="<?=Yii::$app->homeUrl?>images/tutorial_icon_03.png" alt="">
					  <div class="carousel-caption">
						<h4>You can resize me to make room for all your thoughts. You can even move me around!</h4>
					  </div>
					</div>
					<div class="item">
					  <img src="<?=Yii::$app->homeUrl?>images/tutorial_icon_04.png" alt=""  class="custom-img">
					  <div class="carousel-caption">
						<h4>You can style me to fit your personality or to match your content! I look good in any theme. </h4>
					  </div>
					</div>
					<div class="item">
					  <img src="<?=Yii::$app->homeUrl?>images/tutorial_icon_05.png" alt="">
					  <div class="carousel-caption">
						<h4>You can add all types of media for me to present, but just one at a time. I am very organized!</h4>
					  </div>
					</div>
					<div class="item">
					  <img src="<?=Yii::$app->homeUrl?>images/tutorial_icon_06.png" alt="">
					  <div class="carousel-caption">
						<h4>You can duplicate me or start fresh any time. If I don't fit anymore, you can even delete me. I'll haunt your dreams though...</h4>
					  </div>
					</div>                                        
				  </div>        <!-- Wrapper for slides -->
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					  <img src="<?=Yii::$app->homeUrl?>images/arrow-left_icon.png" alt="">
					  <span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					  <img src="<?=Yii::$app->homeUrl?>images/arrow-right_icon.png" alt="">
					  <span class="sr-only">Next</span>
					</a>                                      
				</div>      <!-- carousel end -->
				
			  </div>
			</div>
		  </div>
		</div>          <!-- Modal --> 
		<!--- Tutorial Ends Here-->	


    <script src="<?= Yii::$app->request->baseUrl?>/js/select2.js"  type="text/javascript" ></script>
	<script type="text/javascript">
	/**
	  * Script re-written by Dency G B 
	 **/
	 
		$(".js-example-basic-multiple").select2({
		 placeholder: "Add some tags",
	 });
	</script>
	
    <script src="<?= Yii::$app->request->baseUrl?>/js/html5imageupload.js" type="text/javascript"></script>
    <script src="<?= Yii::$app->request->baseUrl?>/js/jquery.caret.js" type="text/javascript"></script>

    <script src="<?= Yii::$app->request->baseUrl?>/js/jquery-ui.js" type="text/javascript"></script>
	<script src="<?= Yii::$app->request->baseUrl?>/js/qarddeck.js" type="text/javascript"></script>
    <!-- Tip Content --> 
    <ol id="joyRideTipContent" style="display: none;">
      <li data-id="working_div" data-text="Next" class="custom">
        <h2>Tip #1</h2>
        <p>Click here to type anything.This is your first block</p>
      </li>
      <li data-id="text_color_li" data-text="Next" class="custom">
        <h2>Tip #2</h2>
        <p>Click here to change color of the text.</p>
      </li>
      <li data-id="block_color_li" data-button="Next" data-options="tipLocation:left;tipAnimation:fade">
        <h2>Tip #3</h2>
        <p>Click here to change the background color of the block.</p>
      </li>
      <li data-id="cardblock_li" data-button="Next" data-options="tipLocation:right">
        <h2>Tip #4</h2>
        <p>Click here to add any extra text</p>
      </li>
      <li data-id="imgblock_li" data-button="Next" data-options="tipLocation:right">
        <h2>Tip #5</h2>
        <p>Click here to add an image</p>
      </li>
      <li data-id="linkblock_li" data-button="Next" data-options="tipLocation:right">
        <h2>Tip #6</h2>
        <p>Click here to add a url</p>
      </li>
      <li data-id="embedblock_li" data-button="Next" data-options="tipLocation:right">
        <h2>Tip #7</h2>
        <p>Click here to add an embed code</p>
      </li>
      <li data-id="fileblock_li" data-button="Next" data-options="tipLocation:right">
        <h2>Tip #8</h2>
        <p>Click here to add a file</p>
      </li>
      <li data-id="copyblock_li" data-button="Next" data-options="tipLocation:right">
        <h2>Tip #9</h2>
        <p>Click here to clone a block</p>
      </li>
      <li data-id="deleteblock_li" data-button="Next" data-options="tipLocation:right">
        <h2>Tip #10</h2>
        <p>Click here to delete a block</p>
      </li>
      <li data-class="help-link" data-button="Close" >
        <h2>Tip #11</h2>
        <p>Click here for any help! Start creating awesome qards!!</p>
      </li>
	</ol>
    <script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/tour/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/tour/modernizr.mq.js"></script>
    <script type="text/javascript" src="<?= Yii::$app->request->baseUrl?>/js/tour/jquery.joyride-2.1.js"></script>	




	<script type="text/javascript">

	/** Tip Content Only for create**/
      $(window).load(function() {
		
        $('#joyRideTipContent').joyride({
          autoStart : true,
		  modal:true,
          expose: true,
		  cookieMonster: true,           // true/false for whether cookies are used
		  cookieName: 'QardDeck',         // choose your own cookie name
          cookieDomain: false, 
        });
      });
	 /** Tip Content **/
	 
	/**
	  * Script re-written by Dency G B 
	 **/
/* 	  $(".js-example-basic-multiple").select2({
		 placeholder: "Add some tags",
	 }); */
	
	/**** Handle the main work space ******/
	$('.dropzone').html5imageupload({
		ghost: false,
	});
	$(window).qardDeck({
		'dark_text_color': '<?php echo $theme_properties['dark_text_color'];?>',
		'overlay_color'  : '<?php echo $theme_properties['overlay_color'];?>',
		'overlay_opacity': '<?php echo $theme_properties['overlay_opacity'];?>',
		'createDeckUrl'  : '<?=Url::to(['deck/create-ajax'], true)?>',
		'addToDeckUrl'   : '<?=Url::to(['deck/add-qard'], true)?>',
		'saveQardUrl'    : '<?=Url::to(['block/save-qard'], true)?>',
		'editQardUrl'    : '<?=Url::to(['qard/edit'], true)?>',
		'previewQardUrl' : '<?=Url::to(['qard/preview-qard'], true);?>',
		'updateBlockPriorityUrl' : '<?=Url::to(['block/change-priority'], true)?>',
		'deleteBlockUrl' : '<?=Url::to(['block/delete-block'], true)?>',
		'blockCreateUrl' : '<?=Url::to(['block/create'], true)?>',
		'homeUrl'        : '<?=\Yii::$app->homeUrl?>',
		'addExtraTextUrl': '<?=Url::to(['block/add-text'], true)?>',
		'getExtraTextUrl': '<?=Url::to(['block/get-text'], true)?>',
		'getUrlPreviewUrl'  : '<?=Url::to(['qard/url-preview'], true);?>',
		'uploadFileUrl'  : '<?=Url::to(['qard/url'], true)?>',
		'uploadSimpleFileUrl'  :'<?=Url::to(['qard/simple'], true)?>',
		'embedCodeUrl'   : '<?=Url::to(['qard/embed-url'], true);?>',
		'changeStyleUrl' : '<?=Url::to(['qard/change-style'], true);?>',
		'addUrlDataUrl'  : '<?=Url::to(['block/add-urldata'], true);?>',
		'addFileDataUrl'  : '<?=Url::to(['block/add-filedata'], true);?>',
		'getFileDataUrl'  : '<?=Url::to(['block/get-filedata'], true);?>',
		'copyQardBlockUrl'  : '<?=Url::to(['block/copy-block'], true);?>',
		'genQardImage'  : '<?=Url::to(['qard/generate-qard-image'], true);?>',
	
		
	});

	</script>
	<script src="<?= Yii::$app->request->baseUrl?>/js/qard_file_handler.js" type="text/javascript"></script>
<script>
	$(document).on('click', '#previewclick', function(){ 
		 if ($('.select2-selection__rendered').find( ".select2-selection__choice" ).length <= 0 ) { 		 
			 alert('Please Add Tags!!!..');
			 $('.select2-search__field').focus();
			  return false;
			 }	
			 
		addSaveCard();		
});

$( "#ajaxDeck" ).submit(function( event ) {
			if($.trim($("#deck-title").val()) == "")
			{
				
				alert("Please Enter The Deck Title!!!.");
				return false;
			}
			else if($.trim($("#bg_image").val()) == "")
			{
				alert("Please Select the Backgound image For Deck!!!.");
				return false;
			}
			else
			{
				saveDeck(this);
				return false;
			}
			
	});
	
	
	 $(document).ready(function () {
        $("#deck-bg_image").change(function() {
			var loadingUrl = "<?=Yii::$app->request->baseUrl?>/img/loading1.gif";
			$(".deck-img-pre").css("background","#f1f1f1 url("+loadingUrl+")")
			$(".deck-img-pre").css("background-size", "cover");	
		});
	 });
	 
	 
</script>