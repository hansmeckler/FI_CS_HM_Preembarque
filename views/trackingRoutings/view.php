<?php
$this->breadcrumbs=array(	
	Yii::t('app','TrackingRoutings')=>array('index'),		
	$model->id,
);

$this->menu=array(
	
	array('label'=>Yii::t('app','List').' '.Yii::t('app','TrackingRoutings'),'url'=>array('index'), 'icon'=>TbHtml::ICON_ALIGN_JUSTIFY . " " . TbHtml::ICON_COLOR_WHITE),
	
	array('label'=>Yii::t('app','Create').' '.Yii::t('app','TrackingRoutings'),'url'=>array('create', 'button'=>1, 'text'=>Yii::t('app','Create').' '.Yii::t('app','TrackingRoutings')), 'icon'=>TbHtml::ICON_FILE . " " . TbHtml::ICON_COLOR_WHITE, "visible"=> Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['create'] == 1 ? true : false),
	
	array('label'=>Yii::t('app','Update').' '.Yii::t('app','TrackingRoutings'),'url'=>array('update', 'button'=>2, 'text'=>Yii::t('app','Update').' '.Yii::t('app','TrackingRoutings'),'id'=>$model->id), 'icon'=>TbHtml::ICON_PENCIL . " " . TbHtml::ICON_COLOR_WHITE, "visible"=> Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['update'] == 1 ? true : false),
	
	//array('label'=>Yii::t('app','Delete').' '.Yii::t('app','TrackingRoutings'),'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Esta seguro que quiere borrar este registro?'), 'icon'=>TbHtml::ICON_TRASH . " " . TbHtml::ICON_COLOR_WHITE),
	
	array('label'=>Yii::t('app','Manage').' '.Yii::t('app','TrackingRoutings'),'url'=>array('admin'), 'icon'=>TbHtml::ICON_COG . " " . TbHtml::ICON_COLOR_WHITE),
);
?>

<h1><?php echo Yii::t('app','View').' '.Yii::t('app','TrackingRoutings'); ?>   #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		//array('name'=>'routing_cli','value'=> isset($model->routingCli) ? $model->routingCli->order_no : $model->routing_cli ),
		'id_cliente',
		//array('name'=>'id_routing','value'=> isset($model->idRouting) ? $model->idRouting->order_no : $model->id_routing ),
		'cotizacion_id',
		//array('name'=>'id_estatus','value'=> isset($model->idEstatus) ? $model->idEstatus->estatus : $model->id_estatus ),
		'name_es',
		'name_en',
		'comentario',
		'fecha_server',
		'fecha_estatus',
		'hora_estatus',
		//array('name'=>'id_pais','value'=> isset($model->idPais) ? $model->idPais->descripcion : $model->id_pais ),
		'notificacion',
		'modificado',
		//array('name'=>'usuario','value'=> isset($model->usuario) ? $model->usuario->pw_name : $model->usuario ),
		'activo',
		'borrado',
	),
)); ?>
