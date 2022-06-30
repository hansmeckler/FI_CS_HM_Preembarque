<div class="form-actions">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_routing')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_routing),array('view','id'=>$data->id_routing)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cotizacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->cotizacion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendedor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendedor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_no')); ?>:</b>
	<?php echo CHtml::encode($data->order_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reference')); ?>:</b>
	<?php echo CHtml::encode($data->reference); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_routing_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_routing_type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->id_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_shipper')); ?>:</b>
	<?php echo CHtml::encode($data->id_shipper); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_notify')); ?>:</b>
	<?php echo CHtml::encode($data->id_notify); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_piezas_old')); ?>:</b>
	<?php echo CHtml::encode($data->no_piezas_old); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso_old')); ?>:</b>
	<?php echo CHtml::encode($data->peso_old); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('volumen_old')); ?>:</b>
	<?php echo CHtml::encode($data->volumen_old); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad_origen')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad_origen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad_destino')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad_destino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_embarque')); ?>:</b>
	<?php echo CHtml::encode($data->no_embarque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_incoterms')); ?>:</b>
	<?php echo CHtml::encode($data->id_incoterms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bodega_prov_emb')); ?>:</b>
	<?php echo CHtml::encode($data->bodega_prov_emb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_transporte')); ?>:</b>
	<?php echo CHtml::encode($data->id_transporte); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tramite_aduanal')); ?>:</b>
	<?php echo CHtml::encode($data->tramite_aduanal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seguro')); ?>:</b>
	<?php echo CHtml::encode($data->seguro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('porcentaje_seguro')); ?>:</b>
	<?php echo CHtml::encode($data->porcentaje_seguro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lugar_entrega')); ?>:</b>
	<?php echo CHtml::encode($data->lugar_entrega); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('solicitado_por')); ?>:</b>
	<?php echo CHtml::encode($data->solicitado_por); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b>
	<?php echo CHtml::encode($data->observaciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mbl_id_shipper')); ?>:</b>
	<?php echo CHtml::encode($data->mbl_id_shipper); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mbl_id_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->mbl_id_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mbl_id_notify')); ?>:</b>
	<?php echo CHtml::encode($data->mbl_id_notify); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mbl_net_rate')); ?>:</b>
	<?php echo CHtml::encode($data->mbl_net_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mbl_selling_rate')); ?>:</b>
	<?php echo CHtml::encode($data->mbl_selling_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mbl_rate_comment')); ?>:</b>
	<?php echo CHtml::encode($data->mbl_rate_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_user_edit')); ?>:</b>
	<?php echo CHtml::encode($data->last_user_edit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_date_edit')); ?>:</b>
	<?php echo CHtml::encode($data->last_date_edit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delete_user')); ?>:</b>
	<?php echo CHtml::encode($data->delete_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delete_date')); ?>:</b>
	<?php echo CHtml::encode($data->delete_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agente_id')); ?>:</b>
	<?php echo CHtml::encode($data->agente_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_no')); ?>:</b>
	<?php echo CHtml::encode($data->routing_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing')); ?>:</b>
	<?php echo CHtml::encode($data->routing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pais')); ?>:</b>
	<?php echo CHtml::encode($data->id_pais); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('import_export')); ?>:</b>
	<?php echo CHtml::encode($data->import_export); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('factura_id')); ?>:</b>
	<?php echo CHtml::encode($data->factura_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comodity_id')); ?>:</b>
	<?php echo CHtml::encode($data->comodity_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_container_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_container_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_naviera')); ?>:</b>
	<?php echo CHtml::encode($data->id_naviera); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_unidad_peso')); ?>:</b>
	<?php echo CHtml::encode($data->id_unidad_peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_unidad_volumen')); ?>:</b>
	<?php echo CHtml::encode($data->id_unidad_volumen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_unidad_peso_vol')); ?>:</b>
	<?php echo CHtml::encode($data->id_unidad_peso_vol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso_volumentrico')); ?>:</b>
	<?php echo CHtml::encode($data->peso_volumentrico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_truck_type')); ?>:</b>
	<?php echo CHtml::encode($data->id_truck_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_paquete')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_paquete); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pais_origen')); ?>:</b>
	<?php echo CHtml::encode($data->id_pais_origen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pais_destino')); ?>:</b>
	<?php echo CHtml::encode($data->id_pais_destino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_puerto_embarque')); ?>:</b>
	<?php echo CHtml::encode($data->id_puerto_embarque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_puerto_desembarque')); ?>:</b>
	<?php echo CHtml::encode($data->id_puerto_desembarque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carrier_id')); ?>:</b>
	<?php echo CHtml::encode($data->carrier_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_facturar')); ?>:</b>
	<?php echo CHtml::encode($data->id_facturar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('airportid_embarque')); ?>:</b>
	<?php echo CHtml::encode($data->airportid_embarque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prepaid')); ?>:</b>
	<?php echo CHtml::encode($data->prepaid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('airportid_desembarque')); ?>:</b>
	<?php echo CHtml::encode($data->airportid_desembarque); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('borrado')); ?>:</b>
	<?php echo CHtml::encode($data->borrado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_sales_support')); ?>:</b>
	<?php echo CHtml::encode($data->id_sales_support); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario_creacion')); ?>:</b>
	<?php echo CHtml::encode($data->id_usuario_creacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_ingreso')); ?>:</b>
	<?php echo CHtml::encode($data->hora_ingreso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notificar_a')); ?>:</b>
	<?php echo CHtml::encode($data->notificar_a); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pais_origen_carga')); ?>:</b>
	<?php echo CHtml::encode($data->pais_origen_carga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_exportador')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_exportador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tarifa_aplicada')); ?>:</b>
	<?php echo CHtml::encode($data->tarifa_aplicada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_secc')); ?>:</b>
	<?php echo CHtml::encode($data->routing_secc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_cli')); ?>:</b>
	<?php echo CHtml::encode($data->routing_cli); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_int')); ?>:</b>
	<?php echo CHtml::encode($data->routing_int); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_eci')); ?>:</b>
	<?php echo CHtml::encode($data->routing_eci); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_ag')); ?>:</b>
	<?php echo CHtml::encode($data->routing_ag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voyage_id')); ?>:</b>
	<?php echo CHtml::encode($data->voyage_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source')); ?>:</b>
	<?php echo CHtml::encode($data->source); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('wms_bl_id')); ?>:</b>
	<?php echo CHtml::encode($data->wms_bl_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ancho')); ?>:</b>
	<?php echo CHtml::encode($data->ancho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alto')); ?>:</b>
	<?php echo CHtml::encode($data->alto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('largo')); ?>:</b>
	<?php echo CHtml::encode($data->largo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tmp_piezas')); ?>:</b>
	<?php echo CHtml::encode($data->tmp_piezas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tmp_peso')); ?>:</b>
	<?php echo CHtml::encode($data->tmp_peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tmp_volumen')); ?>:</b>
	<?php echo CHtml::encode($data->tmp_volumen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('piezas_entregadas_wms')); ?>:</b>
	<?php echo CHtml::encode($data->piezas_entregadas_wms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_documento')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_documento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_solicitud')); ?>:</b>
	<?php echo CHtml::encode($data->id_solicitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_shipper_cliente')); ?>:</b>
	<?php echo CHtml::encode($data->id_shipper_cliente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tarifario_costo')); ?>:</b>
	<?php echo CHtml::encode($data->id_tarifario_costo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_coloader')); ?>:</b>
	<?php echo CHtml::encode($data->id_coloader); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_piezas')); ?>:</b>
	<?php echo CHtml::encode($data->no_piezas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('peso')); ?>:</b>
	<?php echo CHtml::encode($data->peso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('volumen')); ?>:</b>
	<?php echo CHtml::encode($data->volumen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_colectar')); ?>:</b>
	<?php echo CHtml::encode($data->id_colectar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idbitalpemusa')); ?>:</b>
	<?php echo CHtml::encode($data->idbitalpemusa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numbitalpemusa')); ?>:</b>
	<?php echo CHtml::encode($data->numbitalpemusa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_flete_manifestar')); ?>:</b>
	<?php echo CHtml::encode($data->valor_flete_manifestar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('poliza_seguro')); ?>:</b>
	<?php echo CHtml::encode($data->poliza_seguro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('container_qty')); ?>:</b>
	<?php echo CHtml::encode($data->container_qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_seg')); ?>:</b>
	<?php echo CHtml::encode($data->routing_seg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('referencia')); ?>:</b>
	<?php echo CHtml::encode($data->referencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_fac')); ?>:</b>
	<?php echo CHtml::encode($data->routing_fac); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bl_id')); ?>:</b>
	<?php echo CHtml::encode($data->bl_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_bl')); ?>:</b>
	<?php echo CHtml::encode($data->no_bl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cliente_order')); ?>:</b>
	<?php echo CHtml::encode($data->id_cliente_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_adu')); ?>:</b>
	<?php echo CHtml::encode($data->routing_adu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_ter')); ?>:</b>
	<?php echo CHtml::encode($data->routing_ter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('routing_copy')); ?>:</b>
	<?php echo CHtml::encode($data->routing_copy); ?>
	<br />

	*/ ?>

</div>