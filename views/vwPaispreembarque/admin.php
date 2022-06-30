<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
");

$condition = VwPaispreembarqueController::actionWhere(1);	

$where = str_replace('t.','',$condition);
			
$sqlc = "select distinct id_pais from vw_preeroutings_alerta where $where order by id_pais";

$sqlo = "select distinct id_pais_origen from vw_preeroutings_alerta where ".str_replace("LTF","",$where)." order by id_pais_origen";

$sqld = "select distinct id_pais_destino from vw_preeroutings_alerta where ".str_replace("LTF","",$where)." order by id_pais_destino";

$sqlf = "select distinct fecha from vw_preeroutings_alerta where $where order by fecha desc";

//echo $where;
?>


<h2><?php echo CHtml::encode("Pendientes de RO Interno")."&nbsp;".
CHtml::link('<i class="icon-resize-full icon-white"></i> Rangos', '#',
array('class'=>'search-button','title'=>'Editar Rangos de Fechas','style'=>'font-size:12px;')
)
.'&nbsp;<font class="badge badge-warning" style="font-size:18px;padding:6px;" title="Fecha Inicial">'.(empty(Yii::app()->session['fecha_i']) ? '' : date('d/m/Y',strtotime(Yii::app()->session['fecha_i']))).'</font>
<font class="badge badge-warning" style="font-size:18px;padding:6px;" title="Fecha Final">'.(empty(Yii::app()->session['fecha_f']) ? '' : date('d/m/Y',strtotime(Yii::app()->session['fecha_f']))).'</font>&nbsp;'
.CHtml::link('<i class="icon-share icon-white"></i> Excel', 
Yii::app()->createUrl('VwPaispreembarque/GenerateExcel',array("count"=>$model->search()->getTotalItemCount())),
array('class'=>'btn btn-success','title'=>'Exportar a Excel','target'=>'_blank')
);
?></h2>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vw-paispreembarque-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>1,		
	'template' => "{summary}\n{pager}\n{items}",	
	'pager'=>array(
        'header'         => '',
        'firstPageLabel' => '<i class=\'icon-step-backward icon-blue-light\'></i>',
        'prevPageLabel'  => '<i class=\'icon-backward icon-blue-light\'></i>',
        'nextPageLabel'  => '<i class=\'icon-forward icon-blue-light\'></i>',
        'lastPageLabel'  => '<i class=\'icon-step-forward icon-blue-light\'></i>',
    ),		
	'columns'=>array(
	
		//'routing_int',
		
		array('name'=>'id_routing',
		'cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',),

		array('name'=>'days',
		'cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',),
	
	

		array('name'=>'borrado',

		'value'=>'
		
		$data->borrado == 1 ? 
		
			CHtml::link("<span class=\"icon-search icon-orange\"></span>","",array("class"=>"btn btn-small btn-block", "title"=>"Vista Routing", 			
			"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank", 			
			"url"=>$this->grid->controller->createUrl("/Routings/view", array("id"=>$data->primaryKey)),			
			"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Routing\",0);",			
			))						
		:

			CHtml::link("<span class=\"icon-search icon-blue\"></span>","",array("class"=>"btn btn-small btn-warning btn-block", "title"=>"Vista Routing", 			
			"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank", 			
			"url"=>$this->grid->controller->createUrl("/Routings/view", array("id"=>$data->primaryKey)),			
			"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Routing\",0);",			
			))			

		','type'=>'raw','header'=>'View','filter' => array(1=>'Borrado',0=>'Activo'), 
		),
				
			
		array('name'=>'routing','value'=>'$data->routing','value'=>'"<span style=white-space:nowrap;>".$data->routing."</span>"', 'type'=>'raw','cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',),
					
		array('name'=>'id_pais_origen','filter' => CHtml::listData( Routings::model()->findAllBySql($sqlo), 'id_pais_origen', 'id_pais_origen'),'cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',		
		),
		
		array('name'=>'id_pais_destino','filter' => CHtml::listData( Routings::model()->findAllBySql($sqld), 'id_pais_destino', 'id_pais_destino'),'cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',),
						
		//'fecha',
			
			
		array('name'=>'fecha',
		//'value'=>'date("d/m/Y",strtotime($data->fecha))','filter' => CHtml::listData( Routings::model()->findAllBySql($sqlf), 'fecha', 'fecha'),
		'cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',),
					
		/*
		'borrado',
		'routing_int',		
		'id_pais',		
		'fecha',
		'order_no',
		'id_transporte',
		'import_export',
		'id_usuario_creacion',
		'cotizacion_id',
		'no_embarque',
		'id_cliente',
		'id_routing_type',
		*/
		
		
		array('name'=>'order_no','value'=>'"<font color=blue onmouseover=\'this.style.cursor=\"pointer\"\' 		
		title=\'$data->order_no\'><u>".substr($data->order_no,0,16). (empty($data->order_no) ? "" : "..")."</u></font>"',
		'type'=>'raw','htmlOptions' => array('style'=>'width:120px;white-space:nowrap;'),'cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',),
		
		array('name'=>'nombre_transporte','value'=>'"<font color=blue onmouseover=\'this.style.cursor=\"pointer\"\' 		
		title=\'".$data->id_transporte." - ".(isset($data->idTransporte) ? $data->idTransporte->descripcion : "")."\'><u>".substr((isset($data->idTransporte) ? $data->idTransporte->descripcion : ""),0,8)."..</u></font>"',
		'type'=>'raw',
		
		
		'cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',
		
		'filter'=>
		CHtml::listData(Transporte::model()->findAll(array("condition"=>"id_transporte NOT IN (6,8,9)","order"=>"descripcion")), 'descripcion', 'descripcion')	
		),
		
		//'import_export',
		
		array('name'=>'import_export',
		'value'=>'$data->import_export == \'t\' ? "Imp" : ($data->import_export != \'t\' ? "Exp" : "*")',		
		'filter' => array('t'=>'Imp','f'=>'Exp'),
		
		'cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',),
		
		array('name'=>'nombre_usuario','value'=>'"<font color=blue onmouseover=\'this.style.cursor=\"pointer\"\' 		
		title=\'".$data->id_usuario_creacion." - ".(isset($data->idUsuarioCreacion) ? $data->idUsuarioCreacion->pw_gecos : "")."\'><u>".substr((isset($data->idUsuarioCreacion) ? $data->idUsuarioCreacion->pw_gecos : ""),0,10)."..</u></font>"',
		'type'=>'raw','htmlOptions' => array('style'=>'white-space:nowrap;'),'cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',),
		
		//'routing_int',
		//array('name'=>'routing_cli','value'=> 'isset($data->routingCli) ? $data->routingCli->routing : "" '),
		array('name'=>'cotizacion_id','cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))'),
		
		//array('name'=>'vendedor_id','value'=> 'isset($data->vendedor) ? $data->vendedor->pw_name : $data->vendedor_id '),
		//'reference',
		//'id_cliente',
		
		array('name'=>'nombre_cliente','value'=>'"<font color=blue onmouseover=\'this.style.cursor=\"pointer\"\' 		
		title=\'".$data->id_cliente." - ".(isset($data->idCliente) ? $data->idCliente->nombre_cliente : "")."\'		
		><u>".substr((isset($data->idCliente) ? $data->idCliente->nombre_cliente : ""),0,8)."..</u></font>"',
		'type'=>'raw','htmlOptions' => array('style'=>'white-space:nowrap;'),'cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',),	

//array('name'=>'id_shipper','value'=> 'isset($data->idShipper) ? $data->idShipper->codigo_tributario : $data->id_shipper '),
//array('name'=>'id_notify','value'=> 'isset($data->idNotify) ? $data->idNotify->codigo_tributario : $data->id_notify '),
		array('name'=>'no_embarque','value'=>'"<font color=blue onmouseover=\'this.style.cursor=\"pointer\"\' 		
		title=\'$data->no_embarque\'><u>".substr($data->no_embarque,0,8). (empty($data->no_embarque) ? "" : "..")."</u></font>"','type'=>'raw','cssClassExpression'=>'$data->borrado == 1 ? "borrado" : ($data->routing_int == 0 ? (Yii::app()->session["pendientes"] ? "nointerno" : "activo") : ($data->routingInt->bl_id == 0 ? "activo" : "bloq"))',),
		
		
		//'last_estatus',

		array('name'=>'last_estatus','value'=>'		
		(count($data->trackings) == 0 ? 	
			
			($data->routing_int == 0 ?

				CHtml::link("<span class=\"icon-remove icon-gray\"></span>", "#", array("class"=>"btn btn-small", "title"=>"Sin Estatus"))
				.
				CHtml::link("<span class=\"icon-ban-circle icon-red\"></span>", "#", array("class"=>"btn btn-small", "title"=>"Sin RO Interno"))
			
			:
				CHtml::link("<span class=\"icon-remove icon-gray\"></span>", "#", array("class"=>"btn btn-small btn-block", "title"=>"Sin Estatus"))
			)

		:
			(count($data->trackingsToday) > 0 ? 	
				
				CHtml::link(substr($data->trackingsLast->name_es,0,6)."..", "", array("class"=>"btn btn-small btn-success btn-block",			
				"title" => isset($data->trackingsLast) ? "Estatus : " . $data->trackingsLast->name_es . "\n" . "Comentario : " . $data->trackingsLast->comentario . "\n" . "Fecha : " . $data->trackingsLast->fecha_estatus . " " . $data->trackingsLast->hora_estatus . "\nUsuario : " . $data->trackingsLast->usuario0->pw_gecos : "",				
				"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank", 			
				"url"=>$this->grid->controller->createUrl("/TrackingRoutings/consult", array("id"=>$data->primaryKey)),	
				
				"titulo"=>"
						
				<span>Routing</span>:<span class=\"badge badge-info\">".$data->routing."</span>
						
				&nbsp;&nbsp;
						
				<span>Pais Creacion</span>:<span class=\"badge badge-info\">".$data->id_pais."</span>
						
				&nbsp;&nbsp;
						
				<span>Pais Origen</span>:<span class=\"badge badge-info\">".$data->id_pais_origen."</span>
					
				&nbsp;&nbsp;
					
				<span>Pais Destino</span>:<span class=\"badge badge-info\">".$data->id_pais_destino."</span>

				&nbsp;&nbsp;",
							
				"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"View Estatus \" + $(this).attr(\"titulo\") ,0);",
				
				))
			:
				CHtml::link(substr($data->trackingsLast->name_es,0,6)."..", "", array("class"=>"btn btn-small btn-warning btn-block", 
				"title" => isset($data->trackingsLast) ? "Estatus : " . $data->trackingsLast->name_es . "\n" . "Comentario : " . $data->trackingsLast->comentario . "\n" . "Fecha : " . $data->trackingsLast->fecha_estatus . " " . $data->trackingsLast->hora_estatus . "\nUsuario : " . $data->trackingsLast->usuario0->pw_gecos : "",
				"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank", 			
				"url"=>$this->grid->controller->createUrl("/TrackingRoutings/consult", array("id"=>$data->primaryKey)),		
				
				"titulo"=>"
						
				<span>Routing</span>:<span class=\"badge badge-info\">".$data->routing."</span>
						
				&nbsp;&nbsp;
						
				<span>Pais Creacion</span>:<span class=\"badge badge-info\">".$data->id_pais."</span>
						
				&nbsp;&nbsp;
						
				<span>Pais Origen</span>:<span class=\"badge badge-info\">".$data->id_pais_origen."</span>
					
				&nbsp;&nbsp;
					
				<span>Pais Destino</span>:<span class=\"badge badge-info\">".$data->id_pais_destino."</span>

				&nbsp;&nbsp;

				<span>No.</span>:",
			
				"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"View Estatus \" + $(this).attr(\"titulo\") ,0);",
			
				))
			)
		)		
		',
		'type'=>'raw','htmlOptions' => array('style'=>'white-space:nowrap;'),
		'filter' => array('> 1'=>'Con Estatus','0'=>'Sin Estatus'),
		),
				
		/*
		array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>
