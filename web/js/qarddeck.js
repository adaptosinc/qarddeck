// jQuery Plugin written For QardDeck
// An easy platform for sharing your content
// version 1.1, Aug 3rd, 2016
// by Dency G B

(function($) {

    // here we go!
    $.qardDeck = function(element, options) {

        // plugin's default options
        // this is private property and is  accessible only from inside the plugin
        var defaults = {
        }

        // to avoid confusions, use "plugin" to reference the current instance of the object
        var plugin = this;

        plugin.settings = {}

        var $element = $(element),  // reference to the jQuery version of DOM element the plugin is attached to
             element = element;        // reference to the actual DOM element

        // the "constructor" method that gets called when the object is created
        plugin.init = function() {
            plugin.settings = $.extend({}, defaults, options);
			workspace();
			$("#working_div .current_blk").focus();
			document.execCommand('styleWithCSS', false, true);
			document.execCommand('foreColor', false, plugin.settings.dark_text_color);
        }

		/* 	
		  MAIN FUNCTION
		 */
		var workspace = function(){
			$(document).delegate("#working_div .current_blk", "input blur keyup keydown resize paste", function(event) {		
				//select color and apply span
				if (event.type === "input") {
					//plugin.focusWorkspace();
				}
				if(event.type === "paste"){
					event.preventDefault();
					// get text representation of clipboard
					
					////console.log(event.originalEvent.clipboardData);
					if (event.clipboardData || event.originalEvent.clipboardData) {
						content = (event.originalEvent || event).clipboardData.getData('text/plain');

						document.execCommand('insertText', false, content);
					}
					else if (window.clipboardData) {
						content = window.clipboardData.getData('Text');

						document.selection.createRange().pasteHTML(content);
					}   

			
				}

				/*
				 * calculate the total height of the qard
				*/
				var qard_height= 0;
				$('.current_blk').each(function(i, obj) {
					var block_height = $(obj).attr('data-height');
					//console.log('block-height:'+block_height);
					qard_height =  parseInt(qard_height)+parseInt(block_height);
				})
				//console.log(qard_height);
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
					//console.log('stopped');
					var last = $(this).children(':last-child');
					var html = $(last).html();
					$('#extra_text').html(html);
					//pass this to extra text and remove from here
					$(last).remove();
					$('#extra_text').focus();
				}
				if ($(this).attr("data-resized")=='true') {
					var scrollHeight = Math.ceil(parseInt($(this)[0].scrollHeight-0.5) / 37.5);
					var setHeight =  $(this).attr("data-height");
					if(scrollHeight > setHeight ){
						$("#working_div .current_blk").attr('data-resized','false');	
						setHeightBlock(this,scrollHeight);
					}
					else{
						//console.log('resized'+scrollHeight);
						return;				
					}
				} 
				/*
				 * Or autoset the height of block
				 **/
				$(this).css("height", 'auto');
				var scrollHeight = Math.ceil(parseInt($(this)[0].scrollHeight-0.5)/ 37.5);
				//console.log("from main:"+$(this)[0].scrollHeight);
				setHeightBlock(this,scrollHeight);
			});		
		};
		plugin.saveDeck = function(deck){						 
			 var formData = new FormData($(deck)[0]);
				$.ajax( {
				  url: plugin.settings.createDeckUrl,
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
					$("input[id=deck-title]").val('');
					$("input[id=deck-bg_image]").val('');
					$(".deck-img-pre").removeAttr("style");
					//$(".grid").prepend(html);
					//$("#ajaxDeckPreview").html(''); // Clear the preview..	
					//$('form[name="ajaxDeck"]')[0].reset();	
 			  	  }				  
				}); 
				return true;				
		};	
		plugin.addToDeck = function(deck){
			var deck_id = $(deck).attr('id');
			var qard_id = $('#qard_id').val()||0; 
			$.ajax({
				url : plugin.settings.addToDeckUrl,
				type : 'POST',
				data : {'qard_id':qard_id,'deck_id':deck_id},
				success : function(response){
					//console.log(response);
					//load the a new create page with a deckid included request
					var red_url = plugin.settings.editQardUrl;
					red_url = red_url+"?id="+qard_id;
					//console.log(red_url);
					window.location.replace(red_url);
					
				}				
			});
			//console.log(deck_id);
		}	
		plugin.focusWorkspace = function(){
			$("#working_div .current_blk").focus();
			document.execCommand('styleWithCSS', false, true);
			document.execCommand('foreColor', false, plugin.settings.dark_text_color);				
		}	
		plugin.updateBlockPriority = function(postData){
			$.ajax({ 
				url: plugin.settings.updateBlockPriorityUrl,
				type: "POST",
				data: postData,
				dataType: "json",
				success: function(data) {
					plugin.focusWorkspace();				
				},
				error: function(data) {
					plugin.focusWorkspace();						
				}
			});
		}
		plugin.deleteBlock = function(block_id){
			$.ajax({
				url: plugin.settings.deleteBlockUrl,
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
		};
		
		plugin.addBlock = function(postData,callFrom,new_block){
			////console.log(postData);return;
			if (callFrom == "save_block") {
				$("#wait").show();
			}
			var div_opacity = plugin.settings.overlay_opacity/100;
			postData.push({
				name: 'div_opacity',
				value: div_opacity
			});
			//overlay color
			var div_overlaycolor = plugin.settings.overlay_color;
			if(typeof div_overlaycolor === 'undefined') {
				div_overlaycolor = 'transparent';
			}
			postData.push({
				name: 'div_overlaycolor',
				value: div_overlaycolor
			});	
			 
			$.ajax({
				//url: "<?=Url::to(['block/create'], true)?>",
				url: plugin.settings.blockCreateUrl,
				type: "POST",
				data: postData,
				dataType: "json",
				async: false,
				success: function(data) {
	
					if (callFrom === "add_block") {
						//$("#wait").hide();
						//var total_height = totalHeight();
						//	       checkHeight();
						var qard = '';
						var theme = '';
						
						//if qard is editing
						if (!$("#qard_id").attr("value")) {
						
							qard = '<input id="qard_id" type="hidden" value="' + data.qard_id + '">';
							$('#qardid-link').attr("href",plugin.settings.homeUrl+"/theme/select-theme/?q_id="+ data.qard_id +"");
						}
						// if stored data contain image then true
						var img = image_icon_span = '';
						var data_img_type = false;
						if (data.link_image) {
							/** Uncomment this for background image **/
							data_img_type = $('#working_div .current_blk').attr("data-img-type");
							if(data_img_type == "background" || data_img_type == "both")
								img = 'background-size:cover;background-image:url('+plugin.settings.homeUrl+'/uploads/block/' + data.link_image + ');';
							/** ----------------------------------- **/
							/** Make link icon **/
							if(data_img_type == "preview" || data_img_type == "both")
								var image_icon_span = '<span data-url = "'+plugin.settings.homeUrl+'/uploads/block/' + data.link_image + '" class="icon-mark pull-right image_icon_span" onclick="showImage(this);"><img src="'+plugin.settings.homeUrl+'images/image_icon.png" alt=""></span>';
							/** ----------------------------------- **/
	/* 						if(data.div_bgimage_position != "null")
								img = img+'background-position:'+data.div_bgimage_position+';' */
							
							
						}
						//creating parent block or img-block
						var new_div = '<div data-style-qard = "'+data.data_style_qard+'" id="' + data.blk_id + '" class="bgimg-block parent_current_blk '+data.data_style_qard+'" style="background-color:' + data.div_bgcolor + '; height:' + data.height + 'px;' + img + '">';
						//creating overlay-block or middel block
						//console.log(plugin.settings.overlay_color);
						if(data_img_type == "background")
							new_div += '<div class="bgoverlay-block" style="background-color:' + data.div_overlaycolor + ';opacity:' +  data.div_opacity + ';height:' + data.height + 'px;">';
						else
							new_div += '<div class="bgoverlay-block" style="height:' + data.height + 'px;">';
						
						//creating main block or text block
						new_div += '<div data-height="' + (data.height / 37.5) + '" style="height:' + data.height + 'px;" data-block_id="' + data.block_id + '" data-theme_id="' + data.theme_id + '" data-block_priority="' + data.block_priority + '" class="text-block current_blk" data-img-type="'+data_img_type+'">' + data.text + '</div></div></div>';
						
						/* Added by Dency */
						/* Image is added to the current block without adding a newblock */
						if(new_block == false){
							//alert("new_block:"+new_block);
							$("#working_div").before(qard);
							$("#working_div").html(theme + new_div);
							//save the image url,opacity and background color for future use
							$('#working_div .current_blk').attr("data-img-url",plugin.settings.homeUrl+'/uploads/block/' + data.link_image);
							if(data.text == ''){
								plugin.focusWorkspace();
								$("#working_div .current_blk").html("<span>Add your comments here</span>");
							}
							if($("#working_div .current_blk").find('.image_icon_span').length > 0)
									$("#working_div .current_blk").find('.image_icon_span').remove();
							$("#working_div .current_blk").append(image_icon_span);
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
									//console.log("wrap old block");
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
					//var url = '<?=Url::to(['qard/preview-qard'], true);?>';
					//window.location.replace(url+"?qard_id="+data.qard_id);
					$("#wait").hide();
					}
					plugin.focusWorkspace();
					//removing uneccessary created working block
					$("#add-block div").each(function() {
					if ($(this).attr('id') === "working_div" && $(this).html() === "") {
						$("#working_div").remove();
					}
					});
					//remove image after stored in db
					$(".dropzone .btn-del").trigger("click");                    
					$("#url_reset_link").trigger("click");
					$("#remove_extra_text").trigger("click"); 
					return true;
					},
					error: function(data) {
						$("#wait").hide();
						//console.log(data);
						return false;
					}
			});			
		};
		
		plugin.addExtraText = function(){
			$.ajax({
			//	url : "<?=Url::to(['block/add-text'], true)?>",
				url : plugin.settings.addExtraTextUrl,
				type: "POST",
				data: { 'extra_text':$("#extra_text").html(),
						'block_id':$("#working_div .current_blk").attr('data-block_id'),
						'title' : $("input[name=extra-text]").val(),
					  },
				success: function(data){  
					data = $.parseJSON(data);
					if(data.status == true){
						if(data.extra_text != ""){
							var html = $("#working_div .current_blk").html();
							if(html == ''){
								var new_html = (data.extra_text).substring(0,30)+"...";
								//console.log(data.link_data);
								$("#working_div .current_blk").html(new_html);
								//return;
							}						
							$("#working_div .current_blk").find(".icon-mark").remove();
							
							//see whether T icon is already there
							var icon = $("#working_div .current_blk").find(".icon-mark").length;
							if(icon == 0)
								$("#working_div .current_blk").append(data.link_data);
							$("#working_div .current_blk").attr("contenteditable","true");								
						}else{ 	
							$("#working_div .current_blk").find(".icon-mark").remove();
						}
					
					}
					else{
						alert("Error! Please try again later");
					}	

				}
			});			
		};
		
		plugin.getExtraText = function(elem){
			$.ajax({
				//url : "<?=Url::to(['block/get-text'], true)?>",
				url: plugin.settings.getExtraTextUrl,
				type: "GET",
				data: { 'block_id': $(elem).attr('block_id') },
				success: function(data){
					$('.nav-tabs a[href="#cardblock"]').tab('show');
					data = $.parseJSON(data);
					$("#extra_text").html(data.extra_text);
					$("input[name=extra-text]").val(data.title);
					$('#cmn-toggle-9').prop("checked",true);
				}
			});				
		};
		
		plugin.saveQard = function(stringified){
			$.ajax({
				url: plugin.settings.saveQardUrl,
				type: "POST",
				data: {data:stringified},
				async: false,
				success: function(response){
					
					$("#wait").hide();
					var qard_id = $("#qard_id").val() || 0;
					var url = plugin.settings.previewQardUrl;
					window.location.replace(url+"?qard_id="+qard_id);
				}
			});			
		}
		
		plugin.fetchUrl = function(urlField,displayCheck){
			var preview_url = $(urlField).val();
			var homeUrl = plugin.settings.homeUrl;
			$.ajax({
				url: plugin.settings.getUrlPreviewUrl,
				type: "GET",
				datatype : 'json',
				data: {
					'url': preview_url,
					'block_id':$("#working_div .current_blk").attr('data-block_id'),
				},
				success: function(data) {
					data = $.parseJSON(data);
					if (data.type == 'PDF' || data.type == 'pdf') {
						<!--ADDED BY DENCY -->
						$('#dispIcon').attr('src', homeUrl+'images/pdf.png');
					}
					if (data.type == 'DOC' || data.type == 'DOCX') {
						$('#dispIcon').attr('src', homeUrl+'images/doc.png');
					}
					if (data.type == 'web_page') {
						if(displayCheck==1){
							
						}else{
							//save for later use
							$("input[id=work_space_text]").val(data.work_space_text);
							$("input[id=work_space_link_only]").val(data.work_space_link_only);
						}
						$('#link_div').html(data.preview_html);
						//add here
						$("input[name=url-title]").val(data.url_title);
						$("input[name=url-desc]").val(data.url_description);
						$('#cmn-toggle-6').prop("checked",true).trigger("change");
					}
					else {
						
						$('#link_div').html(data);
					}
					if(displayCheck!=1){
						adjustHeight();
					}
				}
			});			
		};
		plugin.useUrl = function(){
			//save the title and description if set
			$.ajax({
			//	url : "<?=Url::to(['block/add-text'], true)?>",
				url : plugin.settings.addUrlDataUrl,
				type: "POST",
				data: { 'url_title':$("input[name=url-title]").val(),
						'block_id':$("#working_div .current_blk").attr('data-block_id'),
						'url_description' : $("input[name=url-desc]").val(),
					  },
				success: function(data){
					$("#working_div .current_blk").find('.icon-mark').remove();
					var work_space_text  = '<span style="color: '+plugin.settings.dark_text_color+';">'+$("input[id=work_space_text]").val()+'</span></br>';
					if($("#working_div .current_blk").html() != '')
						$("#working_div .current_blk").append($("input[id=work_space_link_only]").val());
					else
						$("#working_div .current_blk").html(work_space_text);
					adjustHeight();					
				}
			});				
			//if html is present in the working div, append after removing all other icons	
		};
		
		//////////////////////Arivazhagan ////////////////////////
		
		plugin.useFileText = function(){
		
			$.ajax({
		
				url : plugin.settings.addFileDataUrl,
				type: "POST",
				data: { 'file_title':$("input[name=filename]").val(),
						'block_id':$("#working_div .current_blk").attr('data-block_id'),
						'file_description' : $("input[name=filedesc]").val(),
					  },
				success: function(data){					
						adjustHeight();		
				}
			});				
			//if html is present in the working div, append after removing all other icons	
		};
		
		
		plugin.getExtrafile = function(block_id,fileName){
				
			$.ajax({			
				url: plugin.settings.getFileDataUrl,
				type: "GET",
				data: { 'block_id': block_id,},
				success: function(data){
				
					data1 = $.parseJSON(data);					
					$("input[name=filename]").val(data1.file_title);
					$("input[name=filedesc]").val(data1.file_description);
					$('#cmn-toggle-56').prop("checked",false);
					
					
$(".drop-file").hide();
$(".fileSwitch").hide();
$("#editcheck").hide();
$('.nav-tabs a[href="#fileblock"]').tab('show');
var ext = fileName.split('.').pop(); 
if(data1.file_title == "")
	filetitle = fileName;
else
	filetitle = data1.file_title;

if (ext == "pdf" ) {
	
		var object = "<div class='active-file-preview'> <h4><span id='file_title' >"+filetitle+"</span> <span  class='trash pull-right' ><span class ='removefile' style='cursor: pointer; cursor: hand;' ><i class='fa fa-trash'></i> &nbsp;Remove This File </span></span></h4>  <hr class='divider' > <div class='active-preview-content' style='display: block;'> <p id='file_desc'>"+data1.file_description+"</p> <div id='file_controls'> <div class='file-download'> <img alt='' src='/qarddeck/web/images/download_icon.png'> </div> <button class='bnt qard' id='file_image' file-name='"+fileName+"'>Change To New File</button> </div> <div id='pdf_area' style='display: none;'></div> </div> </div>";
			
		object += "</object>";  					
		$("#showFilePreview").html(object);
		$("#showFilePreview").show();  				
		$("#dispIcon").hide();
		$("#showFile").hide(); 		
	}	
	if (ext == "doc" || ext == 'docx') {
		 
		var object = "<div class='active-file-preview'>   <h4 id='file_title'>"+filetitle+"<span class ='removefile' style='cursor: pointer; cursor: hand;' ><i class='fa fa-trash'></i> &nbsp;Remove This File </span></span> </h4>  <hr class='divider'> <div class='active-preview-content' style='display: block;'> <p id='file_desc'>"+data1.file_description+"</p> <div id='file_controls'> <div class='file-download'> <img alt='' src='/qarddeck/web/images/download_icon.png'> </div> <button class='bnt qard' id='file_image' file-name='"+fileName+"'>Change To New File</button> </div> <div id='pdf_area' style='display: none;'></div> </div> </div>";
	
	
		object += "</object>";      
		$("#showFilePreview").html(object); 
		$("#showFilePreview").show();		
	} 
	
	
					
				}
			});				
		};
		
		
		///////////////////////////////////////////////////////
		plugin.uploadFile = function(ajaxData){
			$.ajax({
				url: plugin.settings.uploadFileUrl,
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
					plugin.setLink($(this),data.code,1);
					$(".fileName").val(data.code);
					$(".victim").html(''); //poor label
					$("#fileTitle").html(data.code); //for image area
				},
				error: function(data) {
					alert("Error! Please try again");
					// Log the error, show an alert, whatever works for you
				}
			});			
		};
		
		plugin.setLink =  function(elem,fileName,id){  
			
		$("#working_div").find(".icon-mark").remove();
		
            var click = "showFilePrev(this,'"+fileName+"')";
            if(id!=3 && id!=1){
					
					var spantext = $("#working_div").find("span").html();
					
					 if($.trim(spantext) == "")
						var spantext = 'Add Your Description Here!<br>';
				
				  var spanicon = '<span for="showFilePrev" class="icon-mark pull-right" onclick='+click+'>'+fileName+'<img src='+plugin.settings.homeUrl+'"images/file_icon.png" alt=""></span>';
				
              }else{
				  var spantext = $("#working_div").find("span").html();
				  
				  if($.trim(spantext) == "")
					var spantext = 'Add Your Description Here!<br>';
				  
				  var spanicon = '<span for="showFilePrev" class="icon-mark pull-right" onclick='+click+'><img src="'+plugin.settings.homeUrl+'images/file_icon.png" alt=""></span>';   
            }             
			$("#working_div .current_blk").focus();
			document.execCommand('foreColor', false, plugin.settings.dark_text_color);	

			spantextval = '<span style="color: '+plugin.settings.dark_text_color+';">'+spantext+'</span></br>';
			span = '<span style="color: '+plugin.settings.dark_text_color+';">'+spantext+spanicon+'</span></br>';
           
		   
		   
            $("#cmn-toggle-56").attr("data-url",span);
            $("#cmn-toggle-56").attr("data-link",spantextval);
			
			  if($('#cmn-toggle-56').prop('checked')){	

				var linespan =  $("#cmn-toggle-56").attr("data-url");
				$("#working_div .current_blk").html(linespan);
				adjustHeight();
			}
			else
			{	
				//var spantextval =  $("#cmn-toggle-56").attr("data-link");
				//$("#working_div .current_blk").html(spantextval); 
			} 
			

		};
		plugin.uploadFileSimple = function(elem){
			
			var file_data = $('#qard-url-upload-click').prop('files')[0];
			var form_data = new FormData();
			form_data.append('file', file_data);
			var myfile = elem.val();
			var ext = myfile.split('.').pop();
			if (ext == "pdf" || ext == "docx" || ext == "doc") {
				$("#extErr").hide();
				if (ext == "pdf") {
					$('#dispIcon').attr('src', plugin.settings.homeUrl+'/images/pdf.png');
				}
				if (ext == "docx" || ext == "doc") {
					$('#dispIcon').attr('src', plugin.settings.homeUrl+'/images/doc.png');
				}
				var csrfToken = $('meta[name="csrf-token"]').attr("content");
				$.ajax({
					url: plugin.settings.uploadSimpleFileUrl,
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function(response) {
						
						$(".fileName").val(response.code);
						$(".victim").html('');
						$("#fileTitle").html(response.code);
						plugin.setLink($(this),response.code,1);
					}
				});
			} else {
				$(".drop-file").show();
				$("#extErr").show();
				$("#showFile").hide();
				///$(".fileName").val('');
				$(".fileSwitch").show();
			};			
		};
		plugin.embedUrl = function(videoUrl){
            var embedd_preview_url = $(videoUrl).val();
            $.ajax({
                url: plugin.settings.embedCodeUrl,
                type: "POST",
				datatype : 'json',
                data: {
                    'embed_code': embedd_preview_url
                },
                success: function(data) {
					
					data = $.parseJSON(data);
					$("#drop-file  , .file_options").hide();
						
					/*added by dency */
					$("#working_div .current_blk").focus();
					document.execCommand('foreColor', false, plugin.settings.dark_text_color);	
					var video_img  = '<span style="color: '+plugin.settings.dark_text_color+';">'+data.video_img+'</span></br>';														
					/****************/
					$("#emcode_hid").val(video_img);
					$("#emcode_hidimg").val(data.video_link_only);
						
					
					$('#embed_div').html(data.iframelink);
					//$('#btnembed_code').hide();
					//$('#link-ecode').show();
					$('#rmembed_code').show();
					$("#cmn-toggle-57").prop("checked",false);	
                } ,
			error: function (data) {
					$('#embed_div').html("<div class='preview-image'></div>");
					//$('#btnembed_code').show();
					//$('#link-ecode').hide();
					$('#rmembed_code').hide();
					} 
            });			
		};
		
		plugin.changeQardStyle = function(elem){
			
			var theme_id = elem.attr('data-theme');
			var q_id = $('#qard_id').val();
			var block_style = elem.attr('data-pattern');
			if(block_style !='' || theme_id !=''){
				if(q_id){			
					$.ajax({
						url : plugin.settings.changeStyleUrl,
						data: {"qard_style":block_style,"qard_id":q_id},
						type: "GET",
						success: function(){
							if(theme_id !='')
								window.location = plugin.settings.homeUrl+'qard/edit?id='+q_id+'&theme_id='+theme_id;
							else
								window.location = plugin.settings.homeUrl+'qard/edit?id='+q_id;
								
						}
					});
				}		
				else
					window.location = plugin.settings.homeUrl+'qard/create?theme_id='+theme_id;	
			}
			return true;			
		};
		
		plugin.applyBGImage = function(){
			//console.log($("#working_div .current_blk").attr("data-img-url"));
			var url = "url('"+$("#working_div .current_blk").attr("data-img-url")+"')";
			$("#working_div .bgimg-block").css("background-image",url);	
			
			var div_opacity = plugin.settings.overlay_opacity/100;
			var div_overlaycolor = plugin.settings.overlay_color;
			
			$("#working_div .bgoverlay-block").css("opacity",div_opacity);
			$("#working_div .bgoverlay-block").css("background-color",div_overlaycolor);			
		};
	
		plugin.applyPreviewImage = function(){
			var url = $("#working_div .current_blk").attr("data-img-url");
			var image_icon_span = '<span data-url = "'+url+ '" class="icon-mark pull-right image_icon_span" onclick="showImage(this);"><img src="'+plugin.settings.homeUrl+'images/image_icon.png" alt=""></span>';
			//remove all other spans
			$("#working_div .current_blk").find('.icon-mark').remove();
			if($("#working_div .current_blk").html() == '')
				image_icon_span = "<span> Add your coments here</span>"+image_icon_span;
			$("#working_div .current_blk").append(image_icon_span);
			
		};
		plugin.copyBlock = function(){
			//save the current block
			var current_block = $("#working_div .current_blk");
			var bg_img_block = $("#working_div .bgimg-block");
			var overlay_blk = $("#working_div .bgoverlay-block");
			//save the current block and add new one
			add_block(true,true);
			$("#working_div .current_blk").html(current_block.html());
			//if backgorund image exists
			var div_bgimage = bg_img_block.css("background-image");
			//console.log(div_bgimage);
			if(div_bgimage != 'none'){
				
				//div_bgimage = div_bgimage.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
				$("#working_div .bgimg-block").css("background-image",div_bgimage);
				$("#working_div .bgimg-block").css("background-size","cover");
				$("#working_div .bgoverlay-block").css("background-color",overlay_blk.css("background-color"));
				$("#working_div .bgoverlay-block").css("opacity",overlay_blk.css("opacity"));
				$("#working_div .current_blk").attr("data-img-type",current_block.attr("data-img-type"));
				//add_block(true,false);
				//here we need to save this block
			}	
			//check for background color
			var bg_color = bg_img_block.css("background-color");
			$("#working_div .bgimg-block").css("background-color",bg_color);
			//console.log(bg_color);
			add_block(true,false);
			adjustHeight();
			//add_block(true,true);
		}
        // fire up the plugin!
        // call the "constructor" method
        plugin.init();
		

    }

    // add the plugin to the jQuery.fn object
    $.fn.qardDeck = function(options) {

        // iterate through the DOM elements we are attaching the plugin to
        return this.each(function() {

            // if plugin has not already been attached to the element
            if (undefined == $(this).data('qardDeck')) {
                var plugin = new $.qardDeck(this, options);
                $(this).data('qardDeck', plugin);

            }

        });

    }
	
})(jQuery);
//});

