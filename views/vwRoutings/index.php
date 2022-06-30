<?php
/* @var $this VwRoutingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vw Routings',
);

$this->menu=array(
	array('label'=>'Create VwRoutings', 'url'=>array('create')),
	array('label'=>'Manage VwRoutings', 'url'=>array('admin')),
);
?>

<h1>Vw Routings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
