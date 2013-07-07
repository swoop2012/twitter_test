<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Парсинг пользователя';
$this->breadcrumbs=array(
	'Парсинг пользователя',
);
?>
<p>Пожалуйста, заполните данные:</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны.</p>

	<?php echo $form->textFieldRow($model,'username'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Получить информацию',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
