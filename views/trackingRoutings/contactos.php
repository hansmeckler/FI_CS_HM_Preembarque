<?php
	//echo "<strong>";
	echo '<div class="alert alert-info">';
	if ($id == 0) echo "Estatus Nuevo : ";
	
	if (isset($estatus))
		echo $estatus;
		//echo $estatus->id." - ".$estatus->estatus;
	
	//echo "</strong>";
	
	echo '</div>';
			

	if ($id > -1) {
?>
<style>#tracking-contactos-grid .items { display: block; height:350px; overflow-y: scroll; }</style><?php $rawData1 = json_decode($rawData,true); $rawData2 = str_replace("\\","",$rawData1); $dataProvider = new CArrayDataProvider($rawData2


, array(

    'pagination'=>false,
    
    /*array(
        'pageSize' => SomeModel::model()->count(),
    ),*/          
)


); $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tracking-contactos-grid',	
	'dataProvider'=>$dataProvider,	
	//'itemsCssClass'=>'table table-hover table-striped table-bordered table-condensed',		
	'selectableRows'=>1,
	'cssFile' => Yii::app()->request->baseUrl.'/css/gridview/styles.css',
	'template' => "{pager}\n{summary}\n{items}",	
	'pager' => array(	    	
	   	'cssFile'=>Yii::app()->request->baseUrl.'/css/pager.css',	    	
	),
	'pagerCssClass'=>'pagination pagination-centered',
	'columns'=>array(
		
		array('name'=>'id', 'type'=>'raw', 'value' => '
		
		(isset($data["id_cliente"]) ?
		
		CHtml::link("<span class=\"icon-pencil icon-white\"></span>", "http://10.10.1.20/catalogo_new/index.php?r=clientes/update&id=" . $data["id_cliente"], array("class"=>"btn btn-small btn-warning btn-block", "title"=>"Editar Contacto Catalogos", "target"=>"_blank")) : $data["id"])
		
		'
		,'header'=>'ID'
		,'htmlOptions'=>array('style'=>'width:60px')
		),
				
		array('name'=>'tipo','header'=>'Tipo Contacto','htmlOptions'=>array('style'=>'width:120px')),
		array('name'=>'nombre','header'=>'Nombre','htmlOptions'=>array('style'=>'width:200px')),
		array('name'=>'email','header'=>'Email','htmlOptions'=>array('style'=>'width:220px')),
		array('name'=>'copia','header'=>'Recibe Copias','htmlOptions'=>array('style'=>'width:100px')),
		array('name'=>'rechazo','header'=>'Recibe Rechazos','htmlOptions'=>array('style'=>'width:100px')),
		
	),
)); 
} else {
	
	
	echo '
	
	<div class="alert alert-info">	
		Para ver lo contactos, seleccione algun estatus de la pestaña Consulta Estatus ó Ingrese algun estatus
	</div>
	
		';
}
?>	