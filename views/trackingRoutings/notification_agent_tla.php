<?php

	$a1 = array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ");
	$b1 = array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;");	
	$ro['name_es'] = str_replace($a1,$b1,$ro['name_es']);	

	
	
	////////////////////////////////////////////////AGENTE INGLES///////////////////////////////////////////////////////
	$user_name = "";
	if (!isset($ro['order_no'])) $ro['order_no'] = "";
	
	echo  "{$ro['header']}
	<p>Dear Agent :</p>
	<p>Here we present the current status of your shipment with the following information : </p>		
	<p>
	<b>R.O. : </b>{$ro['routing']}<br>	
	<b>Order number / P.O. : </b>{$ro['order_no']}<br>	
	<b>Shipment : </b>" . (empty($ro['no_embarque']) ? "Pending" : $ro['no_embarque']) . "<br>	
	<b>Consignee : </b>{$ro['nombre_cliente']}<br>	
	<b>STATUS : </b>{$ro['name_en']}<i></i><br>	
	</p>
	<p style='text-align:justify'>If you need any additional information please contact our Operations Department e-mail: {$ro['SetSupportName']} <a href='mailto:{$ro['SetSupportEmail']}'>{$ro['SetSupportEmail']}</a> or by phone: {$ro['SetSupportPhone']}.</p>
	<p>Cordially,</p>
	<p>{$ro['atentamente']}</p>
	<p><b>IMPORTANT:<br>	
	Please do not reply to this email, it is sent from an automated system, there will be no response from this address. For assistance contact customer service department.</b></p>
	<font color='white'>$user_name</font>
	
	<br>
	
	<hr>
	
	<br>
	
	<p>Estimado Agente : </p>
	<p>A continuaci&oacute;n le damos a conocer el status actual de su mercaderia amparada con la siguiente informaci&oacute;n : </p>		
	<p>
	<b>R.O. : </b>{$ro['routing']}<br>	
	<b>Embarque : </b>" . (empty($ro['no_embarque']) ? "Pendiente" : $ro['no_embarque']) . "<br>	
	<b>Cliente : </b>{$ro['nombre_cliente']}<br>	
	<b>STATUS : </b>{$ro['name_en']}<i> ({$ro['name_es']})</i><br>	
	</p>
	<p style='text-align:justify'>Si necesita mayor informaci&oacute;n de su carga puede consultar con nuestro departamento de Operaciones al email: {$ro['SetSupportName']} <a href='mailto:{$ro['SetSupportEmail']}'>{$ro['SetSupportEmail']}</a> o al tel&oacute;fono: {$ro['SetSupportPhone']}.</p>	  
	<p>Estamos para servirle,</p>
	<p>Atentamente,</p>
	<p>{$ro['atentamente']}</p>
	<p><b>IMPORTANTE:<br>	
	Favor no responder este email ya que fue enviado desde un sistema automaticamente y no tendr&aacute; respuesta desde esta direcci&oacute;n de correo.</b></p>";	
	
		
		