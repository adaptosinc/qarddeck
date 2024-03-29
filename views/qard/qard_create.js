$(function() {

            $(".js-example-basic-multiple").select2();
            $("#showFile").hide();

            //for drag the block

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
//	    $("#working_div .current_blk").resizable({
//	    containment: "#add-block",
//	    handles: 's, n'
//	    });
            $(document).delegate("#add-block .parent_current_blk", "mouseenter mouseleave", function(event) {
                if (event.type === "mouseleave") {
                    $(this).find(".drag").remove();

                } else {
		    
                    if ($(this).find("div").hasClass("drag") === false) {
                        $(this).find(".bgoverlay-block").after('<div class="drag"><i class="fa fa-arrows"></i></div>');
                    }
                }
            });
	   
	    var dragging = false;
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
		});

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




            //	 $('#working_div .current_blk').resizable();

            $("#extErr").hide();

            // on click image tab should increase block height
            $(document).delegate("#cmn-toggle-3", "click", function() {
                if ($(this).is(":checked")) {
                    if (parseInt($("#working_div .current_blk").attr("data-height")) < 4) {
                        setHeightBlock(4);
                    }
                } else {
                    removeBr();
                }
            });



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


            $(document).delegate("#reset_image", "click", function() {
                $(".dropzone .btn-cancel").trigger("click");
            });


            $(document).delegate("#working_div .current_blk", "paste", function(event) {
                // cancel paste
                event.preventDefault();
                // get text representation of clipboard
                var text = event.originalEvent.clipboardData.getData('Text');
                // insert text manually
                document.execCommand("insertHTML", false, text);
                setHeightBlock('', event);
                //	    var total_height=totalHeight();
                //	    console.log(total_height);
                //	    if(total_height>(600-37.5)){
                //		$(".add-block .add-another").hide();
                //	    }else{
                //		$(".add-block .add-another").show();
                //	    }
                //
                //	    var offsetHeight=parseInt($("#working_div .current_blk")[0].offsetHeight);
                //	    var scrollHeight=parseInt($("#working_div .current_blk")[0].scrollHeight);
                //	    maxHeight=Math.ceil((scrollHeight-offsetHeight)/37.5);
                //	    height_number=parseInt($("#working_div .current_blk").attr("data-height"))+maxHeight;
                //	    height=height_number*37.5;
                //
                //
                //    //	console.log("offsetHeight"+offsetHeight+"scrollHeight=="+scrollHeight);
                //
                //	    if(total_height>=(150)){
                //		document.execCommand('undo', false, null);
                //	    }

            });
//	    $(document).delegate("#working_div", "click", function(event) {
//		$("#working_div .current_blk").focus();
//	    });
            $(document).delegate("#working_div .current_blk", "blur keyup", function(event) {
                if (event.keyCode === 8) {
                    var cursorPos = $(this).caret('pos');
                    var str = $(this).html();
                    $(this).html(str.replace(/((<br>)(<br>))?$/gm, ""));
                    $(this).css("height", "auto");
                    var scrollHeight = Math.ceil(parseInt($(this)[0].scrollHeight) / 37.5);
                    var height_number = scrollHeight;
                    setHeightBlock(height_number);
                    $(this).caret('pos', cursorPos);
                } else {
                    setHeightBlock('', event);
                }
            });
            //	$(document).delegate("#add-block .parent_current_blk",'click',function(){
            //	   if($(this).parent("#working_div").length){
            ////	       var cursorPos=$("#working_div .current_blk").caret('pos');
            ////	       $("#working_div .current_blk").caret('pos',cursorPos);
            ////	       $("#working_div .current_blk").focus();
            //	   }
            //	});
	    
