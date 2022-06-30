<?php
/* @var $this VwPaispreembarqueController */
/* @var $model VwPaispreembarque */

$this->breadcrumbs=array(
	'Vw Paispreembarques'=>array('index'),
	$model->id_routing,
);

$this->menu=array(
	array('label'=>'List VwPaispreembarque', 'url'=>array('index')),
	array('label'=>'Create VwPaispreembarque', 'url'=>array('create')),
	array('label'=>'Update VwPaispreembarque', 'url'=>array('update', 'id'=>$model->id_routing)),
	array('label'=>'Delete VwPaispreembarque', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_routing),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage VwPaispreembarque', 'url'=>array('admin')),
);
?>

<h1>View VwPaispreembarque #<?php echo $model->id_routing; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_routing',
		'borrado',
		'routing_int',
		'routing',
		'id_pais',
		'id_pais_origen',
		'id_pais_destino',
		'fecha',
		'order_no',
		'id_transporte',
		'import_export',
		'id_usuario_creacion',
		'cotizacion_id',
		'no_embarque',
		'id_cliente',
		'id_routing_type',
		'days',
	),
)); ?>
