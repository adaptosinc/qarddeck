                <section class="template-main content">
                    
                    <div class="action-qard">
                        <h2>Select a Template</h2>
						
                        <button class="btn btn-warning active" id="stdtemp">Standard Templates</button>
					
                        <button class="btn btn-grey " id="mytemp">My Templates</button>
					
                    </div>
					
				 <div id="wait" style="display:none" class="waiting_logo"><img src='<?=Yii::$app->request->baseUrl?>/img/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
				 
                   
					<!----------------- Standard Template --------------------->
					
							<div  class="templates-list container" id="standardtemp" >
                   
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 350, "gutter": 45 }'>

					<!--<div class="grid-item" id="blank" >                             
									<div class="qard-content">
                                    
									</div>
									<div class="qard-top">
                                    <h4>Admin Blank Canvas</h4>
									
									<p>&nbsp;</p>
									<p>&nbsp;</p>
									
										
									</div>                                 
                            </div> -->
							
							
							 
							
										<?php  
						if(isset($adminqards) && !empty($adminqards))
						{							
							foreach($adminqards as $model){
								$theme= $model->qardTheme;
								$theme_properties = unserialize($theme['theme_properties']);
								$str = '<div class="grid-item" id="'.$model->qard_id.'"><div id="add-block'.$model->qard_id.'" class="qard-content qardclick" for="'.$model->qard_id.'" >';
								$blocks = $model->blocks;
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
											if(!isset($theme['data_img_type']))
												$theme['data_img_type'] = "preview";
										//img block styles
											//$img_block_style .= 'opacity:'.$theme['image_opacity'].';';
											if($block->link_image != '' && ($theme['data_img_type'] == 'background' || $theme['data_img_type'] == 'both')){
													
													$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
													$img_block_style .= 'background-size: cover;';
													$data_img_url = \Yii::$app->homeUrl.'uploads/block/'.$block->link_image;
											}
											if($theme['div_bgcolor'] != '')
												$img_block_style .= 'background-color:'.$theme['div_bgcolor'].';';	
											$img_block_style .= 'min-height:'.$theme['height'].'px;';
											$img_block_style .= 'height:auto;';
											
										//overlay block styles
											if($block->link_image != '' && ($theme['data_img_type'] == 'background' || $theme['data_img_type'] == 'both')){
												$opacity = $theme_properties['overlay_opacity']/100;
												//$overlay_block_style .= 'opacity:'.$opacity.';';
												//if(isset($theme['div_overlaycolor']) && $theme_properties['div_overlaycolor']!='')
													$overlay_block_style .= 'background-color:'.$theme_properties['overlay_color'].';';								
												
											}
											$overlay_block_style .= 'min-height:'.$theme['height'].'px;';
											$overlay_block_style .='height:auto;';
											
											$text_block_style .= 'min-height:'.$theme['height'].'px;';
											$text_block_style .='overflow:hidden;';
											$text_block_style .='height:auto;';
											$text_block_style .='text-align: left !important;';
									}
									///////////////////////////
									if(!isset($theme['data_style_qard']))
										$theme['data_style_qard'] = 'line';
									$str .= '<div class="bgimg-block '.$theme['data_style_qard'].'" style="'.$img_block_style.'" >
									<div class="bgoverlay-block" style="'.$overlay_block_style.'">
									<div class="text-block" style="'.$text_block_style.'" data-block-id="'.$block->block_id.'">';
									$str .= $block->text;
									$str .= '</div></div></div>';

								}	}
								$str .= '		</div>
								';	
								echo $str;
								echo '<div class="qard-top">
										<h4>'.$model->title.'</h4>
										<p><i class="fa fa-clock-o"></i>&nbsp; 2 min to create</p>
										<button class="btn btn-sm" data-toggle="modal" data-target="#myModaldiva">Qard Details</button>
									</div></div>  ';
							}
						} else {
							?>
							<div class="grid-item" id="blank" >                             
									
									<div class="qard-top">
                                    <h4>Sry, No More Templates!!!.</h4>
									
									<p style='height: 180px;'></p>
									
									
										
									</div>                                 
                            </div>
							
							<?php 
						}
										?>
									</div>
								</div>
								</div>
								</div>
								
			<!----------------- My Template --------------------->
			
							<div  class="templates-list container" id="mylisttemp" style="display:none" >
                   
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 350, "gutter": 45 }'>

							<div class="grid-item" id="blank" style="top:50px" >                             
									<div class="qard-content">
                                    
									</div>
									<div class="qard-top">
                                    <h4>Canvas</h4>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
										
									</div>                                 
                            </div>  
							
										<?php  
								if(isset($qards) && !empty($qards))
									{					
								foreach($qards as $model){
								$theme= $model->qardTheme;
								$theme_properties = unserialize($theme['theme_properties']);
								$str = '<div class="grid-item" id="'.$model->qard_id.'"><div id="add-block'.$model->qard_id.'" class="qard-content qardclick" for="'.$model->qard_id.'" >';
								$blocks = $model->blocks;
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
											if(!isset($theme['data_img_type']))
												$theme['data_img_type'] = "preview";
										//img block styles
											//$img_block_style .= 'opacity:'.$theme['image_opacity'].';';
											if($block->link_image != '' && ($theme['data_img_type'] == 'background' || $theme['data_img_type'] == 'both')){
													
													$img_block_style .= 'background-image:url('.\Yii::$app->homeUrl.'uploads/block/'.$block->link_image.');';
													$img_block_style .= 'background-size: cover;';
													$data_img_url = \Yii::$app->homeUrl.'uploads/block/'.$block->link_image;
											}
											if($theme['div_bgcolor'] != '')
												$img_block_style .= 'background-color:'.$theme['div_bgcolor'].';';	
											$img_block_style .= 'min-height:'.$theme['height'].'px;';
											$img_block_style .= 'height:auto;';
											
										//overlay block styles
											if($block->link_image != '' && ($theme['data_img_type'] == 'background' || $theme['data_img_type'] == 'both')){
												$opacity = $theme_properties['overlay_opacity']/100;
												//$overlay_block_style .= 'opacity:'.$opacity.';';
												//if(isset($theme['div_overlaycolor']) && $theme_properties['div_overlaycolor']!='')
													$overlay_block_style .= 'background-color:'.$theme_properties['overlay_color'].';';								
												
											}
											$overlay_block_style .= 'min-height:'.$theme['height'].'px;';
											$overlay_block_style .='height:auto;';
											
											$text_block_style .= 'min-height:'.$theme['height'].'px;';
											$text_block_style .='overflow:hidden;';
											$text_block_style .='height:auto;';
											$text_block_style .='text-align: left !important;';
									}
									///////////////////////////
									if(!isset($theme['data_style_qard']))
										$theme['data_style_qard'] = 'line';
									$str .= '<div class="bgimg-block '.$theme['data_style_qard'].'" style="'.$img_block_style.'" >
									<div class="bgoverlay-block" style="'.$overlay_block_style.'">
									<div class="text-block" style="'.$text_block_style.'" data-block-id="'.$block->block_id.'">';
									$str .= $block->text;
									$str .= '</div></div></div>';

								}	}
								$str .= '		</div>
								';	
								echo $str;
								echo '<div class="qard-top">
										<h4>'.$model->title.'</h4>
										<p><i class="fa fa-clock-o"></i>&nbsp; 2 min to create</p>
										<a class="btn btn-sm removetmp"  id="'.$model->qard_id.'"><i class="fa fa-trash"></i>&nbsp; Remove</a>
									</div></div>  ';
							}
							
									}			?>
									</div>
								</div>
								</div>
			</div>
					
					
                 
                </section>
