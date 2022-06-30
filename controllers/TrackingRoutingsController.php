<?php

class TrackingRoutingsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	public $asDialog=true;


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		//return ContactosUsersMenu::ControllerActionsSet2( 0 );
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','loadcomments','loadnotifications','detalles','consult'), //,'update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','GeneratePdf','GenerateExcel','detalles'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

		$this->layout = '//layouts/column1';

		$model = $this->loadModel($id);
	    if (Yii::app()->request->isAjaxRequest) {
			    //if ($this->asDialog)

	        $this->renderPartial('view',array(
	            'model'=>$model,
	        ), false, true);

	    } else {


	        $this->render('view',array(
	            'model'=>$model,
	        ));
	    }
	}



	//CONTACTOS

    function EmailsExternos($id,$titulo,$pais) {

        if ($titulo == "Agente") {

		$qry = "SELECT id_contacto as contacto_id, agente_id as cod, nombres as nombre, trim(email) as email, 2 as nivel, '$titulo' as tipo FROM agentes_contactos WHERE agente_id = $id AND activo = 't'";


        } else {

		//si no hay contactos, genera una linea
		$qry = "SELECT 0 as contacto_id, $id as cod, 'sin contactos' as nombre, '' as email, 2 as nivel, '$titulo' as tipo WHERE (SELECT count(*) FROM contactos WHERE id_cliente = $id AND activo = 't') = 0
UNION
SELECT contacto_id, id_cliente as cod, nombres as nombre, trim(email) as email, 2 as nivel, '$titulo' as tipo FROM contactos WHERE id_cliente = $id AND activo = 't'";
		}
        return $qry;
    }

	function SplitChars($texto,$flg=""){
		if ($flg == ",")
	    return preg_split( "/[\/\;]/", $texto);
	    else
	    return preg_split( "/[\,\/\;]/", $texto);
	}

	function CleanChars($texto,$chars=""){

			//return preg_replace('/[^A-Za-z0-9\-\ \.\,]/', '', $texto );

			$chars = '/[^A-Za-z0-9\-\ \.\,'.$chars.']/';

			return preg_replace($chars, '', $texto );

			/*return preg_replace_callback('/[^A-Za-z0-9\-\ \.\,]/', function($matches){
			   //return utf8_encode(chr($matches[1]));
				 return ' ';
			}, $texto);*/

	}

	function validate_email($e){
	    return (bool)preg_match("`^[a-z0-9!#$%&'*+\/=?^_\`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_\`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$`i", trim($e));
	}

	function EmailsExternosFunc($datos,$pais_final) {


		//print_r($datos);

		$SQLQuery = "";
		// solo el agente jala los contactos de divisiones
		//AGENTE
		//2016-03-07 hoy aun se utilizara contactos agentes
		if ($datos['notificar_agente'] == 1) {
            if (!empty($SQLQuery)) $SQLQuery .= " UNION ";
            $SQLQuery .= $this->EmailsExternos($datos['agente_id'], "Agente", $pais_final);
		}

		if (intval($datos['ORDER_TO']) > 0) { //CODIGO

            if (!empty($SQLQuery)) $SQLQuery .= " UNION ";
			$SQLQuery .= $this->EmailsExternos($datos['ORDER_TO'], "Notify", ""); //2016-04-25

			if ($datos['notificar_coloader'] > 0) {

				if (!empty($SQLQuery)) $SQLQuery .= " UNION ";
				$SQLQuery .= $this->EmailsExternos($datos['notificar_coloader'], "Coloader", ""); //2016-10-26

			} else {

				if ($datos['notificar_shipper'] > 0) {
					if (!empty($SQLQuery)) $SQLQuery .= " UNION ";
					$SQLQuery .= $this->EmailsExternos($datos['shipper_id'], "Shipper", "");
				}

			}

		} else {

			//COLOADER
			if ($datos['notificar_cliente'] + $datos['notificar_shipper'] > 0 && $datos['notificar_coloader'] > 0) {
				if (!empty($SQLQuery)) $SQLQuery .= " UNION ";
				$SQLQuery .= $this->EmailsExternos($datos['notificar_coloader'], "Coloader", "");

			} else {
				//SHIPPER
				if ($datos['notificar_shipper'] == 1) {
					if (!empty($SQLQuery)) $SQLQuery .= " UNION ";
					$SQLQuery .= $this->EmailsExternos($datos['shipper_id'], "Shipper", "");
				}
				//CLIENTE
				if ($datos['notificar_cliente'] == 1) {
					if (!empty($SQLQuery)) $SQLQuery .= " UNION ";
					$SQLQuery .= $this->EmailsExternos($datos['cliente_id'], "Consigneer", "");
				}
			}
		}


		//echo "$SQLQuery<br>";

		$arr_externos = array();
		if (!empty($SQLQuery)) {


			$arr_emails_unico = array();

			//$getData = Paises::model()->findAllBySql($SQLQuery)
			//Routings::model()->findAll(array("condition"=>"","order"=>"")),'id_routing','order_no'), array('prompt' => '-- Seleccione --')); ?

			$getData = Yii::app()->db->createCommand($SQLQuery)->queryAll();
			foreach($getData as $arr) {

					$emails_str = $this->SplitChars(strtolower($arr['email']));
					$arr['nombre'] = $this->CleanChars($arr['nombre']);

					$nombres_str = $this->SplitChars(ucwords(strtolower($arr['nombre'])),",");
					foreach ($emails_str as $y => $email) {

						$email = trim($email);

						$send = 0;
						$error = "";
						if (empty($email)) {
							$send = -1;
							$error = "No tiene cuenta de correo";

						} else {

							if ($this->validate_email($email) == true){

								if (isset($nombres_str[$y-1])) {

									if (empty($nombres_str[$y]) && $y > 0)
										$nombres_str[$y] = $nombres_str[$y-1];
								}

								if (!in_array($email, $arr_emails_unico)) {
									$arr_emails_unico[] = $email;
								} else {
									$send = -3;
									$error = "Email duplicado";
								}

							} else {
								$send = -1;
								$error = "Email invalido";
							}
						}

						//$arr_externos[] = array("id"=>$arr['contacto_id'], "nombre"=>$nombres_str[$y], "email"=>$email, "tipo"=>$arr['tipo'], $arr['tipo']."_id"=>$arr['cod'], "contacto_id"=>$arr['contacto_id'], "send"=>$send, "error"=>$error, "id_cliente"=>$arr['cod']);

						if (isset($nombres_str[$y]) || !empty($email)) 
						{
							$array = array();
							$array["id"] = $arr['contacto_id'];
							$array["nombre"] = "";
							if (isset($nombres_str[$y]))
								$array["nombre"] = $nombres_str[$y];
							$array["email"] = $email;
							$array["tipo"] = $arr['tipo'];
							$array[$arr['tipo']."_id"] = $arr['cod'];
							$array["contacto_id"] = $arr['contacto_id'];
							$array["send"] = $send;
							$array["error"] = $error;
							$array["id_cliente"] = $arr['cod'];
							$arr_externos[] = $array;
						}
					}
			}
		}


		/*echo "<pre>"; //dio error Deprecated: preg_replace(): The /e modifier is deprecated, use preg_replace_callback instead in
		print_r($arr_externos);
		echo "</pre>";
		die();*/

		return $arr_externos;
	}



	//CONTACTOS DIVISIONES
	function EmailsDivisiones($user,$datos=array(),$pais1_="",$area_="",$tipo_="",$impexp_="",$carga_="",$transship_="") {


		$arr_tmp = array();

		if ($impexp_ == "I") $impexp_ = "Import";
		else
		if ($impexp_ == "E") $impexp_ = "Export";

		if ($impexp_ == 1) $impexp_ = "Import";
		else
		if ($impexp_ == 0) $impexp_ = "Export";
		
		if ($transship_ == 't') $transship_ = 1;
		if ($transship_ == 'f') $transship_ = 0;

		$pais_ = '';

		if (!empty($pais1_))
			$pais_ = '"'.$pais1_.'"';

		$SQLQuery = "";


		//CONTACTOS
		if ($datos['internos'] == 1)
		$SQLQuery .= " OR (catalogo = 'USUARIO' AND pais ILIKE '%".$pais_."%')";
		/*
		//AGENTE
		// solo el agente jala los contactos de divisiones
		if ($datos['notificar_agente'] == 1)
			$SQLQuery .= " OR (catalogo = 'AGENTE' AND id_catalogo = '{$datos['agente_id']}') ";

		//COLOADER
		if ($datos['notificar_cliente'] + $datos['notificar_shipper'] > 0 && $datos['notificar_coloader'] > 0) {
			//$SQLQuery .= " AND tipo_persona = 'Coloader' AND id_catalogo = '{$datos['notificar_coloader']}' ";
			$SQLQuery .= " OR (catalogo = 'CLIENTE' AND id_catalogo = '{$datos['notificar_coloader']}') ";
		} else {
			//SHIPPER
			if ($datos['notificar_shipper'] == 1) {
				//$SQLQuery .= " AND tipo_persona = 'Shipper' AND id_catalogo = '{$datos['shipper_id']}' ";
				$SQLQuery .= " OR (catalogo = 'CLIENTE' AND id_catalogo = '{$datos['shipper_id']}') ";
			}
			//CLIENTE
			if ($datos['notificar_cliente'] == 1) {
				//$SQLQuery .= " AND tipo_persona = 'Consigneer' AND id_catalogo = '{$datos['cliente_id']}' ";
				$SQLQuery .= " OR (catalogo = 'CLIENTE' AND id_catalogo = '{$datos['cliente_id']}') ";
			}
		}
		*/


		$SQLQuery = "SELECT id, id_catalogo, nombre, email, telefono, pais, area, impexp, carga, tranship, tipo_persona, copia, rechazo, contactoxpais FROM contactos_divisiones WHERE status = 'Activo' AND ((id = 0) $SQLQuery) ";

		//if (!empty($pais1_)) //por el momento desabilitado porque data no esta preparada
			//$SQLQuery .= " AND pais ILIKE '%".$pais_."%' ";




		if (!empty($area_))
			$SQLQuery .= " AND area ILIKE '%".$area_."%' ";

		if (!empty($tipo_))
			$SQLQuery .= " AND (tipo_persona IN (".$tipo_.") OR (id_catalogo = '$user' AND tipo_persona = 'Contacto' )) ";


		if (!empty($impexp_))
			$SQLQuery .= " AND impexp ILIKE '%".$impexp_."%' ";

		if (!empty($carga_))
			$SQLQuery .= " AND carga ILIKE '%".$carga_."%' ";

		if (!empty($transship_)) {
			//si en divisiones trae 1 es que solo recibe transhipment , 0 recibe todo
			$SQLQuery .= " AND (tranship = '0' OR '1' = '".$transship_."') ";
		}

		$SQLQuery .= "ORDER BY id";


		//echo "$SQLQuery<br>";

		$getData = Yii::app()->db->createCommand($SQLQuery)->queryAll();

		/*echo "<pre>";
		print_r($getData);
		echo "</pre>";*/


		$arr_emails_unico = array();




		foreach($getData as $row) {

				$obj = json_decode($row["contactoxpais"],true);
				if (empty($obj[$pais1_]))
					$email = $row["email"];
				else
					$email = $obj[$pais1_];

				$send = 0;
				$error = "";

				if (empty($email)) {

					$send = -4;
					$error = "No tiene cuenta de correo";

				} else {

					if ($this->validate_email($email) == true){

						if (!in_array($email, $arr_emails_unico)) {

							$arr_emails_unico[] = $email;

						} else {
							$send = -3;
							$error = "Email duplicado";
						}

					} else {
						$send = -1;
						$error = "Email invalido";
					}
				}

				$arr_tmp[] = array("id"=>$row['id_catalogo'], "pais"=>$row["pais"], "nombre"=>$row["nombre"], "email"=>$email, "telefono"=>$row["telefono"], "tipo"=>$row["tipo_persona"], $row['tipo_persona']."_id"=>$row['id_catalogo'], "division_id"=>$row['id'], "copia"=>$row["copia"], "rechazo"=>$row["rechazo"],"send"=>$send,"error"=>$error );

		}

		echo '<script>console.log("'.str_replace('"','',$SQLQuery).'");</script>';

		return $arr_tmp;
	}



	function envia_email(&$arr_contactos,$tipo_email,$asunto,$cuerpo,$subject,$body_agent,$body_consigneer,$pais_destino) {

		$send = "0";

		$tracking_name = "Tracking Aimar";
		$tracking = "tracking@aimargroup.com";

		if (substr($pais_destino,2,3) == "LTF") {
			$tracking_name = "Tracking LTF";
			$tracking = "tracking@latinfreightneutral.com";
		}

		$local = $_SERVER['REMOTE_ADDR'] == "localhost" || $_SERVER['REMOTE_ADDR'] == "127.0.0.1" || $_SERVER['REMOTE_ADDR'] == "::1" || $_SERVER['REMOTE_ADDR'] == "172.16.0.200";
		// || $_SERVER['REMOTE_ADDR'] == "172.16.0.188" || $_SERVER['REMOTE_ADDR'] == "172.16.0.200" || $_SERVER['REMOTE_ADDR'] == "10.10.1.20";


		// $local = true;


		//echo "(".$_SERVER['REMOTE_ADDR'].")";




		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = "mail.aimargroup.com";
		//$mail->Host = "10.10.1.27";
		
		$mail->SMTPAuth = false;
		$mail->Username = 'tracking@aimargroup.com';
		$mail->Password = '@rdC4Dn!xK6fr#G';

		$mail->SetFrom($tracking, $tracking_name);

		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

		//$mail->MsgHTML($html);

		$hayagente = "";
	  foreach ($arr_contactos as $key => $contacto) {

	  	 try {
	        $send = 0;
					if ($contacto["send"] == 0) {  //-1:error en cuanta  -2:agentes multiples emails -3:duplicado -4:no tiene cuenta

							if (strtoupper(substr($pais_destino,0,2)) == "BZ") { //ingles
								$asunto_x = $subject;
								$cuerpo_x = $body_consigneer;
							} else { //español
								$asunto_x = $asunto;
								$cuerpo_x = $cuerpo;
							}

					    if ($tipo_email == "Notificacion") {

									switch ($contacto["tipo"]) {
									case "Desarrollo":
										ob_start();
											echo "<pre>";
											print_r($arr_contactos);
											echo "</pre><br>";
											echo $_SERVER['REMOTE_ADDR'];
										$contactos = ob_get_contents();
										ob_end_clean();

										//$asunto_x = $asunto;
										$cuerpo_x .= "<hr>".$contactos;

										if (!empty($hayagente))
											$cuerpo_x .= "<hr>AGENTES:<br><u>Subject:</u><br>".$subject."<br><u>Body:</u><br>".$body_agent."<br>".$hayagente;
										break;

									case "Agente":
										$asunto_x = $subject;
										$cuerpo_x = $body_agent;
										$hayagente .= $contacto["email"]."<br>";
										break;
									}
							}

				      if ($local) $asunto_x = $_SERVER['REMOTE_ADDR'].$asunto_x;

				      $mail->Subject = $asunto_x;

							//$mail->Subject = $this->CleanChars($asunto_x,"\/");

				      $mail->MsgHTML($cuerpo_x);

				        //if (empty($contacto["pais_destino"])) $contacto["pais_destino"] = $pais_destino;
			        switch ($tipo_email){
			        case "Notificacion"://notificacion
			        				switch ($contacto["tipo"]){
			        				case "Shipper":
											case "Notify":
			        				case "Consigneer":
			        				//case "Agente":
			        				case "Coloader":
										//if (substr($pais_destino,2,3) == "LTF") {
										//	$arr_contactos[$key]["error"] = "Pais $pais_destino inactivo temporalmente";
										//} else {

														if (!$local) {
															if ($contacto["tipo"] == "Agente" && strpos($contacto["email"],"aimargroup")) {
																//no envia a un agente con email de aimar
																$arr_contactos[$key]["error"] = "Agente con email de aimar";
															} else {

																//$mail->AddAddress($contacto["email"],$contacto["nombre"]);//agente/clientes/shipper
																//$send = 1;
															}
														}
										//}
			        							break;

			        				case "Contacto": 	//2
			        				case "Monitor": 	//1
			        				case "Soporte": 	//0
			        						if ($contacto["copia"] == "Si"){
					        					if (!$local){
							        				$mail->AddAddress($contacto["email"],$contacto["nombre"]);
													$send = 1;
												}
				        					}
				        					break;

			        				case "Desarrollo": //1
				        					if ($contacto["copia"] == "Si"){
						        				$mail->AddAddress($contacto["email"],$contacto["nombre"]);
														//$mail->AddAddress("operaciones.hn2@latinfreightneutral.com",$contacto["nombre"]);
														$send = 1;
													}
				        					break;
											}
			        break;

			        case "NoEnvioEmail"://error en notificacion
			        			if ($contacto["rechazo"] == "Si") {
				        			if ($contacto["tipo"] == "Desarrollo") {
				        				$mail->AddAddress($contacto["email"],$contacto["nombre"]);
												$send = 1;
				        			} else {
			        					if (!$local) {
					        					$mail->AddAddress($contacto["email"],$contacto["nombre"]);
												$send = 1;
												}
											}
										}
			        			break;

			        case "ErrorGeneral"://error en Query
			        			if ($contacto["tipo"] == "Desarrollo") {
			        				$mail->AddAddress($contacto["email"],$contacto["nombre"]);
											$send = 1;
			        			}
			        			break;
							}

							/*echo "($tipo_email)(local=$local)(send=$send)<br>";

							echo "<pre>";
							print_r($contacto);
							echo "</pre>";

							echo "<pre>";
							print_r($mail);
							echo "</pre>";*/

							//print_r($arr_contactos);


							if ($send == 1) {

								if ($mail->Send()) {

									$arr_contactos[$key]["send"] = 1;
									$send = "OK";

									/*echo "<pre>";
									print_r($arr_contactos[$key]);
									echo "</pre>";*/

								} /*else {
									$arr_contactos[$key]["error"] = $mail->getError();
									$arr_contactos[$key]["send"] = 0;
								}*/


							} else {

								if (empty($arr_contactos[$key]["error"])) {
									$arr_contactos[$key]["error"] = "No envio email";
									if ($local)
										$arr_contactos[$key]["error"] .= " (localhost)";
								}

								if (empty($arr_contactos[$key]["send"]))
									$arr_contactos[$key]["send"] = 0;
							}



		        	$mail->ClearAllRecipients();
		        	//$mail->ClearAttachments();

							//echo "send notification (*)";
							//die();
					}

				} catch (phpmailerException $e) {
  	
				  	$arr_contactos[$key]["error"] = $e->errorMessage();
				  	$arr_contactos[$key]["send"] = -1;
				  	$send = -1;  						

				} catch (Exception $e) {
				  	$arr_contactos[$key]["error"] = $e->getMessage();
				  	$arr_contactos[$key]["send"] = -1;
				  	$send = -1;
				}

/*
				} catch (phpmailerException $e) {
				  	$arr_contactos[$key]["error"] = $e->errorMessage();
				  	$arr_contactos[$key]["send"] = -1;
				  	$send = -1;
				} catch (Exception $e) {
				  	$arr_contactos[$key]["error"] = $e->errorMessage();
				  	$arr_contactos[$key]["send"] = -1;
				  	$send = -1;
				}
*/
		}

		return $send;

	}



	function contactos($id_routing,$id_estatus,$import_export) {

		$arr_datos = array();

		$ro = Routings::model()->findByPk($id_routing);

		$estatus = Aimartrackings::model()->findByPk($id_estatus);

	    //$estatus->notificar_cliente
	    //$estatus->notificar_shipper

		$arr_datos['estatus_es'] = $estatus->estatus_es;
		$arr_datos['estatus'] = $estatus->estatus;
	    $arr_datos['internos'] = $this->EmailsDivisiones($ro->id_usuario_creacion,array("internos"=>1), $ro->id_pais, "Preembarque", "'Soporte','Desarrollo','Monitor'",$import_export);

		$arr_temp = array();
		$arr_temp["agente_id"] = intval($ro->agente_id);
		$arr_temp["notificar_agente"] = intval($estatus->notificar_agente);
		$arr_temp["notificar_coloader"] = intval($ro->id_coloader);
		$arr_temp["shipper_id"] = intval($ro->id_shipper);
		$arr_temp["notificar_shipper"] = intval($estatus->notificar_shipper);
		$arr_temp["cliente_id"] = intval($ro->id_cliente);
		$arr_temp["notificar_cliente"] = $estatus->notificar_cliente;
		$arr_temp["ORDER_TO"] = intval($ro->id_notify);

		//$arr_datos["notificar_agente"] = intval($estatus->notificar_agente);

		//$arr_temp["agente_id"] = 1139; //pruebas


		$region = "'BZ','CR','GT','HN','BZLTF','CRLTF','GTLTF','HNLTF','NILTF','PALTF','SVLTF','NI','N1','PA','SV'";



		//En las exportaciones el status se debe enviar:
		if ($import_export == 0) {

			//a.  Siempre al shipper
			$arr_temp["notificar_shipper"] = 1;

			//b.  Se enviará el status al cliente unicamente si la carga tiene destino Centroamerica incluyendo Belice y Panama.
			if (strpos($region,"'".$ro->id_pais_destino."'") > 0)
				$arr_temp["notificar_cliente"] = 1;
		}





		//contactos anteriores (todos menos agentes)
		$arr_datos['externos'] = $this->EmailsExternosFunc($arr_temp, $ro->id_pais);

		$arr_datos['ro']['routing'] = $ro->routing;
		//$arr_datos['ro']['id_routing'] = $ro->id_routing;
		$arr_datos['ro']['id_cliente'] = $ro->id_cliente;
		$arr_datos['ro']['id_shipper'] = $ro->id_shipper;
		$arr_datos['ro']['nombre_cliente'] = $ro->idCliente->nombre_cliente;
		$arr_datos['ro']['nombre_shipper'] = $ro->idShipper->nombre_cliente;

		$arr_datos['ro']['id_pais'] = $ro->id_pais;
		$arr_datos['ro']['descripcion'] = $ro->idPais->descripcion;

		//$arr_datos['ro']['import_export'] = $ro->import_export == "t" ? "IMPORT":"EXPORT";
		$arr_datos['ro']['import_export'] = $import_export == 1 ? "IMPORT":"EXPORT";

		$arr_datos['ro']['no_embarque'] = $ro->no_embarque;
		$arr_datos['ro']['cotizacion_id'] = $ro->cotizacion_id;
		$arr_datos['ro']['transporte'] = $ro->idTransporte2->descripcion;
		$arr_datos['ro']['order_no'] = $ro->order_no;

		$arr_datos['ro']['id_usuario_creacion'] = $ro->id_usuario_creacion;

		//echo "<script>console.log('".json_encode($arr_datos)."');</script>";

		echo "<script>console.log();console.log('".json_encode($arr_datos['internos'])."');</script>";

		echo "<script>console.log();console.log('".json_encode($arr_temp)."');</script>";

//die();
		return $arr_datos;
	}

	function wsNotification($tracking_id) {
		
		$result = array();
		
		try {	
			$url = "http://10.10.1.21:7480/SendParametros.asmx?wsdl";	//produccion	

			//$url = "http://10.10.1.32:54822/SendParametros.asmx?wsdl"; 	//desarrollo 

			//$url = "http://10.10.1.21:9093//SendParametros.asmx?wsdl"; 	//PRUEBAS

			$client = new SoapClient($url);  	
			$load = $client->Notification(	
				array(
					'tracking_id'=>$tracking_id,
					'product'=>'4',	
					'sub_product'=>'', 	
					'impex'=>'', 
					'bl_id'=>'', 	
					'status_id'=>'', 
					'produccion'=>1,     //flag en false solo para pruebas
					'user'=>Yii::app()->user->id,	
					'ip'=>$_SERVER['REMOTE_ADDR'], 							
				)
			);				
			$result = $load->NotificationResult;	
			//echo "//////////////wsNotification <pre>";
			//print_r($result);
			//echo "</pre>";					
		} catch(Exception $e) {
			//echo "//////////////wsNotification Error : " . $e->getMessage();
			$result['stat'] = -1;
			$result['msg'] = $e->getMessage();		
		}
		
		return $result;
	}

	function SendNotifications($arr_contactos) {

		$arr_notifica = array_merge($arr_contactos['internos'], $arr_contactos['externos']);
		$arr_notifica = array_reverse($arr_notifica, true);

		$SetSupportName = "";
		$SetSupportPhone = "";
		$SetSupportEmail = "";
		foreach ($arr_contactos['internos'] as $email_str) {
			if ($arr_contactos['ro']['id_usuario_creacion'] == $email_str["id"]) {
				if ($email_str["tipo"]=="Contacto") {
					$SetSupportName = $email_str["nombre"];
					$SetSupportPhone = $email_str["telefono"];
					$SetSupportEmail = $email_str["email"];
					break;
				}
			}
		}


		if (empty($SetSupportEmail)) {
			$SQLQuery = "SELECT id_usuario, pw_gecos, pais, pw_name, dominio from usuarios_empresas where id_usuario = '".$arr_contactos['ro']['id_usuario_creacion']."' AND pw_activo = 1";
			$getData = Yii::app()->db->createCommand($SQLQuery)->queryRow();
			if ($getData) {
				$SetSupportName = $getData["pw_gecos"];
				$SetSupportPhone = "";
				$SetSupportEmail = $getData["pw_name"]."@".$getData["dominio"];
			}
		}

		/*se iva a traer la factura pero eso lo deben ingresar en la misma casilla de p.o.
		if (empty($arr_contactos['ro']['order_no'])) {
				$arr_contactos['ro']['order_no'] = "-";
				$rui=Routings::model()->findByPk($arr_contactos['ro']['id_routing']);
				if ($rui) {
						echo "(".$rui->id_routing_type.")";
						echo "(".$rui->routing_int.")";
 						if ($rui->id_routing_type == 1) {
								$carut=CargosRouting::model()->find("id_routing=".$rui->routing_int);
								if ($carut)
										$arr_contactos['ro']['order_no'] = $carut->factura_id;//yo creo que debe ser el routing interno
						}
				}
		}

				echo "<pre>";
				print_r($arr_contactos);
				echo "</pre>";
				die();
*/

		//$subject = "Status Notification ".$arr_contactos['ro']['order_no']." / ".$arr_contactos['ro']['routing']." ".$arr_contactos['ro']['id_cliente'].":".$arr_contactos['ro']['nombre_cliente'];
		$subject = "Status Notification ";

		$arr_contactos['ro']['order_no'] = $this->CleanChars($arr_contactos['ro']['order_no'],"\/");

		if (!empty($arr_contactos['ro']['order_no']))
			$subject .= "PO ".$arr_contactos['ro']['order_no']." / ";

		$subject .= "RO ".$arr_contactos['ro']['routing']." / ";

		$subject .= "C: ".$arr_contactos['ro']['nombre_cliente']." / ";

		if (!empty($arr_contactos['ro']['nombre_shipper']))
			$subject .= "S: ".$arr_contactos['ro']['nombre_shipper']." / ";

		$subject .= "Embarque: ";

		$subject .= !empty($arr_contactos['ro']['no_embarque']) ? $arr_contactos['ro']['no_embarque'] : "Pendiente";


		$webp_url1 = "http://www.aimargroup.com";

		$id_pais = $arr_contactos['ro']['id_pais'];
	    switch ($id_pais) {
	    case "N1":
				$logo = "wp-content/uploads/2015/05/logo.png";
				$webp_url = "http://grhlogisticsnic.com";
				$webp_tex = "www.grhlogistics.com";
				$atentamente = "GRH";
				break;

	    case "BZLTF":
	    case "GTLTF":
	    case "SVLTF":
	    case "HNLTF":
	    case "NILTF":
	    case "CRLTF":
	    case "PALTF":
	    		$logo = "img/logo_latin_new.jpg";
	    		$webp_url = "http://www.latinfreightneutral.com";
	    		$webp_tex = "www.latinfreightneutral.com";
				$atentamente = "Latin Freight";
	    		break;
	    default:
	    		$logo = "img/aimargroup.jpg";
	    		$webp_url = "http://www.aimargroup.com";
	    		$webp_tex = "www.aimargroup.com";
				$atentamente = "Aimar Group";
	    		break;
	    }

		$flag_img = "<img src='$webp_url1/img/".substr(strtolower( $id_pais == "N1" ? "NI" : $id_pais ),0,2)."-flag.png' height=16>";

		$header = "<img src='$webp_url/$logo' height=60>$flag_img ".$arr_contactos["ro"]["descripcion"]." ".$arr_contactos["ro"]["import_export"]." ".$arr_contactos['ro']['transporte'];

	  $arr_contactos["ro"]["header"] = $header;
		$arr_contactos["ro"]["name_en"] = $arr_contactos['estatus'];
		$arr_contactos["ro"]["name_es"] = $arr_contactos['estatus_es'];

		$arr_contactos["ro"]["comentario"] = $arr_contactos['comentario'];
		$arr_contactos["ro"]["webp_url"] = $webp_url;
		$arr_contactos["ro"]["webp_tex"] = $webp_tex;
		$arr_contactos["ro"]["SetSupportName"] = $SetSupportName;
		$arr_contactos["ro"]["SetSupportEmail"] = $SetSupportEmail;
		$arr_contactos["ro"]["SetSupportPhone"] = $SetSupportPhone;
		$arr_contactos["ro"]["atentamente"] = $atentamente;

		$b_agente = "";





		if (isset($arr_contactos["notificar_agente"])) {

	    if ($arr_contactos["notificar_agente"] == 1) {
					ob_start();
	        $this->renderPartial('notification_agent',array(
	            'ro'=>$arr_contactos["ro"],
	        ), false, true);
					$b_agente = ob_get_contents(); ob_end_clean();
	    }
		}



        $b_belize = "";
        $b_region = "";

		ob_start();
        if (strtoupper(substr($id_pais,0,2)) == "BZ") {
        	$this->renderPartial('notification', array('ro'=>$arr_contactos["ro"]), false, true);
        	$b_belize = ob_get_contents(); 
        } else {
        	$this->renderPartial('notificacion', array('ro'=>$arr_contactos["ro"]), false, true);
        	$b_region = ob_get_contents(); 
        }
        ob_end_clean();


		$send = $this->envia_email($arr_notifica,"Notificacion",$subject,$b_region,$subject,$b_agente,$b_belize,$id_pais);

		/*echo "<pre>";
		print_r($arr_notifica);
		echo "</pre>";

		//print_r($arr_contactos);
echo "send notification (*)"; die();*/

		//reporta los emails no enviados, solo los externos
		$b_noenvio = "";
    foreach ($arr_contactos['externos'] as $key => $valor) {
			if ($valor["send"] == -1) {
        		$b_noenvio.= "<font color=red>IMPORTANTE:</font> No se pudo enviar estatus al ";
        		$b_noenvio.= $valor["tipo"]."<br>";
    			$b_noenvio.="<b>{$valor[$valor["tipo"]."_id"]} - {$valor["nombre"]}</b> E-mail : {$valor["email"]}<br>";
        		$b_noenvio.="{$valor["error"]}, favor de revisar y actualizar.<br><br>";
        	}
		}

		if (!empty($b_noenvio)) {

			//Yii::app()->user->setFlash("error", $b_noenvio);

			$msg = $b_noenvio;

	        $b_noenvio .= "A continuacion el mensaje original: <br><br>";
	        $b_noenvio .= "<hr>";
	        $b_noenvio .= "<b>SUBJECT : $subject</b><br><br>";
	        $b_noenvio .= "<hr>";
	        $b_noenvio .= $b_region . $b_belize;
			$send=$this->envia_email($arr_contactos['internos'],"NoEnvioEmail","NO SE ENVIO:$subject",$b_noenvio,"","","",$id_pais);
        }
		else
			$msg = 1;
			//Yii::app()->user->setFlash("success", "Autonotificacion enviada correctamente" );


		return array('msg'=>$msg,'notificacion'=>json_encode($arr_notifica));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id,$c)
	{
		$model=new TrackingRoutings;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['TrackingRoutings']))
		{
			$model->attributes=$_POST['TrackingRoutings'];

			$model->usuario = Yii::app()->user->id;
			$model->fecha_estatus = date("Y-m-d");
			$model->hora_estatus = date("h:i:s");
			$model->activo = 1;

			$arr_contactos = $this->contactos($model->id_routing,$model->id_estatus,$model->import_export);
			$model->name_es = $arr_contactos['estatus_es'];
			$model->name_en = $arr_contactos['estatus'];
			$model->id_cliente = $arr_contactos['ro']['id_cliente'];
			$model->cotizacion_id = $arr_contactos['ro']['cotizacion_id'];

			$arr_contactos['comentario'] = $model->comentario;

			//echo '<script>console.log("'.json_encode($arr_contactos).'");</script>';


			//no debe quitarsele las diagonales
			//$model->notificacion = str_replace("\\","",$this->SendNotifications($arr_contactos));

			//$res = $this->SendNotifications($arr_contactos); //2020-10-28 OK

			//$model->notificacion = $res['notificacion']; //2020-10-28 OK

			if (empty($model->fecha_alerta)) $model->fecha_alerta = null; //necesario para evitar error en yii admin

			$model->routing_cli = $model->id_routing;//es obligatorio y debe tener relacion

			if($model->save()) {
				
				$res = $this->wsNotification($model->id);

				//print_r($res);

				//echo "(".$res['msg'].")";

				if ($res->stat == 1)
					Yii::app()->user->setFlash("success", "Autonotificacion enviada correctamente " . $model->id );
				else
					Yii::app()->user->setFlash("error", $res->msg);

					$model->id_estatus = 0;
					$model->comentario = "";
					$model->fecha_alerta = "";


			}	else {

				Yii::app()->user->setFlash("error", $model->getErrors());

			}

			//$this->refresh();
			
			/*
			$_GET['routingCli'] = $model->routing_cli;
			//$_GET['routing'] = $model->routingCli->routing;
			$_GET['routing'] = $model->routing;
			$_GET['pais'] = $model->id_pais;
			*/
			//$_GET['import'] = $model->import_export;

			//$routing = $model;



			//$routing=Routings::model()->findByPk($model->id_routing);
			//$routing->import_export = $model->import_export;

			//print_r($_POST['TrackingRoutings']); die();

		} else {

			//$_GET['bloquea'] = 0;


			//solo entran routing cliente
			$routing=Routings::model()->findByPk($id);

			$model->id_routing = $routing->id_routing;
			$model->routing = $routing->routing;
			$model->id_pais = $routing->id_pais;
			$model->import_export = $routing->import_export;
			$model->id_pais_origen = $routing->id_pais_origen;
			$model->id_pais_destino = $routing->id_pais_destino;
			$model->id_transporte = $routing->id_transporte;



			//$_GET['import'] = intval($routing->import_export);

			if ($routing->borrado == 1) {

				//$_GET['bloquea'] = 1;
				Yii::app()->user->setFlash('error','Routing Borrado');

			} else {

				//debe validar por el routing interno
				$seguir = true;
				//if (isset($routing->routingInt->bl_id)) { //ya hay routing interno
				/*
				if ($routing->routing_int > 0) { //ya hay routing interno

					if ($routing->routingInt->bl_id == 0) { //trafico aun no ha vinculado el routing

						$seguir = true;

					} else {

						$seguir = false;

						if (count($routing->trackings) == 0) { //no hay estatus ingresados

							//no deberia pasar aca porque ya lo bloquea desde el Routings/admin
							Yii::app()->user->setFlash('error','Routing en trafico, no se ingresan mas estatus (1).');

						} else {

							Yii::app()->user->setFlash('error','Routing en trafico, no se ingresan mas estatus.');
						}
					}
				}
				*/

				if ($seguir == true) { //if ($routing->bl_id == 0) { //puede seguir ingresando estatus

				//if ($routing->routing_int == 0) { //puede seguir ingresando estatus

					//$region = "'BZ','CR','GT','HN','BZLTF','CRLTF','GTLTF','HNLTF','NILTF','PALTF','SVLTF','NI','N1','PA','SV'";
					$region = Yii::app()->session['region'];

					//echo "(".$routing->id_pais_origen.")(".$routing->id_pais_destino.")(".$routing->id_pais.")(".str_replace("'","",Yii::app()->session['usr_pais']).")<br>";

					//if (strpos($region,$routing->id_pais_origen) > 0 && strpos($region,$routing->id_pais_destino) > 0 && $routing->id_pais != $routing->id_pais_origen && $routing->id_pais != $routing->id_pais_destino


					/*
					$EsUserOrigen = intval(strpos(Yii::app()->session['usr_pais'],$routing->id_pais_origen)) == 0 ? false : true;
					$EsUserDestino = intval(strpos(Yii::app()->session['usr_pais'],$routing->id_pais_destino)) == 0 ? false : true;
					$EsOrigenRegion = intval(strpos($region,$routing->id_pais_origen)) == 0 ? false : true;
					$EsDestinoRegion = intval(strpos($region,$routing->id_pais_destino)) == 0 ? false : true;
					*/

					$EsUserOrigen = strpos(Yii::app()->session['usr_pais'],"'".$routing->id_pais_origen);
					$EsUserDestino = strpos(Yii::app()->session['usr_pais'],"'".$routing->id_pais_destino);
					$EsOrigenRegion = strpos("*$region","'{$routing->id_pais_origen}");
					$EsDestinoRegion = strpos("*$region","'{$routing->id_pais_destino}");

					/*echo "(".Yii::app()->session['usr_pais'].")<br>";

					echo "($EsUserOrigen)
					($EsUserDestino)
					($EsOrigenRegion)
					($EsDestinoRegion)<br>";					

					echo "($routing->id_pais_origen)
					($routing->id_pais_destino)
					($routing->id_pais_origen)
					($routing->id_pais_destino)<br>";					

					die();*/

					$EsUserOrigen = $EsUserOrigen > -1 ? true : false;
					$EsUserDestino = $EsUserDestino > -1 ? true : false;
					$EsOrigenRegion = $EsOrigenRegion > -1 ? true : false;
					$EsDestinoRegion = $EsDestinoRegion > -1 ? true : false;

					//echo "(EsUOri=$EsUserOrigen)(EsUDes=$EsUserDestino)(EsOriR=$EsOrigenRegion)(EsDesR=$EsDestinoRegion)<br>";

					//si usuario es del pais origen ó pais origen no es de la region
					if ($EsUserOrigen || !$EsOrigenRegion) {

						//3. Cuando uno de los países de origen o destino no es de Centroamerica entonces mosotrará los status de importación o exportación según sea el RO cliente que fue creado.
						if (!$EsOrigenRegion || !$EsDestinoRegion) {

							//$_GET['import'] = intval($routing->import_export);
							$model->import_export = intval($routing->import_export);

						} else {

						//4. Cuando el origen o destino sean países de Centroamerica los que status que mostrará son de exportación a los países de origen y los países destino no podrán ingresar status estarán bloqueados.
								if ($routing->id_pais_origen != $routing->id_pais_destino) {

										//if (strpos($region,$routing->id_pais_origen) > 0 && strpos($region,$routing->id_pais_destino) > 0) {
										if ($EsOrigenRegion || $EsDestinoRegion) {

											//if (strpos(Yii::app()->session['usr_pais'],$routing->id_pais_origen) > 0)
											if ($EsUserOrigen)
												$model->import_export = 0;
												//$_GET['import'] = 0;

											//if (strpos(Yii::app()->session['usr_pais'],$routing->id_pais_destino) > 0) {
											if ($EsUserDestino && $EsOrigenRegion) {

												//bloquea
												//$_GET['bloquea'] = 1;

												//Yii::app()->user->setFlash('error','Su pais solo tiene consulta de los estatus en pestaña consulta');

												Yii::app()->user->setFlash('error','2. No es posible ingresar estatus a '.$routing->id_pais_origen.', solo tiene consulta de los estatus en pestaña consulta.');

												//$_GET['import'] = 1;
												$model->import_export = 1;

												/*echo CHtml::script("
								                window.parent.$('#cru_dialog').dialog('close');
								                window.parent.$('#cru_frame').attr('src','');
								                ");
								                Yii::app()->end();*/
							                }
										}
								}
						}


					} else {

						//$_GET['bloquea'] = 1;
						Yii::app()->user->setFlash('error','No es posible ingresar estatus a '.$routing->id_pais_origen.', solo tiene consulta de los estatus en pestaña consulta.');

					}

				//} else {

				//	Yii::app()->user->setFlash('error','Routing en trafico, no se ingresan mas estatus.');

				}

			}


			/*
			$_GET['routingCli'] = $routing->routing_cli;
			$_GET['pais'] = $routing->id_pais;
			if ($routing->id_routing_type == 1 && empty($_GET['routingCli'])) {
				$_GET['routingCli'] = $routing->id_routing;
				$_GET['routing'] = $routing->routing;
			} else {
				$_GET['routing'] = $routing->routingCli->routing;
			}
			*/


			//agregado 2017-04-19
			echo CHtml::script("
			if (window.parent.$.fn.yiiGridView)
				window.parent.$.fn.yiiGridView.update('vw-routings-grid');
			");
			//Yii::app()->end();


		}

		//$_GET['routingCli'] = intval($_GET['routingCli']);
		//$_GET['id'] = intval($_GET['id']);


		/*
		if (empty($_GET['routingCli'])) {

			echo '<p>
				<div id="alert-error" class="alert in fade alert-error">
					'.chtml::encode("No tiene Routing Cliente").'
				</div>
			</p>';

		} else {
		*/
			if (Yii::app()->request->isAjaxRequest) {
		        $this->renderPartial('create',array(
		            'model'=>$model,
		            //'routing'=>$routing,
		            'imp_exp' => $model->import_export == 0 ? "Export" : "Import",
								'c' => $c,
		        ), false, true);
			} else {
			    if ($this->asDialog)
			    	$this->layout = '//layouts/iframe';
		        $this->render('create',array(
		            'model'=>$model,
		            //'routing'=>$routing,
		            'imp_exp' => $model->import_export == 0 ? "Export" : "Import",
								'c' => $c,
		        ));
			}

		//}

	}



	public function actionConsult($id)
	{
		$model=new TrackingRoutings;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['TrackingRoutings']))
		{
			$model->attributes=$_POST['TrackingRoutings'];

			$model->usuario = Yii::app()->user->id;
			$model->fecha_estatus = date("Y-m-d");
			$model->hora_estatus = date("h:i:s");
			$model->activo = 1;

			$arr_contactos = $this->contactos($model->id_routing,$model->id_estatus,$model->import_export);
			$model->name_es = $arr_contactos['estatus_es'];
			$model->name_en = $arr_contactos['estatus'];
			$model->id_cliente = $arr_contactos['ro']['id_cliente'];
			$model->cotizacion_id = $arr_contactos['ro']['cotizacion_id'];

			$arr_contactos['comentario'] = $model->comentario;


			//echo '<script>console.log("'.json_encode($arr_contactos).'");</script>';

			//print_r($arr_contactos);

			//no debe quitarsele las diagonales
			//$model->notificacion = str_replace("\\","",$this->SendNotifications($arr_contactos));

			//$res = $this->SendNotifications($arr_contactos);

			//$model->notificacion = $res['notificacion'];

			$model->routing_cli = $model->id_routing;//es obligatorio y debe tener relacion

			if($model->save()) {

				$res = $this->wsNotification($model->id);

				//echo "(".$res['msg'].")";

				if ($res->stat == 1)
					Yii::app()->user->setFlash("success", "Autonotificacion enviada correctamente" );
				else
					Yii::app()->user->setFlash("error", $res->msg);

				//$this->refresh();

			//}	else {

				//Yii::app()->user->setFlash("error", $model->getErrors());

			}

			/*
			$_GET['routingCli'] = $model->routing_cli;
			//$_GET['routing'] = $model->routingCli->routing;
			$_GET['routing'] = $model->routing;
			$_GET['pais'] = $model->id_pais;
			*/
			//$_GET['import'] = $model->import_export;

			//$routing = $model;



			//$routing=Routings::model()->findByPk($model->id_routing);
			//$routing->import_export = $model->import_export;

			//print_r($_POST['TrackingRoutings']); die();

		} else {

			//$_GET['bloquea'] = 0;


			//solo entran routing cliente
			$routing=Routings::model()->findByPk($id);

			$model->id_routing = $routing->id_routing;
			$model->routing = $routing->routing;
			$model->id_pais = $routing->id_pais;
			$model->import_export = $routing->import_export;
			$model->id_pais_origen = $routing->id_pais_origen;
			$model->id_pais_destino = $routing->id_pais_destino;



			//$_GET['import'] = intval($routing->import_export);

			if ($routing->borrado == 1) {

				//$_GET['bloquea'] = 1;
				Yii::app()->user->setFlash('error','Routing Borrado');

			} else {

				//debe validar por el routing interno
				$seguir = true;
				//if (isset($routing->routingInt->bl_id)) { //ya hay routing interno
				if ($routing->routing_int > 0) { //ya hay routing interno

					if ($routing->routingInt->bl_id == 0) { //trafico aun no ha vinculado el routing

						$seguir = true;

					} else {

						$seguir = false;

						if (count($routing->trackings) == 0) { //no hay estatus ingresados

							//no deberia pasar aca porque ya lo bloquea desde el Routings/admin
							Yii::app()->user->setFlash('error','Routing en trafico, no se ingresan mas estatus (1).');

						} else {

							Yii::app()->user->setFlash('error','Routing en trafico, no se ingresan mas estatus.');
						}
					}
				}

				if ($seguir == true) { //if ($routing->bl_id == 0) { //puede seguir ingresando estatus

				//if ($routing->routing_int == 0) { //puede seguir ingresando estatus

				//$region = "'BZ','CR','GT','HN','BZLTF','CRLTF','GTLTF','HNLTF','NILTF','PALTF','SVLTF','NI','N1','PA','SV'";
				$region = Yii::app()->session['region'];

					//echo "(".$routing->id_pais_origen.")(".$routing->id_pais_destino.")(".$routing->id_pais.")(".str_replace("'","",Yii::app()->session['usr_pais']).")<br>";

					//if (strpos($region,$routing->id_pais_origen) > 0 && strpos($region,$routing->id_pais_destino) > 0 && $routing->id_pais != $routing->id_pais_origen && $routing->id_pais != $routing->id_pais_destino


/*
$EsUserOrigen = intval(strpos(Yii::app()->session['usr_pais'],$routing->id_pais_origen)) == 0 ? false : true;
$EsUserDestino = intval(strpos(Yii::app()->session['usr_pais'],$routing->id_pais_destino)) == 0 ? false : true;
$EsOrigenRegion = intval(strpos($region,$routing->id_pais_origen)) == 0 ? false : true;
$EsDestinoRegion = intval(strpos($region,$routing->id_pais_destino)) == 0 ? false : true;
*/

		$EsUserOrigen = strpos(Yii::app()->session['usr_pais'],"'".$routing->id_pais_origen);
		$EsUserDestino = strpos(Yii::app()->session['usr_pais'],"'".$routing->id_pais_destino);
		$EsOrigenRegion = strpos("*$region","'{$routing->id_pais_origen}");
		$EsDestinoRegion = strpos("*$region","'{$routing->id_pais_destino}");

		$EsUserOrigen = $EsUserOrigen > -1 ? true : false;
		$EsUserDestino = $EsUserDestino > -1 ? true : false;
		$EsOrigenRegion = $EsOrigenRegion > -1 ? true : false;
		$EsDestinoRegion = $EsDestinoRegion > -1 ? true : false;

					//echo "(EsUOri=$EsUserOrigen)(EsUDes=$EsUserDestino)(EsOriR=$EsOrigenRegion)(EsDesR=$EsDestinoRegion)<br>";

					//si usuario es del pais origen ó pais origen no es de la region
					if ($EsUserOrigen || !$EsOrigenRegion) {

						//3. Cuando uno de los países de origen o destino no es de Centroamerica entonces mosotrará los status de importación o exportación según sea el RO cliente que fue creado.
						if (!$EsOrigenRegion || !$EsDestinoRegion)

							//$_GET['import'] = intval($routing->import_export);
							$model->import_export = intval($routing->import_export);

						else

						//4. Cuando el origen o destino sean países de Centroamerica los que status que mostrará son de exportación a los países de origen y los países destino no podrán ingresar status estarán bloqueados.
						if ($routing->id_pais_origen != $routing->id_pais_destino) {

							//if (strpos($region,$routing->id_pais_origen) > 0 && strpos($region,$routing->id_pais_destino) > 0) {
							if ($EsOrigenRegion || $EsDestinoRegion) {

								//if (strpos(Yii::app()->session['usr_pais'],$routing->id_pais_origen) > 0)
								if ($EsUserOrigen)
									$model->import_export = 0;
									//$_GET['import'] = 0;

								//if (strpos(Yii::app()->session['usr_pais'],$routing->id_pais_destino) > 0) {
								if ($EsUserDestino && $EsOrigenRegion) {

									//bloquea
									//$_GET['bloquea'] = 1;

									//Yii::app()->user->setFlash('error','Su pais solo tiene consulta de los estatus en pestaña consulta');

									Yii::app()->user->setFlash('error','2. No es posible ingresar estatus a '.$routing->id_pais_origen.', solo tiene consulta de los estatus en pestaña consulta.');

									//$_GET['import'] = 1;
									$model->import_export = 1;

									/*echo CHtml::script("
					                window.parent.$('#cru_dialog').dialog('close');
					                window.parent.$('#cru_frame').attr('src','');
					                ");
					                Yii::app()->end();*/
				                }
							}
						}

					} else {

						//$_GET['bloquea'] = 1;
						Yii::app()->user->setFlash('error','No es posible ingresar estatus a '.$routing->id_pais_origen.', solo tiene consulta de los estatus en pestaña consulta.');

					}

				//} else {

				//	Yii::app()->user->setFlash('error','Routing en trafico, no se ingresan mas estatus.');

				}

			}


			/*
			$_GET['routingCli'] = $routing->routing_cli;
			$_GET['pais'] = $routing->id_pais;
			if ($routing->id_routing_type == 1 && empty($_GET['routingCli'])) {
				$_GET['routingCli'] = $routing->id_routing;
				$_GET['routing'] = $routing->routing;
			} else {
				$_GET['routing'] = $routing->routingCli->routing;
			}
			*/


		}

		//$_GET['routingCli'] = intval($_GET['routingCli']);
		//$_GET['id'] = intval($_GET['id']);


		/*
		if (empty($_GET['routingCli'])) {

			echo '<p>
				<div id="alert-error" class="alert in fade alert-error">
					'.chtml::encode("No tiene Routing Cliente").'
				</div>
			</p>';

		} else {
		*/
			if (Yii::app()->request->isAjaxRequest) {
		        $this->renderPartial('consult',array(
		            'model'=>$model,
		            //'routing'=>$routing,
		            'imp_exp' => $model->import_export == 0 ? "Export" : "Import"
		        ), false, true);
			} else {
			    if ($this->asDialog)
			    	$this->layout = '//layouts/iframe';
		        $this->render('consult',array(
		            'model'=>$model,
		            //'routing'=>$routing,
		            'imp_exp' => $model->import_export == 0 ? "Export" : "Import"
		        ));
			}

		//}

	}
