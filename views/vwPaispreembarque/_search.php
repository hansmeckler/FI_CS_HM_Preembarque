<?php
/* @var $this VentasRegionalController */
/* @var $model VentasRegional */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	//'action'=>Yii::app()->createUrl($this->route),
	'action'=>Yii::app()->createUrl('VwPaispreembarque/admin'),
	'method'=>'POST',
)); ?>


<style>
	.row { margin:5px; vertical-align:middle; }
</style>
     
    <div class="row">
		<?php echo CHtml::label('Fecha Inicio', 'fecha_i'); ?>
				
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			//'themeUrl'=>'/js/jquery-ui-1.8/themes',
			//'theme'=>'ui-lightness',      
			'name'=>'fecha_i',
			'value'=>Yii::app()->session['fecha_i'],
			//'value'=>empty($_GET['fecha_i']) ? '' : date('d/m/Y',strtotime($_GET['fecha_i'])),
			// additional javascript options for the date picker plugin
			'options'=>array(
				'flat'=>true,//remove to hide the datepicker
				'showButtonPanel'=>true,
				'dateFormat' => 'yy-mm-dd',
				//'dateFormat' => 'dd/mm/yy',
				'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
				'changeMonth'=>true,
				'changeYear'=>true,        
				'showOn' => 'button',        
				'buttonImage' => Yii::app()->request->baseUrl . '/images/calendar_select_day.png',
				//'buttonImageOnly' => true,
				'buttonText' => Yii::t('ui', 'Seleccione fecha'),
			),
			'language'=> Yii::app()->language,    
			'htmlOptions'=>array(
				'placeholder' => 'Seleccione fecha inicio',
				//'required'=>'on', 
				//'readonly'=>true,
				'onmouseover'=>'this.style.cursor="pointer"',
				'onkeydown'=>'return false',
				'style'=>'background:#D2E6F5;width:100px',
			),
		));
		?>
				
    </div>
 
    <div class="row">
		<?php echo CHtml::label('Fecha Final', 'fecha_f'); ?>
				
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			//'themeUrl'=>'/js/jquery-ui-1.8/themes',
			//'theme'=>'ui-lightness',      
			'name'=>'fecha_f',
			'value'=>Yii::app()->session['fecha_f'],
			//'value'=>empty($_GET['fecha_f']) ? '' : date('d/m/Y',strtotime($_GET['fecha_f'])),
			// additional javascript options for the date picker plugin
			'options'=>array(
				'flat'=>true,//remove to hide the datepicker
				'showButtonPanel'=>true,
				'dateFormat' => 'yy-mm-dd',
				//'dateFormat' => 'dd/mm/yy',
				'showAnim'=>'fadeIn',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
				'changeMonth'=>true,
				'changeYear'=>true,        
				'showOn' => 'button',        
				'buttonImage' => Yii::app()->request->baseUrl . '/images/calendar_select_day.png',
				//'buttonImageOnly' => true,
				//'buttonText' => Yii::t('ui', 'Seleccione fecha'),
			),
			'language'=> Yii::app()->language,    
			'htmlOptions'=>array(
				'placeholder' => 'Seleccione fecha final',
				//'required'=>'on', 
				//'readonly'=>true,
				'onmouseover'=>'this.style.cursor="pointer"',
				'onkeydown'=>'return false',
				'style'=>'background:#D2E6F5;width:100px',
			),
			
		));
		?>
	
    </div>
 
	<div class="row buttons">
		
		<?php
			$this->widget('zii.widgets.jui.CJuiButton',array(
			    'name'=>'Submit',			    
			    'caption'=>'Consultar',
			    'onclick'=>new CJavaScriptExpression('function(){ if ($("#fecha_i").val() != "" || $("#fecha_f").val() != "") { } else { alert("Debe seleccionar una de las fechas"); return false; }  }'),
			    'options'=>array(
			        'icons'=>array(
			            'primary'=>'ui-icon-ok',
			        )
			    ),
			    			    
			));
		?>


		<?php

						
			/*$this->widget('zii.widgets.jui.CJuiButton',array(
			    'buttonType'=>'button',
			    'name'=>'btnSave',
			    'caption'=>'Save',
			    'onclick'=>new CJavaScriptExpression('function(){ alert("Save button clicked"); this.blur(); return false;}'),
			));*/
			

						
			$this->widget('zii.widgets.jui.CJuiButton',array(
			    //'buttonType'=>'button',
			    'name'=>'btnSave',
			    'caption'=>'Limpiar',
			    'onclick'=>new CJavaScriptExpression('function(){ if ($("#fecha_i").val() != "" || $("#fecha_f").val() != "") { $("#fecha_i").val(""); $("#fecha_f").val(""); } else { return false; } }'),
			));
			

		?>

				
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->


<script>
	
	$(document).ready(function() {		
		$('.ui-datepicker-trigger').attr('onmouseover','this.style.cursor="pointer"');
		$(".row").css("display","inline-block");
	});	
</script>