<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
");

$condition = Routings::actionWhere(1);
$where = str_replace('t.','',$condition);
$sqlc = "select distinct id_pais from vw_preeroutings_alerta where $where order by id_pais";
$sqlo = "select distinct id_pais_origen from vw_preeroutings_alerta where ".str_replace("LTF","",$where)." order by id_pais_origen";
$sqld = "select distinct id_pais_destino from vw_preeroutings_alerta where ".str_replace("LTF","",$where)." order by id_pais_destino";
$sqlf = "select distinct fecha from vw_preeroutings_alerta where $where order by fecha desc";
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	//'action'=>Yii::app()->createUrl($this->route),
	'action'=>Yii::app()->createUrl('VwRoutingsAlerta/admin'),
	'method'=>'POST',
)); ?>

<h2><?php echo CHtml::encode("RO's Interno Pendientes")."&nbsp;del&nbsp;";
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
		//'placeholder' => 'Seleccione fecha inicio',
		//'required'=>'on',
		'readonly'=>true,
		'onmouseover'=>'this.style.cursor="pointer"',
		'onkeydown'=>'return false',
		//'style'=>'background:#D2E6F5;width:100px',
		'style'=>'width:100px;position:relative;top:5px;border:0px',
		'class'=>'btn btn-warning',
		'title'=>'Seleccione Fecha',
	),
));

echo "&nbsp;al&nbsp;</font>";

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
Yii::app()->createUrl('VwRoutingsAlerta/GenerateExcel',array("count"=>$model->search()->getTotalItemCount())),
array('class'=>'btn btn-success','title'=>'Exportar a Excel','target'=>'_blank')
);

?></h2>

<?php $this->endWidget(); ?>


<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
));*/ ?>
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
	'id'=>'vw-routings-alerta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows'=>1,
	'beforeAjaxUpdate'=>'function(id,options){
		DisplayLogo(options.url);
	}',	
	'template' => "{summary}\n{pager}\n{items}",
	'pager'=>array(
				'class' => 'CLinkPager',
				'header'         => '',
				'maxButtonCount'    => 20,
/*
        'firstPageLabel' => '<i class=\'icon-step-backward icon-blue-light\'></i>',
        'prevPageLabel'  => '<i class=\'icon-backward icon-blue-light\'></i>',
        'nextPageLabel'  => '<i class=\'icon-forward icon-blue-light\'></i>',
        'lastPageLabel'  => '<i class=\'icon-step-forward icon-blue-light\'></i>',
*/
    ),
    'cssFile' => Yii::app()->baseUrl . '/css/gridview/stylesAlerta.css',
	'columns'=>array(

		array(
            'header'=>'#', 'value'=>'$row + ($this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize) + 1',

        ),


	array( //'name'=>'borrado',
		'value'=>'
		$data->borrado == 1 ?
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

		//'id_catalogo',
		array('name'=>'id_routing','headerHtmlOptions'=>array('title'=>'Routing ID')),

		array('name'=>'days','headerHtmlOptions'=>array('title'=>'Dias acumulados sin RO Interno')),

		//'activo',
		//'borrado',
		//routing_int
		//array('name'=>'routing_int','value'=>'"<span style=white-space:nowrap;>".$data->routing_int."</span>"', 'type'=>'raw',),

		//routing
		array('name'=>'routing','htmlOptions' => array('style'=>'white-space:nowrap;'),'type'=>'raw',),

    //id_pais
		array('name'=>'id_pais','filter' => CHtml::listData( VwRoutingsAlerta::model()->findAllBySql($sqlc), 'id_pais', 'id_pais')
		//'visible'=> true, //pendiente de validar usuarios gerenciales, ven esta columna
		,'headerHtmlOptions'=>array('title'=>'Pais Creacion')
		),

        //id_pais_origen
		array('name'=>'id_pais_origen','filter' => CHtml::listData( VwRoutingsAlerta::model()->findAllBySql($sqlo), 'id_pais_origen', 'id_pais_origen')
		,'headerHtmlOptions'=>array('title'=>'Pais Origen')
		),

		//id_pais_destino
		array('name'=>'id_pais_destino','filter' => CHtml::listData( VwRoutingsAlerta::model()->findAllBySql($sqld), 'id_pais_destino', 'id_pais_destino')
		,'headerHtmlOptions'=>array('title'=>'Pais Destino')
		),

		//fecha
		array('name'=>'fecha',
		'filter' => CHtml::listData( VwRoutingsAlerta::model()->findAllBySql($sqlf), 'fecha', 'fecha') ),

		//order_no
		array('name'=>'order_no', 'value'=>array($this, 'shortText'),'type'=>'raw','htmlOptions' => array('style'=>'width:120px;white-space:nowrap;'),),

		//'id_routing_type',
		//'id_transporte',

		//nombre_transporte
		array('name'=>'transporte', 'value'=>array($this, 'shortText'), 'type'=>'raw',  'filter'=>CHtml::listData(Transporte::model()->findAll(array("condition"=>"id_transporte NOT IN (6,8,9)","order"=>"descripcion")), 'letra', 'descripcion')),

		//import_export
		array('name'=>'import_export','filter' => array('Import'=>'Import','Export'=>'Export'),'headerHtmlOptions'=>array('title'=>'Import / Export')),

		//'id_usuario_creacion',
		//'nombre_creacion',
		array('name'=>'nombre_creacion', 'value'=>array($this, 'shortText'), 'type'=>'raw','htmlOptions' => array('style'=>'white-space:nowrap;'),),

		//cotizacion_id
		array('name'=>'cotizacion_id'),

		//'id_cliente',
		//'nombre_cliente',
		array('name'=>'nombre_cliente', 'value'=>array($this, 'shortText'), 'type'=>'raw', 'htmlOptions' => array('style'=>'white-space:nowrap;'), ),

		//'no_embarque',
		array('name'=>'no_embarque', 'value'=>array($this, 'shortText'), 'type'=>'raw', ),

		//last_estatus
		array('name'=>'last_id','value'=>'
		($data->last_id == 0 ?
				CHtml::link("<span class=\"icon-remove icon-gray\"></span>", "#", array("class"=>"btn btn-small btn-block", "title"=>"Sin Estatus"))
		:
				CHtml::link(substr(strtolower($data->name_es),0,6)."..", "", array("class"=>"btn btn-small btn-" . (count($data->trackingsToday) > 0 ? "success" : "warning")  . " btn-block",
				"title" => empty($data->name_es) ? "" : "Estatus : " . $data->name_es . "\n" . "Comentario : " . $data->comentario . "\n" . "Fecha : " . $data->fecha_estatus . " " . $data->hora_estatus . "\nUsuario : " . $data->usuario0->pw_gecos . (empty($data->fecha_alerta) ? "" : "\n\nFecha Alerta Hoy : " . date("d/m/Y",strtotime($data->fecha_alerta))),
				"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
				"url"=>$this->grid->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->primaryKey,"c"=>1)),
				"titulo"=>"Routing : ".$data->routing,
				"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"View Estatus \" + $(this).attr(\"titulo\") ,0);",
				"style"=>"height:20px;"
				))
		)
		',
		'type'=>'raw',
		'filter' => array('>0'=>'Con Estatus','0'=>'Sin Estatus'),
		'headerHtmlOptions' => array('style'=>'white-space:nowrap;'),
		),

	),
)); ?>

