<?php
$this->breadcrumbs=array(
	Yii::t('app','TrackingRoutings')=>array('index'),
	Yii::t('app','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List').' '.Yii::t('app','TrackingRoutings'),'url'=>array('index'), 'icon'=>TbHtml::ICON_ALIGN_JUSTIFY . " " . TbHtml::ICON_COLOR_WHITE),
	array('label'=>Yii::t('app','Manage').' '.Yii::t('app','TrackingRoutings'),'url'=>array('admin'), 'icon'=>TbHtml::ICON_COG . " " . TbHtml::ICON_COLOR_WHITE),
);
?>

<?php //echo "<strong>Routing : </strong>".$model->routing."&nbsp;&nbsp;<strong>Creacion : </strong>".$model->id_pais."&nbsp;&nbsp;<strong>Origen : </strong>".$model->id_pais_origen."&nbsp;&nbsp;<strong>Destino : </strong>".$model->id_pais_destino."<br>"; ?>

<?php if (!$this->asDialog) : ?>

<h1><?php echo Yii::t('app','Create').' '.Yii::t('app','TrackingRoutings'); ?> </h1>

<?php endif; ?>

<?php
/*if (Yii::app()->session['pendientes']) {

$this->widget('zii.widgets.jui.CJuiTabs',array(
    'tabs'=>array(

        'Consulta Estatus <i class=\'icon-list icon-blue-light\'></i>' =>$this->renderPartial('child_admin',array('id_routing'=>$model->id_routing),true),

        'Contactos <i class=\'icon-envelope icon-blue-light\'></i>'=>$this->renderPartial('contactos', array('rawData'=>json_encode(array()),'id'=>-1),true),

    ),
    'headerTemplate' => '<li><a href="{url}" title="{title}">{title}</a></li>',
    // additional javascript options for the tabs plugin
    'options'=>array(
        //'collapsible'=>true,
        //'active'=> isset($_GET['active']) ? 0 : 2,
        'heightStyle', 'fill', //auto fill content
        //'height' => '100%',
    ),
    'id'=>'rotab',
));

} else {
	*/

	$routing=Routings::model()->findByPk($model->id_routing);



//if (Yii::app()->controller->action->id == "login" && Yii::app()->controller->id == "site") {

//echo "(".Yii::app()->controller->id.")";

if ($c == 1) {

	$this->widget('zii.widgets.jui.CJuiTabs',array(
	    'tabs'=>array(
	        //'Ingresar Estatus '.$imp_exp.' <i class=\'icon-pencil icon-blue-light\'></i>' => $this->renderPartial('_form', array('model'=>$model),true),
	        'Contactos <i class=\'icon-envelope icon-blue-light\'></i>'=>$this->renderPartial('contactos', array('rawData'=>json_encode(array()),'id'=>-1),true),
	        'Consulta Estatus <i class=\'icon-list icon-blue-light\'></i>' =>$this->renderPartial('child_admin',array('id_routing'=>$model->id_routing),true),
	    ),
	    'headerTemplate' => '<li><a href="{url}" title="">{title}</a></li>',
	    // additional javascript options for the tabs plugin
	    'options'=>array(
	        //'collapsible'=>true,
	        'active'=>  1,//count($routing->trackings) == 0 ? 0 : 2,
	        'heightStyle', 'fill', //auto fill content
	        //'height' => '100%',
	    ),
	    'id'=>'rotab',
	));

} else {

$this->widget('zii.widgets.jui.CJuiTabs',array(
    'tabs'=>array(
        'Ingresar Estatus '.$imp_exp.' <i class=\'icon-pencil icon-blue-light\'></i>' => $this->renderPartial('_form', array('model'=>$model),true),
        'Contactos <i class=\'icon-envelope icon-blue-light\'></i>'=>$this->renderPartial('contactos', array('rawData'=>json_encode(array()),'id'=>-1),true),
        'Consulta Estatus <i class=\'icon-list icon-blue-light\'></i>' =>$this->renderPartial('child_admin',array('id_routing'=>$model->id_routing),true),
    ),
    'headerTemplate' => '<li><a href="{url}" title="">{title}</a></li>',
    // additional javascript options for the tabs plugin
    'options'=>array(
        //'collapsible'=>true,
        'active'=>  count($routing->trackings) == 0 ? 0 : 2,
        'heightStyle', 'fill', //auto fill content
        //'height' => '100%',
    ),
    'id'=>'rotab',
));

}



Yii::app()->clientScript->registerScript("submain1", "
	$(window).on('load resize', function () {
		$('#rotab').css('width',$(window).width() - 20);
		$('#rotab').css('height',$(window).height() - 20);
		$('#rotab').css('overflow','hidden');
		var body = $('#rotab').parent();
		$(body).css('padding','0px');
		$(body).css('float','left');
	});
");
?>
