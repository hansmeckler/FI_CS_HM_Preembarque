<?php
/* @var $this RoutingsAlertController */
/* @var $dataProvider CActiveDataProvider */

if (isset(Yii::app()->session['mn_title'])) 
	$label=Yii::app()->session['mn_title']; 
else 
	$label=$this->pluralize($this->class2name($this->modelClass)); 

$this->breadcrumbs=array(
	$label,
);

$this->menu=array(
	array('label'=>'<span class="icon-asterisk"></span> Crear '.$label, 'url'=>array('create')),
	array('label'=>'<span class="icon-home"></span> A-B-C '.$label, 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<h1>Lista <small>$label</small></h1>",
	));
?>


<!--<h1></h1>-->

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php $this->endWidget();?>
