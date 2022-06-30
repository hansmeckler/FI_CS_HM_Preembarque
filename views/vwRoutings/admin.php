<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
");

$condition = Routings::actionWhere(2);
$where = str_replace('t.','',$condition);
$sqlc = "select distinct id_pais from vw_preeroutings where $where order by id_pais";
$sqlo = "select distinct id_pais_origen from vw_preeroutings where $where order by id_pais_origen";
$sqld = "select distinct id_pais_destino from vw_preeroutings where $where order by id_pais_destino";
$sqlf = "select distinct fecha from vw_preeroutings where $where order by fecha desc";
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	//'action'=>Yii::app()->createUrl($this->route),
	'action'=>Yii::app()->createUrl('VwRoutings/admin'),
	'method'=>'POST',
)); ?>


<h2 style="text-shadow: 2px 2px silver;"><?php echo CHtml::encode("Estatus a Routings")."&nbsp;del&nbsp;";
//echo CHtml::link('<i class="icon-resize-full icon-white"></i> Rangos', '#',array('class'=>'search-button','title'=>'Editar Rangos de Fechas','style'=>'font-size:12px;'));

$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	//'themeUrl'=>'/js/jquery-ui-1.8/themes',
	//'theme'=>'ui-lightness',
	'name'=>'fecha_i',
	'value'=>Yii::app()->session['fecha_i'],
	// additional javascript options for the date picker plugin
	'options'=>array(
		'flat'=>true,//remove to hide the datepicker
		'showButtonPanel'=>true,
		'dateFormat' => 'yy-mm-dd',
		//'dateFormat' => 'dd/mm/yy',
		'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
		'changeMonth'=>true,
		'changeYear'=>true,
		//'showOn' => 'button',
		//'buttonImage' => Yii::app()->request->baseUrl . '/images/calendar_select_day.png',
		//'buttonImageOnly' => true,
		//'buttonText' => Yii::t('ui', 'Seleccione fecha'),
	),
	'language'=> Yii::app()->language,
	'htmlOptions'=>array(
		'placeholder' => 'Seleccione fecha inicio',
		//'required'=>'on',
		'readonly'=>true,
		'onmouseover'=>'this.style.cursor="pointer"',
		'onkeydown'=>'return false',
		//'style'=>'background:#D2E6F5;width:100px',
		//'style'=>'width:100px;text-shadow: -1px -1px gray;position:relative;top:5px;',
		'style'=>'width:100px;position:relative;top:5px;border:0px',
		'class'=>'btn btn-warning',
	),
));

echo "&nbsp;al&nbsp;";

$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	//'themeUrl'=>'/js/jquery-ui-1.8/themes',
	//'theme'=>'ui-lightness',
	'name'=>'fecha_f',
	'value'=>Yii::app()->session['fecha_f'],
	// additional javascript options for the date picker plugin
	'options'=>array(
		'flat'=>true,//remove to hide the datepicker
		'showButtonPanel'=>true,
		'dateFormat' => 'yy-mm-dd',
		//'dateFormat' => 'dd/mm/yy',
		'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
		'changeMonth'=>true,
		'changeYear'=>true,
		//'showOn' => 'button',
		//'buttonImage' => Yii::app()->request->baseUrl . '/images/calendar_select_day.png',
		//'buttonImageOnly' => true,
		//'buttonText' => Yii::t('ui', 'Seleccione fecha'),
	),
	'language'=> Yii::app()->language,
	'htmlOptions'=>array(
		'placeholder' => 'Seleccione fecha inicio',
		//'required'=>'on',
		'readonly'=>true,
		'onmouseover'=>'this.style.cursor="pointer"',
		'onkeydown'=>'return false',
		//'style'=>'background:#D2E6F5;width:100px',
		//'style'=>'width:100px;text-shadow: -1px -1px gray;position:relative;top:5px;',
		'style'=>'width:100px;position:relative;top:5px;border:0px',
		'class'=>'btn btn-warning btn-small',
	),
));

echo "&nbsp;";

$this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit',
	'type'=>'primary',
	'label'=>'Cargar',
	'icon'=>'icon-cog icon-white',
));

