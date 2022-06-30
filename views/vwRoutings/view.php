<?php
/* @var $this VwRoutingsController */
/* @var $model VwRoutings */

$this->breadcrumbs=array(
	'Vw Routings'=>array('index'),
	$model->id_routing,
);

$this->menu=array(
	array('label'=>'List VwRoutings', 'url'=>array('index')),
	array('label'=>'Create VwRoutings', 'url'=>array('create')),
	array('label'=>'Update VwRoutings', 'url'=>array('update', 'id'=>$model->id_routing)),
	array('label'=>'Delete VwRoutings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_routing),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VwRoutings', 'url'=>array('admin')),
);
?>

<h1>View VwRoutings #<?php echo $model->id_routing; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_catalogo',
		'id_routing',
		'activo',
		'borrado',
		'routing_int',
		'routing',
		'id_pais',
		'id_pais_origen',
		'id_pais_destino',
		'fecha',
		'order_no',
		'import_export',
		'cotizacion_id',
		'no_embarque',
		'id_routing_type',
		'id_transporte',
		'nombre_transporte',
		'id_usuario_creacion',
		'nombre_creacion',
		'id_cliente',
		'nombre_cliente',
		//'id_shipper',
		//'nombre_shipper',
		//'days',
	),
)); ?>
