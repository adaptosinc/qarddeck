<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Qard */

$this->title = 'Create Qard';
?>
<link href="<?= Yii::$app->request->baseUrl?>/css/bootstrap-tagsinput.css" rel="stylesheet">
<script src="<?= Yii::$app->request->baseUrl?>/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/typeahead.js" type="text/javascript"></script>
<script src="<?= Yii::$app->request->baseUrl?>/js/dropzone.js" type="text/javascript"></script>

<section class="create-card">
    <div class="row">
	
	<div class="col-sm-4 col-md-4">
	    <div class="qard-div add-block">
		<div  id="cur_block" class="cur_block">
		    <p id="working_blk">
			
		    </p>
		</div>
		<h4 class="add-another" onclick="add_block()">Add another block <span><img src="<?= Yii::$app->request->baseUrl?>/images/add.png" alt="add"></span></h4>
	    </div>
	</div>
	<div class="col-sm-8 col-md-8">
	    <div id="cardtabs">

	      <!-- Nav tabs -->
	      <ul class="nav nav-tabs col-sm-2 col-md-2" role="tablist">
		<li role="presentation" class="active"><a href="#cardblock" aria-controls="cardblock" role="tab" data-toggle="tab"><img src="<?= Yii::$app->request->baseUrl?>/images/txt.png" alt=""></a></li>
		<li role="presentation"><a href="#fileblock" aria-controls="fileblock" role="tab" data-toggle="tab"><img src="<?= Yii::$app->request->baseUrl?>/images/file.png" alt=""></a></li>
		<li role="presentation"><a href="#imgblock" aria-controls="imgblock" role="tab" data-toggle="tab"><img src="<?= Yii::$app->request->baseUrl?>/images/img.png" alt=""></a></li>
		<li role="presentation"><a href="#linkblock" aria-controls="linkblock" role="tab" data-toggle="tab"><img src="<?= Yii::$app->request->baseUrl?>/images/link.png" alt=""></a></li>
		<li role="presentation"><a href="#paintblock" aria-controls="paintblock" role="tab" data-toggle="tab"><img src="<?= Yii::$app->request->baseUrl?>/images/paint.png" alt=""></a></li>
	      </ul>

	      <!-- Tab panes -->
	      
	      <div class="tab-content col-sm-10 col-md-10">
		<div role="tabpanel" class="tab-pane active" id="cardblock">
		    <form name="add_text" id="add_text">
		    <fieldset>
			<div class="form-group col-sm-6 col-md-6">
			    <h4>Block Size</h4>
			    <input type="text" name="blk-size" id="blk-size" pattern="^\d{2}$" class="form-control" placeholder="Number of block units(2)" maxlength="2" min="1" >
			</div>
			<div class="form-group col-sm-6 col-md-6">
			    <h4>Block Background Color</h4>
			    <input type="text" name="blk-color" id="blk-color" class="form-control" placeholder="Background color (#0000)">
			</div>
			<ul class="on-off pull-right">
			    <li>
				<div class="switch">
				    <input id="cmn-toggle-5" class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-5" onclick="showtext()"></label>
				</div>  <span>Extra Text</span>                                          
			    </li>
			    <li>
				<div class="switch">
				    <input id="cmn-toggle-6" class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-6"></label>
				</div>  <span>Make Qard Title</span>                                          
			    </li>                                              
			</ul>                                          
		    </fieldset>
		    <div id="descfield" style="//display: none;">
			<textarea name="desc" placeholder="Enter The Text" id="block-txt"></textarea>
		    </div>
		    </form>
		</div>
		<div role="tabpanel" class="tab-pane" id="fileblock">
		    <form action="<?=  Url::to(['block/create'],true)?>" name="file_upload" class="dropzone">
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
		</div>
		<div role="tabpanel" class="tab-pane" id="imgblock">
		    <form action="<?=  Url::to(['block/create'],true)?>" class="dropzone">
		      <div class="fallback">
			<input name="file" type="file" multiple />
		      </div>
		    </form>
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
		    <form name="add_link" id="add_link">
		    <fieldset>
			<div class="form-group">
			    <input type="text" name="link" id="link" class="form-control" placeholder="Paste Url (Another qard deck,website,youtube video, images etc)">
			    <p style="color: orange;">Link directly to another Qard or Deck by using its QardDech share URL</p>
			</div>
			<div class="form-group">
			    <img src="<?= Yii::$app->request->baseUrl?>/images/icon-left.png" alt="" class="col-sm-1 col-md-1" height="25px">
			    <div class="col-sm-5 col-md-5"><input type="text" name="link_color" id="link_color" class="form-control" placeholder="Link Color (#ffffff)"></div>
			    <div class="col-sm-5 col-md-5"><input type="text" name="link_hcolor" id="link_hcolor" class="form-control col-sm-5 col-md-5" placeholder="Link hover Color (#ffffff)"></div>
			</div>

			<ul class="on-off pull-right">
			    <li>
				<div class="switch">
				    <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-1"></label>
				</div>  <span>Display Link</span>                                          
			    </li>
			    <li>
				<div class="switch">
				    <input id="cmn-toggle-2" class="cmn-toggle cmn-toggle-round" type="checkbox">
				    <label for="cmn-toggle-2"></label>
				</div>  <span>Open Link in New Tab</span>                                    
			    </li>                                        
			</ul>                                        

		    </fieldset>
		    </form>
		</div>
		<div role="tabpanel" class="tab-pane" id="paintblock">...</div>
	      </div>

	    </div>

	</div>  
	
    </div>
	    <div class="bottom-card row">
		<div class="col-sm-8 col-md-8">
		    <div class="col-sm-6 col-md-6">
			<input type="text" name="title" class="form-control" placeholder="Qard Title">
		    </div>
		    <div class="col-sm-6 col-md-6">
			<input type="text" name="tags" id="tabletags" class="form-control" placeholder="Qard Tags" data-role="tagsinput">
		    </div>                                    
		</div>
		<div class="col-sm-4 col-md-4">
		    <ul class="help-list"> 
			<li><a href="javascript:void(0)"><img src="<?= Yii::$app->request->baseUrl?>/images/help.png" alt=""></a></li>
			<li><a href="javascript:void(0)"><img src="<?= Yii::$app->request->baseUrl?>/images/eye.png" alt=""></a></li>
			<li><a href="javascript:void(0)"><img src="<?= Yii::$app->request->baseUrl?>/images/comment.png" alt=""></a></li>
			<li><a href="javascript:void(0)"><img src="<?= Yii::$app->request->baseUrl?>/images/icon-paint.png" alt=""></a></li>
			<li><button class="btn btn-sm btn-default" name="preview">Preview</button></li>
			<li><button class="btn btn-sm btn-default" name="preview" type="submit">Save</button></li>
		    </ul>
		</div>
	    </div>   
    

