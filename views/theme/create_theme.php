<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Theme */
/* @var $form yii\widgets\ActiveForm */
?>
<section class="page-main content">
	<div class="create-theme">
	<?php $form = ActiveForm::begin(    ['fieldConfig' => [
                        'options' => [
                            'class'=>'form-field'
                        ]
    ]]); ?>
		<div class="form-group">
			<label>Theme Name</label>		 
			<?= $form->field($model, 'theme_name', [
				'template' => "{input}\n{hint}\n{error}"
			])->textInput(['placeholder'=>'Add theme name']) ?>
			<!--<input type="text" name="theme name" placeholder="Add theme name">-->
		</div>          <!-- form-group  -->
		<div class="form-group">
			<label>Theme Colors</label>
			<div class="themebg">
				<ul>
					<li class="themebg1">
						<?= $form->field($model, 'theme_color_1', [
							'template' => "{input}",
						])->input('color',['class'=>"bgcolor color_field",'id'=>'theme_color_1']) ?>
						<!--<input type="color" name="theme_color_1" class="bgcolor color_field">-->
						<div><input id="theme_color_1_hex" type="text" value="#000000" class="hex_field"></div>
					</li>
					<li class="themebg2">
						<?= $form->field($model, 'theme_color_2', [
							'template' => "{input}",
						])->input('color',['class'=>"bgcolor color_field",'id'=>'theme_color_2']) ?>
						<!--<input type="color" name="theme_color_1" class="bgcolor color_field">-->
						<div><input id="theme_color_2_hex" type="text" value="#000000" class="hex_field"></div>
					</li>
					<li class="themebg3">
						<?= $form->field($model, 'theme_color_3', [
							'template' => "{input}",
						])->input('color',['class'=>"bgcolor color_field",'id'=>'theme_color_3']) ?>
						<!--<input type="color" name="theme_color_1" class="bgcolor color_field">-->
						<div><input id="theme_color_3_hex" type="text" value="#000000" class="hex_field"></div>
					</li>
					<li class="themebg4">
						<?= $form->field($model, 'theme_color_4', [
							'template' => "{input}",
						])->input('color',['class'=>"bgcolor color_field",'id'=>'theme_color_4']) ?>
						<!--<input type="color" name="theme_color_1" class="bgcolor color_field">-->
						<div><input id="theme_color_4_hex" type="text" value="#000000" class="hex_field"></div>
					</li>
					<li class="themebg5">
						<?= $form->field($model, 'theme_color_5', [
							'template' => "{input}",
						])->input('color',['class'=>"bgcolor color_field",'id'=>'theme_color_5']) ?>
						<!--<input type="color" name="theme_color_1" class="bgcolor color_field">-->
						<div><input id="theme_color_5_hex" type="text" value="#000000" class="hex_field"></div>
					</li>
					<!--<li class="themebg2">
						<input type="color" name="theme_color_2" class="bgcolor color_field">
						<div><input type="text" value="#000000" class="hex_field"></div>

					</li>
					<li class="themebg3">
						<input type="color" name="theme_color_3" class="bgcolor color_field">
						<div><input type="text" value="#000000" class="hex_field"></div>
					</li>
					<li class="themebg4">
						<input type="color" name="theme_color_4" class="bgcolor color_field">
						<div><input type="text" value="#000000" class="hex_field"></div>
					</li>
					<li class="themebg5">
						<input type="color" name="theme_color_5" class="bgcolor color_field">
						<div><input type="text" value="#000000" class="hex_field"></div>
					</li>-->                                    
				</ul>
			</div>
		</div>          <!-- form-group  -->
		<div class="form-group">
			<label>Fonts</label>
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<ul class="text-elements">
						<li><a id="bold" onClick="$(this).toggleClass('on');updateInput(this)">B</a></li>
						<li><a id="italics" onClick="$(this).toggleClass('on');updateInput(this)"><i>I</i></a></li>
						<li class="underline"><a id="underline" onClick="$(this).toggleClass('on');updateInput(this)">U</a></li>
					</ul>
					<?= Html::activeHiddenInput($model, 'is_bold', ['id'=>'is_bold']); ?>
					<?= Html::activeHiddenInput($model, 'is_italics', ['id'=>'is_italics']); ?>
					<?= Html::activeHiddenInput($model, 'is_underline', ['id'=>'is_underline']); ?>

					<ul class="align-elements">
						<li>
							<div class="dropdown">
								<button id="align_list" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <sec id="selected"><a id="justify"><i class="fa fa-align-justify"></i></a></sec>
								  <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="align_list" id="align-dropdown">
								  <li><a id="justify"><i class="fa fa-align-justify"></i></a></li>
								  <li><a id="center"><i class="fa fa-align-center"></i></a></li>
								  <li><a id="left"><i class="fa fa-align-left"></i></a></li>
								  <li><a id="right"><i class="fa fa-align-right"></i></a></li>
								</ul>
							</div>
						</li>
						<li>
						<?= $form->field($model, 'text_color', [
							'template' => "{input}",
						])->input('color',['class'=>"fa fa-font align_icon",'id'=>'text_color']) ?>						
						<!--<input type="color" id="text_color" name="text_color" class="fa fa-font align_icon"></li>-->
						<li><i class="fa fa-indent align_icon"></i></li>
					</ul> 
					<?= Html::activeHiddenInput($model, 'text_align', ['id'=>'text_align']); ?>				
				</div>      <!-- /div  -->
				<div class="col-sm-4 col-md-4">
					<?= $form->field($model,'font_style',[
						'template' => "{input}",
					])->textInput(['class'=>"form-control",'placeholder'=>"Font (Roboto)"]); ?>
					<!--<input type="text" name="size" class="form-control" placeholder="Font (Roboto)">-->
				</div>      <!-- /div  -->
				<div class="col-sm-4 col-md-4">
					<ul class="font-elements">
						<li>
							<span>Light Text</span>
							<!--<input type="color" name="light_text" class="color_field">-->
							<?= $form->field($model, 'light_text_color', [
								'template' => "{input}",
							])->input('color',['class'=>"color_field",'id'=>'light_text_color']) ?>
							<div><input type="text" id="light_text_color_hex" value="#000000" class="hex_field"></div>
						</li>
						<li>
							<span>Dark Text</span>
							<!--<input type="color" name="dark_text" class="color_field">-->
							<?= $form->field($model, 'dark_text_color', [
								'template' => "{input}",
							])->input('color',['class'=>"color_field",'id'=>'dark_text_color']) ?>							
							<div><input type="text" id="dark_text_color_hex" value="#000000" class="hex_field"></div>
						</li>                                        
						<li>
							<span>Light Link</span>
							<?= $form->field($model, 'light_link_color', [
								'template' => "{input}",
							])->input('color',['class'=>"color_field",'id'=>'light_link_color']) ?>							
							<div><input type="text" id="light_link_color_hex" value="#000000" class="hex_field"></div>
						</li>
						<li>
							<span>Dark Link</span>
							<?= $form->field($model, 'dark_link_color', [
								'template' => "{input}",
							])->input('color',['class'=>"color_field",'id'=>'dark_link_color']) ?>							
							<div><input type="text" id="dark_link_color_hex" value="#000000" class="hex_field"></div>
						</li>                                        
					</ul>                                    
				</div>      <!-- /div  -->                                
			</div>
		</div>      <!-- form-group  -->
		<div class="form-group">
			<label>Image</label>
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="font-elements col-sm-2 col-md-2">
						<span><strong>Overlay</strong></span>
						<!--<input type="color" name="overlay" class="color_field" >
						<div><input type="text" value="#000000" class="hex_field"></div>-->
						<?= $form->field($model, 'overlay_color', [
							'template' => "{input}",
						])->input('color',['class'=>"color_field",'id'=>'overlay_color']) ?>							
						<div><input type="text" id="overlay_color_hex" value="#000000" class="hex_field"></div>
					</div>
					<div class="col-sm-3 col-md-3">
					<?= $form->field($model,'overlay_opacity',[
						'template' => "{input}",
					])->textInput(['class'=>"form-control",'placeholder'=>"Overlay Opacity (%)"]); ?>
						<!--<input type="text" name="opacity" placeholder="Overlay Opacity (%)">-->
					</div>
					<div class="col-sm-6 col-md-6">
						<ul class="font-elements">
							<li>
								<span>Block Background</span>
								<?= $form->field($model, 'block_background_color', [
									'template' => "{input}",
								])->input('color',['class'=>"color_field",'id'=>'block_background_color']) ?>							
								<div><input type="text" id="block_background_color_hex" value="#000000" class="hex_field"></div>
							</li>
							<li>
								<span>Element highlight Color (icons, buttons, etc.)</span>
								<?= $form->field($model, 'element_highlight_color', [
									'template' => "{input}",
								])->input('color',['class'=>"color_field",'id'=>'element_highlight_color']) ?>							
								<div><input type="text" id="element_highlight_color_hex" value="#000000" class="hex_field"></div>
							</li>                                                                                
						</ul>                                        
					</div>
				</div>
			</div>
		</div>              <!-- form-group  -->
		<div class="form-group">
			<ul class="pull-right">
				<li><button class="btn btn-md btn-default" name="cancel">Cancel</button></li>
				<li><button type="submit" class="btn btn-md btn-default" name="preview">Save</button></li>
			</ul>
		</div>
	<?php ActiveForm::end(); ?>
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
