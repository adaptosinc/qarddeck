<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
   
    public $css = [
	'font-awesome/css/font-awesome.css',
	//'css/html5imageupload.css',
	'css/master.css',
	'css/fonts.css',
    ];
    public $jsOptions = [
	'position' => \yii\web\view::POS_HEAD,
    ];
    public $js = [
	'js/bootstrap.min.js',
	'js/html2canvas.js',	
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
