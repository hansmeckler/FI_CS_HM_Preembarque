<?php $columns = array(
		'id_routing',
				
		array('name'=>'activo', 'value'=>'$data->activo == 1 ? "Activo" : "Inactivo"'),
		array('name'=>'borrado', 'value'=>'$data->borrado == 1 ? "Borrado" : ""'),

		'routing',

		array('name'=>'routing_int', 

			'value'=>'$data->routing_int > 0 ? 
				isset($data->routingInt) ? $data->routing_int . " - " . $data->routingInt->routing : $data->routing_int
			: ""',

			'htmlOptions' => array('style'=>'text-align:center;')),		

		array('name'=>'routing_int', 'header' => 'Trafico',

			'value'=>'isset($data->routingInt->no_bl) ? 

					($data->routingInt->bl_id > 0 ?

					"Bl:" . $data->routingInt->bl_id . " Bl No:" . $data->routingInt->no_bl . " Fecha Trafico : " . ($data->routingInt->bl_id_fecha == "1970-01-01 00:00:00" ? "" : date("d/m/Y H:i:s", strtotime($data->routingInt->bl_id_fecha))) 
					: "-")
					: ""',
		),
		
		array('name'=>'id_pais', 'htmlOptions' => array('style'=>'width:50px;')),		
		array('name'=>'id_pais_origen', 'htmlOptions' => array('style'=>'width:50px;')),		
		array('name'=>'id_pais_destino', 'htmlOptions' => array('style'=>'width:50px;')),		

		array('name'=>'fecha', 'htmlOptions' => array('style'=>'text-align:center;')),		

		array('name'=>'order_no', 'htmlOptions' => array('style'=>'text-align:left;')),		
	
		array('name'=>'nombre_transporte','value'=>'isset($data->idTransporte) ? $data->id_transporte." - ".$data->idTransporte->descripcion : $data->id_transporte'),

		array('name'=>'import_export', 'value'=>'$data->import_export == 1 ? "Import" : "Export"'),		
		
		array('name'=>'nombre_usuario','value'=>'isset($data->idUsuarioCreacion) ? $data->id_usuario_creacion." - ".$data->idUsuarioCreacion->pw_gecos : $data->id_usuario_creacion'),
		
		'cotizacion_id',
		
		array('name'=>'nombre_cliente','value'=>'isset($data->idCliente) ? $data->id_cliente." - ".$data->idCliente->nombre_cliente : $data->id_cliente'),
		
		'no_embarque',
		
		array('name'=>'last_estatus','value'=>'isset($data->trackingsLast->name_es) ? $data->trackingsLast->id." - ".$data->trackingsLast->name_es . " " . $data->trackingsLast->fecha_estatus . " " . $data->trackingsLast->hora_estatus . " Usuario : " . $data->trackingsLast->usuario0->pw_gecos : ""'),
); 

$titulo = "Ingreso de Estatus a Routings";

include_once("CleanGrid.php");

?>

