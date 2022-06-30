<?php
$this->breadcrumbs=array(
	Yii::t('app','TrackingRoutings'),
);

$this->menu=array(
	
	array('label'=>Yii::t('app','Create').' '.Yii::t('app','TrackingRoutings'),'url'=>array('create', 'button'=>1, 'text'=>Yii::t('app','Create').' '.Yii::t('app','TrackingRoutings')), 'icon'=>TbHtml::ICON_FILE . " " . TbHtml::ICON_COLOR_WHITE, "visible"=> Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['create'] == 1 ? true : false),
	
	array('label'=>Yii::t('app','Manage').' '.Yii::t('app','TrackingRoutings'),'url'=>array('admin'), 'icon'=>TbHtml::ICON_COG . " " . TbHtml::ICON_COLOR_WHITE),
);
?>

<h1><?php echo Yii::t('app','List').' '.Yii::t('app','TrackingRoutings'); ?> </h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