<script>
$(".qardclick").on("click",function(){
	$("#wait").show();
	var id=$(this).attr('for');
	console.log(id);
	window.location = '<?php echo \Yii::$app->homeUrl; ?>qard/select-template?selected='+id;
});

$("#stdtemp").on("click",function(){
	$(this).addClass("active");
	$("#mytemp").removeClass("active");
	$("#standardtemp").show();
	$("#mylisttemp").hide();		
});

$("#mytemp").on("click",function(){
	$(this).addClass("active");
	$("#stdtemp").removeClass("active");
	$("#mylisttemp").show();
	$("#standardtemp").hide();		
});

 <?php if(isset($_GET['page'])){ ?> 
 $( "#mytemp" ).trigger( "click" );
 <?php  } ?>
 
$(".removetmp").on("click",function(){
	
	var qardid = $(this).attr('id');	
	var rm1 = confirm("Do You Want to Remove this Templete?");
	if(rm1 == true)
	{
		var rm2 = confirm("One More confirmation to Remove this Templete?");
		if(rm2 == true)
		{			
			$.ajax({
				  url: "<?=\Yii::$app->homeUrl?>qard/tempdelete",
				  type: 'POST',
				  data: { 'qardid':qardid },				  
				  success:function(data){
						alert(data);
						 // return false;
						 window.location = '<?php echo \Yii::$app->homeUrl; ?>qard/select-template?page=mytemplate';
						
					}
				  });
				
				 //return false;  
				  
		} else {
			return false;
		}
	
	} else {
		return false;
	}
});
</script>
<style>
.grid-item { width: 350px; margin-left: 15px;}

.waiting_logo {
    background: rgba(0, 0, 0, 0.6) none repeat scroll 0 0;
    border: 1px solid black;
    display: none;
    height: 100%;
    left: 0;
    min-height: 990px;
    padding-top: 30%;
    position: absolute;
    text-align: center;
    top: 0;
    width: 100%;
    z-index: 50;
}

</style>
