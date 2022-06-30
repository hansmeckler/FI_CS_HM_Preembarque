<?php

	$a1 = array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ");
	$b1 = array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;");	
	$ro['comentario'] = str_replace($a1,$b1,$ro['comentario']);
	$ro['name_es'] = str_replace($a1,$b1,$ro['name_es']);	

	////////////////////////////////////////////////CLIENTE ESPAÑOL LATINO///////////////////////////////////////////////////
	echo  "{$ro['header']}
	<p>Estimado Cliente : </p>
	<p>A continuaci&oacute;n le damos a conocer el status actual de su mercaderia amparada con la siguiente informaci&oacute;n : </p>		
	<p>
	<b>R.O. : </b>{$ro['routing']}<br>	
	<b>Order number / P.O. : </b>{$ro['order_no']}<br>	
	<b>Embarque : </b>" . (empty($ro['no_embarque']) ? "Pendiente" : $ro['no_embarque']) . "<br>	
	<b>Cliente : </b>{$ro['nombre_cliente']}<br>	
	<b>STATUS : </b>{$ro['name_en']}<i> ({$ro['name_es']})</i><br>	
	<b>Observaciones : </b><font color='green'>". nl2br($ro['comentario'])."</font>
	</p>
	<p style='text-align:justify'>Si necesita mayor informaci&oacute;n de su carga puede consultar con nuestro departamento de Operaciones al email: {$ro['SetSupportName']} <a href='mailto:{$ro['SetSupportEmail']}'>{$ro['SetSupportEmail']}</a> o al tel&oacute;fono: {$ro['SetSupportPhone']}.</p>	  
	<p>Estamos para servirle,</p>
	<p>Atentamente,</p>
	<p>{$ro['atentamente']}</p>
	<p><b>IMPORTANTE:<br>	
	Favor no responder este email ya que fue enviado desde un sistema automaticamente y no tendr&aacute; respuesta desde esta direcci&oacute;n de correo.</b></p>";
	
	