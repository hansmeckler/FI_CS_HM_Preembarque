<?php
/* @var $this VwRoutingsController */
/* @var $model VwRoutings */

$this->breadcrumbs=array(
	'Vw Routings'=>array('index'),
	$model->id_routing=>array('view','id'=>$model->id_routing),
	'Update',
);

$this->menu=array(
	array('label'=>'List VwRoutings', 'url'=>array('index')),
	array('label'=>'Create VwRoutings', 'url'=>array('create')),
	array('label'=>'View VwRoutings', 'url'=>array('view', 'id'=>$model->id_routing)),
	array('label'=>'Manage VwRoutings', 'url'=>array('admin')),
);
?>

<h1>Update VwRoutings <?php echo $model->id_routing; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>