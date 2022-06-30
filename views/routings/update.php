<?php
$this->breadcrumbs=array(
	Yii::t('app','Routings')=>array('index'),	
	$model->id_routing=>array('view','id'=>$model->id_routing),
	Yii::t('app','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List').' '.Yii::t('app','Routings'),'url'=>array('index'), 'icon'=>TbHtml::ICON_ALIGN_JUSTIFY . " " . TbHtml::ICON_COLOR_WHITE),
	
	array('label'=>Yii::t('app','Create').' '.Yii::t('app','Routings'),'url'=>array('create', 'button'=>1, 'text'=>Yii::t('app','Create').' '.Yii::t('app','Routings')), 'icon'=>TbHtml::ICON_FILE . " " . TbHtml::ICON_COLOR_WHITE, "visible"=> Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['create'] == 1 ? true : false),
	
	array('label'=>Yii::t('app','View').' '.Yii::t('app','Routings'),'url'=>array('view','id'=>$model->id_routing), 'icon'=>TbHtml::ICON_EYE_OPEN . " " . TbHtml::ICON_COLOR_WHITE),
	
	array('label'=>Yii::t('app','Manage').' '.Yii::t('app','Routings'),'url'=>array('admin'), 'icon'=>TbHtml::ICON_COG . " " . TbHtml::ICON_COLOR_WHITE),
);
?>

<?php if (!$this->asDialog) : ?>

<h1><?php echo Yii::t('app','Update').' '.Yii::t('app','Routings'); ?>   #<?php echo $model->id_routing; ?></h1>

<?php endif; ?>
	

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>