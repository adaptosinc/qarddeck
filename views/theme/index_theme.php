<?php 

$this->title = 'Themes';
$this->params['breadcrumbs'][] = $this->title;

?>

	<section class="home-main content">
		
		<div class="action-qard">
			<button class="btn btn-warning">Back to Templates</button>
			<button class="btn btn-default qard">Create a New Theme</button>                        
		</div>
		<div class="themes-list">        <!-- qard list -->
		<div class="container">
			<div class="row">
			<?php
			$i = 0;
			foreach($models as $model){
				$theme_properties = unserialize($model->theme_properties);
				$class = '';

				echo '<div class="qard-bg col-sm-2 col-md-2 '.$class.'">     <!-- qard -->
						<div class="qard-top">
							<h4>'.$model->theme_name.'</h4>
						</div>
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
					</div>';
					$i++;
				
			}?>
			</div>
		</div>
     <!-- row  -->
		</div>      <!-- template list -->
		<h4 style="margin-top: 30px;">Select a Theme</h4>
	</section>