<?php
/* @var $this VwPaispreembarqueController */
/* @var $data VwPaispreembarque */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_routing')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_routing), array('view', 'id'=>$data->id_routing)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('borrado')); ?>:</b>
	<?php echo CHtml::encode($data->borrado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_int')); ?>:</b>
	<?php echo CHtml::encode($data->routing_int); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing')); ?>:</b>
	<?php echo CHtml::encode($data->routing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pais')); ?>:</b>
	<?php echo CHtml::encode($data->id_pais); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pais_origen')); ?>:</b>
	<?php echo CHtml::encode($data->id_pais_origen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pais_destino')); ?>:</b>
	<?php echo CHtml::encode($data->id_pais_destino); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_no')); ?>:</b>
	<?php echo CHtml::encode($data->order_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_transporte')); ?>:</b>
	<?php echo CHtml::encode($data->id_transporte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('import_export')); ?>:</b>
	<?php echo CHtml::encode($data->import_export); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_usuario_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cotizacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->cotizacion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_embarque')); ?>:</b>
	<?php echo CHtml::encode($data->no_embarque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->id_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_routing_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_routing_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('days')); ?>:</b>
	<?php echo CHtml::encode($data->days); ?>
	<br />

	*/ ?>

</div>