echo "&nbsp;";
//echo '&nbsp;<font class="badge badge-warning" style="font-size:18px;padding:6px;" title="Fecha Inicial">'.(empty(Yii::app()->session['fecha_i']) ? '' : date('d/m/Y',strtotime(Yii::app()->session['fecha_i']))).'</font>
//<font class="badge badge-warning" style="font-size:18px;padding:6px;" title="Fecha Final">'.(empty(Yii::app()->session['fecha_f']) ? '' : date('d/m/Y',strtotime(Yii::app()->session['fecha_f']))).'</font>&nbsp;';

echo CHtml::link('<i class="icon-share icon-white"></i> Excel',
Yii::app()->createUrl('VwRoutings/GenerateExcel',array("count"=>$model->search()->getTotalItemCount())),
array('class'=>'btn btn-success','title'=>'Exportar a Excel','target'=>'_blank')
);

?></h2>

<?php $this->endWidget(); ?>




<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */

 //|| strpos(str_replace(substr('.Yii::app()->session["usr_pais"].',0,2)."|","","BZ|CR|GT|HN|BZLTF|CRLTF|GTLTF|HNLTF|NILTF|PALTF|SVLTF|NI|N1|PA|SV|"),$data->id_pais_origen."|") > 0

?>
</div><!-- search-form -->

<style>
h2 {
  text-shadow: 0 1px 0 #ccc,
               0 2px 0 #c9c9c9,
               0 3px 0 #bbb,
               0 4px 0 #b9b9b9,
               0 5px 0 #aaa,
               0 6px 1px rgba(0,0,0,.1),
               0 0 5px rgba(0,0,0,.1),
               0 1px 3px rgba(0,0,0,.3),
               0 3px 5px rgba(0,0,0,.2),
               0 5px 10px rgba(0,0,0,.25),
               0 10px 10px rgba(0,0,0,.2),
               0 20px 20px rgba(0,0,0,.15);
}

/*.summary { font-size:32px; display:inline; float:right;  }*/
#content, h2, .grid-view { margin:0px; padding:0px; }
#content  { position:relative; top:-20px; }
.btn, #fecha_i, #fecha_f { box-shadow: 4px 4px 5px #888888; }
#fecha_i, #fecha_f {
	box-shadow: 0px 9px 10px rgba(0,0,0,0.4), /*orientacion de externa*/
	inset 0px 2px 9px rgba(255,255,255,0.2),
	inset 0 -8px 9px rgba(0,0,0,0.2); /*interna*/
	color:white;
}

#fecha_i:hover, #fecha_f:hover {
	box-shadow: 0px 9px 10px rgba(100,100,100,0.4), /*orientacion de externa*/
	inset 0px 2px 9px rgba(100,100,100,0.2),
	inset 0 -8px 9px rgba(100,100,100,0.2); /*interna*/
	color:black;
}

