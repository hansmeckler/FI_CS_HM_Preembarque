<?php

class VwRoutingsController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				//'actions'=>array('admin','delete'),
				'actions'=>array('admin','GenerateExcel'),
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
		$model=new VwRoutings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VwRoutings']))
		{
			$model->attributes=$_POST['VwRoutings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_routing));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['VwRoutings']))
		{
			$model->attributes=$_POST['VwRoutings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_routing));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
		$dataProvider=new CActiveDataProvider('VwRoutings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);

		if (empty($_POST['fecha_i']) && empty($_POST['fecha_f'])) {
			unset(Yii::app()->session['fecha_i']);
			unset(Yii::app()->session['fecha_f']);
		} else {
			Yii::app()->session['fecha_i'] = $_POST['fecha_i'];
			Yii::app()->session['fecha_f'] = $_POST['fecha_f'];
		}

		$model=new VwRoutings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VwRoutings']))
			$model->attributes=$_GET['VwRoutings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionGenerateExcel($count)
	{
		if (VwRoutings::model()->count(Yii::app()->session['VwRoutings_records']) == $count && $count > 1000) {
			echo "<script>alert('Simplifique su busqueda, demasiados datos para exportar.');</script>";
			die();
		}

		$dataProvider = new CActiveDataProvider('VwRoutings', array(
			'criteria'=>Yii::app()->session['VwRoutings_records'],
			'sort'=>array(
					'defaultOrder'=>'fechalertorder DESC',
					//'defaultOrder'=>'case when cast("trackingsLast".fecha_alerta as date) = cast(now() as date) then 0 else 1 end, t.id_routing Desc',
			),
			'pagination'=>false,
		));

		Yii::app()->request->sendFile('VwRoutings_'.date('YmdHis').'.xls',
			$this->renderPartial('reportExcel', array('dataProvider'=>$dataProvider), true)
		);

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return VwRoutings the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=VwRoutings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param VwRoutings $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vw-routings-form')
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
			return "<span onmouseover='this.style.cursor=\"pointer\"' title='$data->nombre_transporte'><u>".$val."</u></span>";
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
						$tit = $data->id_usuario_creacion . " - " . $val;
						break;
					case 'nombre_cliente':
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


	function fontText($data,$row,$dataColumn) {

			return $data->trackingsLast->fecha_alerta == date("Y-m-d") ?
				"alerta"
				:
				(intval($data->borrado) == 1 ?
						"borrado"
					:
					(intval($data->routing_int) == 0 ?
						"activo"
						:
						(intval($data->routingInt->bl_id) == 0 ?
							"activo"
							:
							"bloq"
						)
					)
				);
	}



}
