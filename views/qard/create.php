<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Qard */
$this->title = 'Create Qard';
?>
<!-- requiered for tag -->
<style>
    .imgCenter {
       display: block;
       margin: 0 auto;
       height: 120px;
    }   
    
 </style>   
<link href="<?= Yii::$app->request->baseUrl?>/css/bootstrap-tagsinput.css" rel="stylesheet">
<script src="<?= Yii::$app->request->baseUrl?>/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/typeahead.js" type="text/javascript"></script>

<!-- requiered for fore color of text -->
<link href="<?= Yii::$app->request->baseUrl?>/css/bootstrap-colorpicker.min.css" rel="stylesheet">

<!--for image crop-->
<link href="<?= Yii::$app->request->baseUrl?>/css/html5imageupload.css" rel="stylesheet">
<link href="<?= Yii::$app->request->baseUrl?>/css/custom.css" rel="stylesheet">

<script src="<?= Yii::$app->request->baseUrl?>/js/bootstrap-colorpicker.js" type="text/javascript"></script>	

<!-- requiered for get selected fiels in text editing -->
<script src="<?= Yii::$app->request->baseUrl?>/js/jquery.selection.js" type="text/javascript"></script>

<!-- requiered for drop down of an image -->
<!--<script src="<?= Yii::$app->request->baseUrl?>/js/dropzone.js" type="text/javascript"></script>-->

<section class="create-card">
    <div class="row">
	
	<div class="col-sm-4 col-md-4">
	    <div id="add-block" class="qard-div add-block">
<!--		<div id="blk_2"class="bgimg-block parent_current_blk" style="background-color: yellowgreen">
		    <div class="bgoverlay-block">
			<div class="text-block current_blk" data-height="2" style="height:75px;"></div>                                    
		    </div>                                
		</div>-->
		
		<div  id="working_div" class="working_div block active"  >
                            <div id="blk_1" class="bgimg-block parent_current_blk">
                                <div class="bgoverlay-block">
                                    <div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off">
                                        
                                    </div>                                    
                                </div>                                
                            </div>
		</div>    
		<h4 class="add-another" onclick="add_block(event)">Add another block <span><img src="<?=Yii::$app->request->baseUrl?>/images/add.png" alt="add"></span></h4>
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
		<li role="presentation"><a href="#deleteblock" aria-controls="deleteblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/delete.png" alt=""></a></li>
	      </ul>

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
				<li id="text_bold"><a href="#" >B</a></li>
				<li id="text_italic"><a href="#"><i>I</a></i></li>
				<li id="text_underline" class="underline" tabindex="-1" title="CTRL+U" data-wysihtml5-command="underline" href="javascript:;" unselectable="on"><a href="#" >U</a></li>
			    </ul>
			</div>
			<div class="form-group col-sm-3 col-md-3">                                            
			    <ul class="align-elements">
				<li ><img src="<?=Yii::$app->request->baseUrl?>/images/icon-left.png" alt="">				<select id="text_align">
					    <option value="justifyLeft">left</option>
					    <option value="justifyRight">right</option>
					    <option value="justifyCenter">center</option>
					    <option  value="justifyFull">justify</option>
					</select></li>
				<li id="text_color"><a href="#"><img src="<?=Yii::$app->request->baseUrl?>/images/fonts.png" alt="" ></a></li>
				<li id="text_indent"><a href="#"><img src="<?=Yii::$app->request->baseUrl?>/images/leftalign.png" alt=""></a></li>
			    </ul>
			</div>                                                                               
			<div class="form-group col-sm-3 col-md-3">                                            
			    <select id="text_family">
				<option value="Inconsolata"> Inconsolata</option>
				<option value="monospace"> monospace</option>
			    </select>
			</div>
			<ul class="on-off pull-left">
			    <li>
				<div class="switch">
				    <input id="cmn-toggle-1" name="is_extra_text" class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-1" onclick="showtext()"></label>
				</div>  <span>Extra Text</span>                                          
			    </li>
			    <li>
				<div class="switch">
				    <input id="cmn-toggle-2" name="is_title" value="1"  class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-2"></label>
				</div>  <span>Make Qard Title</span>                                          
			    </li>                                              
			</ul>                                          
		    </fieldset>
		    <div id="descfield" class="working_div" style="display: none;">
			<div name="desc" id="extra_text" class="cur_blk " placeholder="Enter The Text" contenteditable="true" ></div>
		    </div>
		</div>
		
		<div role="tabpanel" class="tab-pane" id="imgblock">		    
		    <!--<form  class="dropzone" id="imageupload" enctype="multipart/form-data" >-->     
			  
		    <div class="drop-image">
			<form action="" id="image_upload"  method="post" enctype="multipart/form-data" >
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
			    <input type="text" id="overlay_color"  class="form-control" placeholder="Overlay Color (#fff)">
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
				</div>  <span>Display as Background Image</span>                                          
			    </li>                                      
			</ul>                                    
		</div>
      <div role="tabpanel" class="tab-pane" id="linkblock">
									
                                    <fieldset>
									<div id="link_div"></div>
                                        <div class="drop-file form-group">                                           
                                            <img src="<?=Yii::$app->request->baseUrl?>/images/browse.png" alt="">
                                            <h2 id="extErr">Only PDF,DOC,DOCX TYPES ARE ALLOWED</h2>                                         
                                            <h3>Drop files/click to Browse</h3></div>
                                        
                                            <div class="drop-image form-group" >                                           
