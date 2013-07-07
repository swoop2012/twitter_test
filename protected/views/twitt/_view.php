<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo Yii::app()->dateFormatter->format('y-MMMM-d HH:mm',$data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('retweet_count')); ?>:</b>
	<?php echo CHtml::encode($data->retweet_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('favorite_count')); ?>:</b>
	<?php echo CHtml::encode($data->favorite_count); ?>
	<br />


</div>