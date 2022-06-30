<?php

class RoutingsAlertController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view'),
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
			if (!empty($_GET['asDialog']))
		        $this->layout = '//layouts/iframe';	    	

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
		$model=new RoutingsAlert;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RoutingsAlert']))
		{
			$model->attributes=$_POST['RoutingsAlert'];
			
			if($model->save()){
	            if (!empty($_GET['asDialog']))
	            {
	                //Close the dialog, reset the iframe and update the grid
	                echo CHtml::script("	                
	                window.parent.$('#cru-dialog').dialog('close');
	                window.parent.$('#cru-frame').attr('src','');
	                window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');
	                ");
	                Yii::app()->end();
	            }
	            else
					$this->redirect(array( Yii::app()->session['level'] > 2 ? 'update' : 'view' ,'id'=>$model->id_routing));
			}
		}

		if( Yii::app()->request->isAjaxRequest )
	    {
	        $this->renderPartial('create',array(
	            'model'=>$model,
	        ), false, true);
	    }
	    else
	    {
		    if (!empty($_GET['asDialog']))
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

		if(isset($_POST['RoutingsAlert']))
		{
			$model->attributes=$_POST['RoutingsAlert'];
			
			if($model->save()){
	            if (!empty($_GET['asDialog']))
	            {
	                //Close the dialog, reset the iframe and update the grid
	                echo CHtml::script("	                
	                window.parent.$('#cru-dialog').dialog('close');
	                window.parent.$('#cru-frame').attr('src','');
	                window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');
	                ");
	                Yii::app()->end();
	            }
	            else
					$this->redirect(array('update','id'=>$model->id_routing));
			}
		}

	    if( Yii::app()->request->isAjaxRequest )
	        {
	        $this->renderPartial('update',array(
	            'model'=>$model,
	        ), false, true);
	    }
	    else
	    {
		    if (!empty($_GET['asDialog']))
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if (!isset($_GET['asDialog'])) $_GET['asDialog'] = "";			
		$dataProvider=new CActiveDataProvider('RoutingsAlert');
	    if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('index',array(
				'dataProvider'=>$dataProvider,
				'asDialog'=>'',
			));	        
	    } else {
			if (!empty($_GET['asDialog']))
		        $this->layout = '//layouts/iframe';	    	
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
				'asDialog'=>$_GET['asDialog'],
			));
	    }
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RoutingsAlert('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RoutingsAlert']))
			$model->attributes=$_GET['RoutingsAlert'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RoutingsAlert the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RoutingsAlert::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La pagina solicitada no existe.');
		return $model;
	}

