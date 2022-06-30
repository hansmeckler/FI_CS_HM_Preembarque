<?php
/* @var $this VwRoutingsController */
/* @var $model VwRoutings */

$this->breadcrumbs=array(
	'Vw Routings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VwRoutings', 'url'=>array('index')),
	array('label'=>'Manage VwRoutings', 'url'=>array('admin')),
);
?>

<h1>Create VwRoutings</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>