<?php 
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\User;



$model = new User();
$login = $model->findByAuthKey($key);
	if ($login->username!='') {
		header('Location:http://localhost/qarddeck/web/site/login?type=valid',true);
	} else {
		header('Location:http://localhost/qarddeck/web/site/login?type=invalid',true);
	} 

?>
