<?php
		$criteria=new CDbCriteria;
		$criteria->condition = "id_routing = ".$id_routing;
		$dataProvider = new CActiveDataProvider('TrackingRoutings', array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
		));
?>






<?php if(Yii::app()->user->hasFlash('success')): ?>
<p>
	<div id="alert-success" class="alert in fade alert-success">
		<a href="#" class="close" data-dismiss="alert" onclick="$('#alert-success').fadeOut()">×</a>
		<?php echo Yii::app()->user->getFlash('success'); ?>

	</div>
</p>
<?php endif; ?>



<?php if(Yii::app()->user->hasFlash('error')): ?>
<p>
	<div id="alert-error" class="alert in fade alert-error">
		<a href="#" class="close" data-dismiss="alert" onclick="$('#alert-error').fadeOut()">×</a>
		<?php echo Yii::app()->user->getFlash('error'); ?>
	</div>
</p>
<?php endif; ?>




<style>
#tracking-routings-grid .items { display: block; height:350px; overflow-y: scroll; }
</style>


	<?php ob_start(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tracking-routings-grid',
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

        array(
            //'class'=>'CButtonColumn',
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'header' => '',
            'headerHtmlOptions'=>array('style'=>'width:20px'),
            'htmlOptions'=>array('style'=>'width:20px'),
            'template'=>'{view}',
            'buttons'=>array(
                'view'=>array(
                    'label'=>'Notificaciones',

                    'url'=>'Yii::app()->createUrl("TrackingRoutings/loadnotifications", array("id"=>$data->id))',
                    //'options'=>array('class'=>'pay'),
                    'visible'=>'$data->notificacion != ""',

					'label'=>'Consultar Contactos',
            		'icon'=>'icon-envelope icon-white',
            		'options'=>array(
            			"class"=>"pay btn btn-small btn-warning",
            		),

                ),
            ),
        ),


		'fecha_estatus',
		'hora_estatus',

		array('name'=>'name_es','value'=>'$data->id_estatus." - ".$data->name_es','htmlOptions'=>array('style'=>'width:200px;')), //white-space:nowrap
		'comentario',
		'id_pais',
		array('name'=>'usuario','value'=> 'isset($data->usuario0) ? $data->usuario0->pw_name : $data->usuario ','htmlOptions'=>array('style'=>'white-space:nowrap')),
		'fecha_alerta',


	),
)); ?>


	<?php $section2 = ob_get_contents(); ob_end_clean();

	//$section2 = str_replace('<table class="items','<div class="tbl-header"><table class="items',$section2);

	//$section2 = str_replace('<tbody>','</table></div><div class="tbl-content"><table class="items"><tbody>',$section2);




	echo $section2; ?>



<?php

Yii::app()->clientScript->registerScript('pay', "
$('#tracking-routings-grid a.pay').click(function(e){
    var url = $(this).attr('href');
    $.post(url,function(res){
         $('#rotab_tab_1').html(res);
         $('#rotab').tabs({ active: 1 });
     });
    return false;
})");

/*
Yii::app()->clientScript->registerScript('pay', "
jQuery('#tracking-routings-grid a.pay').live('click',function() {

        //if(!confirm('Are you sure you want to mark this commission as PAID?')) return false;

        var url = $(this).attr('href');
        $.post(url,function(res){
             $('#rotab_tab_1').html(res);
             $('#rotab').tabs({ active: 1 });
         });
        return false;
});
");*/
?>