/*
    public function actionGenerateExcel()
	{
		$session=new CHttpSession;
		$session->open();		

		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300); 
		
		if(isset($session['RoutingsAlert_records']))
			$model = RoutingsAlert::model()->findAll($session['RoutingsAlert_records']);
		else
			$model = RoutingsAlert::model()->findAll();
		
		Yii::app()->request->sendFile('PDF_RoutingsAlert_'.date('YmdHis').'.xls',
			$this->renderPartial('reportExcel', array(
				'model'=>$model
			), true)
		);
	}	
*/

	public function actionGenerateExcel($count)
	{
		if (RoutingsAlert::model()->count(Yii::app()->session['RoutingsAlert_records']) == $count && $count > 500) {
			echo "Simplifique su busqueda, demasiados datos para exportar.";
			die();
		}


		$dataProvider = new CActiveDataProvider('RoutingsAlert', array(
			'criteria'=>Yii::app()->session['RoutingsAlert_records'],
			/*'sort'=>array(
			    'defaultOrder'=>'t.id_routing DESC',
			),*/
			'pagination'=>false,
		));

		Yii::app()->request->sendFile('RoutingsAlert_'.date('YmdHis').'.xls',
			$this->renderPartial('reportExcel', array('dataProvider'=>$dataProvider), true)
		);

	}



   
    public function actionGeneratePdf() 
	{
		$session=new CHttpSession;
		$session->open();
		
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300); 
		
		if(isset($session['RoutingsAlert_records']))
			$model = RoutingsAlert::model()->findAll($session['RoutingsAlert_records']);
		else
			$model = RoutingsAlert::model()->findAll();
			
		if (count($model) > 500) {		
			throw new CHttpException(405,'La pagina solicitada es demasiado extensa minimize los datos. ('.count($model).')');			
		} else {		
									//$orientation,$format,$langue,$unicode,$encoding,$marges
			$html2pdf = Yii::app()->ePdf->HTML2PDF('P','A4','en',true,'UTF-8',array(5,5,5,5));
	       	$html2pdf->pdf->SetTitle('PDF_RoutingsAlert');
	       	$html2pdf->pdf->SetDisplayMode('fullpage');
	        $html = $this->renderPartial('reportPdf', array('model'=>$model,'title'=>'RoutingsAlert'), true);	        
	        $html2pdf->WriteHTML($html);
	        $html2pdf->Output('PDF_RoutingsAlert_'.date('YmdHis').'.pdf');
		}
	}

	/**
	 * Performs the AJAX validation.
	 * @param RoutingsAlert $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='routings-alert-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}



	public function shortText($data,$row,$dataColumn) {

		$val = $dataColumn->name;
		$val = $data->$val;
		$tit = $val;

		if ($dataColumn->name == 'transporte') {
			$val = $data->idTransporte->letra;
			$tit = $data->idTransporte->descripcion;
			return "<span onmouseover='this.style.cursor=\"pointer\"' title='$tit'><u>".$val."</u></span>";
		} else {
				$len = 8;
				switch ($dataColumn->name) {
					case 'order_no':
						$len = 16;
						break;
					//default	:
						//$len = 8;
						//break;
						//nombre_transporte
					case 'nombre_creacion':
						$val = $data->idUsuarioCreacion->pw_gecos;						
						$tit = $data->id_usuario_creacion . " - " . $val;
						break;
					case 'nombre_cliente':						
						$val = $data->idCliente->nombre_cliente;
						$tit = $data->id_cliente . " - " . $val;
						break;
						//no_embarque
				}

				if (strlen($val) > $len)
					return "<span onmouseover='this.style.cursor=\"pointer\"' title='$tit'><u>".ucfirst(strtolower(substr($val,0,$len)))."..</u></span>";
				else
					return $val;
		}
	}


	public function cssView($data,$row,$dataColumn) {	
		
		/*$l = isset($data->trackingsLast->id) ? $data->trackingsLast->id : 0; //last status

		if ($l > 0) {*/
			
			return CHtml::link("<span class=\"icon-search icon-orange\"></span>","",array("class"=>"btn btn-small btn-block", "title"=>"Vista Routing",
			"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
			"url"=>Yii::app()->controller->createUrl("view", array("id"=>$data->routing)),
			"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Routing\",0);",
			));
			
		/*} else {

			return CHtml::link("<span class=\"icon-search icon-blue\"></span>","",array("class"=>"btn btn-small btn-warning btn-block", "title"=>"Vista Routing",
			"data-toggle"=>"modal", "data-target"=>"#myModal", "target"=>"_blank",
			"url"=>Yii::app()->controller->createUrl("view", array("id"=>$data->routing)),
			"onclick"=>"crud_frame_adjust($(this).attr(\"url\"),\"Vista Routing\",0);",
			));			

		}*/
	}

	public function cssLast($data,$row,$dataColumn) {	
		
		$l = isset($data->trackingsLast->id) ? $data->trackingsLast->id : 0; //last status

		if ($l > 0) {

			return CHtml::link(substr(strtolower($data->trackingsLast->name_es),0,6)."..", "", array("class"=>"btn btn-small btn-" . ($data->trackingsToday > 0 ? "success" : "warning")  . " btn-block",
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
