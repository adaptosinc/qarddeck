
<link href="<?= Yii::$app->request->baseUrl?>/css/select2.css" rel="stylesheet">
<select class="js-example-basic-multiple" multiple="multiple">
  <option value="AL">Alabama</option>
  <option value="WY">Wyoming</option>
</select>
<script src="<?= Yii::$app->request->baseUrl?>/js/select2.js" type="text/javascript"></script>

<script type="text/javascript">
$(".js-example-basic-multiple").select2();
</script>