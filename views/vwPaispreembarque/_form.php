<?php
/* @var $this VwPaispreembarqueController */
/* @var $model VwPaispreembarque */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vw-paispreembarque-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_routing'); ?>
		<?php echo $form->textField($model,'id_routing'); ?>
		<?php echo $form->error($model,'id_routing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'borrado'); ?>
		<?php echo $form->checkBox($model,'borrado'); ?>
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
		<?php echo $form->textField($model,'fecha'); ?>
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
		<?php echo $form->checkBox($model,'import_export'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->