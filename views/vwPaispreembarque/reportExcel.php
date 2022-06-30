<?php $columns = array(
		'id_routing',
		//'activo',
		'routing',
		'id_pais_origen',
		'id_pais_destino',
		'fecha',
		'order_no',
		
		array('name'=>'nombre_transporte','value'=>'isset($data->idTransporte) ? $data->id_transporte." - ".$data->idTransporte->descripcion : $data->id_transporte'),

		

		'import_export',
		
		array('name'=>'nombre_usuario','value'=>'isset($data->idUsuarioCreacion) ? $data->id_usuario_creacion." - ".$data->idUsuarioCreacion->pw_gecos : $data->id_usuario_creacion'),

		
		'cotizacion_id',
		
		array('name'=>'nombre_cliente','value'=>'isset($data->idCliente) ? $data->id_cliente." - ".$data->idCliente->nombre_cliente : $data->id_cliente'),
		
		'no_embarque',
		
		array('name'=>'last_estatus','value'=>'isset($data->trackingsLast->name_es) ? $data->trackingsLast->id." - ".$data->trackingsLast->name_es . " " . $data->trackingsLast->fecha_estatus . " " . $data->trackingsLast->hora_estatus . " Usuario : " . $data->trackingsLast->usuario0->pw_gecos : ""'),
		
		
); 

$titulo = "Routings Pendientes de RO Interno";

include_once("CleanGrid.php");

?>

