<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'routings-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
	'focus'=>array($model,'cotizacion_id'),
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'cotizacion_id',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'vendedor_id',CHtml::listData(UsuariosEmpresas::model()->findAll(array("condition"=>"","order"=>"")),'id_usuario','pw_name'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->textFieldRow($model,'order_no',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'reference',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->dateFieldRow($model,'fecha',array('class'=>'span2')); ?>

	<?php echo $form->dropDownListRow($model,'id_routing_type',CHtml::listData(RoutingType::model()->findAll(array("condition"=>"","order"=>"")),'id_routing_type','descripcion'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_cliente',CHtml::listData(Clientes::model()->findAll(array("condition"=>"","order"=>"")),'id_cliente','codigo_tributario'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_shipper',CHtml::listData(Clientes::model()->findAll(array("condition"=>"","order"=>"")),'id_cliente','codigo_tributario'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_notify',CHtml::listData(Clientes::model()->findAll(array("condition"=>"","order"=>"")),'id_cliente','codigo_tributario'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->textFieldRow($model,'no_piezas_old',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'peso_old',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'volumen_old',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ciudad_origen',array('class'=>'span5','maxlength'=>60)); ?>

	<?php echo $form->textFieldRow($model,'ciudad_destino',array('class'=>'span5','maxlength'=>60)); ?>

	<?php echo $form->textFieldRow($model,'no_embarque',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->dropDownListRow($model,'id_incoterms',CHtml::listData(Incoterms::model()->findAll(array("condition"=>"","order"=>"")),'id_incoterms','descripcion'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->checkBoxRow($model,'bodega_prov_emb'); ?>

	<?php echo $form->dropDownListRow($model,'id_transporte',CHtml::listData(Transporte::model()->findAll(array("condition"=>"","order"=>"")),'id_transporte','descripcion'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->checkBoxRow($model,'tramite_aduanal'); ?>

	<?php echo $form->checkBoxRow($model,'seguro'); ?>

	<?php echo $form->textFieldRow($model,'porcentaje_seguro',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'lugar_entrega',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'solicitado_por',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'observaciones',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mbl_id_shipper',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mbl_id_cliente',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mbl_id_notify',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mbl_net_rate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mbl_selling_rate',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'mbl_rate_comment',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->checkBoxRow($model,'activo'); ?>

	<?php echo $form->textFieldRow($model,'last_user_edit',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'last_date_edit',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'delete_user',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'delete_date',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'agente_id',CHtml::listData(Agentes::model()->findAll(array("condition"=>"","order"=>"")),'agente_id','direccion'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->textFieldRow($model,'routing_no',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'routing',array('class'=>'span5','maxlength'=>25)); ?>

	<?php echo $form->dropDownListRow($model,'id_pais',CHtml::listData(Paises::model()->findAll(array("condition"=>"","order"=>"")),'codigo','descripcion'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->checkBoxRow($model,'import_export'); ?>

	<?php echo $form->textFieldRow($model,'factura_id',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'comodity_id',CHtml::listData(Commodities::model()->findAll(array("condition"=>"","order"=>"")),'commodityid','nameen'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_container_type',CHtml::listData(ContainerType::model()->findAll(array("condition"=>"","order"=>"")),'id_container_type','short_name'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_naviera',CHtml::listData(Navieras::model()->findAll(array("condition"=>"","order"=>"")),'id_naviera','nit'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_unidad_peso',CHtml::listData(UnidadMedida::model()->findAll(array("condition"=>"","order"=>"")),'id_unidad_medida','descripcion_unidad'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_unidad_volumen',CHtml::listData(UnidadMedida::model()->findAll(array("condition"=>"","order"=>"")),'id_unidad_medida','descripcion_unidad'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_unidad_peso_vol',CHtml::listData(UnidadMedida::model()->findAll(array("condition"=>"","order"=>"")),'id_unidad_medida','descripcion_unidad'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->textFieldRow($model,'peso_volumentrico',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'id_truck_type',CHtml::listData(TrucksType::model()->findAll(array("condition"=>"","order"=>"")),'id_truck_type','short_name'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_tipo_paquete',CHtml::listData(TipoPaquete::model()->findAll(array("condition"=>"","order"=>"")),'tipo_id',''), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_pais_origen',CHtml::listData(Paises::model()->findAll(array("condition"=>"","order"=>"")),'codigo','descripcion'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_pais_destino',CHtml::listData(Paises::model()->findAll(array("condition"=>"","order"=>"")),'codigo','descripcion'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->textFieldRow($model,'id_puerto_embarque',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id_puerto_desembarque',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'carrier_id',CHtml::listData(Carriers::model()->findAll(array("condition"=>"","order"=>"")),'carrier_id','name'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->dropDownListRow($model,'id_facturar',CHtml::listData(Clientes::model()->findAll(array("condition"=>"","order"=>"")),'id_cliente','codigo_tributario'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->textFieldRow($model,'airportid_embarque',array('class'=>'span5')); ?>

	<?php echo $form->checkBoxRow($model,'prepaid'); ?>

	<?php echo $form->textFieldRow($model,'airportid_desembarque',array('class'=>'span5')); ?>

	<?php echo $form->checkBoxRow($model,'borrado'); ?>

	<?php echo $form->textFieldRow($model,'id_sales_support',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id_usuario_creacion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'hora_ingreso',array('class'=>'span5','maxlength'=>0)); ?>

	<?php echo $form->textFieldRow($model,'notificar_a',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pais_origen_carga',array('class'=>'span5','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'codigo_exportador',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->dropDownListRow($model,'tarifa_aplicada',CHtml::listData(RoutingTarifa::model()->findAll(array("condition"=>"","order"=>"")),'id_tarifa_aplicada','descripcion'), array('prompt' => '-- Seleccione --')); ?>

	<?php echo $form->textFieldRow($model,'routing_secc',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'routing_cli',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'routing_int',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'routing_eci',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'routing_ag',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'voyage_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'source',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'wms_bl_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ancho',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'alto',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'largo',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'tmp_piezas',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'tmp_peso',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'tmp_volumen',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'piezas_entregadas_wms',array('class'=>'span5','maxlength'=>12)); ?>

	<?php echo $form->textFieldRow($model,'tipo_documento',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id_solicitud',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id_shipper_cliente',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id_tarifario_costo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id_coloader',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'no_piezas',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'peso',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'volumen',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'id_colectar',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'idbitalpemusa',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'numbitalpemusa',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'valor_flete_manifestar',array('class'=>'span5','maxlength'=>14)); ?>

	<?php echo $form->textFieldRow($model,'poliza_seguro',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'container_qty',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'routing_seg',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'referencia',array('class'=>'span5','maxlength'=>25)); ?>

	<?php echo $form->textFieldRow($model,'routing_fac',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'bl_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'no_bl',array('class'=>'span5','maxlength'=>75)); ?>

	<?php echo $form->textFieldRow($model,'id_cliente_order',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'routing_adu',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'routing_ter',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'routing_copy',array('class'=>'span5')); ?>


	<?php //ob_start(); ?>
	<?php //$section1 = ob_get_contents(); ob_end_clean(); ?>
		
    <?php /*echo TbHtml::tabbableTabs(array(
        array('label' => 'Datos Generales', 'content' => $section1, 'active' => true),
    ), array('placement' => TbHtml::TABS_PLACEMENT_LEFT ) );*/ ?>


<?php if (!$this->asDialog) : ?>

	<div class="form-actions">

		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
			'icon'=>$model->isNewRecord ? 'icon-file icon-white' : 'icon-pencil icon-white',
		)); ?>

	</div>
	
<?php /*else: ?>
	
	
	<?php echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Save',$_SERVER['REQUEST_URI'],array(	
				'update'=>'.modal-body',
   				//'type'=>'POST','dataType'=>'json','beforeSend' => 'function(data){ }', 'success' => 'js:function(data){ }',
            	'error' => 'function(data) {                   
    	        	alert(data.responseText);
	            }',
            ),
			array('style'=>'display:none'
	)); */ ?>
		
<?php endif; ?>
	

<?php $this->endWidget(); ?>
