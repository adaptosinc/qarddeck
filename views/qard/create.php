<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
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

            <div class="col-sm-4 col-md-4">
                <div id="add-block" class="qard-div add-block" style="overflow:hidden">
                    <?php
		if(isset($model['qard_id'])){
		    echo 'Qard<input type="hidden" name="qard_id" value="'.$model['qard_id'].'">';
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

                        <div id="working_div" class="working_div block active">
                            <div id="blk_1" class="bgimg-block parent_current_blk">
                                <div class="bgoverlay-block">
                                    <div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off" data-block_priority="1" style="overflow:hidden"></div>
                                </div>
                            </div>
                        </div>
                        <h4 class="add-another" onclick="add_block(event)" style="display:block">Add another block <span><img src="<?=Yii::$app->request->baseUrl?>/images/add.png" alt="add"></span></h4>
                </div>
            </div>
            <div class="col-sm-8 col-md-8">
                <div id="cardtabs">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs col-sm-2 col-md-2" role="tablist">
                        <li role="presentation" class="active"><a href="#cardblock" aria-controls="cardblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/txt.png" alt=""></a></li>
                        <!--<li role="presentation"><a href="#fileblock" aria-controls="fileblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/file.png" alt=""></a></li>-->
                        <li role="presentation"><a href="#linkblock" aria-controls="linkblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/link.png" alt=""></a></li>
                        <li role="presentation"><a id="imgblock_tab" href="#imgblock" aria-controls="imgblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/img.png" alt=""></a></li>
                        <li role="presentation"><a href="#paintblock" aria-controls="paintblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/paint.png" alt=""></a></li>
                        <li role="presentation"><a href="#copyblock" aria-controls="copyblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/copy.png" alt=""></a></li>
                        <li role="presentation" id="deleteblock"><a href="#deleteblock" aria-controls="deleteblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/delete.png" alt=""></a></li>
                    </ul>
                    <!--added by vijay-->


                    <!-- Tab panes -->
                    <div class="tab-content col-sm-10 col-md-10">
                        <div role="tabpanel" class="tab-pane active" id="cardblock">
                            <fieldset class="wysihtml5-toolbar">
                                <div class="form-group col-sm-3 col-md-3">
                                    <select id="text_size">
				<option> 1</option>
				<option> 2</option>
				<option> 3</option>
				<option> 4</option>
				<option> 5</option>
				<option> 6</option>
				<option> 7</option>
				<option> 8</option>
			    </select>
                                </div>
                                <div class="form-group col-sm-3 col-md-3">
                                    <ul class="text-elements">
                                        <li id="text_bold"><a href="#">B</a></li>
                                        <li id="text_italic"><a href="#"><i>I</a></i>
                                        </li>
                                        <li id="text_underline" class="underline" tabindex="-1" title="CTRL+U" data-wysihtml5-command="underline" href="javascript:;" unselectable="on"><a href="#">U</a></li>
                                    </ul>
                                </div>
                                <div class="form-group col-sm-3 col-md-3">
                                    <ul class="align-elements">
                                        <li><img src="<?=Yii::$app->request->baseUrl?>/images/icon-left.png" alt=""> <select id="text_align">
					    <option value="justifyLeft">left</option>
					    <option value="justifyRight">right</option>
					    <option value="justifyCenter">center</option>
					    <option  value="justifyFull">justify</option>
					</select></li>
                                        <li id="text_color">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="<?=Yii::$app->request->baseUrl?>/images/fonts.png" alt="" >	
    <span class="caret"></span>
  </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <a href="#" class="color" style="background:<?php echo $theme_properties['dark_text_color'];?>;display: inline-block;height: 25px;width: 25px;" data-color="<?php echo $theme_properties['dark_text_color'];?>" onClick="setForeColor(this);"></a>
                                                    <a href="#" class="color" style="background:<?php echo $theme_properties['light_text_color'];?>;display: inline-block;height: 25px;width: 25px;" data-color="<?php echo $theme_properties['light_text_color'];?>"  onClick="setForeColor(this);"></a>
                                                </ul>
                                            </div>
                                            </li>
                                            <li id="text_indent"><a href="#"><img src="<?=Yii::$app->request->baseUrl?>/images/leftalign.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="form-group col-sm-3 col-md-3">
                                    <select id="text_family">
				<option value="Roboto"> Roboto</option>
				<option value="Inconsolata"> Inconsolata</option>
				<option value="monospace"> monospace</option>
			    </select>
                                </div>
                                <ul class="on-off pull-left">
                                    <li>
                                        <div class="switch">
                                            <input id="cmn-toggle-1" name="is_extra_text" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                            <label for="cmn-toggle-1" onclick="showtext()"></label>
                                        </div> <span>Extra Text</span>
                                    </li>
                                    <li>
                                        <div class="switch">
                                            <input id="cmn-toggle-2" name="is_title" value="1" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                            <label for="cmn-toggle-2"></label>
                                        </div> <span>Make Qard Title</span>
                                    </li>
                                </ul>
                            </fieldset>
                            <div id="descfield" class="working_div" style="display: none;">
                                <div name="desc" id="extra_text" class="cur_blk " placeholder="Enter The Text" contenteditable="true"></div>
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
                            <fieldset>
                                <form method="post" action="" id="qard-url-upload" enctype="multipart/form-data" novalidate class="box">

                                    <div id="link_div"></div>
                                    <div class="drop-file form-group" id="drop-file">
                                        <img src="<?=Yii::$app->request->baseUrl?>/images/browse.png" alt="">

                                        <h2 id="extErr">Only PDF,DOC,DOCX TYPES ARE ALLOWED</h2>
                                        <h3>Drop files/click to Browse</h3></div>

                                    <div class="drop-image form-group" id="drop-image" style="min-height:0px!important;">

                                        <img id="dispIcon" class="imgCenter">
                                        <span id="showFile">
                                                        <input type="text" name="filename" class="filename form-control fileName" placeholder="File Name">
                                                        <textarea name="desc" class="form-control desc" placeholder="Description"></textarea>
                                                </span>
                                    </div>
                                    <div class="fileSwitch">
                                        <input id="qard-url-upload-click" name="image" class="hidden" type="file">
                                        <div class="box__input">

                                            <input type="file" name="files[]" id="file" class="box__file hidden" data-multiple-caption="{count} files selected" multiple />
                                            <!--			<label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>-->
                                            <!--			<button type="submit" class="box__button">Upload</button>-->
                                        </div>
                                        <h3><center>or...</center></h3>
                                        <div class="form-group" id="showlinkUrl">
                                            <input type="text" name="url" id="link_url" class="form-control pasteUrl" placeholder="Paste Url (Another qard deck,website,youtube video, images etc)">
                                            <p style="color: orange;">Link directly to another Qard or Deck by using its QardDech share URL</p>
                                        </div>
										<h3><center>or...</center></h3>
                                        <div class="form-group" id="embedCode">
                                            <input type="text" name="embed_code" id="embed_code" class="form-control pasteUrl" placeholder="Paste your embed code (Youtube, Vimeo etc)">
                                        </div>
                                        <!--<div class="form-group link_options" style="display:none">
                                                <div class="col-sm-4 col-md-4 on-off">
                                                    <div class="switch">
                                                        <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                        <label for="cmn-toggle-4"></label>
                                                    </div>  <span>Display Link</span>                                                  
                                                </div>
                                                <div class="col-sm-4 col-md-4 on-off">
                                                    <div class="switch">
                                                        <input id="cmn-toggle-5" class="cmn-toggle cmn-toggle-round" type="checkbox" onClick="showUrlPreview()">
                                                        <label for="cmn-toggle-5"></label>
                                                    </div>  <span>Display Preview</span>                                                  
                                                </div>
                                                <div class="col-sm-4 col-md-4 on-off">
                                                    <div class="switch">
                                                        <input id="cmn-toggle-6" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                        <label for="cmn-toggle-6"></label>
                                                    </div>  <span>Open in New Tab</span>                                                  
                                                </div>
                                            </div>-->
                                        <ul class="on-off pull-right link_options" style="display:none">
                                            <li>
                                                <div class="switch">
                                                    <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                    <label for="cmn-toggle-4"></label>
                                                </div> <span>Display Link</span>
                                            </li>
                                            <li>
                                                <div class="switch">
                                                    <input id="cmn-toggle-5" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                    <label for="cmn-toggle-5"></label>
                                                </div> <span>Display Preview</span>
                                            </li>
                                            <li>
                                                <div class="switch">
                                                    <input id="cmn-toggle-6" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                    <label for="cmn-toggle-6"></label>
                                                </div> <span>Open in New Tab</span>
                                            </li>
                                            <li><a href="#"><img id="url_reset_link" src="<?=Yii::$app->request->baseUrl?>/images/refresh.png" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <ul class="on-off pull-right file_options">
                                        <li>
                                            <div class="switch">
                                                <input id="cmn-toggle-7"  class="dispFileName cmn-toggle cmn-toggle-round" type="checkbox">
                                                <label for="cmn-toggle-7"></label>
                                            </div> <span>Display File Name</span>
                                        </li>
                                        <li>
                                            <div class="switch linkSwitch">
                                                <input id="cmn-toggle-8" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                <label for="cmn-toggle-8"></label>
                                            </div> <span>Open Link in New Tab</span>
                                        </li>
                                        <li><a href="#"><img id="reflink" src="<?=Yii::$app->request->baseUrl?>/images/refresh.png" alt=""></a></li>
                                    </ul>
                            </fieldset>
                            </form>
                            </fieldset>



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
                                        <li class="color" style="background:<?php echo $theme_properties['theme_color_1'] ?>" data-color="<?php echo $theme_properties['theme_color_1'] ?>" onclick="setBGColor(this);"></li>
                                        <li class="color" style="background:<?php echo $theme_properties['theme_color_2'] ?>" data-color="<?php echo $theme_properties['theme_color_2'] ?>" onclick="setBGColor(this);"></li>
										<li class="color" style="background:<?php echo $theme_properties['theme_color_3'] ?>" data-color="<?php echo $theme_properties['theme_color_3'] ?>" onclick="setBGColor(this);"></li>
										<li class="color" style="background:<?php echo $theme_properties['theme_color_4'] ?>" data-color="<?php echo $theme_properties['theme_color_4'] ?>" onclick="setBGColor(this);"></li>
										
										<li class="color" style="background:<?php echo $theme_properties['theme_color_5'] ?>" data-color="<?php echo $theme_properties['theme_color_5'] ?>" onclick="setBGColor(this);"></li>							
									</ul>
                                </div>

                            </fieldset>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="copyblock">..</div>
                        <div role="tabpanel" class="tab-pane" id="deleteblock">.</div>
                    </div>

                </div>

            </div>
        </div>
        <div class="bottom-card row">
            <div class="col-sm-8 col-md-8">
                <div class="col-sm-6 col-md-6">
                    <input type="text" name="qard_title" id="qard_title" class="form-control" placeholder="Qard Title">
                </div>
                <div class="col-sm-6 col-md-6">
                    <!--			<input type="text" name="tags" id="tags" class="form-control" placeholder="Qard Tags" data-role="tagsinput">-->

                    <select class="js-example-basic-multiple form-control" id="tags" name="tags" multiple="multiple">
			    <?php foreach($tags as $key=>$value){
				echo '<option value="'.$value->name.'">'.$value->name.'</option>';
			    }?>
			</select>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <ul class="help-list">
                    <li><a href=""><img src="<?=Yii::$app->request->baseUrl?>/images/help.png" alt=""></a></li>
                    <li><a href=""><img src="<?=Yii::$app->request->baseUrl?>/images/eye.png" alt=""></a></li>
                    <li><a href=""><img src="<?=Yii::$app->request->baseUrl?>/images/comment.png" alt=""></a></li>
                    <li><a href=""><img src="<?=Yii::$app->request->baseUrl?>/images/icon-paint.png" alt=""></a></li>
                    <li><button class="btn btn-sm btn-default" name="preview" id="qard_preview">Preview</button></li>
                    <li onclick="addSaveCard(event)"><button class="btn btn-sm btn-default" name="preview">Save</button></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- block_error popup -->

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
	/**
	  * Script re-written by Dency G B 
	 **/

	/**** Handle the main work space ******/

/* 	$(document).delegate("#working_div .current_blk", "hover", function(event) {	
	
	}); */
	$(document).delegate("#working_div .current_blk", "input blur keyup keydown resize DOMSubtreeModified", function(event) {		
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
			$(last).remove();

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
	/*
	 * Double click to edit the block again
	 */
	$(document).delegate('.add-block > div', "dblclick", function(event) {

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
					$(this).find(".bgoverlay-block").after('<div class="drag"><i class="fa fa-arrows"></i></div>');

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
						console.log(data);

					},
					error: function(data) {
						console.log(data);
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
	//		document.execCommand('styleWithCSS', false, true);
	$("#working_div .current_blk").focus();
	var html = getSelected();
	console.log(html);
	console.log(html.focusNode.textContent);
	html = html.focusNode.textContent;
//console.log(t.anchorNode.childNodes.data);
			//$("#working_div .current_blk").focusEnd();
			document.execCommand('styleWithCSS', false, true);
			document.execCommand('foreColor', false, $(inp).attr('data-color'));
			//var css = "color: "+$(inp).attr('data-color')+";";
			//var html = '<div style="'+css+'">'+html+'</div>';
			//replaceSelectionWithHtml(html);
			//document.execCommand('insertHTML', false, '<span style="'+css+'">'+document.getSelection()+'</span>');
		}
		//$('#text_color li').on('click', function(e) {
		//   
		//    var color=$(this).css("background-color"); // get id of clicked li
		//console.log(color);
		//    document.execCommand('foreColor', false, '#fff');$('.working_div').focus();return false;});
		/*
		 * to make text in indent
		 */
		$('#text_indent').click(function() {
			document.execCommand('indent', false, null);
			$('.working_div').children().focus();
			return false;
		});
		function getSelected() {
            if (window.getSelection) {
                return window.getSelection();
            }
            else if (document.getSelection) {
                return document.getSelection();
            }
            else {
                var selection = document.selection && document.selection.createRange();
                if (selection.text) {
                    return selection.text;
                }
                return false;
            }
            return false;
        };
		$.fn.focusEnd = function() {
			$(this).focus();
			var tmp = $('<span />').appendTo($(this)),
				node = tmp.get(0),
				range = null,
				sel = null;

			if (document.selection) {
				range = document.body.createTextRange();
				range.moveToElementText(node);
				range.select();
			} else if (window.getSelection) {
				range = document.createRange();
				range.selectNode(node);
				sel = window.getSelection();
				sel.removeAllRanges();
				sel.addRange(range);
			}
			tmp.remove();
			return this;
		}		
		function replaceSelectionWithHtml(html) {
			var range, html;
			if (window.getSelection && window.getSelection().getRangeAt) {
				range = window.getSelection().getRangeAt(0);
				range.deleteContents();
				var div = document.createElement("div");
				div.innerHTML = html;
				var frag = document.createDocumentFragment(), child;
				while ( (child = div.firstChild) ) {
					frag.appendChild(child);
				}
				range.insertNode(frag);
			} else if (document.selection && document.selection.createRange) {
				range = document.selection.createRange();
				range.pasteHTML(html);
			}
		}
		/********************/
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	/**** Link Block operations ******/
        $('input[id=link_url]').on('change', function() {

            callUrl(this);
        });
        $('body').on('change', $('input[name=url_title]', 'textarea[name=url_content]'), function() {
            showUrlPreview();
        });
        $(document).delegate('span.review-qard', 'dblclick', function() {
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
            $('#link_div').html(html);
            $('.link_options').show();
            $(".drop-file  , .file_options").hide();

        });
        $('#cmn-toggle-5').on('change', function() {
            console.log($(this).val());
        });
		/**** End of Link Block operations ******/
		

		
		/** Image block operations **/
		$('.dropzone').html5imageupload();
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
	function add_block(event){
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
            data.push({
                name: 'div_bgimage',
                value: div_bgimage
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

            var tags = [];
            $('#tags :selected').each(function(i, selected) {
                tags[i] = $(selected).text();
            });
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
			commanAjaxFun(data, 'add_block');
			//create another working block(div)
                                //$("#working_div").remove();
/* 			var nextBlockPriority = getNextBlockPriority();
			$("#working_div .parent_current_blk").unwrap();
			var new_div = '<div  id="working_div" class="working_div active"><div id="blk_' + getNextBlockId() + '" class="bgimg-block parent_current_blk"><div class="bgoverlay-block"><div class="text-block current_blk" data-height="1"  contenteditable="true" unselectable="off" data-block_priority="' + nextBlockPriority + '"></div></div></div></div>';
			$("#add-block .parent_current_blk:last").after(new_div); */
	}
	function addSaveCard() {
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
			data.push({
				name: 'div_bgimage',
				value: div_bgimage
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
			$(this).find(".current_blk").attr("data-block_priority", (index + 1));
			data.push({
				name: 'block_priority',
				value: index + 1
			});
			//check qard id is present to edit or add new qard
			var qard_id = $("#qard_id").val() || 0;
			data.push({
				name: 'qard_id',
				value: qard_id
			});
			// getting tags fot qard
			var tags = [];
			$('#tags :selected').each(function(i, selected) {
				tags[i] = $(selected).text();
			});
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

			$(this).addClass("delete_blk");

			//	    if(typeof $(this).find(".current_blk").html() == typeof undefined && typeof data.div_bgimage==typeof undefined && typeof data.thumb_values== typeof undefined){
			//		alert("please enter block or image to save");
			//		return false;
			//	    }
			//
			//	    console.log(data);
			//	    return false;

			commanAjaxFun(data, 'save_block');


		});
	}
	function getNextBlockId() {
		var blk_id = 0;
		$(".add-block div").each(function() {
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
		$(".add-block .parent_current_blk").each(function() {
			var attr = $(this).find(".current_blk").attr('data-block_priority');
			if (typeof attr !== typeof undefined) {

				if (blk_pri < parseInt(attr)) {
					blk_pri = parseInt(attr);
				}
			}
		});
		return ++blk_pri;
	}
	function commanAjaxFun(postData, callFrom) {

		//	console.log(postData);return false;
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
					}
					// if stored data contain image then true
					var img = '';
					if (data.link_image) {
						img = 'background-size:cover;background-image:url(<?=Yii::$app->request->baseUrl?>/uploads/block/' + data.link_image + ');';
					}
					//creating parent block or img-block
					var new_div = '<div id="' + data.blk_id + '" class="bgimg-block parent_current_blk" style="background-color:' + data.div_bgcolor + '; height:' + data.height + 'px;' + img + '">';
					//creating overlay-block or middel block
					new_div += '<div class="bgoverlay-block" style="background-color:' + data.div_overlaycolor + ';opacity:' + data.div_opacity + ';height:' + data.height + 'px;">';
					//creating main block or text block
					new_div += '<div data-height="' + (data.height / 37.5) + '" style="height:' + data.height + 'px;" data-block_id="' + data.block_id + '" data-theme_id="' + data.theme_id + '" data-block_priority="' + data.block_priority + '" class="text-block current_blk">' + data.text + '</div></div></div>';

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
							var new_div = '<div  id="working_div" class="working_div active"><div id="blk_' + getNextBlockId() + '" class="bgimg-block parent_current_blk"><div class="bgoverlay-block"><div class="text-block current_blk" data-height="1"  contenteditable="true" unselectable="off" data-block_priority="' + nextBlockPriority + '"></div></div></div></div>';
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
        function callUrl(urlField) {
            console.log($(urlField).val());
            var preview_url = $(urlField).val();
            var get_preview_url = "<?=Url::to(['qard/url-preview'], true);?>";
            $.ajax({
                url: get_preview_url,
                type: "GET",
                data: {
                    'url': preview_url
                },
                success: function(data) {
                    console.log(data);
                    if (data == 'PDF' || data == 'pdf') {
                        <!--ADDED BY DENCY -->
                        $(".file_options").show();
                        $(".link_options").hide();
                        <!------------------->
                        $("#drop-file").hide();
                        $("#drop-image").show();
                        // $(".fileName").val(response.code);
                        $(".fileSwitch").hide();
                        $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/pdf.png');
                    }
                    if (data == 'DOC' || data == 'DOCX') {
                        <!--ADDED BY DENCY -->
                        $(".file_options").show();
                        $(".link_options").hide();
                        <!------------------->
                        $("#drop-file").hide();
                        $("#drop-image").show();
                        // $(".fileName").val(response.code);
                        $(".fileSwitch").hide();
                        $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/doc.png');
                    }
                    //$('.working_div div').html(data);
                    else {
                        //hide file options
                        $("#drop-file  , .file_options").hide();
                        //show link options
                        $(".link_options").show();
                        $('#link_div').html(data);
                    }
                    //var title = $('input[name=url_title]').val();
                    //var link = '<h4 class="url-content"><a href="'+preview_url+'">'+title+'</a></h4>'
                    //$('.working_div div').html(link);
                    showUrlPreview();
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
                    '<span class="url-content"><h4>' + title + '</h4>' +
                    '<span class="url-text"><p>' + content + '</p>' +
                    '</span></span></span></span>';
            } else {
                var str = '<span class="review-qard" id="url_parent' + $("#working_div div").attr("id") + '"><span class="img-preview col-sm-3 col-md-3"><img src="' + image + '" alt=""></span>' +
                    '<span class="col-sm-9 col-md-9" id="title_desc_url' + $("#working_div div").attr("id") + '">' +
                    '<span class="url-content"><h4>' + title + '</h4>' +
                    '<span class="url-text"><p>' + content + '</p>' +
                    '</span></span></span></span>';
            }
            $("#working_div .current_blk").html(str);
			$("#working_div .current_blk")[0].css("height", 'auto');
			var scrollHeight = Math.ceil(parseInt($("#working_div .current_blk")[0].scrollHeight) / 37.5);
			setHeightBlock($("#working_div .current_blk"),scrollHeight);
        }
		
        $('#url_reset_link').on('click', function() {
            $('#link_div').empty();
            $(".drop-file , .drop-image , .file_options").show();
            $("input[id=link_url]").val('');
            $(".link_options").hide();
        });

        $('#qard_preview').on('click', function() {

        });
		/* end of link block functions */
		/** File upload functions **/
        //ADDED BY NANDHINI

           $(".dispFileName").on('click', function(e) {
           if($('.dispFileName').is(':checked')){
               var fileName = $(".fileName").val();   
               setLink($(this),fileName);
           }else{
               var fileName = $(".fileName").val();   
               setLink($(this),''); 
           }
        });

        function setLink(elem,fileName){     
               var click = 'showFiles("'+fileName+'")';
                if(fileName!=''){
                       var span = "Add Your Description Here!<br><span style='height: 24px;width: 25px;'>"+fileName+"<img onclick="+click+" src='<?= Yii::$app->request->baseUrl?>/images/docfile.png'/></span>";                                    }else{
                  var span = "<span>Add Your Description Here!<br><img onclick="+click+" style='height: 24px;width: 25px;' src='<?= Yii::$app->request->baseUrl?>/images/docfile.png'/></span>";    
              }               
                $("#working_div .current_blk").html(span);
	}
        $("#showFile").hide();
        $('.drop-file').on('click', function(e) {
            $('#qard-url-upload-click').trigger('click');

            return false;
            //  $('#qard-url-upload').click();             
        });     
        $('input[id=qard-url-upload-click]').change(function(e) {
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
                $.ajax({
                    url: "<?=Url::to(['qard/simple'], true)?>",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function(response) {
                        $("#dispIcon").show();
                        $(".drop-file").hide();
                        $(".drop-image").show();
                        $("#showFile").show();
                        $(".fileName").val(response.code);
                        $(".fileSwitch").hide();
                        setLink($(this),'');
                        // console.log(response);
                        //count++;
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

            // location.reload();
            // $(".drop-file").show();
            //   $(".drop-image").hide();
            //  $(".fileSwitch").show();   
            //         $(".fileSwitch").show();

            $("#dispIcon").hide();
            $(".drop-file , .drop-image , .file_options").show();
            $(".fileSwitch").show();
            $("input[id=link_url]").val('');
            $('input[id=qard-url-upload-click]').val('');
            $("#showFile").hide();
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
		
                
         function showFiles(fileName){
          alert(fileName)   ;
          
          
          }
                
                
                
                
	/***************************/
        </script>
        
    <script>
        'use strict';;
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
                    triggerFormSubmit = function() {
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
                        console.log("adv drop");
                        droppedFiles = e.dataTransfer.files; // the files that were dropped
                        showFiles(droppedFiles);


                        triggerFormSubmit();

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
                            console.log("insid");
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
                            }

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
    <script>
        'use strict';

        ;
        (function($, window, document, undefined) {
            // feature detection for drag&drop upload

            var isAdvancedUpload = function() {
                var div = document.createElement('div');
                return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
            }();


            // applying the effect for every form

            $('.box').each(function() {
                var $form = $(this),
                    $input = $form.find('input[type="file"]'),
                    $label = $form.find('label'),
                    $errorMsg = $form.find('.box__error span'),
                    $restart = $form.find('.box__restart'),
                    droppedFiles = false,
                    showFiles = function(files) {
                        //					$label.text( files.length > 1 ? ( $input.attr( 'data-multiple-caption' ) || '' ).replace( '{count}', files.length ) : files[ 0 ].name );
                    };

                // letting the server side to know we are going to make an Ajax request
                $form.append('<input type="hidden" name="ajax" value="1" />');

                // automatically submit the form on file select
                $input.on('change', function(e) {
                    showFiles(e.target.files);


                    $form.trigger('submit');


                });


                // drag&drop files if the feature is available
                if (isAdvancedUpload) {
                    $form
                        .addClass('has-advanced-upload') // letting the CSS part to know drag&drop is supported by the browser
                        .on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
                            // preventing the unwanted behaviours
                            e.preventDefault();
                            e.stopPropagation();

                        })
                        .on('dragover dragenter', function() //
                            {
                                $form.addClass('is-dragover');
                            })
                        .on('dragleave dragend drop', function() {
                            $form.removeClass('is-dragover');
                        })
                        .on('drop', function(e) {
                            droppedFiles = e.originalEvent.dataTransfer.files; // the files that were dropped

                            console.log(droppedFiles);
                            showFiles(droppedFiles);


                            $form.trigger('submit'); // automatically submit the form on file drop


                        });
                }


                // if the form was submitted

                $form.on('submit', function(e) {
                    // preventing the duplicate submissions if the current one is in progress
                    if ($form.hasClass('is-uploading')) return false;

                    $form.addClass('is-uploading').removeClass('is-error');

                    if (isAdvancedUpload) // ajax file upload for modern browsers
                    {
                        e.preventDefault();

                        // gathering the form data
                        var ajaxData = new FormData($form.get(0));

                        console.log(ajaxData);
                        if (droppedFiles) {
                            $.each(droppedFiles, function(i, file) {
                                ajaxData.append($input.attr('name'), file);
                            });
                        }

                        // ajax request
                        $.ajax({
                            url: $form.attr('action'),
                            type: $form.attr('method'),
                            data: ajaxData,
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            complete: function() {
                                $form.removeClass('is-uploading');
                            },
                            success: function(data) {
                                $form.addClass(data.success == true ? 'is-success' : 'is-error');
                                if (!data.success) $errorMsg.text(data.error);
                            },
                            error: function() {
                                //alert( 'Error. Please, contact the webmaster!' );
                            }
                        });
                    } else // fallback Ajax solution upload for older browsers
                    {
                        var iframeName = 'uploadiframe' + new Date().getTime(),
                            $iframe = $('<iframe name="' + iframeName + '" style="display: none;"></iframe>');

                        $('body').append($iframe);
                        $form.attr('target', iframeName);

                        $iframe.one('load', function() {
                            var data = $.parseJSON($iframe.contents().find('body').text());
                            $form.removeClass('is-uploading').addClass(data.success == true ? 'is-success' : 'is-error').removeAttr('target');
                            if (!data.success) $errorMsg.text(data.error);
                            $iframe.remove();
                        });
                    }
                });


                // restart the form if has a state of error/success

                $restart.on('click', function(e) {
                    e.preventDefault();
                    $form.removeClass('is-error is-success');
                    $input.trigger('click');
                });

                // Firefox focus bug fix for file input
                $input
                    .on('focus', function() {
                        $input.addClass('has-focus');
                    })
                    .on('blur', function() {
                        $input.removeClass('has-focus');
                    });
            });

        })(jQuery, window, document);
    </script>

    <script>
        'use strict';

        ;
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
                    triggerFormSubmit = function() {
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
                                ajaxData.append($('#qard-url-upload input').attr('name'), file);

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
                                    console.log(data);
                                    $("#dispIcon").show();
                                    $("#showFile").show();
                                    $(".drop-file").hide();
                                    $(".drop-image").show();
                                    $(".fileName").val(data.code);
                                    $(".fileSwitch").hide();
                                },
                                error: function() {
                                    alert("already");
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
                                url: "<?=Url::to(['qard/url'], true)?>",
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',
                                success: function(response) {
                                    alert("whic");
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
                            } else alert('Error. Please, contact the webmaster!');
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