//	    $(document).delegate("#working_div .current_blk", "click", function(event) {
//		var cursorPos = $(this).caret('pos');
//		console.log(cursorPos);
//		$(this).focus();
//		$(this).caret('pos', cursorPos);
//	    });

            //increase height of the div
            $(document).delegate("#working_div .current_blk", "click", function(event) {
		
                setHeightBlock('', event);
		
                //	    checkHeight(event);
                //	    $(this).focus();
                //	    $(this).caret('pos',cursorPos);

            });


            $(document).delegate('#canvas_thumb', "change", function(event) {
                alert("vliayt");
            });
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


            // for image or file drop
            $('.dropzone').html5imageupload();

            $('#for_image').html5imageupload({

                // to delete image from database
                onAfterCancel: function() {
                    //		var block_id=$("#block_id").val()|| 16;
                    //		$.ajax({url:"<?=Url::to(['block/delete-block'], true)?>",type:'post',data:{'block_id':block_id},function(data){console.log(data);}});
                },
                onSave: function() {
                    console.log("vijaysharma");
                }

            });

            $('.color_picker').colorpicker();
            $("#link_color").colorpicker();
            $("#link_hcolor").colorpicker();
            $("#overlay_color").colorpicker();
            $("#bg_color").colorpicker();
            $('#cardtabs a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
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
            //for block
            $(document).delegate("#blk_size", "keyup keydown", function() {
                setHeightBlock($(this).val());
            });
        });

        /*
         * to find total height
         */
        function totalHeight() {
            var total_height1 = 0;
            $(".qard-div .current_blk").each(function() {
                var attr = $(this).attr('data-height');

                if (typeof attr !== typeof undefined && attr !== false) {
//                    console.log(attr);
                    total_height1 += parseInt(attr) * 37.5;
//                    console.log(total_height1);
                }
            });
            return total_height1;
        }

        function setHeightBlock(height, event) {
            //	var size = height*37.5;
            var total_height = totalHeight();
            //	console.log("total_height="+total_height);
            var offsetHeight = parseInt($("#working_div .current_blk")[0].offsetHeight);
            var scrollHeight = parseInt($("#working_div .current_blk")[0].scrollHeight);
            var maxHeight = Math.ceil((scrollHeight - offsetHeight) / 37.5);
	    
	    	console.log("offsetHeight="+offsetHeight+"scrollHeight="+scrollHeight);
            if (height) {
                //	    if(Math.ceil(offsetHeight/37.5)>height){
                //		return false;
                //	    }
                var height_number = height - parseInt($("#working_div .current_blk").attr("data-height"));
                total_height = total_height + (height_number * 37.5);
                //	    console.log("total after="+total_height);

            } else {
                	    console.log("maxHieght"+maxHeight);
                total_height = (maxHeight * 37.5) + total_height;
                //	    console.log("total after="+total_height);
                height = (parseInt($("#working_div .current_blk").attr("data-height")) + maxHeight);
                //	    height=height_number*37.5;

            }
            $(".add-block .add-another").show();
//	    return false;
            if (total_height <= 600) {

                //	    console.log("viay"+height);
                $("#working_div .parent_current_blk").css("height", (height * 37.5));
                $("#working_div .bgoverlay-block").css("height", (height * 37.5));
                $("#working_div .current_blk").css("height", (height * 37.5));
                $("#working_div .current_blk").attr("data-height", height);
                return true;
                //	}else if(scrollHeight > offsetHeight){
                //	    
            } else {
                $(".add-block .add-another").hide();
                document.execCommand('undo', false, null);
                return false;
            }
        }




        function removeBr() {

            if ($("#working_div .current_blk").text() === "") {
                $("#working_div div").each(function() {
                    if (typeof $(this).attr("data-height") !== typeof undefined) {
                        $(this).attr("data-height", 1);
                    }
                    $(this).css("height", (1 * 37.5));
                });

            } else {
                $($("#working_div .current_blk").get().reverse()).each(function(index) {
                    console.log(index + "----" + (index) % 2);
                    if (($(this).is("br")) && (((index) % 2) === 0)) {
                        if ($(this).prev().is('br')) {
                            console.log("vijay");
                            //		   $(this).prev().remove();
                            //		   
                            //		   $(this).remove();
                        }
                    }
                });
            }
        }
        //    function checkHeight(e){
        //	var total_height=totalHeight();
        //	if(total_height>(600-37.5)){
        //	    $(".add-block .add-another").hide();
        //	}else{
        //	    $(".add-block .add-another").show();
        //	}
        //	
        //	var offsetHeight=parseInt($("#working_div .current_blk")[0].offsetHeight);
        //	var scrollHeight=parseInt($("#working_div .current_blk")[0].scrollHeight);
        //	maxHeight=Math.ceil((scrollHeight-offsetHeight)/37.5);
        //	console.log("maxHieght"+maxHeight);
        //	
        //	height_number=parseInt($("#working_div .current_blk").attr("data-height"))+maxHeight;
        //	height=height_number*37.5;
        //	
        //	
        //	console.log("offsetHeight"+offsetHeight+"scrollHeight=="+scrollHeight);
        //	
        //	
        ////	if(total_height>=(600)){
        //////	    console.log("vijay");
        ////	    if(scrollHeight > offsetHeight){
        ////		if(e.keyCode!==8){
        ////		    e.preventDefault();
        ////		}
        ////	    
        ////	    }else{
        ////		if(e.keyCode===1)
        ////		    e.preventDefault();
        ////	    }
        ////	}
        //	
        //	
        //	if(scrollHeight > offsetHeight && total_height<=(600-37.5)){
        //	    setHeightBlock(height_number);
        //	}else if(scrollHeight>offsetHeight){
        //	    if(e.keyCode!==8){
        //		document.execCommand('undo', false, null);}
        //	    $(".add-block .add-another").hide();
        //	}else{
        ////	    console.log($("#working_div div").last().find('br'));
        //	}
        //    }

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
                        var total_height = totalHeight();
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
                        var new_div = '<div id="' + data.blk_id + '" class="bgimg-block parent_current_blk" style="height:' + data.height + 'px;' + img + '">';
                        //creating overlay-block or middel block
                        new_div += '<div class="bgoverlay-block" style="background-color:' + data.div_bgcolor + ';opacity:' + data.div_opacity + ';height:' + data.height + 'px;">';
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



                            console.log("tao" + total_height);
                            var nextBlockPriority = getNextBlockPriority();
                            if (total_height <= 600) {
                                $("#working_div").remove();
                                var new_div = '<div  id="working_div" class="working_div active"><div id="blk_' + getNextBlockId() + '" class="bgimg-block parent_current_blk"><div class="bgoverlay-block"><div class="text-block current_blk" data-height="1"  contenteditable="true" unselectable="off" data-block_priority="' + nextBlockPriority + '"></div></div></div></div>';
                                $("#add-block .parent_current_blk:last").after(new_div);
                                console.log("added new block");
                            } else {
                                $("#working_div").remove();
                                alert("qard is full");
                            }
                        }
                    } else {
                        $("#" + data.blk_id).find(".current_blk").attr("data-block_id", data.block_id);
                        $("#" + data.blk_id).find(".current_blk").attr("data-theme_id", data.theme_id);
/*  						var user = '<?php echo \Yii::$app->user->id; ?>';
						if(!user || user == ''){
							$('.pull-right button[data-target="#myModal"]').trigger('click');	
						}else{ */
							var url = '<?=Url::to(['qard/publish'], true);?>';
							//redirect to publish and view qard
							window.location.replace(url);
						/* } */
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
         * add_block with all values
         */
        function add_block(event) {

            //	$("#wait").show();
            // to check height
            //	checkHeight(event);
            // if storing image
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


            var div_bgcolor = $("#working_div .bgoverlay-block").css("background-color");
            data.push({
                name: 'div_bgcolor',
                value: div_bgcolor
            });

            var div_bgimage = $("#working_div .bgimg-block").css("background-image").replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
            data.push({
                name: 'div_bgimage',
                value: div_bgimage
            });


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

            ////	console.log("df"+$("#working_div .current_blk").text());
            //	if($("#working_div .current_blk").text().trim() == '' && typeof data.div_bgimage==typeof undefined && typeof data.thumb_values== typeof undefined){
            //		    console.log("please enter block or image to save");
            ////		    return false;
            //		}
            //
            ////
            //	console.log(data);
            //	return false;
            return commanAjaxFun(data, 'add_block');
            $("#wait").hide();
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

            $("#add-block .parent_current_blk").each(function(index) {

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
                //OVERLAY color for overlay block
                var div_bgcolor = $(this).find(".bgoverlay-block").css("background-color");
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

            //	$("#add-block .delete_blk").remove();

        }

        //ADDED BY DENCY
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
                    setHeightBlock('', '');
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
            //setInterval(function(){ checkHeight(); }, 1000);
            //setiInterval(function(){checkHeight();},1000);
            //setHeightBlock(5);
            //	$("#working_div div").html(str);
            $("#working_div .current_blk").html(str);
            setHeightBlock('', '');
            //$('#link_div').hide();

        }
        $('#url_reset_link').on('click', function() {
            $('#link_div').empty();
            $(".drop-file , .drop-image , .file_options").show();
            $("input[id=link_url]").val('');
            $(".link_options").hide();
        });

        $('#qard_preview').on('click', function() {
	//		$('div[id=myModal]').tab('show');


/*             var dataUrl = renderer.domElement.toDataURL("image/png");
            console.log(dataUrl);
            html2canvas([document.getElementById('add-block')], {
                onrendered: function(canvas) {
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
                    }).done(function(respond) {
                        console.log(respond);
                        //$("#save").html("Uploaded Canvas image link: <a href="+respond+">"+respond+"</a>").hide().fadeIn("fast");
                    });

                }
            }); */
        });

        ////////////////////////////////////

        //ADDED BY NANDHINI
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
        $(function() {
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
        });
        //////////////////////////////////////////////////
        // THE FOLLOWING CODE IS USED FOR RESIZE THE DIV//
        //////////////////////////////////////////////////
        (function($) {

            // A collection of elements to which the resize event is bound.
            var elems = $([]),

                // An id with which the polling loop can be canceled.
                timeout_id;

            // Special event definition.
            $.event.special.resize = {
                setup: function() {
                    var elem = $(this);

                    // Add this element to the internal collection.
                    elems = elems.add(elem);

                    // Initialize default plugin data on this element.
                    elem.data('resize', {
                        w: elem.width(),
                        h: elem.height()
                    });

                    // If this is the first element to which the event has been bound,
                    // start the polling loop.
                    if (elems.length === 1) {
                        poll();
                    }
                },
                teardown: function() {
                    var elem = $(this);

                    // Remove this element from the internal collection.
                    elems = elems.not(elem);

                    // Remove plugin data from this element.
                    elem.removeData('resize');

                    // If this is the last element to which the event was bound, cancel
                    // the polling loop.
                    if (!elems.length) {
                        clearTimeout(timeout_id);
                    }
                }
            };

            // As long as a "resize" event is bound, this function will execute
            // repeatedly.
            function poll() {

                // Iterate over all elements in the internal collection.
                elems.each(function() {
                    var elem = $(this),
                        width = elem.width(),
                        height = elem.height(),
                        data = elem.data('resize');

                    // If element size has changed since the last time, update the element
                    // data store and trigger the "resize" event.
                    if (width !== data.w || height !== data.h) {
                        data.w = width;
                        data.h = height;
                        elem.triggerHandler('resize');
                    }
                });

                // Poll, setting timeout_id so the polling loop can be canceled.
                timeout_id = setTimeout(poll, 250);
            };

        })(jQuery);

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
                                    $("#dispIcon").hide();
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