</section> 


 <!-- signup popup -->

    <div class="modal fade" tabindex="-1" id="Block_error" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <h3>Almost There...</h3>	
	    <p id="disp_error"></p>
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
    if (document.getElementById('myId')) {
	    var myDropzone = new Dropzone("div#myId", { url: "/file/post"});
	    // other code here
	  }
    $(function(){
	
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

    $('#tabletags').tagsinput({
      typeaheadjs: {
	name: 'citynames',
	displayKey: 'name',
	valueKey: 'name',
	source: citynames.ttAdapter()
      }
    });


    /*
     * to display text on block
     */
    $("#block-txt").on('keyup change',function(){
	var block_size=parseInt($("#blk-size").val() || 1);
	$div_cur_size=block_size*38;
	var content=$(this).val();
	$("#working_blk").text(content);
	var text_height=$("#working_blk").height();
	if(text_height>(block_size*40)){
	    //$(this).val();
	    $("#Block_error").modal('show');
	    $('#disp_error').text("please inceare size of the block");
	    return false;
	   //event.preventDefault();
	}
    });
    
    
    /*
    * for link
     */
     $("#link").on("change keydown",function(event){
	var content=$("#working_blk_link").length;
	console.log(content);
	if(content)
	{
	    $("#working_blk_link").text($(this).val());
	}else{
	    $("#working_blk").append('<p ><a id="working_blk_link" href="javascript:void(0);"></a></p>');
	}
     });
    /*
    * chage link color
     */
     $("#link_color").on('change keyup',function(){
	$("#working_blk_link").css("color",$(this).val());
     });
     
     /*
    * chage link color
     */
     $("#link_Hcolor").on('change keyup',function(){
	$("#working_blk_link").css("color",$(this).val());
     });
    
    /*
    * Changing color of block 
     */
    $("#blk-color").on('keyup change',function(){
	//console.log();
	$("#cur_block").css('background-color',$(this).val());
    });
    /*
    * Changing size of block 
     */
    $("#blk-size").on('keyup change',function(){
	//console.log();
	var size=37.5*parseInt($(this).val() || 1);
	
	$("#cur_block").css('height',size);
    });
    
     
    /*
    * condition
     */
     function add_block(){
	 
	 console.log("sdfsd");
	 $("#add_text").submit();
	 $("#add_link").submit();
	 var another_p='<p>'+$("#cur_block").text()+'</p>';
	 var another_div='<div class="cur_block">'+another_p+'</div>';
	 $("#cur_block").clone().appendTo("#cur_block");
	
     }
     
     
     $("#add_text").submit(function(){
	 
	 var block_id=$("#block_id").val() || '0';
	 var data=$(this).serializeArray();
	 data.push({name:'block_id',value:block_id});
	 
	 $.ajax({
            type: 'post',
            url: "<?=Url::to(['block/create'],true)?>",
            data: data,
            success: function () {
              console.log('form add text was submitted');
            }
          });
	 
	 
	 return false;
    });
    
    $("#add_link").submit(function(){
    
	var block_id=$("#block_id").val() || '0';
	var data=$(this).serializeArray();
	data.push({name:'block_id',value:block_id});
	 
	 
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




