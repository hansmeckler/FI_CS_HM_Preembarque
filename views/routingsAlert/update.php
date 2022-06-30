<?php
/* @var $this RoutingsAlertController */
/* @var $model RoutingsAlert */

if (isset(Yii::app()->session['mn_title'])) 
	$label=Yii::app()->session['mn_title']; 
else 
	$label=$this->pluralize($this->class2name($this->modelClass)); 

$this->breadcrumbs=array(
	$label=>array('index'),
	$model->id_routing=>array('view','id'=>$model->id_routing),
	'Modificar',
);

$this->menu=array(
	array('label'=>'<span class="icon-list-alt"></span> Lista '.$label, 'url'=>array('index')),
	array('label'=>'<span class="icon-asterisk"></span> Crear '.$label, 'url'=>array('create'), 'visible'=>  Yii::app()->session['level'] > 1 ),
	array('label'=>'<span class="icon-eye-open"></span> Vista '.$label, 'url'=>array('view', 'id'=>$model->id_routing)),
	array('label'=>'<span class="icon-home"></span> A-B-C '.$label, 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<h1>Modificar <small>$label #$model->id_routing</small></h1>",
	));
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->endWidget();?>
