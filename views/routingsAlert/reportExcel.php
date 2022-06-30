<?php if (isset($model)):?>
<table border=1>
<?php foreach($model as $row): ?>
<tr>
		<th><?php echo CHtml::encode($row->getAttributeLabel('id_routing')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('borrado')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('routing_int')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('routing')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('id_pais')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('id_pais_origen')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('id_pais_destino')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('fecha')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('order_no')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('id_transporte')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('import_export')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('id_usuario_creacion')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('cotizacion_id')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('no_embarque')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('id_cliente')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('id_routing_type')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('days')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('activo')); ?></th>
		<th><?php echo CHtml::encode($row->getAttributeLabel('bl_id_fecha')); ?></th>
</tr>
<?php break; ?>
<?php endforeach; ?>

<?php foreach($model as $row): ?>
<tr>
		<td><?php echo CHtml::encode($row->id_routing); ?></td>
		<td><?php echo CHtml::encode($row->borrado); ?></td>
		<td><?php echo CHtml::encode($row->routing_int); ?></td>
		<td><?php echo CHtml::encode($row->routing); ?></td>
		<td><?php echo CHtml::encode($row->id_pais); ?></td>
		<td><?php echo CHtml::encode($row->id_pais_origen); ?></td>
		<td><?php echo CHtml::encode($row->id_pais_destino); ?></td>
		<td><?php echo CHtml::encode($row->fecha); ?></td>
		<td><?php echo CHtml::encode($row->order_no); ?></td>
		<td><?php echo CHtml::encode($row->id_transporte); ?></td>
		<td><?php echo CHtml::encode($row->import_export); ?></td>
		<td><?php echo CHtml::encode($row->id_usuario_creacion); ?></td>
		<td><?php echo CHtml::encode($row->cotizacion_id); ?></td>
		<td><?php echo CHtml::encode($row->no_embarque); ?></td>
		<td><?php echo CHtml::encode($row->id_cliente); ?></td>
		<td><?php echo CHtml::encode($row->id_routing_type); ?></td>
		<td><?php echo CHtml::encode($row->days); ?></td>
		<td><?php echo CHtml::encode($row->activo); ?></td>
		<td><?php echo CHtml::encode($row->bl_id_fecha); ?></td>

</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
