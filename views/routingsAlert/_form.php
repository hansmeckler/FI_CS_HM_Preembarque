<?php
/* @var $this RoutingsAlertController */
/* @var $model RoutingsAlert */
/* @var $form CActiveForm */
?>

<div class="form-controls">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'routings-alert-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_routing'); ?>
		<?php echo $form->textField($model,'id_routing'); ?>
		<?php echo $form->error($model,'id_routing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'borrado'); ?>
		<?php echo //$form->dropDownList($model,'borrado',array(0=>'opcion1',1=>'opcion2'), array('prompt' => '-- Seleccione --'));

			$form->checkBox($model,'borrado'); ?>
		<?php echo $form->error($model,'borrado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'routing_int'); ?>
		<?php echo $form->textField($model,'routing_int'); ?>
		<?php echo $form->error($model,'routing_int'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'routing'); ?>
		<?php echo $form->textField($model,'routing',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'routing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pais'); ?>
		<?php echo $form->textField($model,'id_pais',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'id_pais'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pais_origen'); ?>
		<?php echo $form->textField($model,'id_pais_origen',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'id_pais_origen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pais_destino'); ?>
		<?php echo $form->textField($model,'id_pais_destino',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'id_pais_destino'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
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
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_no'); ?>
		<?php echo $form->textField($model,'order_no',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'order_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_transporte'); ?>
		<?php echo $form->textField($model,'id_transporte'); ?>
		<?php echo $form->error($model,'id_transporte'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'import_export'); ?>
		<?php echo //$form->dropDownList($model,'import_export',array(0=>'opcion1',1=>'opcion2'), array('prompt' => '-- Seleccione --'));

			$form->checkBox($model,'import_export'); ?>
		<?php echo $form->error($model,'import_export'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_usuario_creacion'); ?>
		<?php echo $form->textField($model,'id_usuario_creacion'); ?>
		<?php echo $form->error($model,'id_usuario_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cotizacion_id'); ?>
		<?php echo $form->textField($model,'cotizacion_id'); ?>
		<?php echo $form->error($model,'cotizacion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'no_embarque'); ?>
		<?php echo $form->textField($model,'no_embarque',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'no_embarque'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cliente'); ?>
		<?php echo $form->textField($model,'id_cliente'); ?>
		<?php echo $form->error($model,'id_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_routing_type'); ?>
		<?php echo $form->textField($model,'id_routing_type'); ?>
		<?php echo $form->error($model,'id_routing_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'days'); ?>
		<?php echo $form->textField($model,'days'); ?>
		<?php echo $form->error($model,'days'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo //$form->dropDownList($model,'activo',array(0=>'opcion1',1=>'opcion2'), array('prompt' => '-- Seleccione --'));

			$form->checkBox($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bl_id_fecha'); ?>
		<?php echo $form->textField($model,'bl_id_fecha'); ?>
		<?php echo $form->error($model,'bl_id_fecha'); ?>
	</div>


<?php //echo $form->hiddenField($model,'attributo',array("value"=>Yii::app()->user->id)); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn btn-primary')); ?>
	</div>




<?php $this->endWidget(); //form end ?>


</div><!-- form -->







