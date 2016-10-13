<?php 

$this->title = 'Themes';
$this->params['breadcrumbs'][] = $this->title;		
?>

			
	<section class="theme-main content">
		<div class="action-qard">
			<button class="btn btn-default pull-left" onclick="location.href='<?php echo \Yii::$app->homeUrl?>/qard/select-template';"><i class="fa fa-chevron-left"></i>&nbsp;Select Template</button>
			<button class="btn btn-default pull-left" onClick="window.location = '<?php echo \Yii::$app->homeUrl?>/theme/create';"><i class="fa fa-chevron-left"></i>&nbsp;Create Theme</button>
			<h2>Select a Theme</h2>
        </div>		
		<!--<div class="action-qard">
			<button class="btn btn-warning">Back to Templates</button>
			<button class="btn btn-default qard" onClick="window.location = '<?php echo \Yii::$app->homeUrl?>/theme/create';">Create a New Theme</button>                        
		</div>-->
		<div class="themes-list">        <!-- qard list -->

			<div class="grid row">
			<?php
			$template = 'false';
			if(!isset($_REQUEST['q_id'])){
				$_REQUEST['q_id']='';
			}
			if($qard_id){
				$_REQUEST['q_id'] = $qard_id;
				$template = 'true';
			}
				
			
			foreach($models as $model){
				$theme_properties = unserialize($model->theme_properties);
				echo '<div class="grid-item qard-bg" id="'.$model->theme_id.'" data-qid="'.$_REQUEST['q_id'].'">     <!-- qard -->
						<div class="qard-content">
							<div class="themebg1">
								<div class="bgcolor" style="background:'.$theme_properties['theme_color_1'].'"></div>
							</div>
							<div class="themebg2">
								<div class="bgcolor" style="background:'.$theme_properties['theme_color_2'].'"></div>
							</div>
							<div class="themebg3">
								<div class="bgcolor" style="background:'.$theme_properties['theme_color_3'].'"></div>
							</div>
							<div class="themebg4">
								<div class="bgcolor" style="background:'.$theme_properties['theme_color_4'].'"></div>
							</div>
							<div class="themebg5">
								<div class="bgcolor" style="background:'.$theme_properties['theme_color_5'].'"></div>
							</div>                                      
						</div>
						<div class="qard-top">
							<h4>'.$model->theme_name.'</h4>
						</div>
					';
				if(\Yii::$app->user->id && \Yii::$app->user->identity->role == 'admin')
					echo '<button class="btn btn-default edit_theme" onClick="window.location = \''. \Yii::$app->homeUrl.'/theme/update?id='.$model->theme_id.'\';">Edit Theme</button>';
				echo "</div>";
				
			}?>
			</div>
		
     <!-- row  -->
		</div>      <!-- template list -->
		<!--<h4 style="margin-top: 30px;">Select a Theme</h4>-->
	</section>
	<script>
	$('.qard-bg').on('click',function(){
		var id = $(this).attr('id');
		var q_id = $(this).attr('data-qid');
		var template = <?=$template ?>;
		var deck_id ='';
		<?php if(isset($deck_id) && !empty($deck_id)){ ?>
			 deck_id = <?=$deck_id ?>;
		<?php } ?>
		
		if(q_id!=''){
			if(template ==true)
				window.location = '<?php echo \Yii::$app->homeUrl; ?>qard/edit-template?theme_id='+id+'&id='+q_id;				
			else
				window.location = '<?php echo \Yii::$app->homeUrl; ?>qard/edit?theme_id='+id+'&id='+q_id;
		}
		else{
			if($.trim(deck_id) != "")
			{
				window.location = '<?php echo \Yii::$app->homeUrl; ?>qard/deck-qard-theme?deck_id='+deck_id+'&theme_id='+id;
			}else{
			 window.location = '<?php echo \Yii::$app->homeUrl; ?>qard/create?theme_id='+id;
			}
		}
	});

	$(document).ready(function(){
		$('.themes-list .qard-content').hover(function(){
			$('.qard-content').removeClass('active');
			$(this).addClass('active');
		});               
	});


	</script>