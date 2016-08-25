	<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */

use yii\jui\AutoComplete;
use yii\web\JsExpression;
use app\models\Tag;

?>      
  
<?php

$data = Tag::find()
    ->select(['name as value', 'name as  label','tag_id as id'])
    ->asArray()
    ->all();
	
/* $data = [                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
    [                                                                                                                                                    
        "value" => "Val 1",                                                                                                                                
        "label" => "Label 1",
        "id" => 1
    ],
    [
        "value" => "Val 2",
        "label" => "Label 2",
        "id" => 2
    ]
];

 */
 

$serachval = Yii::$app->session->getFlash("searchval");		
$serachid = Yii::$app->session->getFlash("searchid");	

echo AutoComplete::widget([
	'name' => 'search',    
	'id' => 'search',	
	'value'=> $serachval,
	'options' => ['class' => 'form-control','placeholder'=>'Searchwe QardDeck'],
	'clientOptions' => [
		'source' => $data, 
		'autoFill'=>true,
		 'select' => new JsExpression("function( event, ui ) {
			$('#searchid').val(ui.item.id);
			window.location.href = '".\Yii::$app->homeUrl."qard/index?type=both&search='+ui.item.id+'';
			}")],
	 ]);
	 
	
	  
?> 
				
<input type="text" name="searchid" id="searchid" value="<?php echo $serachid; ?>"  >


<script>
$(document).ready(function(){
	$('#search').on('blur', function(e) {
		var serachval = $(this).val();						
		if($.trim(serachval) == "" )
		{
			$("#searchid").val('');
			window.location.href = '<?=Yii::$app->homeUrl?>qard/index?type=both';
		}	
	});
	
	$('#search').keypress(function (e) {
 var key = e.which;
 if(key == 13 || key == 8 )  // the enter and Backspace key code
  {
	var serachval = $(this).val();						
		if($.trim(serachval) == "" )
		{  
			$("#searchid").val('');
			window.location.href = '<?=Yii::$app->homeUrl?>qard/index?type=both';
		}
  }
});   

	
});
</script>
