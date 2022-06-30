<?php

class RoutingsController extends Controller
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
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','rules'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				//'actions'=>array('create','update','GenerateExcel'),
				'actions'=>array('admin','GenerateExcel'),
				'users'=>array('@'),
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				//'actions'=>array('admin','delete'),
				'actions'=>array('admin','GenerateExcel'),
				'users'=>array('admin'),
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionError() {
		echo "<h1>El routing " . $_GET['id'] . ", No tiene Routing Cliente!</h1>";
	}

/*
	public function actionWhere($no) {

		if (!isset(Yii::app()->session['fecha_i']) || !isset(Yii::app()->session['fecha_f'])) {
			$sql2 = "SELECT to_date(cast(CURRENT_DATE - interval '3' month as varchar),'yyyy-mm-dd') as fecha_i, CURRENT_DATE as fecha_f";
			$row = Yii::app()->db->createCommand($sql2)->queryAll();
			Yii::app()->session['fecha_i'] = $row[0]['fecha_i'];
			Yii::app()->session['fecha_f'] = $row[0]['fecha_f'];
		}

		$condition = "(t.id_pais_origen IN (".str_replace("LTF","",Yii::app()->session['usr_pais']).") OR t.id_pais_destino IN (".str_replace("LTF","",Yii::app()->session['usr_pais']).") OR t.id_pais IN (".Yii::app()->session['usr_pais'].") ) AND t.id_routing_type = '1' AND t.id_transporte NOT IN (6,8,9)";
		$condition .= " AND t.fecha >= '".Yii::app()->session['fecha_i']."' ";
		$condition .= " AND t.fecha <= '".Yii::app()->session['fecha_f']."' ";


		//if (Yii::app()->session['pendientes'])
		//	$condition .= " AND routing_int = 0 AND t.borrado = 'f'";

		//echo '<script>console.log("'.$condition.'");</script>';

		//echo "($no) $condition";

		return $condition;
	}*/


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
	    if (Yii::app()->request->isAjaxRequest || $this->asDialog) {
	        $this->renderPartial('view',array(
	            'model'=>$model,
	        ), false, true);
	    } else {
	        $this->render('view',array(
	            'model'=>$model,
	        ));
	    }
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Routings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Routings']))
		{
			$model->attributes=$_POST['Routings'];
			if($model->save()) {
				if ($this->asDialog) {
	                echo CHtml::script("
	                window.parent.$('#cru_dialog').dialog('close');
	                window.parent.$('#cru_frame').attr('src','');
	                if (window.parent.$.fn.yiiGridView)
	                	window.parent.$.fn.yiiGridView.update('routings-grid');
	                ");
	                Yii::app()->end();
				} else {
					$array = array('update','id'=>$model->id_routing);

					$this->redirect($array);
				}
			}
		}

		if (Yii::app()->request->isAjaxRequest) {
	        $this->renderPartial('create',array(
	            'model'=>$model,
	        ), false, true);
		} else {
		    if ($this->asDialog)
		    	$this->layout = '//layouts/iframe';
	        $this->render('create',array(
	            'model'=>$model,
	        ));
		}
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

		if(isset($_POST['Routings']))
		{
			$model->attributes=$_POST['Routings'];
			if($model->save()) {
				if ($this->asDialog) {
	                echo CHtml::script("
	                window.parent.$('#cru_dialog').dialog('close');
	                window.parent.$('#cru_frame').attr('src','');
	                if (window.parent.$.fn.yiiGridView)
	                	window.parent.$.fn.yiiGridView.update('routings-grid');
	                ");
	                Yii::app()->end();
				} else {
					$array = array('update','id'=>$model->id_routing);

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
		$dataProvider=new CActiveDataProvider('Routings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionRules()
	{

		if ($this->asDialog)
		    $this->layout = '//layouts/iframe';

		$this->render('rules');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		if (isset($_POST['fecha_i']) || isset($_POST['fecha_f'])) {
			Yii::app()->session['fecha_i'] = $_POST['fecha_i'];
			Yii::app()->session['fecha_f'] = $_POST['fecha_f'];
		}

		//$this->actionWhere();
		//Yii::app()->session['pendientes'] = false;

		$model=new Routings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Routings']))
			$model->attributes=$_GET['Routings'];

		//$sql = "SELECT codigo FROM paises WHERE codigo IN (SELECT distinct upper(replace(bd,'ventas_','')) FROM referencias_usuarios WHERE id_nuevo = '".Yii::app()->user->id."' AND activo = 't' LIMIT 50) ORDER BY codigo LIMIT 50";

		//echo "(".$sql.")<br>";

		//if (Yii::app()->user->name <> "admin")

		//if (empty($model->id_pais))
		//	$model->id_pais = Yii::app()->db->createCommand($sql)->queryScalar();

		//if (empty($model->id_pais_origen))
			//$model->id_pais_origen = Yii::app()->db->createCommand($sql)->queryScalar();

		//id_pais_destino

		//if (Yii::app()->user->name <> "admin") {
			/* paso al model addCondition
			if (!isset(Yii::app()->session['id_routing_type']))
				Yii::app()->session['id_routing_type'] = 1;


			if (!isset($model->id_routing_type))
				$model->id_routing_type = Yii::app()->session['id_routing_type'];
			else
				Yii::app()->session['id_routing_type'] = $model->id_routing_type;
				*/
		//}


		$this->render('admin',array(
			'model'=>$model,
			//'sql'=>$sql,
		));
	}


	/**
	 * Manages all models.
	 */
	/*
	public function actionPendientes()
	{

		if (isset($_POST['fecha_i']) || isset($_POST['fecha_f'])) {
			Yii::app()->session['fecha_i'] = $_POST['fecha_i'];
			Yii::app()->session['fecha_f'] = $_POST['fecha_f'];
		}

		Yii::app()->session['pendientes'] = true;

		$model=new Routings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Routings']))
			$model->attributes=$_GET['Routings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}*/


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Routings::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='routings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGenerateExcel($count)
	{
		if (Routings::model()->count(Yii::app()->session['Routings_records']) == $count && $count > 500) {
			echo "Simplifique su busqueda, demasiados datos para exportar.";
			die();
		}


		$dataProvider = new CActiveDataProvider('Routings', array(
			'criteria'=>Yii::app()->session['Routings_records'],
			/*'sort'=>array(
			    'defaultOrder'=>'t.id_routing DESC',
			),*/
			'pagination'=>false,
		));

		/*
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);
		$criteria = array();
		if(isset(Yii::app()->session['Routings_records']))
			$criteria['criteria'] = Yii::app()->session['Routings_records'];
		$criteria['pagination'] = false;//array('pageSize'=>Routings::model()->count());
		$model = new CActiveDataProvider('Routings',$criteria);
		*/

		$filename = 'Routings_'.date('YmdHis').'.xls';

		Yii::app()->request->sendFile($filename,
			$this->renderPartial('reportExcel', array('dataProvider'=>$dataProvider), true)
		);

		//$this->renderPartial('reportExcel', array('dataProvider'=>$dataProvider), true);
		//die();

	}


    public function actionGeneratePdf($count)
	{
		if (Routings::model()->count(Yii::app()->session['Routings_records']) == $count) {
			echo "Simplifique su busqueda, demasiados datos para exportar.";
			die();
		}

		/*ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);
		$criteria = array();
		if(isset(Yii::app()->session['Routings_records']))
			$criteria['criteria'] = Yii::app()->session['Routings_records'];
		$criteria['pagination'] = false;
		$criteria['sort'] = array('defaultOrder'=>'id_routing DESC');
		$model = new CActiveDataProvider('Routings',$criteria);*/

		Yii::app()->session['Routings_records']->order = 'id_routing DESC';


		$model = new CActiveDataProvider('Routings', array('criteria'=>Yii::app()->session['Routings_records']));

		/*$model = new CActiveDataProvider('Routings', array(
			'criteria'=>Yii::app()->session['Routings_records'],
			'sort'=>array(
			    'defaultOrder'=>'id_routing DESC',
			),
			'pagination'=>false,
		));*/

								//$orientation,$format,$langue,$unicode,$encoding,$marges
		$html2pdf = Yii::app()->ePdf->HTML2PDF('P','A4','en',true,'UTF-8',array(5,5,5,5));
       	$html2pdf->pdf->SetTitle('PDF_Routings');
       	$html2pdf->pdf->SetDisplayMode('fullpage');
        $html = $this->renderPartial('reportPdf', array('model'=>$model,'title'=>'Routings'), true);
        $html2pdf->WriteHTML($html);
        $html2pdf->Output('Routings_'.date('YmdHis').'.pdf');
	}





	public function shortText($data,$row,$dataColumn) {


		$borrado = isset($data->borrado) ? $data->borrado : false; 		
		$fecha_alerta = isset($data->trackingsLast->fecha_alerta) ? $data->trackingsLast->fecha_alerta : "1970-10-16";
		$routing_int = isset($data->routing_int) ? $data->routing_int : 0;
		$routingInt = isset($data->routingInt->bl_id) ? $data->routingInt->bl_id : 0;
	
		$css = ($fecha_alerta >= date("Y-m-d") ? "alerta" : 
			($borrado == true ? "borrado" : 
				($routing_int > 0 && $routingInt > 0 ? "bloq" : "activo")
			)
		);



		$val = $dataColumn->name;
		$val = $data->$val;
		$tit = $val;

/*
		if ($dataColumn->name == 'transporte') {
			$val = $data->idTransporte->letra;
			$tit = $data->idTransporte->descripcion;
			//return "<span onmouseover='this.style.cursor=\"pointer\"' title='$tit'><u>".$val."</u></span>";
		} else {
*/			
		$len = 8;
		switch ($dataColumn->name) {
			case 'transporte':
				$val = $data->idTransporte->letra;
				$tit = $data->idTransporte->descripcion;
				$len = 1000;
				break;
			case 'order_no':
				$len = 16;
				break;
			case 'nombre_creacion':
				$val = $data->idUsuarioCreacion->pw_gecos;						
				$tit = $data->id_usuario_creacion . " - " . $val;
				break;
			case 'nombre_cliente':						
				$val = $data->idCliente->nombre_cliente;
				$tit = $data->id_cliente . " - " . $val;
				break;
			case 'routing':
			case 'fecha':
			//case 'no_embarque':
			case 'order_no':
				$len = 1000;
				break;
		}

		if (strlen($val) > $len)
			$val = "<u>".ucfirst(strtolower(substr($val,0,$len)))."..</u>";
		
		return "<span class=$css onmouseover='this.style.cursor=\"pointer\"' title='$tit'>".$val."</span>";
	}

	public function cssButton($data,$row,$dataColumn) {
	
/*
($data->borrado == true ? 
			(isset($data->trackingsLast->id) ? $data->trackingsLast->id : 0 > 0 ? "B1" : "B2")
		:
			$data->routing_int > 0 ?
				(isset($data->routingInt->bl_id) ? $data->routingInt->bl_id : 0 > 0 ? 
					(isset($data->trackingsLast->id) ? $data->trackingsLast->id : 0 > 0 ? "T1" : "T2")
				: 
					(isset($data->trackingsLast->id) ? $data->trackingsLast->id : 0 > 0 ? "R1" : "R2")
				)
			:
				"F1"
		)
*/

		$t = isset($data->routingInt->bl_id) ? $data->routingInt->bl_id : 0; //en trafico
		$l = isset($data->trackingsLast->id) ? $data->trackingsLast->id : 0; //last status

		if ($data->borrado) { 
			$b = ($l > 0 ? "B1" : "B2"); 
		} else {

			if ($data->routing_int > 0) {				
				if ($t > 0) {
					$b = ($l > 0 ? "T1" : "T2");
				} else {
					$b = ($l > 0 ? "R1" : "R2");
				}
			} else {
				$b = ($l > 0 ? "F1" : "F2");
			}
		}

		switch ($b) {
			case "F1": 
			case "F2": 
			
				return CHtml::link("<span class=\"icon-pencil icon-white\"></span>","",array("class"=>"btn btn-small btn-primary btn-block",
			    "title"=>"Input Estatus",
			    "data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
			    "url"=>Yii::app()->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->primaryKey, "c"=>0)),
			    "titulo"=>"Routing : ".$data->routing,
			    "onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Input Estatus \" + $(this).attr(\"titulo\") ,0);",
			    ));
				break;

			
			case "R1": 
			case "R2": 
/*			
				return CHtml::link("<span class=\"icon-pencil icon-blue\"></span>","",array("class"=>"btn btn-small btn-default btn-block",
			    "title"=>"Input Estatus",
			    "data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
			    "url"=>Yii::app()->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->primaryKey, "c"=>0)),
			    "titulo"=>"Routing : ".$data->routing,
			    "onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Input Estatus \" + $(this).attr(\"titulo\") ,0);",
			    ));

*/
				return CHtml::link("<span class=\"icon-random icon-green\"></span>","",
				array("class"=>"btn btn-small btn-block", 								
				"title"=>"Ro Interno ".$data->routing_int,
				"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
				"url"=>Yii::app()->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->primaryKey, "c"=> $b == "T1" ? 1 : 0 )),
				"titulo"=>"Routing : ".$data->routing,				
				"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Estatus \" + $(this).attr(\"titulo\") ,0);",
				));
				break;

			case "T1": // en trafico con estatus			
			case "T2": // en trafico sin estatus
				return CHtml::link("<span class=\"icon-random icon-gray\"></span>", "",
					array(
						"class" => "btn btn-small btn-block", 
						"title" => "Ro Interno ".$data->routing_int." / Bl:" . $data->routingInt->bl_id . " Bl No:" . $data->routingInt->no_bl . " Fecha Trafico : " . ($data->routingInt->bl_id_fecha == "1970-01-01 00:00:00" ? "" : date("d/m/Y H:i:s", strtotime($data->routingInt->bl_id_fecha))),
						"disabled"=>true,
					)
				);				
				break;

			case "B1": 
			case "B2": 
				return CHtml::link("<span class=\"icon-trash icon-orange\"></span>","",array("class"=>"btn btn-small btn-block", "title"=>"Borrado / View Estatus",
				"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
				"url"=>Yii::app()->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->primaryKey,"c"=>0)),
				"titulo"=>"Routing : ".$data->routing,
				"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Estatus \" + $(this).attr(\"titulo\") ,0);",
				));
				break;
		}
	}


	public function cssView($data,$row,$dataColumn) {	

		$l = isset($data->trackingsLast->id) ? $data->trackingsLast->id : 0; //last status

		if ($l > 0 && $data->borrado == true) {

			return CHtml::link("<span class=\"icon-search icon-orange\"></span>","",array("class"=>"btn btn-small btn-block", "title"=>"Vista Routing",
			"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
			"url"=>Yii::app()->controller->createUrl("view", array("id"=>$data->primaryKey)),
			"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Routing\",0);",
			));
			
		} else {

			return CHtml::link("<span class=\"icon-search icon-blue\"></span>","",array("class"=>"btn btn-small btn-warning btn-block", "title"=>"Vista Routing",
			"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
			"url"=>Yii::app()->controller->createUrl("view", array("id"=>$data->primaryKey)),
			"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Routing\",0);",
			));	

		}
	}



	public function cssLast($data,$row,$dataColumn) {	
		
		$l = isset($data->trackingsLast->id) ? $data->trackingsLast->id : 0; //last status

		if ($l > 0) {

			return CHtml::link(substr(strtolower($data->trackingsLast->name_es),0,6)."..", "", array("class"=>"btn btn-small btn-" . ("warning")  . " btn-block",  //$data->trackingsToday > 0 ? "success" : 

			"title" => empty($data->trackingsLast->name_es) ? "" : "Estatus : " . $data->trackingsLast->name_es . "\n" . "Comentario : " . $data->trackingsLast->comentario . "\n" . "Fecha : " . $data->trackingsLast->fecha_estatus . " " . $data->trackingsLast->hora_estatus . "\nUsuario : " . 

			(isset($data->trackingsLast->usuario0) ? $data->trackingsLast->usuario0->pw_gecos : $data->trackingsLast->usuario)

			. (empty($data->trackingsLast->fecha_alerta) ? "" : "\n\nFecha Alerta Hoy : " . date("d/m/Y",strtotime($data->trackingsLast->fecha_alerta))),
			"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
			"url"=>Yii::app()->controller->createUrl("/TrackingRoutings/create", array("id"=>$data->id_routing,"c"=>1)),
			"titulo"=>"Routing : ".$data->routing,
			"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"View Estatus \" + $(this).attr(\"titulo\") ,0);",
			"style"=>"height:20px;"
			));	

		} else {
			
			if ($data->fecha == date("Y-m-d"))
				return CHtml::link("<span class=\"icon-remove icon-gray\"></span>", "#", array("class"=>"btn btn-small btn-block", "title"=>"Sin Estatus", "disabled"=>true));
			else
				return CHtml::link("<span class=\"icon-remove icon-white\"></span>", "#", array("class"=>"btn btn-small btn-block btn-danger", "title"=>"Sin Estatus", "disabled"=>true));
		}

	}



}