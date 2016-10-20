                <section class="template-main content">
                    
                    <div class="action-qard">
                        <h2>Select a Template</h2>
						
                        <button class="btn btn-warning active" id="stdtemp">Standard Templates</button>
					
                        <button class="btn btn-grey " id="mytemp">My Templates</button>
					
                    </div>
					
				
                    
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
								$str = '<div class="grid-item" id="'.$model->qard_id.'"><div id="add-block'.$model->qard_id.'" class="qard-content">';
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
								$str = '<div class="grid-item" id="'.$model->qard_id.'"><div id="add-block'.$model->qard_id.'" class="qard-content">';
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
							
									}			?>
									</div>
								</div>
								</div>
			</div>
					
					
                 
                </section>
<script>
$(".grid-item").on("click",function(){
	var id=$(this).attr('id');
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

</script>
<style>
.grid-item { width: 350px; margin-left: 15px;}
</style>
