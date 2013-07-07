<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
if($validated)
    $this->widget('ext.User.UserWidget',array('user'=>$model->result));
    $this->renderPartial('_twitter_user_form',compact('model'));
?>
<?php if($validated):?>
<div id='ajax-content' style="display:none">
    <h3>Ожидайте, идёт выгрузка твиттов</h3>
    <?php echo CHtml::image('/images/ajax-loader.gif');?>
</div>
<?php endif;?>

