<?php

/**
 * This is the model class for table "tracking_routings".
 *
 * The followings are the available columns in table 'tracking_routings':
 * @property integer $id
 * @property integer $routing_cli
 * @property string $id_cliente
 * @property string $id_routing
 * @property string $cotizacion_id
 * @property integer $id_estatus
 * @property string $name_es
 * @property string $name_en
 * @property string $comentario
 * @property string $fecha_server
 * @property string $fecha_estatus
 * @property string $hora_estatus
 * @property string $id_pais
 * @property string $notificacion
 * @property string $modificado
 * @property integer $usuario
 * @property integer $activo
 * @property integer $borrado
 * @property integer $import_export
 * @property string $routing
 * @property integer $id_transporte
 * @property string $fecha_alerta
 *
 * The followings are the available model relations:
 * @property UsuariosEmpresas $usuario0
 * @property Clientes $idCliente
 * @property Aimartrackings $idEstatus
 * @property Paises $idPais
 * @property Routings $idRouting
 * @property Routings $routingCli
 */
class TrackingRoutings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tracking_routings';
	}

	public function primaryKey(){
		return 'id';
	}
	
	public $id_pais_origen;
	public $id_pais_destino;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_routing, routing_cli, id_estatus, comentario', 'required'),			
			array('routing_cli, id_estatus, usuario, activo, borrado, import_export, id_transporte', 'numerical', 'integerOnly'=>true),
			array('hora_estatus', 'length', 'max'=>8),
			array('id_pais', 'length', 'max'=>5),
			array('routing', 'length', 'max'=>25),
			array('id_cliente, id_routing, cotizacion_id, name_es, name_en, fecha_server, notificacion, modificado, nombre_cliente, routing, fecha_alerta', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, routing_cli, id_cliente, id_routing, cotizacion_id, id_estatus, name_es, name_en, comentario, fecha_server, fecha_estatus, hora_estatus, id_pais, notificacion, modificado, usuario, activo, borrado, import_export, nombre_cliente, routing, id_transporte, fecha_alerta', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idEstatus' => array(self::BELONGS_TO, 'Aimartrackings', 'id_estatus'),
			'idRouting' => array(self::BELONGS_TO, 'Routings', 'id_routing'),
			'routingCli' => array(self::BELONGS_TO, 'Routings', 'routing_cli'),
			'usuario0' => array(self::BELONGS_TO, 'UsuariosEmpresas', 'usuario'),
			'idPais' => array(self::BELONGS_TO, 'Paises', 'id_pais'),
			'idCliente' => array(self::BELONGS_TO, 'Clientes', 'id_cliente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'routing_cli' => 'Routing Cli',
			'id_cliente' => 'Id Cliente',
			'id_routing' => 'Id Routing',
			'cotizacion_id' => 'Cotizacion',
			'id_estatus' => 'Estatus',
			'name_es' => 'Estatus Nombre',
			'name_en' => 'Status Name',
			'comentario' => 'Comentario',
			'fecha_server' => 'Fecha Server',
			'fecha_estatus' => 'Fecha',
			'hora_estatus' => 'Hora',
			'id_pais' => '&nbsp;Pais',
			'notificacion' => 'Notificacion',
			'modificado' => 'Modificado',
			'usuario' => 'Usuario',
			'activo' => 'Activo',
			'borrado' => 'Borrado',
			'import_export' => 'Import Export',
			'routing' => 'Routing',
			'id_transporte' => 'Id Transporte',
			'fecha_alerta' => 'Fecha Alerta',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->with=array('idCliente','routingCli');
		
		$criteria->addSearchCondition('"idCliente".nombre_cliente', $this->nombre_cliente, true, 'AND', 'ILIKE');	
		
		//$criteria->addSearchCondition('"routingCli".routing', $this->routing_no, true, 'AND', 'ILIKE');	

		$criteria->compare('id',$this->id);
		$criteria->compare('routing_cli',$this->routing_cli);
		$criteria->compare('t.id_cliente',$this->id_cliente);
		$criteria->compare('t.id_routing',$this->id_routing);
		$criteria->compare('cotizacion_id',$this->cotizacion_id);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('name_es',$this->name_es,true,'ILIKE');
		$criteria->compare('name_en',$this->name_en,true,'ILIKE');
		$criteria->compare('comentario',$this->comentario);
		$criteria->compare('fecha_server',$this->fecha_server);
		$criteria->compare('fecha_estatus',$this->fecha_estatus);
		$criteria->compare('hora_estatus',$this->hora_estatus,true,'ILIKE');
		$criteria->compare('t.id_pais',$this->id_pais,true,'ILIKE');
		$criteria->compare('notificacion',$this->notificacion);
		$criteria->compare('modificado',$this->modificado);
		$criteria->compare('usuario',$this->usuario);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('borrado',$this->borrado);
		$criteria->compare('import_export',$this->import_export);
		$criteria->compare('routing',$this->routing,true,'ILIKE');
		$criteria->compare('id_transporte',$this->id_transporte);		
		Yii::app()->session['TrackingRoutings_records'] = $criteria;		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,			
			'sort'=>array(
			    'defaultOrder'=>'id ASC',
			),				
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TrackingRoutings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/*
    public function behaviors()
    {
        return array('ESaveRelatedBehavior' => array(
                'class' => 'application.components.ESaveRelatedBehavior')
        );
    }
    */	
	
}
