<?php

	$a1 = array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ");
	$b1 = array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;");	
	$ro['comentario'] = str_replace($a1,$b1,$ro['comentario']);
	
	
	////////////////////////////////////////////////AL CLIENTE EN INGLES///////////////////////////////////////////////////////
	echo  "{$ro['header']}
	<p>Dear Consignee : </p>
	<p>Here we present the current status of your shipment with the following information : </p>	
	<p>
	<b>R.O. : </b>{$ro['routing']}<br>	
	<b>Order number / P.O. : </b>{$ro['order_no']}<br>	
	<b>Shipment : </b>" . (empty($ro['no_embarque']) ? "Pending" : $ro['no_embarque']) . "<br>	
	<b>Consignee : </b>{$ro['nombre_cliente']}<br>	
	<b>STATUS : </b>{$ro['name_en']}<i></i><br>	
	<b>Comments : </b><font color='green'>".nl2br($ro['comentario'])."</font>
	</p>
	<p style='text-align:justify'>If you need any additional information please contact our Operations Department e-mail: {$ro['SetSupportName']} <a href='mailto:{$ro['SetSupportEmail']}'>{$ro['SetSupportEmail']}</a> or by phone: {$ro['SetSupportPhone']}.</p>
	<p>Cordially,</p>
	<p>{$ro['atentamente']}</p>
	<p><b>IMPORTANT:<br>	
	Please do not reply to this email, it is sent from an automated system, there will be no response from this address. For assistance contact customer service department.</b></p>";
	
	
	
	
		