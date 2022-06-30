<?php

	$columns = array(
	array('name'=>'id_routing','cssClassExpression'=> '$data->css'),
	array('name'=>'activo','header'=>'Estado','value'=>'$data->css'	,'cssClassExpression'=> '$data->css'	),
	array('name'=>'routing_int',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'routing',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'id_pais',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'id_pais_origen',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'id_pais_destino',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'fecha',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'order_no',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'nombre_transporte',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'import_export',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'nombre_creacion',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'cotizacion_id',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'nombre_cliente',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'no_embarque',	'cssClassExpression'=> '$data->css'	),
	array('name'=>'last_id','value'=>'empty($data->name_es) ? "- - - - -" : $data->last_id." - ".$data->name_es . " " . $data->fecha_estatus . " " . $data->hora_estatus . " Usuario : " . $data->usuario0->pw_gecos','cssClassExpression'=> '$data->css'),
	);

$titulo = "Routings";

include_once("CleanGrid.php");

?>