/***
 ** Functions used
 **/
function adjustHeight(){
	var elem = $('#working_div .current_blk');
	$(elem).css("height", 'auto');
	var scrollHeight = Math.ceil(parseInt($(elem)[0].scrollHeight-0.5) / 37.5);
	setHeightBlock(elem,scrollHeight);		
}
function totalHeight(){
	var qard_height= 0;
	$('.current_blk').each(function(i, obj) {
		var block_height = $(obj).attr('data-height');
		//console.log('block-height:'+block_height);
		qard_height =  parseInt(qard_height)+parseInt(block_height);
	})
	return qard_height;
}
function setHeightBlock(elem,offset){
	//check total block height before that
		var h = offset*37.5;
		$(elem).css("height", h);
		$(elem).attr('data-height',offset);	
		//set for other elements also
		$("#working_div .parent_current_blk").css("height", h);
		$("#working_div .bgoverlay-block").css("height", h);
		//console.log(offset);
} 
/** Embed code preview **/
function embedCode(videoLink){
	var eUrl = $(videoLink).attr('data-value');
//	console.log(eUrl);
	var html = '<iframe src="'+eUrl+'" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	$('.preview-image').html(html);
	$('.nav-tabs a[href="#linkblock"]').tab('show');
	$('.nav-tabs a[href="#embed"]').tab('show');
	
	//// ARIVAZAHGAN CODE //////////////////
	// var spantext = $("#working_div .text-block").find("span").html();
	var linkhtml ='<span class="icon-mark pull-right" id="embedHide" data-value="'+eUrl+'" onclick="embedCode(this);"><img src="/qarddeck/web/images/video_icon.png" alt=""></span>';
	$("#paste").hide();
	$("#embed").show();
	$("#embed_code").val(html);
	//$("#emcode_hid").val(spantext);
	$("#emcode_hidimg").val(linkhtml);
	
	//$("#link-ecode").show();
	$("#rmembed_code").show();
	$("#cmn-toggle-57").prop("checked",true);	
	
	/////////////////////////////////
	
}
function saveDeck(deck){
	$(window).data('qardDeck').saveDeck(deck);			
}
function addToDeck(deck){
	$(window).data('qardDeck').addToDeck(deck);		
}
function focusWorkspace(){
	$(window).data('qardDeck').focusWorkspace();			
}
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
function setBGColor(elem){
	color = $(elem).attr('data-color');
	$('#bg_color').val(color);
	$("#working_div .bgimg-block").attr('data-bgcolor-id',$(elem).attr('data-bgcolor-id'));
	$("#working_div .bgimg-block").css('background-color', color);
}
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
function showExtraText(elem){
	//console.log($(this).parent().find('.current_blk'));
	//$(elem).parent('div').trigger("dblclick");
	$(window).data('qardDeck').getExtraText(elem);
		
}
function showImage(element){
	$('.nav-tabs a[href="#imgblock"]').tab('show');
	$(element).trigger("dblclick");
	var data_image = $(element).attr("data-url");
	$('.drop-image').hide();
	var img = "<img class='hover_me' src='"+data_image+"' style='width:100%;height:300px;'>";
	$('.img_preview').html(img);
	$('.img_preview').show();
}
function callUrl(urlField,displayCheck) {
	$(window).data('qardDeck').fetchUrl(urlField,displayCheck);
	//save title and description of url
	
}

