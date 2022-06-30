<?php
/* @var $this TrackingRoutings2Controller */
/* @var $model TrackingRoutings */
/* @var $form CActiveForm */
?>

<div class="form-controls" style="display:block;height:100%">

<?php /* $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tracking-routings-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'focus'=>array($model,'id_estatus'),
)); */ ?>




<?php if(Yii::app()->user->hasFlash('error')): ?>

	<br>
	<div class="alert alert-error">
	<button class="close" data-dismiss="alert" type="button">×</button>
		<?php print_r(Yii::app()->user->getFlash('error')); ?>
	</div>

<?php else: ?>





<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tracking-routings-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'focus'=>array($model,'id_estatus'),
)); ?>

	<?php /*echo $form->hiddenField($model,'routing_cli',array('value'=>$routing->routing_cli)); ?>
	<?php echo $form->hiddenField($model,'id_routing',array('value'=>$routing->id_routing)); ?>
	<?php echo $form->hiddenField($model,'id_pais',array('value'=>$routing->id_pais)); ?>
	<?php echo $form->hiddenField($model,'import_export',array('value'=>$_GET['import'])); ?>
	<?php echo $form->textFieldRow($model,'routing',array('value'=>$routing->routing,'class'=>'span8', 'readonly'=>true, 'required' => true, 'style'=>'height:1.5em')); */ ?>


	<?php echo $form->hiddenField($model,'id_pais_origen'); ?>
	<?php echo $form->hiddenField($model,'id_pais_destino'); ?>
	<?php echo $form->hiddenField($model,'id_routing'); ?>
	<?php echo $form->hiddenField($model,'id_pais'); ?>
	<?php echo $form->hiddenField($model,'import_export'); ?>
	<?php echo $form->hiddenField($model,'id_transporte'); ?>
	<?php echo $form->textFieldRow($model,'routing',array('class'=>'span8', 'readonly'=>true, 'required' => true, 'style'=>'height:1.5em'));  ?>


	<?php //echo $form->dropDownListRow($model,'id_estatus',CHtml::listData(Aimartrackings::model()->findAll(array("condition"=>"pre_embarque = 1","order"=>"")),'id','estatus'), array('prompt' => '-- Seleccione --')); ?>

	<?php /*echo $form->dropDownListRow($model,'id_estatus',CHtml::listData(Aimartrackings::model()->findAll(array("condition"=>"activo = 1 AND ocean = 1 AND import = ".$_GET['import'],"order"=>"estatus")),'id','estatus'),
		array(
		'prompt' => '-- Seleccione --',
		'ajax' => array(
			'type'=>'POST',
			'url'=>Yii::app()->createUrl('TrackingRoutings/loadcomments'), //or $this->createUrl('loadcities') if '$this' extends CController
			'update'=>'#TrackingRoutings_comentario', //or 'success' => 'function(data){...handle the data in the way you want...}',
			'data'=>array('estatus_id'=>'js:this.value'),
			)
		)
	); */?>

<?php
$sql = "SELECT id, concat(secuencia,' ',estatus,'--I',
case when notificar_agente = 1 then 'A' else '' end,
case when notificar_cliente = 1 then 'C' else '' end,
case when notificar_shipper = 1 then 'S' else '' end,
case when publico = 1 then 'P' else '' end) as estatus
FROM aimartrackings WHERE pre_embarque=1 AND activo=1 AND import = '".$model->import_export."' AND id_transporte = '".$model->id_transporte."' AND id >= (SELECT id_estatus FROM (SELECT b.id_estatus FROM tracking_routings b WHERE b.routing_cli = '".$model->id_routing."' ORDER BY b.id DESC) x
UNION SELECT 0 as id_estatus ORDER BY id_estatus DESC LIMIT 1) ORDER BY secuencia";

//roxana solicito quitar el filtro de estatus anteriores segun correo
//Fwd: RE: mejoras modulo pre embarque enviado por cesar 29/05/2017 10:05am
$sql = "SELECT id, concat(LPAD(id::text, 3, '0'),' ',estatus,'--I',
case when notificar_agente = 1 then 'A' else '' end,
case when notificar_cliente = 1 then 'C' else '' end,
case when notificar_shipper = 1 then 'S' else '' end,
case when publico = 1 then 'P' else '' end) as estatus
FROM aimartrackings WHERE pre_embarque=1 AND activo=1 AND import = '".$model->import_export."' AND id_transporte = '".$model->id_transporte."'
ORDER BY secuencia";

