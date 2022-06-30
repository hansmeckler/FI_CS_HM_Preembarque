<?php

class VwPaispreembarqueController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
				'actions'=>array('create','update','GenerateExcel'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionWhere($no) {
			
		if (!isset(Yii::app()->session['fecha_i']) || !isset(Yii::app()->session['fecha_f'])) {
			$sql2 = "SELECT to_date(cast(CURRENT_DATE - interval '3' month as varchar),'yyyy-mm-dd') as fecha_i, CURRENT_DATE as fecha_f";	
			$row = Yii::app()->db->createCommand($sql2)->queryAll();	
			Yii::app()->session['fecha_i'] = $row[0]['fecha_i'];
			Yii::app()->session['fecha_f'] = $row[0]['fecha_f'];
		}
			
		$condition = "(t.id_pais_origen IN (".str_replace("LTF","",Yii::app()->session['usr_pais']).") OR t.id_pais_destino IN (".str_replace("LTF","",Yii::app()->session['usr_pais']).") OR t.id_pais IN (".Yii::app()->session['usr_pais'].") )"; // AND t.id_routing_type = '1' AND t.id_transporte NOT IN (6,8,9)"; 		
		$condition .= " AND t.fecha >= '".Yii::app()->session['fecha_i']."' ";	
		$condition .= " AND t.fecha <= '".Yii::app()->session['fecha_f']."' ";
		
		
		//if (Yii::app()->session['pendientes'])		se incluyo en la vista
		//	$condition .= " AND routing_int = 0 AND t.borrado = 'f'";
		
		//echo '<script>console.log("'.$condition.'");</script>';
		
		//echo "($no) $condition";
		
		return $condition;
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new VwPaispreembarque;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['VwPaispreembarque']))
		{
			$model->attributes=$_POST['VwPaispreembarque'];
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

		if(isset($_POST['VwPaispreembarque']))
		{
			$model->attributes=$_POST['VwPaispreembarque'];
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
		$dataProvider=new CActiveDataProvider('VwPaispreembarque');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
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
		
				
		$model=new VwPaispreembarque('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VwPaispreembarque']))
			$model->attributes=$_GET['VwPaispreembarque'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return VwPaispreembarque the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=VwPaispreembarque::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	

	public function actionGenerateExcel($count)
	{
		if (Routings::model()->count(Yii::app()->session['VwPaispreembarque_records']) == $count && $count > 500) {
			echo "Simplifique su busqueda, demasiados datos para exportar.";			
			die();			
		}
			
		$dataProvider = new CActiveDataProvider('VwPaispreembarque', array(
			'criteria'=>Yii::app()->session['VwPaispreembarque_records'],			
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
		
				
		Yii::app()->request->sendFile('VwPaispreembarque_'.date('YmdHis').'.xls',
			$this->renderPartial('reportExcel', array('dataProvider'=>$dataProvider), true)
		);

	}	
	

	/**
	 * Performs the AJAX validation.
	 * @param VwPaispreembarque $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vw-paispreembarque-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
