<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <link href="https://fonts.googleapis.com/css?family=Limelight|Flamenco|Federo|Yesteryear|Josefin Sans|Spinnaker|Sansita One|Handlee|Droid Sans|Oswald:400,300,700" media="screen" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
    
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
    <?php Yii::app()->clientScript->registerCss('scrollingblock','.line-box {
	width: 600px;
}
.line-box {
	background: #eee;
	overflow: hidden;
	margin: -5px 0 20px;
	padding: 5px 0;
	width: 100%;
}
.line-box .line-wrap {
	width: 99999px;
	float: left;
}
.line-box p {
	margin: 0 5px 0 0;
}');
?>

</head>

<body>
<div class="container" id="page">
<div class="well">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
</div>
	<div class="clear"></div>

</div><!-- page -->

</body>
</html>
