<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'routing_cli',CHtml::listData(Routings::model()->findAll(array("condition"=>"","order"=>"")),'id_routing','order_no'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->textFieldRow($model,'id_cliente',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'id_routing',CHtml::listData(Routings::model()->findAll(array("condition"=>"","order"=>"")),'id_routing','order_no'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->textFieldRow($model,'cotizacion_id',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'id_estatus',CHtml::listData(Aimartrackings::model()->findAll(array("condition"=>"","order"=>"")),'id','estatus'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->textFieldRow($model,'name_es',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name_en',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'comentario',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'fecha_server',array('class'=>'span5')); ?>

	<?php echo $form->dateFieldRow($model,'fecha_estatus',array('class'=>'span2')); ?>

	<?php echo $form->textFieldRow($model,'hora_estatus',array('class'=>'span5','maxlength'=>8)); ?>

	<?php echo $form->textFieldRow($model,'id_pais',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textAreaRow($model,'notificacion',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'modificado',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'usuario',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'activo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'borrado',array('class'=>'span5')); ?>


<?php if (!$this->asDialog) : ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>
<?php endif; ?>
	

<?php $this->endWidget(); ?>
