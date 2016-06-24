<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
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

    <section class="create-card">
        <div id="wait" class="waiting_logo"><img src='<?=Yii::$app->request->baseUrl?>/img/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
		<button style="margin-left: 350px;" class="btn btn-default qard" data-toggle="modal" data-target="#myModaledit"><a href="<?=Url::to(['qard/edit','id'=>$model->qard_id], true)?>">Edit</a></button>
        <div class="row">

            <div class="col-sm-4 col-md-4">
                
                    <?php
		if(isset($model['qard_id'])){
		    echo '<input type="hidden" name="qard_id" value="'.$model['qard_id'].'">';
		}
		?>
        <input type="hidden" name="theme_id" value="<?=$theme['theme_id']?>">
		
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
		
		$str = '
				<div class="qard-content" id="qard'.$model->qard_id.'" >
				<div id="add-block'.$model->qard_id.'" class="add-block">';

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
						if($block->link_image != ''){
								
								$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
								$img_block_style .= 'background-size: cover;';
						}
						if($theme['div_bgcolor'] != '')
							$img_block_style .= 'background-color:'.$theme['div_bgcolor'].';';	
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
				$str .= '<div class="bgimg-block" style="'.$img_block_style.'" >
				<div class="bgoverlay-block" style="'.$overlay_block_style.'">
				<div class="text-block" style="'.$text_block_style.'">';
				$str .= $block->text;
				$str .= '</div></div></div>';

			}	}
		$str .= '		</div>
				</div>
			<div class="qard-bottom">
				<ul class="qard-tags">
					<li class="pull-left">#tag#tag#tag</li>
					<li class="pull-right">x days ago</li>
				</ul>
				<h4>Author Full name</h4>
				<ul class="social-list">
					<li><a act-id="'.$model->qard_id.'" act-type="like"><img src="'.\Yii::$app->homeUrl.'images/heart.png" alt=""><br />500</a></li>
					<li><a act-id="'.$model->qard_id.'" act-type="comment"><img src="'.\Yii::$app->homeUrl.'images/comment-dark.png" alt=""><br />500</a></li>
					<li><a act-id="'.$model->qard_id.'" act-type="bookmark"><img src="'.\Yii::$app->homeUrl.'images/certify.png" alt=""><br />500</a></li>
					<li><a act-id="'.$model->qard_id.'" act-type="share"><img src="'.\Yii::$app->homeUrl.'images/share.png" alt=""><br />500</a></li>
				</ul>
			</div>
			';	
			echo $str;
			?>
               
            </div>
		<div class="col-sm-8 col-md-8" id="preview" style="border: 1px solid #eaeaea;height:500px"> <iframe src="https://player.vimeo.com/video/171427463" width="870" height="700" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
        </div>
        <!--<div class="bottom-card row">
            <div class="col-sm-8 col-md-8">
                <div class="col-sm-6 col-md-6">
                    <input type="text" name="qard_title" id="qard_title" class="form-control" placeholder="Qard Title">
                </div>
                <div class="col-sm-6 col-md-6">
                    <!--			<input type="text" name="tags" id="tags" class="form-control" placeholder="Qard Tags" data-role="tagsinput">-->

                     <!--<select class="js-example-basic-multiple form-control" id="tags" name="tags" multiple="multiple">

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
        </div>-->
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
	
	/**
	 * Click on link icon to see the content
	**/
	function displayLink(identifier){
		var dataurl = $(identifier).data('url');
		var checkit = $(identifier).find('#hiddenUrl');
		var displayCheck = 1;
		callUrl(checkit,displayCheck);
		$('#preview').show();
		return false;
	}
		/*
		* Link block functions
		*/
        function callUrl(urlField,displayCheck) {
            console.log($(urlField).val());
			
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
                        $(".file_options").show();
                        $(".link_options").hide();
                        <!------------------->
                        $("#drop-file").hide();
                        $("#drop-image").show();
                        // $(".fileName").val(response.code);
                        $(".fileSwitch").hide();
                        $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/pdf.png');
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
                        $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/doc.png');
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
                        $('#preview').html(data.preview_html);
						
                    }
                    else {
                        //hide file options
                        $("#drop-file  , .file_options").hide();
                        //show link options
                        $(".link_options").show();
                        $('#preview').html(data);
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
         function showFilePrev(fileName){

            var ext = fileName.split('.').pop();
            if (ext == "pdf" ) {
				var object = "<span id='spanob'><object id='obj' data=\"../uploads/docs/"+fileName+"\" type=\"application/pdf\" width=\"100%\" height=\"700px\">";
				object += "</object>";       
				$("#preview").html(object);          
                }
            if (ext == "doc" || ext == 'docx') {
				var test = "<?= Yii::$app->request->baseUrl?>/uploads/docs/"+fileName;

				var object = '<iframe style="width:100%;height:700px;" class="doc" src="'+test+'" &embedded=true"></iframe>';  
					
				object += "</object>";       
				$("#preview").html(object); 
				console.log(object);
               }
         
          }  
		/** End of dragging function **/
		
	/***************************/
	</script>
