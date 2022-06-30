<?php if ($model !== null):?>

<page backtop="15mm" backbottom="10mm" backleft="0mm" backright="0mm">
    <page_header>
        <table style="width: 100%; border: solid 1px gray;">
            <tr>
                <td style="text-align: left;    width: 33%"><img src="images/aimar.gif"></td>
                <td style="text-align: center;    width: 34%"><?=$title?></td>
                <td style="text-align: right;    width: 33%"><?php echo date("d/m/Y"); ?></td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: solid 1px gray;">
            <tr>
                <td style="text-align: left;    width: 50%">RoutingsAlert</td>
                <td style="text-align: right;    width: 50%">pagina [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>

<style>
	th {background:rgb(200,200,200);}
	tbody tr:nth-child(odd) {background-color:rgb(180,180,180)}	
	thead th { padding: 3 3 4 3; border-right:1px solid white} /* top right bottom left*/
	tbody td { border-bottom:0.5pt solid gray; padding: 0 3 0 3; font-weight:normal}	
</style>

	<table cellpadding="0" cellspacing="0" class="tbl_row">
		<thead>
		<?php foreach($model as $i => $row): ?>
		<tr>
			<th>No.</th>
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
\t\t</tr>
	 	<?php break; ?>
	 	<?php endforeach; ?>
	 	</thead>
	 	
	 	<tbody>	 	
		<?php foreach($model as $i => $row): ?>
		<tr>
			<td><?php echo $i+1; ?></td>
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
	    </tbody>
	</table>
</page>
<?php endif; ?>
