<?php
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
require(dirname(__FILE__) . '/../../../framework/YiiBase.php');
class Yii extends YiiBase {
    /**
     * @static
     * @return CWebApplication
     */
    public static function app()
    {
        return parent::app();
    }
}

$config=dirname(__FILE__).'/protected/config/main.php';
header("Content-type: text/html; charset=utf-8");
Yii::createWebApplication($config)->run();
