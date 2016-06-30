<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<section class="main-profile">
	<!--<ul class="profile-title desktop-view">
		<li><h4>Latest from QardDeck</h4></li>
	</ul>-->
	<ul class="profile-title mobile-page">
		<li><h4>Latest from QardDeck</h4></li>
		<li class="pull-right">
			<ul>
				<li><button class="btn btn-default signin">Qards</button></li>
				<li><button class="btn btn-default">Decks</button></li>
			</ul>
		</li>
	</ul>                    
	
	<div class="main-content">
		<div class="popular-qards">     <!-- popular qard list -->
			<div class="row">
				<div class="col-sm-12 col-md-12" >
					<div class="grid">
						<?php  
							echo $feed;
						?>
					</div>
				</div>
				<div class="col-sm-3 col-md-3">
					<div class="featured-tags">     <!--featured tags -->
						<h4>Featured Tags</h4>
						<button class="btn btn-default">Tag</button>
					</div>
						<!--<div class="sidebar-qard">      side qard 
							<div class="qard-content">
								
							</div>
							<div class="qard-bottom">
								<ul class="qard-tags">
									<li class="pull-left">#tag#tag#tag</li>
									<li class="pull-right">x days ago</li>
								</ul>
								<h4>Author Full name</h4>
								<ul class="social-list">
									<li><a href="">20<img src="images/newqard.png" height="50px" alt=""></a></li>
									<li><a href=""><img src="images/heart.png" alt=""><br />500</a></li>                                                    
									<li><a href=""><img src="images/certify.png" alt=""><br />500</a></li>
									<li><a href=""><img src="images/share.png" alt=""><br />500</a></li>
								</ul>
							</div>                                           
						</div> -->                                    
				</div>
			</div>          <!-- row -->
		</div>
	</div>

</section>
<p id="loading" align="center" >
	<img src="<?php echo \Yii::$app->homeUrl; ?>images/loading.gif" width="100px" height="100px" alt="Loading…" />
</p>
<script>
/* $('#save').on('click',function(){
	var dataUrl = document.getElementById('save').toDataURL("image/png");
	console.log(dataUrl);
    html2canvas([document.getElementById('save')], {
		onrendered: function (canvas) {
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
		}).done(function(respond){
				console.log(respond);
			//$("#save").html("Uploaded Canvas image link: <a href="+respond+">"+respond+"</a>").hide().fadeIn("fast");
		});

	  }
	});
	
}); */
$(document).ready(function() {
	var win = $(window);
	var page = 1;
	// Each time the user scrolls
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
			$('#loading').show();
			$.ajax({
				url: '<?=Url::to(['qard/index'], true);?>',
				dataType: 'html',
				data: {'page':page},
				success: function(html) {
					console.log(page);
					$('.grid').append(html);
					$('#loading').hide();
				}
			});
			page = page+1;
		}
	});
	$('.social-list li a').on('click',function(){
		console.log($(this).attr('act-type'));
			$.ajax({
				url: '<?=Url::to(['qard/activity'], true);?>',
				dataType: 'html',
				type : 'GET',
				data: {'id':$(this).attr('act-id'),'type':$(this).attr('act-type')},
				success: function(response) {
					console.log(response);
				}
			});
	});
	$('.qard-content').on('click',function(){
		var data_id = $(this).attr('id');
		var id = data_id.replace("qard", "");
		var url = '<?=Url::to(['qard/consume'], true);?>';
		window.location.href = url+"?qard_id="+id;
	});
});

</script>