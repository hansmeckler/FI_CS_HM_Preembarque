<?php
$this->breadcrumbs=array(
	Yii::t('app','Routings'),
);

$this->menu=array(
	
	array('label'=>Yii::t('app','Create').' '.Yii::t('app','Routings'),'url'=>array('create', 'button'=>1, 'text'=>Yii::t('app','Create').' '.Yii::t('app','Routings')), 'icon'=>TbHtml::ICON_FILE . " " . TbHtml::ICON_COLOR_WHITE, "visible"=> Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['create'] == 1 ? true : false),
	
	array('label'=>Yii::t('app','Manage').' '.Yii::t('app','Routings'),'url'=>array('admin'), 'icon'=>TbHtml::ICON_COG . " " . TbHtml::ICON_COLOR_WHITE),
);
?>

<h1><?php echo Yii::t('app','List').' '.Yii::t('app','Routings'); ?> </h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
