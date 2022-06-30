<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta name="description" content="solucion de administracion de sistemas">
    <meta name="author" content="Hans Meckler">
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/aimar<?php echo $_SERVER['SERVER_ADDR'] == '127.0.0.1' ? "_blue" : "_lb"?>.bmp">

	<!-- blueprint CSS framework -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" />

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" type="text/css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/yii.css" type="text/css" rel="stylesheet">
</head>

<body>

<div class="container" id="page">

	<!--<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->


<?php /*$this->widget('bootstrap.widgets.TbNavbar',array(
        'fixed' => false,
    	//'fluid' => true,
        'type' => 'inverse',
        'brand' => CHtml::encode(Yii::app()->name),//<img src="images/aimar.gif" style="height:30px"> ' . Yii::app()->params['version'],
        'brandUrl' => 'http://www.aimargroup.com',
	    'items'=>array(

	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
	            'htmlOptions' => array('class' => 'pull-right'),
				'items' => array(


					array('label'=>'Insert Status', 'url'=>array('/routings/admin'), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>TbHtml::ICON_ALIGN_JUSTIFY . " " . TbHtml::ICON_COLOR_WHITE),

					array('label'=>'Consulta Status', 'url'=>array('/trackingRoutings/admin'), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>TbHtml::ICON_ALIGN_JUSTIFY . " " . TbHtml::ICON_COLOR_WHITE),

					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest, 'icon'=>TbHtml::ICON_ALIGN_JUSTIFY . " " . TbHtml::ICON_COLOR_WHITE),

					array('label'=>'Logout ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest, 'url'=>array('/site/logout'), 'icon'=>TbHtml::ICON_OFF . " " . TbHtml::ICON_COLOR_WHITE, 'alt'=>'Logout..'),




				),
			),

	    ),
	)); */?>



	<?php /*
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>CHtml::encode(Yii::app()->name), 'url'=>'#'),
				array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),

				array('label'=>'Guardar Estatus', 'url'=>array('/routings/admin'), 'visible'=>!Yii::app()->user->isGuest),

				array('label'=>'Consulta Estatus', 'url'=>array('/trackingRoutings/admin'), 'visible'=>!Yii::app()->user->isGuest),

				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->session['usr_nm'].')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); //Yii::app()->user->name ?>
	</div><!-- mainmenu --> */ ?>



<?php $this->widget('bootstrap.widgets.TbNavbar',array(
        'fixed' => true,
    	//'fluid' => true,
        //'type' => isset(Yii::app()->session['usr_ltf']) ? (Yii::app()->session['usr_ltf'] == true ? '' : 'inverse') : 'inverse',
        'type'=>'inverse',

        'brand' => '<span id="lg_paises" style="display:inline;">' . str_replace(",","&nbsp;",str_replace("'","",str_replace("[","",str_replace("]","",Yii::app()->session['usr_pais'])))) . '</span><img id="lg_latin" src="images/newlogo_latin.jpg" style="height:35px;display:none;"><img id="lg_aimar" src="images/aimar.gif" style="height:35px;display:none;">&nbsp;<font size=1>Version ' . Yii::app()->params['version'] . '</font>',

        /*<img src="images/' .
        (isset(Yii::app()->session['usr_ltf']) ? (Yii::app()->session['usr_ltf'] == true ? 'newlogo_latin.jpg' : 'aimar.gif') : 'LogoAimar25Anios.png')
        . '" style="height:35px"> <font size=1>Version ' . Yii::app()->params['version'] .'</font>',*/

        'brandUrl' => '#',//http://www.aimargroup.com',
	    'items'=>array(
	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
				'items' => array(
					//CHtml::encode(Yii::app()->name)

					array('label'=>'Pendientes', 'url'=>array('/RoutingsAlert/admin'),
	            	'icon' => "icon-bell", 'visible'=>!Yii::app()->user->isGuest), // icon-yellow

					array('label'=>'Estatus', 'url'=>array('/Routings/admin'),
	            	'icon' => "icon-pencil", 'visible'=>!Yii::app()->user->isGuest), // icon-blue-light

					//array('label'=>Yii::app()->user->id.' - '.Yii::app()->session['usr_nm'], 'url'=>array(''),
					//'icon' => "icon-user icon-white", 'visible'=>!Yii::app()->user->isGuest),

	                array('label'=>'Help', 'url'=>array('/routings/rules'),
	                'icon' => "icon-question-sign", 'visible'=>!Yii::app()->user->isGuest), // icon-green
				),
			),
	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
	            'htmlOptions' => array('class' => 'pull-right'),
				'items' => array (
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),


					//array('label'=>'Logout', 'url'=>array('/site/logout'),
					//'icon' => "icon-off icon-white", 'visible'=>!Yii::app()->user->isGuest),


					array(
					    'label' => Yii::app()->session['usr_nm'], 'url' => '#', 'icon'=>'icon-user', // icon-orange
					    'visible'=>!Yii::app()->user->isGuest,
					    'items' => array(
					        array('label'=>'Logout', 'url'=>array('/site/logout'), 'icon'=>'icon-off'), // icon-red
					        array('label'=>'ip'.$_SERVER['REMOTE_ADDR'], 'url'=>'#', 'icon'=>'icon-star'), // icon-yellow

					        array('label'=>Yii::app()->user->id, 'url'=>'#', 'icon'=>'icon-flag'), // icon-yellow
					        array('label'=>Yii::app()->session['usr_level'], 'url'=>'#', 'icon'=>'icon-eye-open'), // icon-yellow

					    )
					),


				),
			),
	    ),
	)); ?>

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php if(isset($this->menu)):?>	<!-- operations -->
		<?php $this->widget('bootstrap.widgets.TbMenu', array(
			'id'=>'operations',
			'type'=>'pills',
			'items'=>$this->menu,
		)); ?>
	<?php endif?>


	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		[<?php echo str_replace(",",' ',str_replace("'",'',Yii::app()->session['usr_pais']));?>]<br/>
		Copyright &copy; <?php echo date('Y'); ?><br/>
		All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

<?php //////////////////////////////// dialog ////////////////////////////////////////// ?>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'cru_dialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Dialog box 1',
        'autoOpen'=>false,
    ),
));
 ?>

<div id="loadImg" style="position:absolute; height:90%; width:96%; display:inline; vertical-align:middle; text-align:center;">
	<div style="position:relative; top:50%; width:auto;">
		Loading <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ajax-loader.gif" />
	</div>
</div>

<iframe id="cru_frame" name="cru_frame" style="border:0px" onload="document.getElementById('loadImg').style.display='none';"></iframe>

<br>

<div class="form-actions">

<?php echo CHtml::link('<span class="icon-pencil icon-white"></span> Update',"#",array('class'=>'btn btn-small btn-primary','id'=>'update-data','onclick'=>'$("#cru_frame").contents().find("form").submit()','style'=>'color:white')); ?>

<?php echo CHtml::link('<span class="icon-file icon-white"></span> Create',"#",array('class'=>'btn btn-small btn-primary','id'=>'create-data','onclick'=>'$("#cru_frame").contents().find("form").submit()','style'=>'color:white')); ?>

</div>

<?php $this->endWidget(); ?>
<?php //////////////////////////////// dialog ////////////////////////////////////////// ?>

<?php include("javascript.php"); ?>

</body>

</html>
