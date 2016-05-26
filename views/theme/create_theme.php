<?php 
use kartik\color\ColorInput;

?>
<section class="page-main content">
	<div class="create-theme">
		<div class="form-group">
			<label>Theme Name</label>
			<input type="text" name="theme name" placeholder="Add theme name">
		</div>          <!-- form-group  -->
		<div class="form-group">
			<label>Theme Colors</label>
			<div class="themebg">
				<ul>
					<li class="themebg1">
						<input type="color" class="bgcolor color_field">
						<p>#000000</p>
					</li>
					<li class="themebg2">
						<input type="color" class="bgcolor color_field">
						<p>#000000</p>

					</li>
					<li class="themebg3">
						<input type="color" class="bgcolor color_field">
						<p>#000000</p>
					</li>
					<li class="themebg4">
						<input type="color" class="bgcolor color_field">
						<p>#000000</p>
					</li>
					<li class="themebg5">
						<input type="color" class="bgcolor color_field">
						<p>#000000</p>
					</li>                                    
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
					<input type="text" id="is_bold">
					<input type="text" id="is_italics">
					<input type="text" id="is_underline">
					<ul class="align-elements">
						<li>
							<div class="dropdown">
								<button id="align_list" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <img src="<?php echo \Yii::$app->homeUrl; ?>images/icon-left.png" alt="">
								  <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="align_list">
								  <li><a href="#"><i class="fa fa-align-justify"></i></a></li>
								  <li><a href="#"><i class="fa fa-align-center"></i></a></li>
								  <li><a href="#"><i class="fa fa-align-left"></i></a></li>
								  <li><a href="#"><i class="fa fa-align-right"></i></a></li>
								</ul>
							</div>
						</li>
						<li><a href="#"><img src="<?php echo \Yii::$app->homeUrl; ?>images/fonts.png" alt=""></a></li>
						<li><a href="#"><img src="<?php echo \Yii::$app->homeUrl; ?>images/leftalign.png" alt=""></a></li>
					</ul>                                    
				</div>      <!-- /div  -->
				<div class="col-sm-4 col-md-4">
					<input type="text" name="size" class="form-control" placeholder="Font (Roboto)">
				</div>      <!-- /div  -->
				<div class="col-sm-4 col-md-4">
					<ul class="font-elements">
						<li>
							<span>Light Text</span>
							<input type="color" name="light_text" class="color_field">
							<p>#000000</p>
						</li>
						<li>
							<span>Dark Text</span>
							<input type="color" name="dark_text" class="color_field">
							<p>#000000</p>
						</li>                                        
						<li>
							<span>Light Link</span>
							<input type="color" name="light_link" class="color_field">
							<p>#000000</p>
						</li>
						<li>
							<span>Dark Link</span>
							<input type="color" name="dark_link" class="color_field">
							<p>#000000</p>
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
						<input type="color" name="overlay" class="color_field" >
						<p>#000000</p>
					</div>
					<div class="col-sm-3 col-md-3">
						<input type="text" name="opacity" placeholder="Overlay Opacity (%)">
					</div>
					<div class="col-sm-6 col-md-6">
						<ul class="font-elements">
							<li>
								<span>Block Background</span>
								<input type="color" name="block_background" class="color_field">
								<p>#000000</p>
							</li>
							<li>
								<span>Element highlight Color (icons, buttons, etc.)</span>
								<input type="color" name="element_highlight_color" class="color_field">
								<p>#000000</p>
							</li>                                                                                
						</ul>                                        
					</div>
				</div>
			</div>
		</div>              <!-- form-group  -->
		<div class="form-group">
			<ul class="pull-right">
				<li><button class="btn btn-md btn-default" name="cancel">Cancel</button></li>
				<li><button class="btn btn-md btn-default" name="preview">Save</button></li>
			</ul>
		</div>
	</div>
</section>
<script>
$(function(){
    $('.color_field').change(function(){
       $(this).next('p').html($(this).val());
    })
})
function updateInput(input){
	//console.log($(input).attr('class'));
	$('#is_'+$(input).attr('id')).val($(input).attr('class'));
}
</script>
