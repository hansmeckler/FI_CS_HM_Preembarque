<?php
/* @var $this RoutingsAlertController */
/* @var $model RoutingsAlert */
/* @var $form CActiveForm */
?>

<div class="form-controls">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_routing'); ?>
		<?php echo $form->textField($model,'id_routing'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'borrado'); ?>
		<?php echo //$form->dropDownList($model,'borrado',array(0=>'opcion1',1=>'opcion2'), array('prompt' => '-- Seleccione --'));

			$form->checkBox($model,'borrado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'routing_int'); ?>
		<?php echo $form->textField($model,'routing_int'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'routing'); ?>
		<?php echo $form->textField($model,'routing',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pais'); ?>
		<?php echo $form->textField($model,'id_pais',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pais_origen'); ?>
		<?php echo $form->textField($model,'id_pais_origen',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pais_destino'); ?>
		<?php echo $form->textField($model,'id_pais_destino',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha'); ?>
		<?php echo  ""; $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'model' => $model,
		    'attribute' => 'fecha',
		    'language' => 'es',		    
		    //'themeUrl' => Yii::app()->baseUrl . '/css/jui',
		    //'theme' => 'softark',
		    //'cssFile' => 'jquery-ui-1.9.2.custom.css',		    
		    'options' => array(
		        'showOn' => 'both',             // also opens with a button
		        'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
		        'showOtherMonths' => true,      // show dates in other months
		        'selectOtherMonths' => true,    // can seelect dates in other months
		        'changeYear' => true,           // can change year
		        'changeMonth' => true,          // can change month
		        'yearRange' => '2000:2099',     // range of year
		        'minDate' => '2000-01-01',      // minimum date
		        'maxDate' => '2099-12-31',      // maximum date
		        'showButtonPanel' => true,      // show button panel
		    ),		   
		    'htmlOptions' => array(
		        'size' => '10',
		        'maxlength' => '10',
		    ),
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_no'); ?>
		<?php echo $form->textField($model,'order_no',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_transporte'); ?>
		<?php echo $form->textField($model,'id_transporte'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'import_export'); ?>
		<?php echo //$form->dropDownList($model,'import_export',array(0=>'opcion1',1=>'opcion2'), array('prompt' => '-- Seleccione --'));

			$form->checkBox($model,'import_export'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_usuario_creacion'); ?>
		<?php echo $form->textField($model,'id_usuario_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cotizacion_id'); ?>
		<?php echo $form->textField($model,'cotizacion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_embarque'); ?>
		<?php echo $form->textField($model,'no_embarque',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cliente'); ?>
		<?php echo $form->textField($model,'id_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_routing_type'); ?>
		<?php echo $form->textField($model,'id_routing_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'days'); ?>
		<?php echo $form->textField($model,'days'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo //$form->dropDownList($model,'activo',array(0=>'opcion1',1=>'opcion2'), array('prompt' => '-- Seleccione --'));

			$form->checkBox($model,'activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bl_id_fecha'); ?>
		<?php echo $form->textField($model,'bl_id_fecha'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Buscar',array('class'=>'btn btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->