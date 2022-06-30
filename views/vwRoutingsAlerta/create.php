<?php
/* @var $this VwRoutingsAlertaController */
/* @var $model VwRoutingsAlerta */

$this->breadcrumbs=array(
	'Vw Routings Alertas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VwRoutingsAlerta', 'url'=>array('index')),
	array('label'=>'Manage VwRoutingsAlerta', 'url'=>array('admin')),
);
?>

<h1>Create VwRoutingsAlerta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>