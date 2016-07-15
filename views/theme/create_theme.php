<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Theme */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="<?=Yii::$app->homeUrl?>js/jscolor.min.js"></script>

<section class="create-theme">

	<div class="heading">
		<h3>Create a Theme</h3>
	</div>
	
	<div class="theme-admin">
		<div class="theme-main">
		<?php $form = ActiveForm::begin(    ['fieldConfig' => [
							'options' => [
								'class'=>'form-field'
							]
		]]); ?>
		<div class="form-group">	 
			<?= $form->field($model, 'theme_name', [
				'template' => "{label}\n{input}\n{hint}\n{error}"
			])->textInput(['class'=>'form-control','placeholder'=>'Add theme name']) ?>
			<!--<input type="text" name="theme name" placeholder="Add theme name">-->
		</div>          <!-- form-group  -->
			<hr class="divider"></hr>
			<div class="form-group">
				<label>Theme Colors</label>
				<ul class="theme-colors">
				<li class="themebg1">
				<?= $form->field($model, 'theme_color_1', [
							'template' => "{input}",
						])->input('',['class'=>"jscolor bgcolor color_field",'id'=>'theme_color_1']) ?>
						<!--<input type="color" name="theme_color_1" class="bgcolor color_field">
						<div><input id="theme_color_1_hex" type="text" value="#000000" class="hex_field"></div>-->
				</li>
				<li class="themebg1">
				<?= $form->field($model, 'theme_color_2', [
							'template' => "{input}",
						])->input('',['class'=>"jscolor bgcolor color_field",'id'=>'theme_color_2']) ?>
						<!--<input type="color" name="theme_color_1" class="bgcolor color_field">
						<div><input id="theme_color_2_hex" type="text" value="#000000" class="hex_field"></div>-->
				</li>
				<li class="themebg1">
				<?= $form->field($model, 'theme_color_3', [
							'template' => "{input}",
						])->input('',['class'=>"jscolor bgcolor color_field",'id'=>'theme_color_3']) ?>
						<!--<input type="color" name="theme_color_1" class="bgcolor color_field">
						<div><input id="theme_color_3_hex" type="text" value="#000000" class="hex_field"></div>-->
				</li>
				<li class="themebg1">
				<?= $form->field($model, 'theme_color_4', [
							'template' => "{input}",
						])->input('',['class'=>"jscolor bgcolor color_field",'id'=>'theme_color_4']) ?>
						<!--<input type="color" name="theme_color_1" class="bgcolor color_field">
						<div><input id="theme_color_4_hex" type="text" value="#000000" class="hex_field"></div>-->
				</li>
				<li class="themebg1">
				<?= $form->field($model, 'theme_color_5', [
							'template' => "{input}",
						])->input('',['class'=>"jscolor bgcolor color_field",'id'=>'theme_color_5']) ?>
						<!--<input type="color" name="theme_color_1" class="bgcolor color_field">
						<div><input id="theme_color_5_hex" type="text" value="#000000" class="hex_field"></div>-->
				</li>
				</ul>
			</div>
			<hr class="divider"></hr>
			<div class="form-group">
				<label>Text</label>
				<ul class="theme-text">

					<li class="light">
						<label>Light Text</label>
							<span class="pick-color">
								<?= $form->field($model, 'light_text_color', [
									'template' => "{input}",
								])->input('',['class'=>"jscolor color_field",'id'=>'light_text_color']) ?>
							</span>
					</li>
					<li class="dark">
						<label>Dark Text</label>
							<span class="pick-color">
								<?= $form->field($model, 'dark_text_color', [
									'template' => "{input}",
								])->input('',['class'=>"jscolor color_field",'id'=>'dark_text_color']) ?>	
							</span>							
					</li>
					<li class="link">
						<label>Light Link</label>
							<span class="pick-color">
								<?= $form->field($model, 'light_link_color', [
									'template' => "{input}",
								])->input('',['class'=>"jscolor color_field",'id'=>'light_link_color']) ?>	  
							</span>
					</li>
					<li class="link-dark">
						<label>Dark Link</label>
							<span class="pick-color">
								<?= $form->field($model, 'dark_link_color', [
									'template' => "{input}",
								])->input('',['class'=>"jscolor color_field",'id'=>'dark_link_color']) ?>	
							</span>
					</li>
				</ul>
			</div>
			<hr class="divider" style="margin-bottom:0;"></hr>
			<div class="row">
				<div class="col-sm-6 col-md-6">
					<label>Image</label>
					<ul class="theme-image">
						<li class="overlay">
							<label>Overlay Color</label>
							<span class="pick-color">
								<?= $form->field($model, 'overlay_color', [
									'template' => "{input}",
								])->input('',['class'=>"jscolor color_field",'id'=>'overlay_color']) ?>	
							</span>                                        
						</li>
						<li class="opacity">
							<label>Opacity</label>
								<?= $form->field($model,'overlay_opacity',[
									'template' => "{input}",
								])->dropDownList(['70'=>'70%','80'=>'80%','90'=>'90%'],['class'=>"form-control",'placeholder'=>"Overlay Opacity (%)"]); ?>	
						</li>
					</ul>
				</div>
				<div class="col-sm-6 col-md-6">
					<label>Block</label>
					<ul class="theme-block">
						<li class="bg">
							<label>Background</label>
							<span class="pick-color">
								<?= $form->field($model, 'block_background_color', [
									'template' => "{input}",
								])->input('',['class'=>"jscolor color_field",'id'=>'block_background_color']) ?>						
							</span>                                         
						</li>                                
					</ul>                                
				</div>                            
			</div>
			<div class="theme-footer">
				<div class="col-sm-6 col-md-6">
					<button class="btn btn-grey">Cancel</button>
				</div>
				<div class="col-sm-6 col-md-6">
					<div class="pull-right">
						<button  class="btn qard" data-toggle="modal" data-target="#myModaltheme">Preview</button>
						<button type="submit" name="preview" class="btn btn-warning">Save Theme</button>                                        
					</div>
				</div>                            
			</div> 
			<?php ActiveForm::end(); ?>			
		</div>

	</div>
</section>

<script>
$(function(){
	/**
	TO HANDLE UPDATE FUNCIONS
	**/
	$('.color_field').each(function(){
	   var id = $(this).attr('id');
       $('#'+id+'_hex').val($(this).val());		
	});
	$('sec[id=selected]').html($('#'+$('input[id=text_align]').val()).html());
	$('#bold').attr('class',$('#is_bold').val());
	$('#italics').attr('class',$('#is_italics').val());
	$('#underline').attr('class',$('#is_underline').val());
    $('.color_field').change(function(){
	   var id = $(this).attr('id');
       $('#'+id+'_hex').val($(this).val());
    });
    $('.hex_field').change(function(){
       $(this).parent('div').parent().find('input[type="color"]').val($(this).val());
    });
	$('#align-dropdown li a').click(function(){
		$('sec[id=selected]').html($(this).html());
		$('input[id=text_align]').val($(this).attr('id'));
	});
	
})
function updateInput(input){
	$('#is_'+$(input).attr('id')).val($(input).attr('class'));
}
</script>
