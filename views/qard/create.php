<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Qard */

$this->title = 'Create Qard';
?>
<!-- requiered for tag -->

<link href="<?= Yii::$app->request->baseUrl?>/css/bootstrap-tagsinput.css" rel="stylesheet">
<script src="<?= Yii::$app->request->baseUrl?>/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/typeahead.js" type="text/javascript"></script>

<!-- requiered for fore color of text -->
<link href="<?= Yii::$app->request->baseUrl?>/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="<?= Yii::$app->request->baseUrl?>/js/bootstrap-colorpicker.js" type="text/javascript"></script>

<!-- requiered for get selected fiels in text editing -->
<script src="<?= Yii::$app->request->baseUrl?>/js/jquery.selection.js" type="text/javascript"></script>

<!-- requiered for drop down of an image -->
<script src="<?= Yii::$app->request->baseUrl?>/js/dropzone.js" type="text/javascript"></script>

<section class="create-card">
    <div class="row">
	
	<div class="col-sm-4 col-md-4">
	    <div class="qard-div add-block">
	    <div  id="cur_block" class="cur_block">	
		<div  id="working_div" class="working_div cur_blk " contenteditable="true" unselectable="off" style="background-color:greenyellow">
			this
		    </div>
	    </div>
		<h4 class="add-another" onclick="add_block()">Add another block <span><img src="<?=Yii::$app->request->baseUrl?>/images/add.png" alt="add"></span></h4>
	    </div>
	</div>
	<div class="col-sm-8 col-md-8">
	    <div id="cardtabs">

	      <!-- Nav tabs -->
	      <ul class="nav nav-tabs col-sm-2 col-md-2" role="tablist">
		<li role="presentation" class="active"><a href="#cardblock" aria-controls="cardblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/txt.png" alt=""></a></li>
		<!--<li role="presentation"><a href="#fileblock" aria-controls="fileblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/file.png" alt=""></a></li>-->
		<li role="presentation"><a href="#linkblock" aria-controls="linkblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/link.png" alt=""></a></li>                                
		<li role="presentation"><a href="#imgblock" aria-controls="imgblock" role="tab" data-toggle="tab"><img src="<?=Yii::$app->request->baseUrl?>/images/img.png" alt=""></a></li>                                
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
				<li ><img src="<?=Yii::$app->request->baseUrl?>/images/icon-left.png" alt=""><select id="text_align">
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
				    <input id="cmn-toggle-5" name="is_extra_text" class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-5" onclick="showtext()"></label>
				</div>  <span>Extra Text</span>                                          
			    </li>
			    <li>
				<div class="switch">
				    <input id="cmn-toggle-6" name="is_title" value="1"  class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-6"></label>
				</div>  <span>Make Qard Title</span>                                          
			    </li>                                              
			</ul>                                          
		    </fieldset>
		    <div id="descfield" style="display: none;">
			<div name="desc" id="extra_text" class="cur_blk " placeholder="Enter The Text" contenteditable="true" >hel</div>
		    </div>
		</div>
		<!--<div role="tabpanel" class="tab-pane" id="fileblock">
		    <form action="/file-upload" class="dropzone">
		      <div class="fallback">
			<input name="file" type="file" multiple />
		      </div>
		    </form>
			<ul class="on-off pull-right">
			    <li>
				<div class="switch">
				    <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-4"></label>
				</div>  <span>Open file in new tab</span>                                          
			    </li>                                      
			</ul>                                     
		</div>-->
		<div role="tabpanel" class="tab-pane" id="imgblock">
		    <form  class="dropzone" id="imageupload" enctype="multipart/form-data" >
		      <div class="fallback">
			<input name="image" type="file" />
		      </div>
		    </form>
		    <div class="form-group image-elements">
			<div class="col-sm-3 col-md-3">
			    <input type="text" name="name" class="form-control" placeholder="Image Opacity (%)">
			</div>
			<div class="col-sm-3 col-md-3">
			    <input type="text" name="name" class="form-control" placeholder="Overlay Color (#fff)">
			</div>
			<div class="col-sm-3 col-md-3">
			    <input type="text" name="name" class="form-control" placeholder="Overlay Opacity (%)">
			</div>
			<div class="col-sm-3 col-md-3">
			    <ul>
				<li><a href="#"><img src="<?=Yii::$app->request->baseUrl?>/images/place.png" alt=""></a></li>
				<li><a href="#"><img src="<?=Yii::$app->request->baseUrl?>/images/refresh.png" alt=""></a></li>
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
			<form action="/file-upload" class="dropzone">
			  <div class="fallback">
			    <input name="file" type="file" multiple />
			  </div>
			</form>                                        
			<div class="form-group">
			    <input type="text" name="url" class="form-control" placeholder="Paste Url (Another qard deck,website,youtube video, images etc)">
			    <p style="color: orange;">Link directly to another Qard or Deck by using its QardDech share URL</p>
			</div>
			<div class="form-group">
			    <img src="<?=Yii::$app->request->baseUrl?>/images/icon-left.png" alt="" class="col-sm-1 col-md-1" height="25px">
			    <div class="col-sm-3 col-md-3"><input type="text" name="name" class="form-control" placeholder="Link Color (#ffffff)"></div>
			    <div class="col-sm-4 col-md-4"><input type="text" name="name" class="form-control col-sm-5 col-md-5" placeholder="Link hover Color (#ffffff)"></div>
			    <div class="col-sm-4 col-md-4 on-off">
				<div class="switch">
				    <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-1"></label>
				</div>  <span>Display Link</span>                                                  
			    </div>
			</div>                                                                                                                     
		    </fieldset>
			<ul class="on-off pull-right">
			    <li>
				<div class="switch">
				    <input id="cmn-toggle-2" class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-2"></label>
				</div>  <span>Open Link in New Tab</span>                                    
			    </li>
			    <li><a href="#"><img src="<?=Yii::$app->request->baseUrl?>/images/refresh.png" alt=""></a></li>                                            
			</ul>                                       

		</div>
		<div role="tabpanel" class="tab-pane" id="paintblock">
		    <fieldset>
			<div class="form-group col-sm-6 col-md-6">
			    <h4>Block Size</h4>
			    <input type="text" name="blk_size" id="blk-size" pattern="^\d{2}$" class="form-control" placeholder="Number of block units(2)" maxlength="2" min="1" >
			</div>
			<div class="form-group col-sm-6 col-md-6">
			    <h4>Block Background Color</h4>
			    <input type="text" name="blk_color" id="blk-color" class="form-control" placeholder="Background color (#0000)">
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
			<li><button class="btn btn-sm btn-default" name="preview">Preview</button></li>
			<li><button class="btn btn-sm btn-default" name="preview">Save</button></li>
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