/*
	public function actionDetalles($id)
	{
		//$routing=Routings::model()->findByPk($id);

		$this->layout = '//layouts/iframe';

		//$this->renderPartial('child_admin',array('id_routing'=>$id),true);

		//$this->render('child_admin',array('id_routing'=>$id));


		$this->widget('zii.widgets.jui.CJuiTabs',array(
		    'tabs'=>array(

		        'Consulta Estatus' =>$this->renderPartial('child_admin',array('id_routing'=>$id),true),

		        'Contactos'=>$this->renderPartial('contactos', array('rawData'=>json_encode(array()),'id'=>-1),true),

		    ),
		    'headerTemplate' => '<li><a href="{url}" title="{title}">{title}</a></li>',
		    // additional javascript options for the tabs plugin
		    'options'=>array(
		        //'collapsible'=>true,
		        //'active'=> isset($_GET['active']) ? 0 : 2,
		        'heightStyle', 'fill', //auto fill content
		        //'height' => '100%',
		    ),
		    //'id'=>'rotab',
		));

	}*/

	public function actionLoadcomments() {


		//print_r($_POST['routing']);
		//die();

		if (empty($_POST['estatus_id'])) {

			echo CHtml::script("$('#rotab_tab_1').html('');");

		} else {

			$arr_contactos = $this->contactos($_POST['id_routing'],$_POST['estatus_id'],$_POST['import']);
			$arr_notifica = array_merge($arr_contactos['internos'], $arr_contactos['externos']);
			$arr_notifica = array_reverse($arr_notifica, true);

			$estatus = Aimartrackings::model()->findByPk($_POST['estatus_id']);

			//$ro = Routings::model()->findByPk($_POST['routingCli']);


			$contactos1 = $this->renderPartial('contactos', array(
			'rawData'=>json_encode($arr_notifica),
			'id'=>0,
			//'estatus'=>$estatus,
			'estatus'=>$estatus->id." - ".$estatus->estatus,
			//'routing'=>$_POST['routing'],
			//"ro"=>"<br>Routing:".$routing->routing."&nbsp;&nbsp;Creacion:".$routing->id_pais."&nbsp;&nbsp;Origen:".$routing->id_pais_origen."&nbsp;&nbsp;Destino:".$routing->id_pais_destino
			),true);

			$contactos1 = str_replace("
","",$contactos1);
			$contactos1 = str_replace("'","",$contactos1);

	//$contactos1 = str_replace('<table class="items','<div class="tbl-header"><table class="items',$contactos1);
	//$contactos1 = str_replace('<tbody>','</table></div><div class="tbl-content"><table class="items"><tbody>',$contactos1);
			echo CHtml::script("$('#rotab_tab_1').html('".$contactos1."');");


			if ($_POST['estatus_id'] > 0) {
				$comments=TrackingComentarios::model()->find("id_estatus_pg = ".$_POST['estatus_id']);
				if ($comments)
					echo $comments->comentario;
				else
					echo "";
			} else {
				echo "";
			}


		}

	}


	public function actionLoadnotifications($id) {

			$model=TrackingRoutings::model()->findByPk($id);

			$contactos1 = $this->renderPartial('contactos', array('rawData'=>$model->notificacion,'id'=>$id,

			'estatus'=>$model->id_estatus." - ".$model->name_es." :: ".$model->fecha_estatus." ".$model->hora_estatus." ::"

			),true);
			$contactos1 = str_replace("
","",$contactos1);
			$contactos1 = str_replace("'","",$contactos1);

			echo $contactos1;
	}




	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TrackingRoutings']))
		{
			$model->attributes=$_POST['TrackingRoutings'];
			if($model->save()) {
				if ($this->asDialog) {
	                echo CHtml::script("
	                window.parent.$('#cru_dialog').dialog('close');
	                window.parent.$('#cru_frame').attr('src','');
	                if (window.parent.$.fn.yiiGridView)
	                	window.parent.$.fn.yiiGridView.update('tracking-routings-grid');
	                ");
	                Yii::app()->end();
				} else {
					$array = array('update','id'=>$model->id);

					$this->redirect($array);
				}
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
	        $this->renderPartial('update',array(
	            'model'=>$model,
	        ), false, true);
		} else {
		    if ($this->asDialog)
		    	$this->layout = '//layouts/iframe';
	        $this->render('update',array(
	            'model'=>$model,
	        ));
		}

	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Solicitud invalida. Porfavor no intente de nuevo.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TrackingRoutings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		$sql = "SELECT codigo FROM paises WHERE codigo IN (SELECT distinct upper(replace(bd,'ventas_','')) FROM referencias_usuarios WHERE id_nuevo = '".Yii::app()->user->id."' AND activo = 'f' LIMIT 50) ORDER BY codigo LIMIT 50";


		$model=new TrackingRoutings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TrackingRoutings']))
			$model->attributes=$_GET['TrackingRoutings'];

		if (empty($model->id_pais))
			$model->id_pais = Yii::app()->db->createCommand($sql)->queryScalar();


		$this->render('admin',array(
			'model'=>$model,
			'sql'=>$sql,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TrackingRoutings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La pagina solicitada no existe.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tracking-routings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGenerateExcel()
	{
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);

		$criteria = array();
		if(isset(Yii::app()->session['TrackingRoutings_records']))
			$criteria['criteria'] = Yii::app()->session['TrackingRoutings_records'];
		$criteria['pagination'] = false;//array('pageSize'=>TrackingRoutings::model()->count());
		$model = new CActiveDataProvider('TrackingRoutings',$criteria);

		Yii::app()->request->sendFile('TrackingRoutings_'.date('YmdHis').'.xls',
			$this->renderPartial('reportExcel', array(
				'model'=>$model
			), true)
		);
	}


    public function actionGeneratePdf()
	{
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);

		$criteria = array();
		if(isset(Yii::app()->session['TrackingRoutings_records']))
			$criteria['criteria'] = Yii::app()->session['TrackingRoutings_records'];
		$criteria['pagination'] = array('pageSize'=>TrackingRoutings::model()->count());
		$model = new CActiveDataProvider('TrackingRoutings',$criteria);

								//$orientation,$format,$langue,$unicode,$encoding,$marges
		$html2pdf = Yii::app()->ePdf->HTML2PDF('P','A4','en',true,'UTF-8',array(5,5,5,5));
       	$html2pdf->pdf->SetTitle('PDF_TrackingRoutings');
       	$html2pdf->pdf->SetDisplayMode('fullpage');
        $html = $this->renderPartial('reportPdf', array('model'=>$model,'title'=>'TrackingRoutings'), true);
        $html2pdf->WriteHTML($html);
        $html2pdf->Output('TrackingRoutings_'.date('YmdHis').'.pdf');
	}

}
