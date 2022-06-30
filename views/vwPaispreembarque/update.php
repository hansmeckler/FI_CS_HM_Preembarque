<?php
/* @var $this VwPaispreembarqueController */
/* @var $model VwPaispreembarque */

$this->breadcrumbs=array(
	'Vw Paispreembarques'=>array('index'),
	$model->id_routing=>array('view','id'=>$model->id_routing),
	'Update',
);

$this->menu=array(
	array('label'=>'List VwPaispreembarque', 'url'=>array('index')),
	array('label'=>'Create VwPaispreembarque', 'url'=>array('create')),
	array('label'=>'View VwPaispreembarque', 'url'=>array('view', 'id'=>$model->id_routing)),
	array('label'=>'Manage VwPaispreembarque', 'url'=>array('admin')),
);
?>

<h1>Update VwPaispreembarque <?php echo $model->id_routing; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>