/**
DEPRECATED right now!
Whether is it required to clear the preview once it is toggled?
or we need a mirror approach here?
**/
function showUrlPreview() {
	var title = $('input[name=url_title]').val();
	var content = $('textarea[name=url_content]').val();
	var image = $('#review-qard-id .img-preview > img').attr('src');
	if (typeof title === 'undefined')
		return false;
	////console.log(title);
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
	adjustHeight();
}
/**
 * Click on link icon to see the content
**/
function displayLink(identifier){
	
	var dataurl = $(identifier).attr('data-url');	
	$(identifier).trigger("dblclick");
	$('.nav-tabs a[href="#linkblock"]').tab('show');
	$('.nav-tabs a[href="#paste"]').tab('show');
	$('input[id=link_url]').val(dataurl).trigger("change");
	//set link url to true
	$('#cmn-toggle-21').prop('checked', true); 
	//callUrl($('input[id=link_url]'),1);
	var dataopen = $(identifier).attr('data-open');
	var datashowurl = $(identifier).attr('data-showurl');
	if(datashowurl == "true")
		$('#cmn-toggle-4').prop("checked",true);
	if(dataopen == "new")
		$('#cmn-toggle-6').prop("checked",true);
	return false;
}
function callEmbedUrl(videoUrl){
	//$('#link_div').hide();
	$(window).data('qardDeck').embedUrl(videoUrl);

}
function showFilePrev(identifier,fileName){
	
	var block_id = $(identifier).parent().parent('.text-block').attr('data-block_id');
	
	$(window).data('qardDeck').getExtrafile(block_id,fileName);	

}
//Dont know for what this function being used
function changePic(v) {
	$(v).parent().remove();
	$('#working_div').find('span.img-preview').remove();
	$('#working_div').find('span.col-sm-9').addClass("col-sm-12 col-md-12");
	$('#working_div').find('span.col-sm-9').removeClass("col-sm-9 col-md-9");
	$('#title_desc_url').removeClass("col-sm-9 col-md-9");
	$('#title_desc_url').addClass("col-sm-12 col-md-12");
}
function copyBlock(){
	$(window).data('qardDeck').copyBlock();
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
/* 		var div_opacity = parseFloat($("#working_div .bgoverlay-block").css("opacity"));
		data.push({
			name: 'div_opacity',
			value: div_opacity
		});
		//overlay color
		var div_overlaycolor = $("#working_div .bgoverlay-block").css("background-color");
		if(typeof div_overlaycolor === 'undefined') {
			div_overlaycolor = 'transparent';
		}
		data.push({
			name: 'div_overlaycolor',
			value: div_overlaycolor
		});	 */
/*             var div_bgcolor = $("#working_div .bgoverlay-block").css("background-color");
		data.push({
			name: 'div_bgcolor',
			value: div_bgcolor
		});
*/

		//////image type/////
		var data_img_type = $("#working_div .current_blk").attr("data-img-type")||'false';
		data.push({
			name: 'data-img-type',
			value: data_img_type
		});	
		////////////////////
		
		var div_bgcolor = $("#working_div .bgimg-block").css("background-color");
		//console.log(div_bgcolor);
		data.push({
			name: 'div_bgcolor',
			value: div_bgcolor
		});
		var div_bgimage = $("#working_div .bgimg-block").css("background-image");
		if(div_bgimage !='none' || div_bgimage !='undefined')
			div_bgimage = $("#working_div .bgimg-block").css("background-image").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
		////console.log(div_bgimage);
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
/*      var div_bg_color = $("#working_div .bgimg-block").css("background-color");
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
		////console.log("block_style:"+data_style_qard);return;
		data.push({
			name: 'data_style_qard',
			value: data_style_qard
		});	
		
	
		//var new_block = true;
		$(window).data('qardDeck').addBlock(data, 'add_block',new_block);
		
		//commanAjaxFun(data, 'add_block',new_block);
		$("#working_div .current_blk").attr("contenteditable","true");
		//create another working block(div)
		$("#dispIcon").hide();
		$(".drop-file , .drop-image , .file_options").show();
		$("#drop-file-bg").hide();
		$(".fileSwitch").hide();
		$("input[id=embed_code]").val('');		
		$('input[id=qard-url-upload-click]').val('');
		$("#showFile").hide();
		$("#showFilePreview").empty();
		
/////////////ARIVAZHAKANS CODE ////////////

		$("#editcheck").show();
		$("#showFilePreview").hide();		
		//$(".fileName").val('');
		//$(".desc").val('');
	
		$("#fileTitle").html('FileName.psd');
		//added by dency
		if(new_block){
			$(".url_reset_link").trigger("click");
		}
}
function addSaveCard() {
	
	add_block(true,false);
	var total_data_height = 0;
	$('.current_blk').each(function(obj) {
		//console.log($(this).attr("data-height"));
		total_data_height = parseInt($(this).attr("data-height"))+parseInt(total_data_height);
	});
	// if storing image
	var data = [];
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
	var all_data = [];
	$("#add-block .parent_current_blk").each(function(obj,index) {
		// getting opacity for image-block div
		var temp_data = [];
		var image_opacity = parseFloat($(this).css("opacity") || 0);
		temp_data.push({
			name: 'image_opacity',
			value: image_opacity
		});
		//opacity for overlay-block
		var div_opacity = parseFloat($(this).find(".bgoverlay-block").css("opacity") || 0);
		temp_data.push({
			name: 'div_opacity',
			value: div_opacity
		});
		//overlay color
		var div_overlaycolor = $(this).find(".bgoverlay-block").css("background-color");
		if(typeof div_overlaycolor === 'undefined') {
			div_overlaycolor = 'transparent';
		}
		////console.log('overlay'+div_overlaycolor);return;
		temp_data.push({
			name: 'div_overlaycolor',
			value: div_overlaycolor
		});			
		//Background color for background block
		var div_bgcolor = $(this).css("background-color");
		////console.log(div_bgcolor);return;
		temp_data.push({
			name: 'div_bgcolor',
			value: div_bgcolor
		});
		//if it contains background as image then true
		var div_bgimage = $(this).css("background-image");
		if (typeof div_bgimage === 'undefined') {
			var div_bgimage = $(this).css("background-image").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
		}
		var div_bgimage = $(this).css("background-image").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
		////console.log(div_bgimage);
		//return;
		temp_data.push({
			name: 'div_bgimage',
			value: div_bgimage
		});
		
		var div_bgimage_position = $(this).css("background-position")||'null';
		temp_data.push({
			name: 'div_bgimage_position',
			value: div_bgimage_position
		});
		//getting height of div
		var height = parseInt($(this).find(".current_blk").attr('data-height')) * 37.5;
		temp_data.push({
			name: 'height',
			value: height
		});
		var data_img_type = $(this).find(".current_blk").attr("data-img-type")||'false';
		temp_data.push({
			name: 'data-img-type',
			value: data_img_type
		});	
		//getting text for the block
		var text = $(this).find(".current_blk").html() || 0;
		temp_data.push({
			name: 'text',
			value: text
		});
		//if extra text is present
		var extra_text = $("#extra_text").html() || 0;
		temp_data.push({
			name: 'extra_text',
			value: extra_text
		});
		//to check operation for edit a block or for add new block
		var block_id = $(this).find(".current_blk").attr("data-block_id") || 0;
		temp_data.push({
			name: 'block_id',
			value: block_id
		});
		// check whether theme is already preasent for qard or not
		var theme_id = $(this).find(".current_blk").attr("data-theme_id") || 0;
		temp_data.push({
			name: 'theme_id',
			value: theme_id
		});
		// check whether theme is already preasent for qard or not
		var calc_index = index + 1;
		//$(this).find(".current_blk").attr("data-block_priority", (index + 1));
		var block_priority = $(this).find(".current_blk").attr("data-block_priority") || calc_index;
		temp_data.push({
			name: 'block_priority',
			value: block_priority
		});
		//check qard id is present to edit or add new qard
		var qard_id = $("#qard_id").val() || 0;
		temp_data.push({
			name: 'qard_id',
			value: qard_id
		});
		// getting tags fot qard
		var tags = $("#tags").val();            
		temp_data.push({
			name: 'tags',
			value: tags
		});
		var qard_title = $("#qard_title").val() || 0;
		temp_data.push({
			name: 'qard_title',
			value: qard_title
		});
		//if block contains title for block then true
		var is_title = $("[name='is_title']:checked").val() || 0;
		temp_data.push({
			name: 'is_title',
			value: is_title
		});
		//to get current block id
		var blk_id = $(this).attr("id");
		temp_data.push({
			name: 'blk_id',
			value: blk_id
		});
		//addded data bgcolor id and font color id
		var data_bgcolor_id = $(this).attr("data-bgcolor-id") || 0;
		temp_data.push({
			name: 'data_bgcolor_id',
			value: data_bgcolor_id
		});	
		var data_fontcolor_id = $(this).find(".current_blk").attr("data-fontcolor-id") || 0;
		temp_data.push({
			name: 'data_fontcolor_id',
			value: data_fontcolor_id
		});	
		//add block style
		// add the block style also
		var data_style_qard = $(this).attr('data-style-qard') || 'line';
		temp_data.push({
			name: 'data_style_qard',
			value: data_style_qard
		});	
		all_data.push({
			name: 'block_data',
			value : temp_data
		});
		$(this).addClass("delete_blk");
/* 			var new_block = true;
		commanAjaxFun(data, 'save_block',new_block); */
	});
	data.push({
		name: 'all_blocks',
		value : all_data			
	});
		
	//console.log(data);
	dataP = JSON.stringify(data);
	
	
	$(window).data('qardDeck').saveQard(dataP);	
	return;
}
/**
 ** Event handlers Used
 **/