<!--                                                <img id="docimg" src="<?=Yii::$app->request->baseUrl?>/images/doc.png" alt="">-->

                                                <img id="dispIcon" class="imgCenter">
                                                <input type="text" name="filename" class="form-control fileName" placeholder="File Name">
                                                <textarea name="desc" class="form-control" placeholder="Description"></textarea>
                                            </div>  
                                        <div class="fileSwitch">
                                             <input id="qard-url-upload" name="image" class="hidden" type="file">                                        
                                            <h3>or...</h3>
                                        <!--</div>-->
                                            <div class="form-group">                                            
                                                <input type="text" name="url" id="link_url" class="form-control pasteUrl" placeholder="Paste Url (Another qard deck,website,youtube video, images etc)">
                                                <p style="color: orange;">Link directly to another Qard or Deck by using its QardDech share URL</p>
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
												<li><a href="#"><img id="reflink" src="<?=Yii::$app->request->baseUrl?>/images/refresh.png" alt=""></a></li>
                                            </div>-->  
											<ul class="on-off pull-right link_options" style="display:none">
                                                <li>
                                                    <div class="switch">
                                                        <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                        <label for="cmn-toggle-4"></label>
                                                    </div>  <span>Display Link</span>                                                  
                                                </li>
                                                <li>
                                                    <div class="switch">
                                                        <input id="cmn-toggle-5" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                        <label for="cmn-toggle-5"></label>
                                                    </div>  <span>Display Preview</span>                                                  
                                                </li>
                                                <li>
                                                    <div class="switch">
                                                        <input id="cmn-toggle-6" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                        <label for="cmn-toggle-6"></label>
                                                    </div>  <span>Open in New Tab</span>                                                  
                                                </li>
												<li><a href="#"><img id="url_reset_link" src="<?=Yii::$app->request->baseUrl?>/images/refresh.png" alt=""></a></li>
                                            </ul>
                                        </div>
                                            <ul class="on-off pull-right file_options">
                                                 <li>
                                                  <div class="switch">
                                                      <input id="cmn-toggle-7" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                      <label for="cmn-toggle-7"></label>
                                                  </div>  <span>Display File Name</span>                                    
                                              </li>
                                              <li>
                                                  <div class="switch linkSwitch">
                                                      <input id="cmn-toggle-8" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                      <label for="cmn-toggle-8"></label>
                                                  </div>  <span>Open Link in New Tab</span>                                    
                                              </li>
                                              <li><a href="#"><img id="reflink" src="<?=Yii::$app->request->baseUrl?>/images/refresh.png" alt=""></a></li>                                            
                                          </ul>  
                                    </fieldset>
                                                                           

                                </div>
		<div role="tabpanel" class="tab-pane" id="paintblock">
		    <fieldset>
			<div class="form-group col-sm-6 col-md-6">
			    <h4>Block Size</h4>
			    <input type="text" name="blk_size" id="blk_size" pattern="^\d{2}$" class="form-control" placeholder="Number of block units(2)" maxlength="2" min="1" >
			</div>
			<div class="form-group col-sm-6 col-md-6">
			    <h4>Block Background Color</h4>
			    <input type="text" name="blk_color" id="bg_color" class="form-control" placeholder="Background color (#0000)">
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
			<input type="text" name="tags" id="tags" class="form-control" placeholder="Qard Tags" data-role="tagsinput">
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

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<script type="text/javascript">
function showtext() {
    //code
    var s = document.getElementById('descfield');
    if (s.style.display == "none") {
	//code
	s.style.display = "block";
    }else {
	s.style.display = "none";
    }
}

