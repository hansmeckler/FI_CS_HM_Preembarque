<?php
/* @var $this RoutingsAlertController */
/* @var $model RoutingsAlert */

if (isset(Yii::app()->session['mn_title'])) 
	$label=Yii::app()->session['mn_title']; 
else 
	$label=$this->pluralize($this->class2name($this->modelClass)); 
	
$this->breadcrumbs=array(
	$label=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'<span class="icon-list-alt"></span> Lista '.$label, 'url'=>array('index')),
	array('label'=>'<span class="icon-home"></span> A-B-C '.$label, 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>"<h1>Crear <small>$label</small></h1>",
	));
?>

<!-- <h1>Crear RoutingsAlert</h1> -->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->endWidget();?>

