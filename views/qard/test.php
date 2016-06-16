
<!--<link href="<?= Yii::$app->request->baseUrl?>/css/select2.css" rel="stylesheet">
<select class="js-example-basic-multiple" multiple="multiple">
  <option value="AL">Alabama</option>
  <option value="WY">Wyoming</option>
</select>
<script src="<?= Yii::$app->request->baseUrl?>/js/select2.js" type="text/javascript"></script>

<script type="text/javascript">
$(".js-example-basic-multiple").select2();
</script>-->

<link href="<?= Yii::$app->request->baseUrl?>/css/custom.css" rel="stylesheet">
 <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
<!--<script src="<?= Yii::$app->request->baseUrl?>/js/jquery-ui.js" type="text/javascript"></script>-->
<!--<script src="<?= Yii::$app->request->baseUrl?>/js/attrchange_ext.js" type="text/javascript"></script>-->
<!--<script src="<?= Yii::$app->request->baseUrl?>/js/attrchange.js" type="text/javascript"></script>-->
<style>
    #resizable{
	width: 300px;
	/*min-height: 100px;*/
	/*max-height: 300px;*/
	
    }
</style>
  <script>
  $(function() {
//    $( "#working_div .current_blk" ).resizable({
//	containment: "#add-block",
//	handles: 's'
////	ghost: true
//	
//    });
    $(document).delegate("#working_div .current_blk","mouseup",function(){
	console.log("vijay");
    });
    var i = 0;
var dragging = false;
   $('#working_div .current_blk').mousedown(function(e){
       e.preventDefault();
       
       dragging = true;
       var main = $('#working_div .current_blk');
       var ghostbar = $('<div>',
                        {id:'ghostbar',
                         css: {
                                height: main.outerHeight(),
                                top: main.offset().top,
                                left: main.offset().left
                               }
                        }).appendTo('body');
       
        $(document).mousemove(function(e){
          ghostbar.css("left",e.pageX+2);
       });
       
    });

   $(document).mouseup(function(e){
       if (dragging) 
       {
           var percentage = (e.pageX / window.innerWidth) * 100;
           var mainPercentage = 100-percentage;
           
           $('#console').text("side:" + percentage + " main:" + mainPercentage);
           
           $('#working_div .current_blk').css("height",percentage + "%");
//           $('#main').css("width",mainPercentage + "%");
           $('#ghostbar').remove();
           $(document).unbind('mousemove');
           dragging = false;
       }
    });
  });
  
  
  </script>


<section class="create-card">
        
        <div class="row">

            <div class="col-sm-4 col-md-4">
                <div id="add-block" class="qard-div add-block">
                
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
                                    <div class="text-block current_blk" data-height="1" contenteditable="true" unselectable="off" data-block_priority="1"></div>
                                </div>
                            </div>
			    <!--<div id="dragbar"></div>-->
                        </div>
                        <h4 class="add-another" onclick="add_block(event)">Add another block <span><img src="<?=Yii::$app->request->baseUrl?>/images/add.png" alt="add"></span></h4>
                </div>
            </div>
            <div class="col-sm-8 col-md-8">
		<div class="clearfix">
		    <div id="sidebar">
			 <span id="position"></span>
			
			sidebar
		    </div>
		    <!--<div id="dragbar"></div>-->
		    <div id="main">
			main
		    </div>
		    </div>
		    <div id="console"></div>
	    </div>
	</div>
</section>
  
  

<style>
.clearfix:after {
    content: '';
    display: table;
    clear: both;
}
.clearfix{
    width: 300px;
    height: 600px
}

#main{
   background-color: BurlyWood;
   float: right;
   height:200px;
    width: 300px;
}
#sidebar{
   background-color: IndianRed;
   width:300px;
   float: left;
   height:200px;
   overflow-y: hidden;
   cursor: row-resize;
}

/*#dragbar{
   background-color:black;
   height:3px;
   float: right;
   width: 100%;
   cursor: row-resize;
}*/
#ghostbar{
    width:3px;
    background-color:#000;
    opacity:0.5;
    position:absolute;
    cursor: row-resize;
    z-index:999}
</style>
<script>
   var i = 0;
var dragging = false;
   $('#sidebar').mousedown(function(e){
       e.preventDefault();
       
       dragging = true;
       var main = $('.clearfix');
       
       console.log("top"+main.offset().top);
        console.log("left"+main.offset().bottom);
       
//       var ghostbar = $('<div>',
//                        {id:'sidebar',
//                         css: {
//                                width: main.outerWidth(),
//                                top: main.offset().top,
//                                bottom: main.offset().bottom
//                               }
//                        }).appendTo('body');
//       
//        $(document).mousemove(function(e){
//          ghostbar.css("bottom",e.pageY+2);
//       });
       
    });

   $(document).mouseup(function(e){
       if (dragging) 
       {
	   
	   console.log("x="+e.pageY+"height"+window.innerHeight);
//           var percentage = (e.pageY / window.innerHeight) * 100;
           var percentage = (e.pageY-148);
	   console.log("x="+percentage);
           var mainPercentage = 100-percentage;
           
           $('#console').text("side:" + percentage + " main:" + mainPercentage);
           
           $('#sidebar').css("height",percentage + "px");
//           $('#main').css("height",mainPercentage + "px");
//           $('#ghostbar').remove();
           $(document).unbind('mousemove');
           dragging = false;
       }
    });

</script>