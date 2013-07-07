<?php
$this->breadcrumbs=array(
	'Твитты',
);
?>

<h1>Твитты по запросу: <?php echo CHtml::encode($q);?></h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
