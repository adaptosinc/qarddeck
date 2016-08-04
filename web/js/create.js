
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
					var scrollHeight = Math.ceil(parseInt($(this)[0].scrollHeight) / 37.5);
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
				var scrollHeight = Math.ceil(parseInt($(this)[0].scrollHeight) / 37.5);
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
					if (data.link_image) {
						/** Uncomment this for background image **/
						//img = 'background-size:cover;background-image:url(<?=Yii::$app->request->baseUrl?>/uploads/block/' + data.link_image + ');';
						/** ----------------------------------- **/
						/** Make link icon **/
						var image_icon_span = '<span data-url = "'+plugin.settings.homeUrl+'/uploads/block/' + data.link_image + '" class="icon-mark pull-right image_icon_span" onclick="showImage(this);"><img src='+plugin.settings.homeUrl+'"images/image_icon.png" alt=""></span>';
						/** ----------------------------------- **/
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
						if(data.text == ''){
							focusWorkspace();
							$("#working_div .current_blk").html("Add your comments here");
						}
							
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
	var scrollHeight = Math.ceil(parseInt($(elem)[0].scrollHeight) / 37.5);
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
	console.log(eUrl);
	var html = '<iframe src="'+eUrl+'" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	$('.preview-image').html(html);
	$('.nav-tabs a[href="#linkblock"]').tab('show');
	$('.nav-tabs a[href="#embed"]').tab('show');
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
		//console.log(div_overlaycolor);
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
		$(".fileSwitch").show();
		$("input[id=link_url]").val('');
		$("input[id=embed_code]").val('');
		$('input[id=qard-url-upload-click]').val('');
		$("#showFile").hide();
		$("#showFilePreview").empty();
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
			var initialHeight = Math.ceil(parseInt($(this).find(".current_blk")[0].scrollHeight) / 37.5);
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