<script type="text/javascript">
   	  
    $(function(){
	// var myDropzone = new Dropzone("#mydivimage", { url: "<?=  Url::to(['block/upload'],true)?>"});
	
	 
	Dropzone.autoDiscover = false;
$('#imageupload').dropzone ({
        url: "<?=  Url::to(['block/upload'],true)?>",
        init: function() {
            this.on("sending", function(file, xhr, formData){
		
		var qard_title=$("#qard_title").val() || 0;
		var tags=$("#tags").val() || 0;
	
                formData.append("tags", tags);
		formData.append("qard_title", qard_title);
		
            }),
            this.on("success", function(file, xhr){
                alert(file.xhr.response);
            })
        },
});
	
	
    
	$('#text_color').colorpicker();
	
    $('#cardtabs a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
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
    
     
    /*
    * condition
     */
     function add_block(){
	 
	 var text=$("#working_div").html() || 0;
	 
	 var extra_text=$("#extra_text").html() || 0;
	 var block_id=$("#block_id").val() || 0;
	 var qard_id=$("#qard_id").val() || 0;
	 var qard_title=$("#qard_title").val() || 0;
	 var tags=$("#tags").val() || 0;
	 var is_title=$("[name='is_title']:checked").val() || 0;
	 if(!qard_title){
	     return false;
	 }
	 
	 
	 $.ajax({
	    url:"<?=  Url::to(['block/create'], true)?>",
	    type:"POST",
	    data:{'text':text,'extra_text':extra_text,'block_id':block_id,'qard_id':qard_id,'qard_title':qard_title,'tags':tags,'is_title':is_title},
	    success:function(data){
		
		
		console.log(data);
	    }
	    
	 });
	 
	// $("#add_text").submit();
	// $("#add_link").submit();
//	 var another_p='<p>'+$("#cur_block").text()+'</p>';
//	 var another_div='<div class="cur_block">'+another_p+'</div>';
//	 $("#cur_block").clone().appendTo("#cur_block");
	
     }
     
    
    
     $("#working_div").on("change keydown",function(){
	if($(this).height()>600){
	   $("#Block_error").modal('show');
	   $("#disp_error").text('can not write on card user extra text to continue!...');
	   showtext();
	}else if($(this).height()>$('#cur_block').height()){
	    var height=parseInt($("#cur_block").height())+37.5;
	    $("#cur_block").css('height',height);
	}
     });
     
     $("#add_text").submit(function(){
	var data=$(this).serializeArray(); 
	// retriving block id
	var block_id=$("#block_id").val() || '0';
	data.push({name:'block_id',value:block_id});
	// font name
	var font=$("#working_blk").css('font-family');
	data.push({name:'font',value:font});
	// store font size
	var font_size=$("#working_blk").css('font-size');
	data.push({name:'font_size',value:font_size});
	// text color
	var text_color=$("#working_blk").css('color');
	data.push({name:'text_color',value:text_color});
	// text alignment
	var text_align=$("#working_blk").css('text-align');
	data.push({name:'text_align',value:text_align});
	//text decoration	
	var text_decoration=$("#working_blk").css('text-decoration');
	data.push({name:'text_decoration',value:text_decoration});
	//text background color
	var blockbg_colour=$("#working_blk").css('background-color');
	data.push({name:'blockbg_colour',value:blockbg_colour});
	//text overlay color
	var textbg_overlaycolour=$("#working_blk").css('background-color');
	data.push({name:'textbg_overlaycolour',value:textbg_overlaycolour});
	//text background color opacity
	var textbg_overlayopacity=$("#working_blk").css('opacity');	 
	data.push({name:'textbg_overlayopacity',value:textbg_overlayopacity});
	

	$.ajax({
	   type: 'post',
	   url: "<?=Url::to(['block/create'],true)?>",
	   data: data,
	   success: function (data) {
	     console.log('form add text was submitted');
	     
	   }
	 });
	 
	 
	return false;
    });
    
    $("#add_link").submit(function(){
    
    return false;
	var data=$(this).serializeArray();
	//retriving block id
	var block_id=$("#block_id").val() || '0';
	data.push({name:'block_id',value:block_id});
	// link color
	var url_colour=$("#working_blk_link").css('color');
	data.push({name:'url_colour',value:url_colour});
	// link hover color
	var url_hovercolour=$("#working_blk_link:hover").css('color'); 
	data.push({name:'url_hovercolour',value:url_hovercolour});
	 
	$.ajax({
	   type: 'post',
	   url: "<?=Url::to(['block/create'],true)?>",
	   data: data,
	   success: function () {
	     console.log('form add link was submitted');
	   }
	 });
	 return false;
	
    });

</script>

<script type="text/javascript">
$(function(){
 $('#working_div').focus();
 
 /*
  * to make text as bold
  */
 $('#text_bold').click(function(){document.execCommand('bold', false, null);$('#working_div').focus();return false;});
 
 /*
  * to make text as italic
  */
 $('#text_italic').click(function(){document.execCommand('italic', false, null);$('#working_div').focus();return false;});
 
 /*
  * to make undeline on text
  */
$('#text_underline').click(function(){document.execCommand('underline', false, null);$('#working_div').focus();return false;});

/*
 * to justify text
 */

$('#text_align').change(function(){
    document.execCommand($(this).val(), false, null);$('#working_div').focus();return false;});
/*
 * to change the size of the text
 */
$('#text_size').change(function(){document.execCommand("fontSize", false, $(this).val());$('#working_div').focus();return false;});

/*
 * to change the font-family of text
 */
$('#text_family').change(function(){document.execCommand("fontName", false, $(this).val());$('#working_div').focus();return false;});

/*
 * to change to fore color of the text
 */
$('#text_color').colorpicker().on('changeColor', function(e) {document.execCommand("foreColor", false, e.color.toHex());$('#working_div').focus();return false;});

/*
 * to make text in indent
 */
$('#text_indent').click(function(){document.execCommand('indent', false, null);$('#working_div').focus();return false;});

});
</script>