</script>        
<script src="<?= Yii::$app->request->baseUrl?>/js/html5imageupload.js" type="text/javascript"></script>
<script type="text/javascript">
	  
    $(function(){ 
	$("#extErr").hide();
	removeBr();
	// on click image tab should increase block height
	$(document).delegate("#cmn-toggle-3","click",function(){
	    if($(this).is(":checked")){
		if(parseInt($("#working_div .current_blk").attr("data-height"))<4){
		    $("#working_div div").each(function(){
			if(typeof $(this).attr("data-height") !== typeof undefined){
			    $(this).attr("data-height",4);
			}
			
			$(this).css("height",(4*37.5));
		    })
		}
	    }else{
		console.log('vijay');
		removeBr();
	    }
	});
	
	
	$(document).delegate("#reset_image","click",function(){$(".dropzone .btn-cancel").trigger("click");});
	
	
	
	
	//increase height of the div
	$(document).delegate("#working_div .current_blk","blur keydown keyup click",function(event){
	    
	    if(event.keyCode==8){
		
//		$(this).css("height","auto");
		console.log("scroll"+$(this).innerHeight());
		console.log($(this).html());
	    }
	    checkHeight(event);
//	    removeBr();
	});
	
	
	$(document).delegate('#canvas_thumb',"change",function(event){
	    alert("vliayt");
	});

	$(document).delegate('.add-block > div',"dblclick",function(event){
	    
	    if($(this).attr("id")!='working_div'){
		
		$('#working_div .current_blk').removeAttr("unselectable");
		$("#working_div .current_blk").removeAttr("contenteditable");
		$("#working_div .current_blk").removeClass("working_div");
		$("#working_div .parent_current_blk").unwrap();
		$(this).wrap('<div  id="working_div" class="working_div active"></div>');
		$(this).find(".current_blk").addClass("working_div");
		$(this).find(".current_blk").attr("unselectable",'off');
		$(this).find(".current_blk").attr("contenteditable",'true');
	    }
	});
	
	
	// for image or file drop
	$('.dropzone').html5imageupload();
	
	$('#for_image').html5imageupload({
	    
	// to delete image from database
	    onAfterCancel:function(){
		var block_id=$("#block_id").val()|| 16;
		$.ajax({url:"<?=Url::to(['block/delete-block'], true)?>",type:'post',data:{'block_id':block_id},function(data){console.log(data);}});
	    },
	    onSave:function(){
		console.log("vijaysharma");
	    }
	   
	});
	
	$('.color_picker').colorpicker();
	$("#link_color").colorpicker();
	$("#link_hcolor").colorpicker();
	$("#overlay_color").colorpicker();
	$("#bg_color").colorpicker();
	$('#cardtabs a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});
	
	
	
	// for image
	$(document).delegate("#image_opc","blur keydown keyup",function(){
	    var per=parseInt($(this).val() || 1)/100;
	    console.log("image opc"+per);
	    $("#working_div .bgimg-block").css('opacity',per);
	});

	$(document).delegate("#overlay_color","blur",function(){
	    var color=$(this).val();
	    console.log(color);
	    $("#working_div .bgoverlay-block").css('background-color',color);
	});

	$(document).delegate("#overlay_opc","blur keydown  keyup",function(){
	    var per=parseInt($(this).val())/100;
	    console.log("image opc"+per);
	    $("#working_div .bgoverlay-block").css('opacity',per);
	});

	$(document).delegate("#bg_color","blur",function(){
	    var color=$(this).val();
	    $("#working_div .bgimg-block").css('background-color',color);
	});


	//for block
	$(document).delegate("#blk_size","keyup keydown",function(){
	    var blk_size=parseInt($(this).val()) || 1;
	    size=blk_size*37.5;
	    console.log(size);
	    if(size<600){
		$("#working_div div").css("height",size);
		$("#working_div div").css("min-height",size);
		$("#working_div div").attr("data-height",blk_size);
	    }

	});
    });

    
    /*
     *  this to create tag on tags
     */
    var citynames = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: {
	url: "<?=Url::to(['tag/get-all-tags'],true)?>",
	filter: function(list) {
	  return $.map(list, function(cityname) {
	    return { name: cityname }; });
	}
      }
    });
    citynames.initialize();

    $('#tags').tagsinput({
      typeaheadjs: {
	name: 'citynames',
	displayKey: 'name',
	valueKey: 'name',
	source: citynames.ttAdapter()
      }
    });
    
    function getStyle(){
    
	var data=[];
	var image_opacity=$("#working_div img").css("opacity") || 1; 
	var div_opacity=$("#working_div div").css("opacity");
	var div_bgcolor=$("#working_div div").css("background-color");
	var height=parseInt($("#working_div div").attr("data-height"))*37.5;
	
	
	data.push({name: 'image_opacity', value: image_opacity});
	data.push({name: 'div_opacity', value: div_opacity});
	data.push({name: 'div_bgcolor', value: div_bgcolor});
	data.push({name: 'height', value: height});
    }
    
    
    
    function setHeightBlock(unit){
		var blk_size = unit;
		size=blk_size*37.5;
		console.log(size);
		if(size<600){
			$("#working_div").parent().css("height",size);
			$("#working_div div").css("min-height",size);
			$("#working_div div").attr("data-height",blk_size);
			
		}		
	}
    function imageonly(){
	var data=$("#image_upload").serializeArray();
	//$("#working_div").children().css('background-image','url(<?=Yii::$app->request->baseUrl."/uploads/block/vijay.JPG)"?>');
	
	$("#working_div").children().append('<img src="<?=Yii::$app->request->baseUrl.'/uploads/block/vijay.JPG'?>"></img>');
	
	return false;
	var block_id=$("#block_id").val() || 0;	
	data.push({name: 'block_id', value: block_id});
	
	var qard_id=$("#qard_id").val() || 0;
	data.push({name: 'qard_id', value: qard_id});
	
	var qard_title=$("#qard_title").val() || 0;
	data.push({name: 'qard_title', value: qard_title});
	
	var tags=$("#tags").val() || 0;
	data.push({name: 'tags', value: tags});
	
	var is_title=$("[name='is_title']:checked").val() || 0;
	data.push({name: 'is_title', value: is_title});
	
	if(!qard_title){
	    return false;
	}
	$.ajax({
	   url:"<?=Url::to(['block/upload'], true)?>",
	   type:"POST",
	   dataType: 'json',
	   data:data,
	   success:function(data){
	       console.log(data);
	       var image='<img src="<?=Yii::$app->request->baseUrl?>/uploads/block/'+data.response+'" alt="not found">';
	       //$("#working_div").html(image);
	       $("#working_div").css("background-image","url(<?=Yii::$app->request->baseUrl?>/uploads/block/"+data.response+")");
	   }

	});
    }
    
    /*
    * to find total height
     */
    function totalHeight(){
	var total_height=0;
	
	
	$(".qard-div div").each(function(){
	    
	    
	    var attr = $(this).attr('data-height');

	    // For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
	    if (typeof attr !== typeof undefined && attr !== false) {
	      // Element has this attribute
	      total_height +=parseInt($(this).attr("data-height"))*37.5;
	    }
	    
//	    if($(this)[0].hasAttribute("data-height")){ 
//		
//		total_height +=parseInt($(this).attr("data-height"))*37.5;
//	    }
	}); 
	    return total_height;
	}
    
    
    
    function removeBr(){
	
	if($("#working_div .current_blk").text()==""){
	    $("#working_div div").each(function(){if(typeof $(this).attr("data-height") !== typeof undefined){$(this).attr("data-height",1);}$(this).css("height",(1*37.5));});
	    
	}else{
	    $($("#working_div .current_blk").get().reverse()).each(function(index){
		console.log(index+"----"+(index)%2);
		if(($(this).is("br")) && (((index)%2)==0))
		{
		    if($(this).prev().is('br')){
			console.log("vijay");
    //		   $(this).prev().remove();
    //		   
    //		   $(this).remove();
		    }
		 }

	    });
	}
    }
    function checkHeight(e){
	var total_height=totalHeight();
	if(total_height>(600-37.5)){
	    $(".add-block .add-another").hide();
	}
	
	var offsetHeight=parseInt($("#working_div .current_blk")[0].offsetHeight);
	var scrollHeight=parseInt($("#working_div .current_blk")[0].scrollHeight);
	maxHeight=Math.ceil((scrollHeight-offsetHeight)/37.5);
	height_number=parseInt($("#working_div .current_blk").attr("data-height"))+maxHeight;
	height=height_number*37.5;
	
	
//	console.log("offsetHeight"+offsetHeight+"scrollHeight=="+scrollHeight);
	
	if(total_height>=(600)){
//	    console.log("vijay");
	    if(scrollHeight > offsetHeight){
		if(e.keyCode!=8){
		$('#working_div .current_blk').html(function (_,txt) {
		    
			return txt.slice(0, -1);
		    });
		e.preventDefault();}
	    
	    }else{
		console.log("onlye enter");
		if(e.keyCode==1)
		    e.preventDefault();
	    }
	}
	
	
	if(scrollHeight > offsetHeight && total_height<=(600-37.5)){
	    
	    $("#working_div div").each(function(){if(typeof $(this).attr("data-height") !== typeof undefined){$(this).attr("data-height",height_number);}$(this).css("height",(height_number*37.5));});
//	    $("#working_div .parent_current_blk").css("height",height);
//	    $("#working_div .current_blk").css("height",height);
	    
//	    $("#working_div .current_blk").attr("data-height",height_number); 
	}else if(scrollHeight>offsetHeight){
	    if(e.keyCode!=8){
		$('#working_div .current_blk').html(function (_,txt) {
		    
			return txt.slice(0, -1);
		    });
		e.preventDefault();}
	    $(".add-block .add-another").hide();
	}else{
//	    console.log($("#working_div div").last().find('br'));
	}
    }
    
    function getBlockId(){var blk_id=0;$(".add-block div").each(function(){var attr = $(this).attr('id');if (typeof attr !== typeof undefined && attr !== false && attr.search("_")) {new_blk_id=attr.split('_');if(blk_id<parseInt(new_blk_id[1])){blk_id=parseInt(new_blk_id[1]);}}});return blk_id;}
    
    
    /*
    * add_block with all values
    */
    function add_block(event){
	// to check height
	checkHeight(event);
	
//	return false;
	
	//for image
	
	var data=$("#image_upload").serializeArray();
	
	var image_opacity=parseFloat($("#working_div .bgimg-block").css("opacity")) || 0; 
	data.push({name: 'image_opacity', value: image_opacity});
	
	var div_opacity=parseFloat($("#working_div .bgoverlay-block").css("opacity"));
	data.push({name: 'div_opacity', value: div_opacity});
	
	
	var div_bgcolor=$("#working_div .bgoverlay-block").css("background-color");
	data.push({name: 'div_bgcolor', value: div_bgcolor});
	
	var div_bgimage=$("#working_div .bgimg-block").css("background-image").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
	data.push({name: 'div_bgimage', value: div_bgimage});
	
	
	var height=parseInt($("#working_div .current_blk").attr("data-height"))*37.5;
	data.push({name: 'height', value: height});
	
	var text=$("#working_div .current_blk").html() || 0; 
	data.push({name: 'text', value: text});
	
	var extra_text=$("#extra_text").html() || 0;
	data.push({name: 'extra_text', value: extra_text});
	
	var block_id=$("#working_div .current_blk").attr("data-block_id") || 0;
	data.push({name: 'block_id', value: block_id});
	
	var theme_id=$("#working_div .current_blk").attr("data-theme_id") || 0;
	data.push({name: 'theme_id', value: theme_id});
	
	var qard_id=$("#qard_id").val() || 0;
	data.push({name: 'qard_id', value: qard_id});
	
	var qard_title=$("#qard_title").val() || 0;
	data.push({name: 'qard_title', value: qard_title});
	
	var tags=$("#tags").val() || 0;
	data.push({name: 'tags', value: tags});
	
	var is_title=$("[name='is_title']:checked").val() || 0;
	data.push({name: 'is_title', value: is_title});
	
	var id=$("#working_div .parent_current_blk").attr("id");
	data.push({name: 'is_title', value: id});

////	console.log("df"+$("#working_div .current_blk").text());
//	if($("#working_div .current_blk").text().trim() == '' && typeof data.div_bgimage==typeof undefined && typeof data.thumb_values== typeof undefined){
//		    console.log("please enter block or image to save");
////		    return false;
//		}
//
////
//	console.log(data);
//	return false;

	$.ajax({
	   url:"<?=Url::to(['block/create'], true)?>",
	   type:"POST",
	   data:data,
	   dataType:"json",
	   success:function(data){
	       checkHeight();
		var qard='';
		var theme='';
		if(qard_id==0){
		    qard='<input id="qard_id" type="hidden" value="'+data.qard_id+'">';
		}
		var img='';
		if(data.link_image){
		    img='background-size:cover;background-image:url(<?=Yii::$app->request->baseUrl?>/uploads/block/'+data.link_image+');';
		}
//		if(!theme_id){
//		    theme='<input type="hidden" id="theme_id" value="'+data.theme_id+'">';
//		}
		var block=$("#working_div .parent_current_blk").attr("id");
		block_id=getBlockId();
		
		var style='style="height:'+height+'px;"';
		
		var content=data.text;
		
		
		var new_div='<div id="'+block+'" class="bgimg-block parent_current_blk" style="height:'+height+'px !important;'+img+'">';
		    new_div+='<div class="bgoverlay-block" style="background-color:'+div_bgcolor+';opacity:'+div_opacity+';">';
		    new_div+='<div data-height="'+(height/37.5)+'" '+style+' data-block_id="'+data.block_id+'" data-block_id="'+data.block_id+'" data-theme_id="'+data.theme_id+'" class="text-block current_blk">'+content+'</div></div></div>';
		
		
		$("#working_div").before(qard+theme+new_div);
		var new_div='<div id="blk_'+(parseInt(++block_id))+'" class="bgimg-block parent_current_blk"><div class="bgoverlay-block"><div class="text-block current_blk" data-height="1"  contenteditable="true" unselectable="off"></div></div></div>';
		
		//document.execCommand("enableObjectResizing", false, "false");
		checkBlock=false;
		
		
		if(block_id){
	    
		    $("#add-block .parent_current_blk").each(function(){
			if(typeof $(this).find(".current_blk").attr("data-block_id") == typeof undefined && block!=$(this).attr("id"))
			{
			    $("#working_div").remove();
			    $(this).wrap('<div  id="working_div" class="working_div active"></div>');
			    $(this).find(".current_blk").addClass("working_div");
			    $(this).find(".current_blk").attr("unselectable",'off');
			    $(this).find(".current_blk").attr("contenteditable",'true');
			    checkBlock=true;
			    return false;

			}
		    });

		}
		
		
		$("#add-block div").each(function(){
		    if( $(this).attr('id')=="working_div" && $(this).html()==""){
		    $("#working_div").remove();}
		});
		if(checkBlock==false){
		    $("#working_div").html(new_div);
		    console.log("vijay new block");
		}else{
		    console.log("old block");
		}
		
//		$("#working_div").append($(".add-block :last_child"));
		$(".dropzone .btn-del").trigger("click");
//		console.log(data);
	   },
	    error:function(data){
		console.log(data);
		alert("error");
	    }
	});
    }
    
    $("#cur_block div").on("click",function(){
    
    
    
    
    
    
    
    
    
    
	
    });
    
