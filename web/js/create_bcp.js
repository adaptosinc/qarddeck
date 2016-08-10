	/**
	  * Script re-written by Dency G B 
	 **/
	 $(".js-example-basic-multiple").select2({
		 placeholder: "Add some tags",
	 });

	/**** Handle the main work space ******/

/* 	$(document).delegate("#working_div .current_blk", "hover", function(event) {	
	
	}); */
	$(document).delegate("#working_div .current_blk", "input blur keyup keydown resize", function(event) {		
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
					url: "block/change-priority",
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
					url: "block/delete-block",
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
		if(total_data_height != 16){
			alert("Ouch, please fill the qard!");
			return;
		}
		
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
/* 		if(!new_block && callFrom=="add_block"){ //request for add_image
			postData.push({
                name: 'is_image',
                value: true				
			});
			postData.push({
                name: 'handle_image',
                value: true				
			});	
		}else{
			postData.push({
                name: 'is_image',
                value: false				
			});			
		}
 */
		$.ajax({
			url: "block/create",
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

				var url = 'qard/publish';
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
            var get_preview_url = "qard/url-preview";
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
                        $('#dispIcon').attr('src', 'images/pdf.png');
                    }
                    if (data.type == 'DOC' || data.type == 'DOCX') {
                        $('#dispIcon').attr('src', 'images/doc.png');
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
			var dataurl = $(identifier).data('url');
			var checkit = $(identifier).find('#hiddenUrl');
			var displayCheck = 1;
			callUrl(checkit,displayCheck);
			$('.nav-tabs a[href="#linkblock"]').tab('show');
			return false;
		}
		/**********************************/
        $('#url_reset_link').on('click', function() {
            $('#link_div').html("<div class='preview-image'></div>");
			 $('#embed_div').html("<div class='preview-image'></div>");
            $("input[id=link_url]").val('');
			$("input[id=embed_code]").val('');
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
                    url: "qard/simple",
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
            var get_embed_url = "qard/embed-url";
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
            var get_embed_url = "qard/embeddisplay-url";
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
		
		// Styling Card script starts
		$('.qard-content').click(function(){
			var styleCard = $(this).parent();
			if(styleCard.hasClass( "line" )){
				$('.bgimg-block').addClass('line');
				$('.bgimg-block').removeClass('flat gap shadow');
				$('.bgimg-block').attr('data-style-qard','line');
			}
			else if(styleCard.hasClass( "gap" )){
				$('.bgimg-block').addClass('gap');
				$('.bgimg-block').removeClass('flat line shadow');
				$('.bgimg-block').attr('data-style-qard','gap');
			}
			else if(styleCard.hasClass( "shadow" )){
				$('.bgimg-block').addClass('shadow');
				$('.bgimg-block').removeClass('flat line gap');
				$('.bgimg-block').attr('data-style-qard','shadow');
			}else{
				$('.bgimg-block').addClass('flat');
				$('.bgimg-block').removeClass('gap line shadow');
				$('.bgimg-block').attr('data-style-qard','flat');
			}
		});
		// Styling Card script Ends
	/***************************/