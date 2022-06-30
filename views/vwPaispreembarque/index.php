<?php
/* @var $this VwPaispreembarqueController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vw Paispreembarques',
);

$this->menu=array(
	array('label'=>'Create VwPaispreembarque', 'url'=>array('create')),
	array('label'=>'Manage VwPaispreembarque', 'url'=>array('admin')),
);
?>

<h1>Vw Paispreembarques</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