</style>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vw-routings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>1,
	'beforeAjaxUpdate'=>'function(id,options){
		DisplayLogo(options.url);
	}',
	'template' => "{summary}\n{pager}\n{items}",
	'pager'=>array(
        'header'         => '',
        'firstPageLabel' => '<i class=\'icon-step-backward icon-blue-light\'></i>',
        'prevPageLabel'  => '<i class=\'icon-backward icon-blue-light\'></i>',
        'nextPageLabel'  => '<i class=\'icon-forward icon-blue-light\'></i>',
        'lastPageLabel'  => '<i class=\'icon-step-forward icon-blue-light\'></i>',
    ),
	'columns'=>array(
		array('header'=>'#', 'value'=>'$row + ($this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize) + 1','cssClassExpression'=>'$data->css'),
		/*array('name'=>'button',
		'value'=>'
		CHtml::link("<span class=\"icon-pencil icon-white\"></span>","",array("class"=>"btn btn-small btn-primary btn-block",
	    "title"=>"Input Estatus / " . ($data->button == 0 ? "Sin RO" : "Con RO") ,
	    "data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
	    "url"=>$this->grid->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->primaryKey,"c"=>0)),
	    "titulo"=>"Routing : ".$data->routing,
	    "onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Input Estatus \" + $(this).attr(\"titulo\") ,0);",
	    ))
		','type'=>'raw'
		,'filter' => array(0=>'Input Sin RO',1=>'Input Con RO',2=>'Bloqueado',3=>'Borrado'),
		),*/

		
		array('name'=>'button',
		'value'=>'
			($data->button == 3 ?
					CHtml::link("<span class=\"icon-trash icon-orange\"></span>","",array("class"=>"btn btn-small btn-block", "title"=>"Borrado / View Estatus",
					"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
					"url"=>$this->grid->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->primaryKey,"c"=>0)),
					"titulo"=>"Routing : ".$data->routing,
					"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Estatus \" + $(this).attr(\"titulo\") ,0);",
					))
			:
					($data->button == 2 ?

							($data->last_id == 0 ?
								CHtml::link("<span class=\"icon-random icon-green\"></span>","",array("class"=>"btn btn-small btn-block", "title"=>"Ro Interno ".$data->routing_int." / Bl:" . $data->bl_id . " Bl No:" . $data->no_bl . " Fecha Trafico : " . ($data->bl_id_fecha == "1970-01-01 00:00:00" ? "" : date("d/m/Y H:i:s",strtotime($data->bl_id_fecha)))  ))
							:
								CHtml::link("<span class=\"icon-random icon-green\"></span>","",array("class"=>"btn btn-small btn-block", "title"=>"Ro Interno ".$data->routing_int." / Bl:" . $data->bl_id . " Bl No:" . $data->no_bl . " Fecha Trafico : " . ($data->bl_id_fecha == "1970-01-01 00:00:00" ? "" : date("d/m/Y H:i:s",strtotime($data->bl_id_fecha))) ,
								"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
								"url"=>$this->grid->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->primaryKey,"c"=>0)),
								"titulo"=>"Routing : ".$data->routing,
								"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Estatus \" + $(this).attr(\"titulo\") ,0);",
								))
							)
					:
							CHtml::link("<span class=\"icon-pencil icon-white\"></span>","",array("class"=>"btn btn-small btn-primary btn-block",
					    "title"=>"Input Estatus / " . ($data->button == 0 ? "Sin RO" : "Con RO") ,
					    "data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
					    "url"=>$this->grid->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->primaryKey,"c"=>0)),
					    "titulo"=>"Routing : ".$data->routing,
					    "onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Input Estatus \" + $(this).attr(\"titulo\") ,0);",
					    ))
					)
			)
		','type'=>'raw'
		,'filter' => array(0=>'Input Sin RO',1=>'Input Con RO',2=>'Bloqueado',3=>'Borrado'),
		),
		

		array( //'name'=>'borrado',
		'value'=>'
		$data->button == 3 ?
			CHtml::link("<span class=\"icon-search icon-orange\"></span>","",array("class"=>"btn btn-small btn-block", "title"=>"Vista Routing",
			"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
			"url"=>$this->grid->controller->createUrl("view", array("id"=>$data->primaryKey)),
			"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Routing\",0);",
			))
		:
			CHtml::link("<span class=\"icon-search icon-blue\"></span>","",array("class"=>"btn btn-small btn-warning btn-block", "title"=>"Vista Routing",
			"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
			"url"=>$this->grid->controller->createUrl("view", array("id"=>$data->primaryKey)),
			"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Routing\",0);",
			))
		','type'=>'raw','header'=>'View','filter' => false, //array(1=>'Borrado',0=>'Activo'),
		),

		//id_routing
		array('name'=>'id_routing', 'cssClassExpression'=>'$data->css','headerHtmlOptions'=>array('title'=>'Routing ID')),

		//routing_int
		array('name'=>'routing_int','cssClassExpression'=>'$data->css','headerHtmlOptions'=>array('title'=>'Routing Interno')),

		//routing
		array('name'=>'routing','cssClassExpression'=>'$data->css','htmlOptions' => array('style'=>'white-space:nowrap;')),

    //id_pais
		array('name'=>'id_pais','cssClassExpression'=>'$data->css','headerHtmlOptions'=>array('title'=>'Pais Creacion')
		,'filter' => CHtml::listData( VwRoutings::model()->findAllBySql($sqlc), 'id_pais', 'id_pais'),
		//'visible'=> false, //pendiente de validar usuarios gerenciales, ven esta columna
		),

    //id_pais_origen
		array('name'=>'id_pais_origen','cssClassExpression'=>'$data->css','headerHtmlOptions'=>array('title'=>'Pais Origen')
		,'filter' => CHtml::listData( VwRoutings::model()->findAllBySql($sqlo), 'id_pais_origen', 'id_pais_origen')),

		//id_pais_destino
		array('name'=>'id_pais_destino','cssClassExpression'=>'$data->css','headerHtmlOptions'=>array('title'=>'Pais Destino')
		,'filter' => CHtml::listData( VwRoutings::model()->findAllBySql($sqld), 'id_pais_destino', 'id_pais_destino'),),

		//fecha
		array('name'=>'fecha','cssClassExpression'=>'$data->css','filter' => CHtml::listData( VwRoutings::model()->findAllBySql($sqlf), 'fecha', 'fecha')),

		//order_no
		array('name'=>'order_no','value'=> array($this,'shortText'),'cssClassExpression'=>'$data->css','htmlOptions'=>array('style'=>'width:120px;white-space:nowrap;'),'type'=>'raw'),

		//transporte
		array('name'=>'transporte','value'=>array($this, 'shortText'),'cssClassExpression'=>'$data->css','type'=>'raw',),

		//import_export
		array('name'=>'import_export','value'=>'substr($data->import_export,0,2)','cssClassExpression'=>'$data->css','headerHtmlOptions'=>array('title'=>'Import / Export'),'filter'=>array('Import'=>'Import','Export'=>'Export')),

		//'id_usuario_creacion',
		//'nombre_creacion',
		array('name'=>'nombre_creacion','value'=>array($this,'shortText'),'cssClassExpression'=>'$data->css','htmlOptions'=>array('style'=>'white-space:nowrap;'),'type'=>'raw'),

		//cotizacion_id
		array('name'=>'cotizacion_id','cssClassExpression'=>'$data->css'),

		//'id_cliente',
		//'nombre_cliente',
		array('name'=>'nombre_cliente','value'=>array($this, 'shortText'),'cssClassExpression'=>'$data->css', 'htmlOptions' => array('style'=>'white-space:nowrap;'),'type'=>'raw'),

		//'no_embarque',
		array('name'=>'no_embarque','value'=>array($this, 'shortText'),'cssClassExpression'=>'$data->css','type'=>'raw'),

		//last_estatus
		array('name'=>'last_id','value'=>'
		($data->last_id == 0 ?
			$data->fecha == date("Y-m-d") ?
				CHtml::link("<span class=\"icon-remove icon-gray\"></span>", "#", array("class"=>"btn btn-small btn-block", "title"=>"Sin Estatus"))
			:
				CHtml::link("<span class=\"icon-remove icon-white\"></span>", "#", array("class"=>"btn btn-small btn-block btn-danger", "title"=>"Sin Estatus"))
		:
				CHtml::link(substr(strtolower($data->name_es),0,6)."..", "", array("class"=>"btn btn-small btn-" . (count($data->trackingsToday) > 0 ? "success" : "warning")  . " btn-block",
				"title" => empty($data->name_es) ? "" : "Estatus : " . $data->name_es . "\n" . "Comentario : " . $data->comentario . "\n" . "Fecha : " . $data->fecha_estatus . " " . $data->hora_estatus . "\nUsuario : " . $data->usuario0->pw_gecos . (empty($data->fecha_alerta) ? "" : "\n\nFecha Alerta Hoy : " . date("d/m/Y",strtotime($data->fecha_alerta))),
				"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
				"url"=>$this->grid->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->primaryKey,"c"=>0)),
				"titulo"=>"Routing : ".$data->routing,
				"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"View Estatus \" + $(this).attr(\"titulo\") ,0);",
				"style"=>"height:20px;"
				))
		)
		',
		'type'=>'raw',
		'filter' => array('>0'=>'Con Estatus','0'=>'Sin Estatus'),
		'headerHtmlOptions' => array('style'=>'white-space:nowrap;'),
		//'htmlOptions' => array('style'=>'height:20px;'),

		),
		//'fechalertorder',

// $data->trackingsLast->usuario0->pw_gecos  .

	),
)); ?>

<?php 
//if (strpos("admin",$_SERVER['REQUEST_URI']))
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = substr($url,0,strpos($url,"admin")+5);
//echo $url;
?>

<script>
/*$('[name="VwRoutings[id_pais]"]').on('change', function() {
	console.log(this.value);
	//$.fn.yiiGridView.update("vw-routings-grid");
	//location.href = '<?=$url?>&pais=' + this.value + '&empresa=' + empresa;
	//return false;
});*/
</script>