//    //height overflow
//    $("#working_div div").on("blur keydown",function(){
//	
//	if($(this).scrollHeight>600){
//	   $("#Block_error").modal('show');
//	   $("#disp_error").text('can not write on card user extra text to continue!...');
//	   showtext();
//	}else if($(this).height()>$('#cur_block').height()){
//	    var height=parseInt($("#cur_block").height())+37.5;
//	    $("#cur_block").css('height',height);
//	}
//    });
    
    function addSaveCard(){
	
	var data=$("#image_upload").serializeArray();
	var qard_title=$("#qard_title").val() || 0;
	data.push({name: 'qard_title', value: qard_title});

	
	if(qard_title==''){
	    alert("please enter qard title");
	    return false;
	    
	}
	
	
	
	$("#add-block .parent_current_blk").each(function(){
	   
	   
	       
		var image_opacity=parseFloat($(this).css("opacity") || 0); 
		data.push({name: 'image_opacity', value: image_opacity});

		var div_opacity=parseFloat($(this).find(".bgoverlay-block").css("opacity") || 0);
		data.push({name: 'div_opacity', value: div_opacity});


		var div_bgcolor=$(this).find(".bgoverlay-block").css("background-color");
		data.push({name: 'div_bgcolor', value: div_bgcolor});
		
		var div_bgimage=$(this).css("background-image");
		if(typeof div_bgimage  == 'undefined' ){
		var div_bgimage=$(this).css("background-image").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
		}
		data.push({name: 'div_bgimage', value: div_bgimage});


		var height=parseInt($(this).find(".current_blk").attr('data-height'))*37.5;
		
		 console.log($(this).find(".current_blk").attr('data-height'));
		data.push({name: 'height', value: height});

		var text=$(this).find(".current_blk").html() || 0; 
		data.push({name: 'text', value: text});

		var extra_text=$("#extra_text").html() || 0;
		data.push({name: 'extra_text', value: extra_text});

		var block_id=$(this).find(".current_blk").attr("data-block_id") || 0;
		data.push({name: 'block_id', value: block_id});
	
		var theme_id=$(this).find(".current_blk").attr("data-theme_id") || 0;
		data.push({name: 'theme_id', value: theme_id});


		var qard_id=$("#qard_id").val() || 0;
		data.push({name: 'qard_id', value: qard_id});

		var tags=$("#tags").val() || 0;
		data.push({name: 'tags', value: tags});
		
		var is_title=$("[name='is_title']:checked").val() || 0;
		data.push({name: 'is_title', value: is_title});
//		
//		if(typeof $(this).find(".current_blk").html() == typeof undefined && typeof data.div_bgimage==typeof undefined && typeof data.thumb_values== typeof undefined){
//		    alert("please enter block or image to save");
//		    return false;
//		}
//		
//		console.log(data);
//		return false;
		
		$.ajax({
			url:"<?=Url::to(['block/create'], true)?>",
			type:"POST",
			data:data,
			dataType:"json",
			success:function(data){
			    checkHeight();
			     var qard='';
			     var theme='';
			     if(qard_id==0){
				 qard='<input id="qard_id" type="hidden" value="'+data.qard_id+'">';
			     }
			     var img='';
			     if(data.link_image){
				 img='background-size:cover;background-image:url(<?=Yii::$app->request->baseUrl?>/uploads/block/'+data.link_image+');';
			     }
	     //		if(!theme_id){
	     //		    theme='<input type="hidden" id="theme_id" value="'+data.theme_id+'">';
	     //		}
			     var block=$("#working_div .parent_current_blk").attr("id");
			     block_id=getBlockId();

			     var style='style="height:'+height+'px;"';

			     var content=$("#working_div .current_blk").html();


			     var new_div='<div id="'+block+'" class="bgimg-block parent_current_blk" style="height:'+height+'px !important;'+img+'">';
				 new_div+='<div class="bgoverlay-block" style="background-color:'+div_bgcolor+';opacity:'+div_opacity+';">';
				 new_div+='<div data-height="'+(height/37.5)+'" '+style+' data-block_id="'+data.block_id+'" data-block_id="'+data.block_id+'" data-theme_id="'+data.theme_id+'" class="text-block current_blk">'+content+'</div></div></div>';

			     
			     $("#working_div").before(qard+theme+new_div);
			     var new_div='<div  id="working_div" class="working_div active"><div id="blk_'+(parseInt(++block_id))+'" class="bgimg-block parent_current_blk"><div class="bgoverlay-block"><div class="text-block current_blk" data-height="1"  contenteditable="true" unselectable="off"></div></div></div></div>';
			     $("#working_div div").remove();
			     
			     

//			     console.log(data);
			},
			 error:function(data){
			     console.log(data);
			     alert("error");
			 }
		     });
		 
		
		
	   
	   
	});
	
	
    }
    
    
    
    
    
    
    
    
    
    
	//ADDED BY DENCY
	$('input[id=link_url]').on('change',function(){
		callUrl(this);
	});
 	$('body').on('change', $('input[name=url_title]','textarea[name=url_content]'),function(){
		showUrlPreview();
	}); 
 	$(document).delegate('span.review-qard', 'dblclick',function(){
	//	e.preventDefault();
		console.log('Double clicked');
		$('.nav-tabs a[href="#linkblock"]').tab('show');
		//$('#linkblock').tab('show')
		//fill the area with this content
		var title = $(this).find( 'span.url-content >h4' ).html();
		var content = $(this).find( 'span.url-text >p' ).html();
		var image = $(this).find( 'span.img-preview' ).html();
		console.log(title);
		if(typeof image == 'undefined'){
			var html = "<div id='review-qard-id' class='review-qard row'>"
				+"<div class='col-sm-12 col-md-12' id='title_desc_url'><div class='url-content'><h4><input name='url_title' type='text' class='form-control' value='"+title+"'></h4>"
				+"<div class='url-text'><p><textarea name='url_content' class='form-control'>"+content+"</textarea></p>"
				+"</div></div></div></div>";			
		}
		else{
			var html = "<div id='review-qard-id' class='review-qard row'><div class='img-preview col-sm-3 col-md-3'>"+image+"<button id='url_img_remove' onclick='changePic(this)' class='btn btn-default btn-remove'>Remove</button></div>"
				+"<div class='col-sm-9 col-md-9' id='title_desc_url'><div class='url-content'><h4><input name='url_title' type='text' class='form-control' value='"+title+"'></h4>"
				+"<div class='url-text'><p><textarea name='url_content' class='form-control'>"+content+"</textarea></p>"
				+"</div></div></div></div>";			
			
		}
		$('#link_div').empty();
		$('#link_div').html(html);	
		$('.link_options').show();
		$(".drop-file , .drop-image , .file_options").hide();
		
	}); 
	$('#cmn-toggle-5').on('change',function(){
		console.log($(this).val());
	});
	function callUrl(urlField){
		console.log($(urlField).val());
		var preview_url = $(urlField).val();
		var get_preview_url = "<?=Url::to(['qard/url-preview'], true);?>";
		$.ajax({
			url : get_preview_url,
			type : "GET",
			data : {'url': preview_url},
			success : function(data){
				console.log(data);
                                if(data=='PDF' || data=='pdf'){
									<!--ADDED BY DENCY -->
									$(".file_options").show();
									$(".link_options").hide();
									<!------------------->
                                       $(".drop-file").hide();
                                       $(".drop-image").show();
                                      // $(".fileName").val(response.code);
                                       $(".fileSwitch").hide();                
                                       $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/pdf.png');                
                                }
                                if(data=='DOC'||data=='DOCX'){
									<!--ADDED BY DENCY -->
									$(".file_options").show();
									$(".link_options").hide();
									<!------------------->
                                       $(".drop-file").hide();
                                       $(".drop-image").show();
                                      // $(".fileName").val(response.code);
                                       $(".fileSwitch").hide();                
                                       $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/doc.png');                
                                }
				//$('.working_div div').html(data);
								else
								{
									//hide file options
									$(".drop-file , .drop-image , .file_options").hide();
									//show link options
									$(".link_options").show();
									$('#link_div').html(data);
								}
				//var title = $('input[name=url_title]').val();
				//var link = '<h4 class="url-content"><a href="'+preview_url+'">'+title+'</a></h4>'
				//$('.working_div div').html(link);
				showUrlPreview();
				checkHeight();
			}
		});		
	}
	function changePic(v){
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
	function showUrlPreview(){
		var title = $('input[name=url_title]').val();
		var content = $('textarea[name=url_content]').val();
		var image = $('#review-qard-id .img-preview > img').attr('src');
		if(typeof title == 'undefined')
			return false;
		//console.log(title);
		if(typeof image == 'undefined'){
			var str = '<span class="url-qard-block" id="url_parent'+$("#working_div div").attr("id")+'">'+
			'<span class="col-sm-12 col-md-12" id="title_desc_url'+$("#working_div div").attr("id")+'">'+
			'<span class="url-content"><h4>'+title+'</h4>'
			+'<span class="url-text"><p>'+content+'</p>'
			+
			'</span></span></span></span>';			
		}
		else
		{
		var str = '<span class="review-qard" id="url_parent'+$("#working_div div").attr("id")+'"><span class="img-preview col-sm-3 col-md-3"><img src="'+image+'" alt=""></span>'+
		'<span class="col-sm-9 col-md-9" id="title_desc_url'+$("#working_div div").attr("id")+'">'+
		'<span class="url-content"><h4>'+title+'</h4>'
		+'<span class="url-text"><p>'+content+'</p>'
		+
		'</span></span></span></span>';			
		}

		//setInterval(function(){ checkHeight(); }, 1000);
		//setiInterval(function(){checkHeight();},1000);
		//setHeightBlock(5);
	//	$("#working_div div").html(str);
		$("#working_div .current_blk").html(str);
		checkHeight();
		//$('#link_div').hide();
		
	}

	$('#url_reset_link').on('click',function(){
		$('#link_div').empty();
		$(".drop-file , .drop-image , .file_options").show();
		$("input[id=link_url]").val('');
		$(".link_options").hide();
	});
	$('#qard_preview').on('click',function(){
		var dataUrl = renderer.domElement.toDataURL("image/png");
		console.log(dataUrl);
		html2canvas([document.getElementById('add-block')], {
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
        ////////////////////////////////////
        
        //ADDED BY NANDHINI
        $('.drop-file').on('click', function(e) {
          $('#qard-url-upload').trigger('click');
          return false;
        //  $('#qard-url-upload').click();             
        });    
        
           $('input[id=qard-url-upload]').change(function(e){
           // $('#profile-image-upload').click();
               var file_data = $('#qard-url-upload').prop('files')[0];   
               var form_data = new FormData();                  
               form_data.append('file', file_data);
               var myfile= $( this ).val();
               var ext = myfile.split('.').pop();
                    if(ext=="pdf" || ext=="docx" || ext=="doc"){
                        $("#extErr").hide();
                        if(ext=="pdf"){
                            $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/pdf.png');                
                        }
                        if(ext=="docx" || ext=="doc"){
                            $('#dispIcon').attr('src', '<?= Yii::$app->request->baseUrl?>/images/doc.png');
             
                        }
                           $.ajax({
                                  url: "<?=Url::to(['qard/url'], true)?>",
                                  cache: false,
                                  contentType: false,
                                  processData: false,
                                  data: form_data,                        
                                  type: 'post',
                                  success: function(response){
                                       $(".drop-file").hide();
                                       $(".drop-image").show();
                                       $(".fileName").val(response.code);
                                       $(".fileSwitch").hide();                                
                                     // console.log(response);
                                      //count++;
                                  }
                           });
                     }else{
                       $(".drop-file").show();
                       $("#extErr").show();
                       $(".fileName").val('');
                       $(".fileSwitch").show();   
                     }
             }); 
       $('#reflink').click(function(e) { 
         location.reload();
          // $(".drop-file").show();
        //   $(".drop-image").hide();
         //  $(".fileSwitch").show();   
//         $(".fileSwitch").show();
        }); 

</script>



<!--dont touch-->



<script type="text/javascript">
$(function(){
 $('.working_div').children('div').focus();
 
 /*
  * to make text as bold
  */
 $('#text_bold').click(function(){document.execCommand('bold', false, null);$('.working_div').focus();return false;});
 
 /*
  * to make text as italic
  */
 $('#text_italic').click(function(){document.execCommand('italic', false, null);$('.working_div').focus();return false;});
 
 /*
  * to make undeline on text
  */
$('#text_underline').click(function(){document.execCommand('underline', false, null);$('.working_div').focus();return false;});

/*
 * to justify text
 */

$('#text_align').change(function(){
    document.execCommand($(this).val(), false, null);$('.working_div').focus();return false;});
/*
 * to change the size of the text
 */
$('#text_size').change(function(){document.execCommand("fontSize", false, $(this).val());$('.working_div').focus();return false;});

/*
 * to change the font-family of text
 */
$('#text_family').change(function(){document.execCommand("fontName", false, $(this).val());$('.working_div').focus();return false;});

/*
 * to change to fore color of the text
 */
$('#text_color').colorpicker().on('changeColor', function(e) {document.execCommand("foreColor", false, e.color.toHex());$('.working_div').focus();return false;});

/*
 * to make text in indent
 */
$('#text_indent').click(function(){document.execCommand('indent', false, null);$('.working_div').children().focus();return false;});

});


//////////////////////////////////////////////////
// THE FOLLOWING CODE IS USED FOR RESIZE THE DIV//
//////////////////////////////////////////////////

(function($){
  
  // A collection of elements to which the resize event is bound.
  var elems = $([]),
  
    // An id with which the polling loop can be canceled.
    timeout_id;
  
  // Special event definition.
  $.event.special.resize = {
    setup: function() {
      var elem = $(this);
      
      // Add this element to the internal collection.
      elems = elems.add( elem );
      
      // Initialize default plugin data on this element.
      elem.data( 'resize', { w: elem.width(), h: elem.height() } );
      
      // If this is the first element to which the event has been bound,
      // start the polling loop.
      if ( elems.length === 1 ) {
        poll();
      }
    },
    teardown: function() {
      var elem = $(this);
      
      // Remove this element from the internal collection.
      elems = elems.not( elem );
      
      // Remove plugin data from this element.
      elem.removeData( 'resize' );
      
      // If this is the last element to which the event was bound, cancel
      // the polling loop.
      if ( !elems.length ) {
        clearTimeout( timeout_id );
      }
    }
  };
  
  // As long as a "resize" event is bound, this function will execute
  // repeatedly.
  function poll() {
    
    // Iterate over all elements in the internal collection.
    elems.each(function(){
      var elem = $(this),
        width = elem.width(),
        height = elem.height(),
        data = elem.data( 'resize' );
      
      // If element size has changed since the last time, update the element
      // data store and trigger the "resize" event.
      if ( width !== data.w || height !== data.h ) {
        data.w = width;
        data.h = height;
        elem.triggerHandler( 'resize' );
      }
    });
    
    // Poll, setting timeout_id so the polling loop can be canceled.
    timeout_id = setTimeout( poll, 250 );
  };
  
})(jQuery);

</script>