//echo $sql;
?>
	<?php
	//if ($_GET['bloquea'] == 0) {

	echo $form->dropDownListRow($model,'id_estatus',CHtml::listData(Aimartrackings::model()->findAllBySql(str_replace("
"," ",$sql)),'id','estatus'),
		array(
		'class'=>'span8',
		'prompt' => '-- Seleccione --',
		'required' => true,
		'ajax' => array(
			'type'=>'POST',
			'url'=>Yii::app()->createUrl('TrackingRoutings/loadcomments'),
			'update'=>'#TrackingRoutings_comentario',
			'data'=>array('estatus_id'=>'js:this.value', 'id_routing'=>$model->id_routing, 'import'=>$model->import_export),
			)
		)
	);



	//print_r($routing);
	//} else {
		/*
?>
<p>
	<div id="alert-success" class="alert in fade alert-success">
		<a href="#" class="close" data-dismiss="alert" onclick="$('#alert-success').fadeOut()">×</a>
		su pais destino solo tiene consulta de los estatus en pestaña consulta

	</div>
</p>
<?php
*/
	//}

	?>

	<?php
	//if ($_GET['bloquea'] == 0)
	echo $form->textAreaRow($model,'comentario',array('rows'=>6, 'cols'=>50, 'class'=>'span8', 'required' => true,));

	echo $form->dateFieldRow($model,'fecha_alerta',array('class'=>'span2','readonly'=>true));  ?>

	<div class="form-actions">

		<?php

		//echo "(".($_GET['import'] == 0 ? "export" : "import").")";
		//echo "(".$_GET['bloquea'].")";

		//if ($_GET['bloquea'] == 0)

			$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>$model->isNewRecord ? 'Create' : 'Save',
				'icon'=>$model->isNewRecord ? 'icon-file icon-white' : 'icon-pencil icon-white',
			));

			/*$this->widget('zii.widgets.jui.CJuiButton',array(
			    'name'=>'Submit',
			    //'caption'=>$model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),
			    'caption'=>$model->isNewRecord ? 'Crear Estatus & Enviar Autonotificacion' : Yii::t('app','Save'),

			    'options'=>array(
			        'icons'=>array(
			            'primary'=>'ui-icon-ok',
			        )
			    ),

			));*/



		?>

	</div>

<?php $this->endWidget(); //form end ?>


<?php endif; ?>

</div><!-- form -->




<?php /*
	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'routing_cli'); ?>
		<?php echo
			//radioButtonList

			$form->dropDownList($model,'routing_cli',CHtml::listData(Routings::model()->findAll(array("condition"=>"","order"=>"")),'id_routing','order_no'), array('prompt' => '-- Seleccione --')); ?>
		<?php echo $form->error($model,'routing_cli'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_cliente'); ?>
		<?php echo $form->textField($model,'id_cliente'); ?>
		<?php echo $form->error($model,'id_cliente'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_routing'); ?>
		<?php echo
			//radioButtonList

			$form->dropDownList($model,'id_routing',CHtml::listData(Routings::model()->findAll(array("condition"=>"","order"=>"")),'id_routing','order_no'), array('prompt' => '-- Seleccione --')); ?>
		<?php echo $form->error($model,'id_routing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cotizacion_id'); ?>
		<?php echo $form->textField($model,'cotizacion_id'); ?>
		<?php echo $form->error($model,'cotizacion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_estatus'); ?>
		<?php echo
			//radioButtonList

			$form->dropDownList($model,'id_estatus',CHtml::listData(Aimartrackings::model()->findAll(array("condition"=>"","order"=>"")),'id','estatus'), array('prompt' => '-- Seleccione --')); ?>
		<?php echo $form->error($model,'id_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_es'); ?>
		<?php echo $form->textField($model,'name_es'); ?>
		<?php echo $form->error($model,'name_es'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_en'); ?>
		<?php echo $form->textField($model,'name_en'); ?>
		<?php echo $form->error($model,'name_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textArea($model,'comentario',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_server'); ?>
		<?php echo $form->textField($model,'fecha_server'); ?>
		<?php echo $form->error($model,'fecha_server'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_estatus'); ?>
		<?php echo  ""; $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'model' => $model,
		    'attribute' => 'fecha_estatus',
		    'language' => 'es',
		    //'themeUrl' => Yii::app()->baseUrl . '/css/jui',
		    //'theme' => 'softark',
		    //'cssFile' => 'jquery-ui-1.9.2.custom.css',
		    'options' => array(
		        'showOn' => 'both',             // also opens with a button
		        'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
		        'showOtherMonths' => true,      // show dates in other months
		        'selectOtherMonths' => true,    // can seelect dates in other months
		        'changeYear' => true,           // can change year
		        'changeMonth' => true,          // can change month
		        'yearRange' => '2000:2099',     // range of year
		        'minDate' => '2000-01-01',      // minimum date
		        'maxDate' => '2099-12-31',      // maximum date
		        'showButtonPanel' => true,      // show button panel
		    ),
		    'htmlOptions' => array(
		        'size' => '10',
		        'maxlength' => '10',
		    ),
		)); ?>
		<?php echo $form->error($model,'fecha_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hora_estatus'); ?>
		<?php echo $form->textField($model,'hora_estatus',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'hora_estatus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pais'); ?>
		<?php echo
			//radioButtonList

			$form->dropDownList($model,'id_pais',CHtml::listData(Paises::model()->findAll(array("condition"=>"","order"=>"")),'codigo','descripcion'), array('prompt' => '-- Seleccione --')); ?>
		<?php echo $form->error($model,'id_pais'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notificacion'); ?>
		<?php echo $form->textArea($model,'notificacion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notificacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modificado'); ?>
		<?php echo $form->textField($model,'modificado'); ?>
		<?php echo $form->error($model,'modificado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario'); ?>
		<?php echo
			//radioButtonList

			$form->dropDownList($model,'usuario',CHtml::listData(UsuariosEmpresas::model()->findAll(array("condition"=>"","order"=>"")),'id_usuario','pw_name'), array('prompt' => '-- Seleccione --')); ?>
		<?php echo $form->error($model,'usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'borrado'); ?>
		<?php echo $form->textField($model,'borrado'); ?>
		<?php echo $form->error($model,'borrado'); ?>
	</div>
*/?>
