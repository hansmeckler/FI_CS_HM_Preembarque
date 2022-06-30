<?php

	$dataProvider = new CActiveDataProvider('RoutingsAlert', array(
		'criteria'=>$model->getSearchCriteria(),
		'pagination'=>false,
	));

	$dataProvider1 = new CActiveDataProvider('RoutingsAlert', array(
		'criteria'=>$model->getSearchCriteria(),
		'pagination'=>false,
			'sort'=>array(			    
				'defaultOrder'=>"t.fecha DESC",			    
			),		
	));

	//echo "<br><br><br><br>(" . Yii::app()->session['region'] . ")";
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	//'action'=>Yii::app()->createUrl($this->route),
	'action'=>Yii::app()->createUrl('RoutingsAlert/admin'),
	'method'=>'POST',
)); ?>

<h2><?php echo CHtml::encode("RO's Interno Pendientes")."&nbsp;del&nbsp;";

$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	//'themeUrl'=>'/js/jquery-ui-1.8/themes',
	//'theme'=>'ui-lightness',
	'name'=>'fecha_i',
	'value'=>Yii::app()->session['fecha_i'],
	// additional javascript options for the date picker plugin
	'options'=>array(
		'flat'=>true,//remove to hide the datepicker
		'showButtonPanel'=>true,
		'dateFormat' => 'yy-mm-dd',
		//'dateFormat' => 'dd/mm/yy',
		'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
		'changeMonth'=>true,
		'changeYear'=>true,
		//'showOn' => 'button',
		//'buttonImage' => Yii::app()->request->baseUrl . '/images/calendar_select_day.png',
		//'buttonImageOnly' => true,
		//'buttonText' => Yii::t('ui', 'Seleccione fecha'),
	),
	'language'=> Yii::app()->language,
	'htmlOptions'=>array(
		//'placeholder' => 'Seleccione fecha inicio',
		//'required'=>'on',
		'readonly'=>true,
		'onmouseover'=>'this.style.cursor="pointer"',
		'onkeydown'=>'return false',
		'style'=>'width:100px;position:relative;top:5px;border:0px',
		'class'=>'btn btn-warning',
		'title'=>'Seleccione Fecha',
	),
));

echo "&nbsp;al&nbsp;";

$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	//'themeUrl'=>'/js/jquery-ui-1.8/themes',
	//'theme'=>'ui-lightness',
	'name'=>'fecha_f',
	'value'=>Yii::app()->session['fecha_f'],
	// additional javascript options for the date picker plugin
	'options'=>array(
		'flat'=>true,//remove to hide the datepicker
		'showButtonPanel'=>true,
		'dateFormat' => 'yy-mm-dd',
		//'dateFormat' => 'dd/mm/yy',
		'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
		'changeMonth'=>true,
		'changeYear'=>true,
		//'showOn' => 'button',
		//'buttonImage' => Yii::app()->request->baseUrl . '/images/calendar_select_day.png',
		//'buttonImageOnly' => true,
		//'buttonText' => Yii::t('ui', 'Seleccione fecha'),
	),
	'language'=> Yii::app()->language,
	'htmlOptions'=>array(
		'placeholder' => 'Seleccione fecha inicio',
		//'required'=>'on',
		'readonly'=>true,
		'onmouseover'=>'this.style.cursor="pointer"',
		'onkeydown'=>'return false',
		'style'=>'width:100px;position:relative;top:5px;border:0px',
		'class'=>'btn btn-warning btn-small',
	),
));

echo "&nbsp;";

$this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit',
	'type'=>'primary',
	'label'=>'Cargar',
	'icon'=>'icon-cog icon-white',
));

echo "&nbsp;";

echo CHtml::link('<i class="icon-share icon-white"></i> Excel',
Yii::app()->createUrl('RoutingsAlert/GenerateExcel',array("count"=>$model->search()->getTotalItemCount())),
array('class'=>'btn btn-success','title'=>'Exportar a Excel','target'=>'_blank')
);

?></h2>

<?php $this->endWidget(); ?>

<style>
	/**
	 * Hide first and last buttons by default.
	 */
	ul.yiiPager .first,
	ul.yiiPager .last
	{
		display:inline;
	}
</style>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'routings-alerta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>1,
	'beforeAjaxUpdate'=>'function(id,options){
		DisplayLogo(options.url);
	}',	
	'template' => "{summary}\n{pager}\n{items}",
	'pager'=>array(
				'class' => 'CLinkPager',
				'header'         => '',
				'maxButtonCount'    => 20,
    ),
    'cssFile' => Yii::app()->baseUrl . '/css/gridview/stylesAlerta.css',
	'columns'=>array(
		array('header'=>'#', 'value'=>'$row + ($this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize) + 1'),
		array('name'=>'view', 'value'=>array($this,'cssView'), 'type'=>'raw'),
		array('name'=>'days','headerHtmlOptions'=>array('title'=>'Dias acumulados sin RO Interno')),
		array('name'=>'id_routing','headerHtmlOptions'=>array('title'=>'Routing ID')),
		array('name'=>'routing','htmlOptions' => array('style'=>'white-space:nowrap;'),'type'=>'raw',),
		array('name'=>'id_pais','filter' => CHtml::listData($dataProvider->getData(),'id_pais','id_pais')),
		array('name'=>'id_pais_origen','filter' => CHtml::listData($dataProvider->getData(),'id_pais_origen','id_pais_origen')),
		array('name'=>'id_pais_destino','filter' => CHtml::listData($dataProvider->getData(),'id_pais_destino','id_pais_destino')),
		array('name'=>'fecha', 'filter' => CHtml::listData($dataProvider1->getData(),'fecha','fecha') ),
		array('name'=>'order_no', 'value'=>array($this, 'shortText'),'type'=>'raw','htmlOptions' => array('style'=>'width:120px;white-space:nowrap;'),),
		array('name'=>'transporte', 'value'=>array($this, 'shortText'), 'type'=>'raw', 'filter'=>CHtml::listData(Transporte::model()->findAll(array("condition"=>"id_transporte NOT IN (6,8,9)","order"=>"descripcion")), 'letra', 'descripcion')),
		array('name'=>'import_export', 'value'=>'$data->import_export ? "Import" : "Export"', 'filter'=>array('t'=>'Import','f'=>'Export'), 'headerHtmlOptions'=>array('title'=>'Import / Export')),
		array('name'=>'nombre_creacion', 'value'=>array($this, 'shortText'), 'type'=>'raw','htmlOptions' => array('style'=>'white-space:nowrap;'),),
		array('name'=>'cotizacion_id'),
		array('name'=>'nombre_cliente', 'value'=>array($this, 'shortText'), 'type'=>'raw', 'htmlOptions' => array('style'=>'white-space:nowrap;'), ),
		array('name'=>'no_embarque', 'value'=>array($this, 'shortText'), 'type'=>'raw'),
		array('name'=>'last_id', 'value'=>array($this,'cssLast'), 'type'=>'raw', 'filter' => array('>0'=>'Con Estatus','0'=>'Sin Estatus')),
	),
)); ?>