$('.help-link a').click(function(e){
	e.preventDefault();
	$('#myModaltut').modal('show');
});
$('#qard-style #themeorder .qard-content').click(function(){
	$('.qard-content').removeClass('active');
	$(this).addClass('active');
	var themeid = $(this).parent().attr('id');
	$('#qrdstyle-link').attr('data-theme',themeid);
});
	

/*
 * Double click to edit the block again
 */
$(document).delegate('.add-block-qard > div', "dblclick", function(event) {
	//console.log($(this).attr("id"));
	if ($(this).attr("id") !== 'working_div') {
		$('#working_div .current_blk').removeAttr("unselectable");
		$("#working_div .current_blk").removeAttr("contenteditable");
		$("#working_div .current_blk").removeClass("working_div");
		$("#working_div .parent_current_blk").unwrap();
		if($(this).html != "")
			$(this).wrap('<div  id="working_div" class="working_div active"></div>');
		$(this).find(".current_blk").addClass("working_div");
		$(this).find(".current_blk").attr("unselectable", 'off');
		$(this).find(".current_blk").attr("contenteditable", 'true');
	}
	

	//var bg_img_block = $('#working_div .bgimg-block').
	var div_bgimage = $("#working_div .bgimg-block").css("background-image");
	//console.log(div_bgimage);
	if(div_bgimage != 'none'){
		
		div_bgimage = $("#working_div .bgimg-block").css("background-image").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
		
		var img = "<img class='hover_me' src='"+div_bgimage+"' style='width:100%;height:300px;'>";
		$('.img_preview').html(img);
		$('.img_preview').show();
		$('.drop-image').hide();
		$('.nav-tabs a[href="#imgblock"]').tab('show');
	}else{
		$('.img_preview').html('');	
	}
			

});
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
		start: function( event, ui ) {
			$(this).trigger('dblclick');
		},
		resize: function(e, ui) {

			//var resized height
			var scrollHeight = Math.ceil(ui.size.height / 37.5);
			//var initial height
			var initialHeight = Math.ceil(parseInt($(this).find(".current_blk")[0].scrollHeight-0.5) / 37.5);
			//console.log(initialHeight);
			$(this).find(".current_blk").attr('data-init-height',initialHeight);
			var total = totalHeight();
			//console.log("total height:"+total);
			if(total >= 16 ){
				if(scrollHeight < initialHeight ){
					adjustHeight();	
				}else{
					setHeightBlock($(this).find(".current_blk"),initialHeight);
				}
			}else{
				//set height to the resized height
				setHeightBlock($(this).find(".current_blk"),scrollHeight);
				$(this).find(".current_blk").attr('data-resized','true');								
			}
		},
		stop: function(e, ui) {
			var scrollHeight = Math.ceil(ui.size.height / 37.5);
			var initialHeight = $(this).find(".current_blk").attr("data-init-height");
			if(scrollHeight < initialHeight )
				adjustHeight();						
		}
	});				
}
});
/*** For sorting the block ***/
$('#add-block').sortable({
	group: 'no-drop',
	handle: '.drag',
	cursorAt: { right: 5},
	tolerance: 'intersect',
	onDragStart: function($item, container, _super) {
		if (!container.options.drop) $item.clone().insertAfter($item);
		_super($item, container);
	},
	stop: function(event, ui){

		if(!$('.add-another').is(':last-child')){					
			//console.log("Dragging Not allowed with total height "+total+" and max_allowed_position "+ max_allowed_position + " add button at "+ $('.add-another').index());
			return false;	
		}
		
		ui.item.trigger("dblclick");
		$("#working_div").each(function(){
			if($(this).html() == '' ){
				$(this).remove();
			}
				
		});		
		totalBlocks = $("#add-block").find(".current_blk").length;	
		////console.log("totla now"+totalBlocks);				
		if ($("#qard_id").length == 0)
			var max_allowed_position = parseInt(totalBlocks+1); 
		else 
			var max_allowed_position = parseInt(totalBlocks+2); 
		
		var total = totalHeight();	
		if($('.add-another').is(':last-child')){
			//console.log("last");
		}


	},
	update: function(event, ui) {
		var postData = getNSetOrderOfBlocks();
		$(window).data('qardDeck').updateBlockPriority(postData);	

	}

});
/** For deleting the block **/
$(document).delegate("#deleteblock", "click", function() {
	var block_id = $("#working_div .current_blk").attr("data-block_id");
	if (typeof block_id !== 'undefined') {
		$(window).data('qardDeck').deleteBlock(block_id);
	} else {
		alert("first select/create block first");
	}
});
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
	//console.log($(this).val());
	$('.working_div').focus();
	return false;
});
//replaced by this
$("#alignment_select li a").click(function(){
  ////console.log($(this).attr("data-align"));
	document.execCommand($(this).attr("data-align"), false, null);
	//console.log($(this).val());
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
$("#remove_extra_text").click(function(){
	$("#extra_text").html('');
	$("input[name=extra-text]").val('');
	$('#cmn-toggle-9').prop("checked",false);
}); 
$('#cmn-toggle-9').click(function(){
	//check selected block first
	//setTimeout("add_block(true,false);",1000);
	////console.log($("#working_div .current_blk").attr('data-block_id'));
	if($(this).prop('checked')){
		add_block(true,false);
		$(window).data('qardDeck').addExtraText();
		
	}else{
		$("#working_div .current_blk").find(".icon-mark").remove();
	}			

});
/**** Link Block operations ******/
$('#cmn-toggle-4').on('change', function() {
	if($(this).prop('checked')){
		if($("input[id=link_url]").val() != '')
		{
			var str = '<span id="show_url_span">'+$("input[id=link_url]").val()+'</span>';
			//$("#working_div .current_blk").find('#previewLink').prepend(str);	
			$(str).insertBefore($("#working_div .current_blk").find('#previewLink'));
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
 $('input[id=link_url]').on('change', function() {
	callUrl(this,0);
});
/* $('#link_url_button').click(function() {
		console.log("url taken");
		//callUrl($('input[id=link_url]'),0);
		add_block(true,false);
		$(window).data('qardDeck').useUrl();

}); */
$('#cmn-toggle-21').on('change', function() {
	if($(this).prop('checked')){
		if($("input[id=link_url]").val() != '')
		{
			add_block(true,false);
			$(window).data('qardDeck').useUrl();			
		}
	}else{
		if($("#working_div .current_blk").find('#previewLink').length != 0 )
			$("#working_div .current_blk").find('#previewLink').remove();
	}
});
$('body').on('change', $('input[name=url_title]', 'textarea[name=url_content]'), function() {
	showUrlPreview();
});
$('.url_reset_link').on('click', function() {
	$('#link_div').html("<div class='preview-image'></div>");
	$('#embed_div').html("<div class='preview-image'></div>");
	$("input[id=link_url]").val('');
	$("input[id=embed_code]").val('');
	$('#cmn-toggle-4').prop("checked",false);
	$('#cmn-toggle-6').prop("checked",false);
	$('#cmn-toggle-21').prop('checked', false); 
	$("input[name=url-title]").val('');
	$("input[name=url-desc]").val('');
});

/**** End of Link Block operations ******/
		
/** Image block operations **/
/* $('.img_preview').mouseenter(function(){
	$(".dropzone .btn-cancel").trigger("click");
	$('.drop-image').show();
	//$('.img_preview').css("z-index","-1");
	$('.img_preview').hide();
	$('.img_preview').html('');
});
$('.drop-image').mouseleave(function(){
	if($('#working_div .current_blk').find('.image_icon_span').length !=0){
		var data_image = $('#working_div .current_blk').find('.image_icon_span').attr("data-url");
		var img = "<img class='hover_me' src='"+data_image+"' style='width:100%;height:300px;'>";
		$('.img_preview').html(img);
		$('.img_preview').show();
		$('.drop-image').hide();			
	}
}); */
$(document).on("click", "#reset_image", function() {
	$(".dropzone .btn-cancel").trigger("click");
	$(".img_preview").html('');
	$(".img_preview").hide('');
	$(".drop-image").show();
});
// on click image tab should increase block height
$(document).on("click", "#cmn-toggle-3", function() {
	if($(this).prop('checked')){
		
		if($("#working_div .current_blk").attr("data-img-type") == "preview")
			$("#working_div .current_blk").attr("data-img-type",'both');
		else
			$("#working_div .current_blk").attr("data-img-type",'background');
		
		if (parseInt($("#working_div .current_blk").attr("data-height")) < 4) {
			setHeightBlock($("#working_div .current_blk"),4);
		}
		if($(".save-pic").length == 0){
			$(window).data('qardDeck').applyBGImage();
		}	
			$(".save-pic").trigger("click");
	} else {
		//removeBr();
		$("#working_div .bgimg-block").css("background-image","none");
		$("#working_div .bgoverlay-block").css("opacity",1);
		$("#working_div .bgoverlay-block").css("background-color",'transparent');
	}
});
$(document).on("click", "#cmn-toggle-7", function() {
	if($(this).prop('checked')){
		if($("#working_div .current_blk").attr("data-img-type") == "background")
			$("#working_div .current_blk").attr("data-img-type",'both');
		else
			$("#working_div .current_blk").attr("data-img-type",'preview');
		
			//setHeightBlock($("#working_div .current_blk"),4);
			if($(".save-pic").length == 0){
				$(window).data('qardDeck').applyPreviewImage();
			}	
			$(".save-pic").trigger("click");

	} else {
		//removeBr();
		$('#working_div .current_blk').find('.image_icon_span').remove();
		adjustHeight();
	}
});
	// for image
$(document).delegate("#image_opc", "blur keydown keyup", function() {
	var per = parseInt($(this).val() || 1) / 100;
	//console.log("image opc" + per);
	$("#working_div .bgimg-block").css('opacity', per);
});
$(document).delegate("#overlay_color", "blur", function() {
	var color = $(this).val();
	//console.log(color);
	$("#working_div .bgoverlay-block").css('background-color', color);
});
$(document).delegate("#overlay_opc", "blur keydown  keyup", function() {
	var per = parseInt($(this).val()) / 100;
	//console.log("image opc" + per);
	$("#working_div .bgoverlay-block").css('opacity', per);
});
$(document).delegate("#bg_color", "blur", function() {
	var color = $(this).val();
	$("#working_div .bgimg-block").css('background-color', color);
});
		
/** End of Image block operations **/

/** File upload functions **/
//ADDED BY NANDHINI
$(".dispFileName").on('click', function(e) {
   if($('.dispFileName').is(':checked')){
	   var fileName = $(".fileName").val();  
		$(window).data('qardDeck').setLink($(this),fileName,2);
	   
   }else{
	   var fileName = $(".fileName").val();   
	   $(window).data('qardDeck').setLink($(this),fileName,3); 
   }
});
$('.drop-file').on('click', function(e) { 
	
	$('#qard-url-upload-click').trigger('click');	
	return false;
	          
}); 
$('input[id=qard-url-upload-click]').on('change',function(e) {

	$(window).data('qardDeck').uploadFileSimple($(e.target));

});
$('#reflink').click(function(e) {
	$("#qard-url-upload").trigger('reset');
	$("#fileTitle").html('FileName.psd');
});		

/** Embedd Video functions **/
$(document).on('change', 'input[id=embed_code]', function(){ 

console.log(this);	
	callEmbedUrl(this);
});

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
	$('#qrdstyle-link').attr("data-pattern",styleCard);
}); 

$('#qrdstyle-link').click(function(e){
	e.preventDefault();
	//check total height			
	//$("h5[class=add-another]").trigger("click");
	
	var theme_id = $(this).attr('data-theme');
	var q_id = $('#qard_id').val();
	var block_style = $(this).attr('data-pattern');
	add_block(true,false);
	$(window).data('qardDeck').changeQardStyle($(e.target));

});

/** Arivazhagan 
Edit Document view

**/

$(document).on('click', '#file_image', function(){ 
//console.log("changed");
$("#showFilePreview").hide();
$("#editcheck").show();
$(".drop-file").show();
$("#drop-file-bg").hide();
$(".fileSwitch").hide();
$(".fileName").val('');
 var File_title = $("#file_title").html();
$("#url-filename").val(File_title); 
 var File_desc = $("#file_desc").html();
$("#url-filedesc").val(File_desc); 

$("#fileTitle").html('FileName.psd');

	
});

$(document).on("click",".icon-mark",function(){
	
	var id = $(this).parents(".parent_current_blk").attr("id");
	
 	if ($("#"+id).attr("id") !== 'working_div') {
		$('#working_div .current_blk').removeAttr("unselectable");
		$("#working_div .current_blk").removeAttr("contenteditable");
		$("#working_div .current_blk").removeClass("working_div");
		$("#working_div .parent_current_blk").unwrap();
		if($("#"+id).html != "")
			$("#"+id).wrap('<div  id="working_div" class="working_div active"></div>');
		$("#"+id).find(".current_blk").addClass("working_div");
		$("#"+id).find(".current_blk").attr("unselectable", 'off');
		$("#"+id).find(".current_blk").attr("contenteditable", 'true');
	} 
	
	var div_id = $(this).attr("for");
	
	if(div_id != "showFilePrev")
	{		
		$(".drop-file , .drop-image , .file_options").show();
		$("#showFilePreview").empty();
		$("#editcheck").show();
		$("#drop-file-bg").hide();
		$("#fileTitle").html('FileName.psd');
		$("#cmn-toggle-56").attr("data-url","");
		$('#cmn-toggle-56').prop('checked', false); 
	}
	
	 if(div_id == "showExtraText")
	{	
		$('#add_extra_text').trigger("click");  			
	}
	else{ 
	$('#extra-list').prop("disabled",true);  
	$("#extra-word").attr( "style","pointer-events: none; opacity: 0.4;" );	
	$("#link-extra").hide();	
	$("#add_extra_text").show();	
	$('#extra-list').val("");  		
	$('#extra_text').html(""); 	
	}
	
});


$(document).on("mouseleave",".add-new-file",function(){	  
   $("#drop-file-bg").hide();
  });
  
  $(document).on("mouseenter",".add-new-file",function(){	  
   $("#drop-file-bg").show();
  });

$('#cmn-toggle-56').click(function(){	

	if($(this).prop('checked')){
		 var linespan =  $(this).attr("data-url");
            $("#working_div .current_blk").html(linespan);				
			add_block(true,false);
			
			$(window).data('qardDeck').useFileText();				
			$("input[name=filename]").val('');
			$("input[name=filedesc]").val('');
			
	}else{	
		  var spantextval =  $(this).attr("data-link");
			$("#working_div .current_blk").html(spantextval); 
	}				
});
		

$(document).on('click', '.removefile', function(){ 
	$('#file_image').trigger('click');
	$('#cmn-toggle-56').attr("data-url","");  
	$('#url-filename').val("");  
	$('#url-filedesc').val("");  
	$('#cmn-toggle-56').attr("data-link","");  
	$('#cmn-toggle-56').prop('checked', false); 
});	

$(document).on('click', '.add-another', function(){ 
	$('#cmn-toggle-56').attr("data-url","");  
	$('#cmn-toggle-56').attr("data-link","");  
	$('#cmn-toggle-56').prop('checked', false); 
	$("input[name=filename]").val('');
	$("input[name=filedesc]").val('');	
	$('#extra-list').prop("disabled",true);  
	$("#extra-word").attr( "style","pointer-events: none; opacity: 0.4;" );	
	$("#link-extra").hide();	
	$("#add_extra_text").show();
	$('#embed_div').html("<div class='preview-image'></div>");
	//$('#btnembed_code').show();
	//$('#link-ecode').hide();	
	$('#rmembed_code').hide();	
	
});	

$(document).on('click', '#add_extra_text', function(){
	$('#extra-list').prop("disabled",false);  
	$("#extra-word").removeAttr( "style" );	
	$("#link-extra").show();	
	$("#add_extra_text").hide();	
	
});


$('#cmn-toggle-57').click(function(){	
	if($(this).prop('checked')){		
		var video_img = $("#emcode_hid").val();
		var video_link_only = $("#emcode_hidimg").val();
		//if html is present in the working div, append after removing akll other icons
			$("#working_div .current_blk").find('.icon-mark').remove();
			if($("#working_div .current_blk").html() != '')
				$("#working_div .current_blk").append(video_link_only);						
			else
				$("#working_div .current_blk").html(video_img);						
					
			adjustHeight();
			
	}else{	
		
		  $("#working_div .current_blk").find('.icon-mark').remove();
		  
	}				
});


$(document).on('click', '#rmembed_code', function(){ 
	$('#embed_div').html("<div class='preview-image'></div>");
	$('#embed_code').val(""); 
	$('#emcode_hid').val("");  
	$('#emcode_hidimg').val("");  
	$("#cmn-toggle-57").prop("checked",false);	
	//$('#link-ecode').hide(); 
	$('#rmembed_code').hide(); 
	//$('#btnembed_code').show(); 
});	

