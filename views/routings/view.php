<?php /*
$this->breadcrumbs=array(	
	Yii::t('app','Routings')=>array('index'),		
	$model->id_routing,
);

$this->menu=array(
	
	array('label'=>Yii::t('app','List').' '.Yii::t('app','Routings'),'url'=>array('index'), 'icon'=>TbHtml::ICON_ALIGN_JUSTIFY . " " . TbHtml::ICON_COLOR_WHITE),
	
	array('label'=>Yii::t('app','Create').' '.Yii::t('app','Routings'),'url'=>array('create', 'button'=>1, 'text'=>Yii::t('app','Create').' '.Yii::t('app','Routings')), 'icon'=>TbHtml::ICON_FILE . " " . TbHtml::ICON_COLOR_WHITE, "visible"=> Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['create'] == 1 ? true : false),
	
	array('label'=>Yii::t('app','Update').' '.Yii::t('app','Routings'),'url'=>array('update', 'button'=>2, 'text'=>Yii::t('app','Update').' '.Yii::t('app','Routings'),'id'=>$model->id_routing), 'icon'=>TbHtml::ICON_PENCIL . " " . TbHtml::ICON_COLOR_WHITE, "visible"=> Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['update'] == 1 ? true : false),
	
	//array('label'=>Yii::t('app','Delete').' '.Yii::t('app','Routings'),'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_routing),'confirm'=>'¿Esta seguro que quiere borrar este registro?'), 'icon'=>TbHtml::ICON_TRASH . " " . TbHtml::ICON_COLOR_WHITE),
	
	array('label'=>Yii::t('app','Manage').' '.Yii::t('app','Routings'),'url'=>array('admin'), 'icon'=>TbHtml::ICON_COG . " " . TbHtml::ICON_COLOR_WHITE),
);*/
?>

<h1><?php echo Yii::t('app','View').' '.Yii::t('app','Routings'); ?>   #<?php echo $model->id_routing; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_routing',
		
		'routing_int',
		'routing',
		'order_no',
		
		'fecha',
		'id_pais',	
		'id_pais_origen',
		'id_pais_destino',
		
		'import_export',
		
		'no_embarque',
		
		'borrado',
		'activo',

		'bl_id',
		'no_bl',
		
		
		
		'routing_no',		
		'cotizacion_id',
		'vendedor_id',
		
		'reference',
		'id_routing_type',
		'id_cliente',
		'id_shipper',
		'id_notify',
		'no_piezas_old',
		'peso_old',
		'volumen_old',
		'ciudad_origen',
		'ciudad_destino',
		
		'id_incoterms',
		'bodega_prov_emb',
		'id_transporte',
		'tramite_aduanal',
		'seguro',
		'porcentaje_seguro',
		'lugar_entrega',
		'solicitado_por',
		'observaciones',
		'mbl_id_shipper',
		'mbl_id_cliente',
		'mbl_id_notify',
		'mbl_net_rate',
		'mbl_selling_rate',
		'mbl_rate_comment',
		
		'last_user_edit',
		'last_date_edit',
		'delete_user',
		'delete_date',
		'agente_id',
		
		'factura_id',
		'comodity_id',
		'id_container_type',
		'id_naviera',
		'id_unidad_peso',
		'id_unidad_volumen',
		'id_unidad_peso_vol',
		'peso_volumentrico',
		'id_truck_type',
		'id_tipo_paquete',
		'id_puerto_embarque',
		'id_puerto_desembarque',
		'carrier_id',
		'id_facturar',
		'airportid_embarque',
		'prepaid',
		'airportid_desembarque',
		
		'id_sales_support',
		'id_usuario_creacion',
		'hora_ingreso',
		'notificar_a',
		'pais_origen_carga',
		'codigo_exportador',
		'tarifa_aplicada',
		'routing_secc',
		'routing_cli',
		'routing_int',
		'routing_eci',
		'routing_ag',
		'voyage_id',
		'source',
		'wms_bl_id',
		'ancho',
		'alto',
		'largo',
		'tmp_piezas',
		'tmp_peso',
		'tmp_volumen',
		'piezas_entregadas_wms',
		'tipo_documento',
		'id_solicitud',
		'id_shipper_cliente',
		'id_tarifario_costo',
		'id_coloader',
		'no_piezas',
		'peso',
		'volumen',
		'id_colectar',
		'idbitalpemusa',
		'numbitalpemusa',
		'valor_flete_manifestar',
		'poliza_seguro',
		'container_qty',
		'routing_seg',
		'referencia',
		'routing_fac',
		'id_cliente_order',
		'routing_adu',
		'routing_ter',
		'routing_copy',
	),
)); ?>
