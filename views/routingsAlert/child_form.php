<?php
/* @var $this RoutingsAlertController */
/* @var $model RoutingsAlert */
/* @var $form CActiveForm */
?>

<?php
$ChildKey = "";
?>
<div style="border:1px solid silver;margin-bottom: 20px; display: <?php echo!empty($display) ? $display : 'none'; ?>; width:100%; clear:left;" class="crow">

<?php if ('id_routing' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']id_routing'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']id_routing'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']id_routing'); ?>        
	</div>

<?php } ?>

<?php if ('borrado' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']borrado'); ?>
        <?php echo CHtml::activeCheckBox($model,'['.$index.']borrado'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']borrado'); ?>        
	</div>

<?php } ?>

<?php if ('routing_int' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']routing_int'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']routing_int'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']routing_int'); ?>        
	</div>

<?php } ?>

<?php if ('routing' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']routing'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']routing',array('size'=>25,'maxlength'=>25)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']routing'); ?>        
	</div>

<?php } ?>

<?php if ('id_pais' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']id_pais'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']id_pais',array('size'=>5,'maxlength'=>5)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']id_pais'); ?>        
	</div>

<?php } ?>

<?php if ('id_pais_origen' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']id_pais_origen'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']id_pais_origen',array('size'=>5,'maxlength'=>5)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']id_pais_origen'); ?>        
	</div>

<?php } ?>

<?php if ('id_pais_destino' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']id_pais_destino'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']id_pais_destino',array('size'=>5,'maxlength'=>5)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']id_pais_destino'); ?>        
	</div>

<?php } ?>

<?php if ('fecha' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']fecha'); ?>
        <?php echo  ""; $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'model' => $model,
		    'attribute' => '['.$index.']fecha',
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
        <?php echo CHtml::error($model, '[' . $index . ']fecha'); ?>        
	</div>

<?php } ?>

<?php if ('order_no' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']order_no'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']order_no',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']order_no'); ?>        
	</div>

<?php } ?>

<?php if ('id_transporte' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']id_transporte'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']id_transporte'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']id_transporte'); ?>        
	</div>

<?php } ?>

<?php if ('import_export' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']import_export'); ?>
        <?php echo CHtml::activeCheckBox($model,'['.$index.']import_export'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']import_export'); ?>        
	</div>

<?php } ?>

<?php if ('id_usuario_creacion' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']id_usuario_creacion'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']id_usuario_creacion'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']id_usuario_creacion'); ?>        
	</div>

<?php } ?>

<?php if ('cotizacion_id' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']cotizacion_id'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']cotizacion_id'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']cotizacion_id'); ?>        
	</div>

<?php } ?>

<?php if ('no_embarque' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']no_embarque'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']no_embarque',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']no_embarque'); ?>        
	</div>

<?php } ?>

<?php if ('id_cliente' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']id_cliente'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']id_cliente'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']id_cliente'); ?>        
	</div>

<?php } ?>

<?php if ('id_routing_type' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']id_routing_type'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']id_routing_type'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']id_routing_type'); ?>        
	</div>

<?php } ?>

<?php if ('days' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']days'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']days'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']days'); ?>        
	</div>

<?php } ?>

<?php if ('activo' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']activo'); ?>
        <?php echo CHtml::activeCheckBox($model,'['.$index.']activo'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']activo'); ?>        
	</div>

<?php } ?>

<?php if ('bl_id_fecha' != $ChildKey) { ?>
	<div class="row">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']bl_id_fecha'); ?>
        <?php echo CHtml::activeTextField($model,'['.$index.']bl_id_fecha'); ?>
        <?php echo CHtml::error($model, '[' . $index . ']bl_id_fecha'); ?>        
	</div>

<?php } ?>
    <div class="row buttons">
        <br />
        <?php echo CHtml::link('<span class="icon-trash"></span>', '#', array('onclick' => 'delete_ajax(this, ' . $index . '); return false;','class'=>'btn btn-small btn-danger')); ?>
    </div>
</div>

    

