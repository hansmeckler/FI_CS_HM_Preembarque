<?php
/* @var $this VwPaispreembarqueController */
/* @var $model VwPaispreembarque */

$this->breadcrumbs=array(
	'Vw Paispreembarques'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VwPaispreembarque', 'url'=>array('index')),
	array('label'=>'Manage VwPaispreembarque', 'url'=>array('admin')),
);
?>

<h1>Create VwPaispreembarque</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>