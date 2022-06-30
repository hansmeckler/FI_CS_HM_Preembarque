<?php
/*
$this->breadcrumbs=array(	
	Yii::t('app','TrackingRoutings')=>array('index'),	
	Yii::t('app','Manage'),
);

$this->menu=array(
	
	array('label'=>Yii::t('app','List').' '.Yii::t('app','TrackingRoutings'),'url'=>array('index'), 'icon'=>TbHtml::ICON_ALIGN_JUSTIFY . " " . TbHtml::ICON_COLOR_WHITE),
	
	array('label'=>Yii::t('app','Create').' '.Yii::t('app','TrackingRoutings'),'url'=>array('create','button'=>1, 'text'=>Yii::t('app','Create').' '.Yii::t('app','TrackingRoutings')), 'icon'=>TbHtml::ICON_FILE . " " . TbHtml::ICON_COLOR_WHITE, 'visible'=> Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['create'] == 1 ? true : false),
	
	//array('label'=>Yii::t('app','Search'),'url'=>array('search'), 'icon'=>TbHtml::ICON_SEARCH . " " . TbHtml::ICON_COLOR_WHITE),
	
	array('label'=>Yii::t('app','Excel'),'url'=>array('GenerateExcel'), 'icon'=>TbHtml::ICON_TH . " " . TbHtml::ICON_COLOR_WHITE, "visible"=> Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['excel'] == 1 ? true : false),
	
	array('label'=>Yii::t('app','Pdf'),'url'=>array('GeneratePdf'), 'icon'=>TbHtml::ICON_BOOK . " " . TbHtml::ICON_COLOR_WHITE, "visible"=> Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['pdf'] == 1 ? true : false),	
); */
?>

<h1><?php echo Yii::t('app','Manage').' '.Yii::t('app','TrackingRoutings'); ?> </h1>

<?php $this->widget('zii.widgets.grid.CGridView', array( 
	'id'=>'tracking-routings-grid',
	'dataProvider'=>$model->search(),
	    
	'selectableRows'=>1,		
	'cssFile' => Yii::app()->request->baseUrl.'/css/gridview/styles.css',
	'template' => "{pager}\n{summary}\n{items}",	
	'pager' => array(	    	
	   	'cssFile'=>Yii::app()->request->baseUrl.'/css/pager.css',	    	
	),
	'pagerCssClass'=>'pagination pagination-centered',	
	'htmlOptions'=>array('style'=>'cursor: pointer;'),
	    
	'filter'=>$model,
	'columns'=>array(
		'id',
		
		array('name'=>'id_pais','filter' => CHtml::listData( Paises::model()->findAllBySql($sql), 'codigo', 'codigo'),),	
		
		array('name'=>'fecha_estatus','value'=>'date("d/m/Y",strtotime($data->fecha_estatus))'),
				
		'hora_estatus',
		
		'routing_cli',
		array('name'=>'routing_no','value'=> 'isset($data->routingCli) ? $data->routingCli->routing : $data->routing_no '),
				
		'id_cliente',
		array('name'=>'nombre_cliente','value'=> 'isset($data->idCliente) ? $data->idCliente->nombre_cliente : $data->nombre_cliente '),
		
		'id_estatus',
		'name_es',
		//array('name'=>'id_estatus','header'=>'Estatus','value'=> 'isset($data->idEstatus) ? $data->idEstatus->estatus : $data->id_estatus '),
		
		'comentario',		
		'usuario',
		
		array('name'=>'activo','value'=> '$data->activo == 1 ? "On":"Off"','filter' => array('1'=>'On','0'=>'Off'),),
		array('name'=>'borrado','value'=> '$data->borrado == 1 ? "On":"Off"','filter' => array('1'=>'On','0'=>'Off'),),
		
				
				
		/*
		'fecha_server',
		'name_es',
		'name_en',		
		'id_pais',
		'notificacion',
		'modificado',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',			
			'template'=>'{update}{view}',
            'buttons'=>array(            	
                'update'=>
                    array(                    	
                	 	'url'=>'$this->grid->controller->createUrl("update", array("id"=>$data->primaryKey))',
						'options'=>array(    						
    						'onclick'=>'if ("' . $this->asDialog . '") { crud_frame_adjust($(this).attr("href"),"'.Yii::t("app","Update").' TrackingRoutings",2); return false;}',
	                    ),
	                    'visible'=>Yii::app()->session['permisos'][Yii::app()->controller->id][Yii::app()->controller->id]['update'] == 1 ? 'true' : 'false',
                   	),
            ),				
		),
		*/
	),
)); ?>

<?php
/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	$('#myModalSearch').modal('show');
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tracking-routings-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php ob_start(); ?>

<p>
Opcionalmente puedes ingresar operadores de comparacion (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al principio de cada una de tus valores de busqueda para especificar como debe realizarse la comparacion.
</p>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $render_search = ob_get_contents(); ob_end_clean(); ?>

<?php $this->widget('bootstrap.widgets.TbModal', array(
		    'id' => 'myModalSearch',           
		    'header' => 'Modal Heading',
		    'htmlOptions'=>array('style'=>'width:75%; left:35%;'),    
		    'content' => $render_search,
		    'footer' => array(
		        //TbHtml::button('Save Changes', array('id'=>'btn-save-modal', 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
		        TbHtml::button('Close', array('id'=>'myModalSearch-close','data-dismiss' => 'modal')),
		    ),    
		)
	);	*/ ?> 
