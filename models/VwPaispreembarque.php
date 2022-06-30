<?php

/**
 * This is the model class for table "vw_preeroutings_alerta".
 *
 * The followings are the available columns in table 'vw_preeroutings_alerta':
 * @property integer $id_routing
 * @property boolean $borrado
 * @property integer $routing_int
 * @property string $routing
 * @property string $id_pais
 * @property string $id_pais_origen
 * @property string $id_pais_destino
 * @property string $fecha
 * @property string $order_no
 * @property string $id_transporte
 * @property boolean $import_export
 * @property string $id_usuario_creacion
 * @property string $cotizacion_id
 * @property string $no_embarque
 * @property string $id_cliente
 * @property string $id_routing_type
 * @property integer $days
 */
class VwPaispreembarque extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vw_preeroutings_alerta';
	}

	public function primaryKey(){
            return 'id_routing';
    }	

	public $nombre_cliente;
	public $nombre_transporte;
	public $nombre_usuario;
	public $last_estatus;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_routing, routing_int, days', 'numerical', 'integerOnly'=>true),
			array('routing', 'length', 'max'=>25),
			array('id_pais, id_pais_origen, id_pais_destino', 'length', 'max'=>5),
			array('order_no', 'length', 'max'=>100),
			array('no_embarque', 'length', 'max'=>50),
			array('borrado, fecha, id_transporte, import_export, id_usuario_creacion, cotizacion_id, id_cliente, id_routing_type, nombre_cliente, nombre_transporte, nombre_usuario, last_estatus', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_routing, borrado, routing_int, routing, id_pais, id_pais_origen, id_pais_destino, fecha, order_no, id_transporte, import_export, id_usuario_creacion, cotizacion_id, no_embarque, id_cliente, id_routing_type, days, nombre_cliente, nombre_transporte, nombre_usuario, last_estatus', 'safe', 'on'=>'search'),
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
			'idCliente' => array(self::BELONGS_TO, 'Clientes', 'id_cliente'),
			'idTransporte' => array(self::BELONGS_TO, 'Transporte', 'id_transporte'),
			'idUsuarioCreacion' => array(self::BELONGS_TO, 'UsuariosEmpresas', 'id_usuario_creacion'),
			
			'routingInt' => array(self::BELONGS_TO, 'Routings', 'routing_int', 'condition'=>"\"routingInt\".borrado = 'f'"),


			'trackings' => array(self::HAS_MANY, 'TrackingRoutings', 'id_routing'),
			'trackingsLast' => array(self::HAS_ONE, 'TrackingRoutings', 'id_routing', 'order'=>'id Desc'),	
			'trackingsToday' => array(self::HAS_MANY, 'TrackingRoutings', 'id_routing', 'condition'=>"fecha_estatus = DATE 'now'"),			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_routing' => 'Id Routing',
			'borrado' => 'Borrado',
			'routing_int' => 'Routing Int',
			'routing' => 'Routing',
			'id_pais' => 'Id Pais',
			'id_pais_origen' => 'Id Pais Origen',
			'id_pais_destino' => 'Id Pais Destino',
			'fecha' => 'Fecha',
			'order_no' => 'Order No',
			'id_transporte' => 'Id Transporte',
			'import_export' => 'Import Export',
			'id_usuario_creacion' => 'Id Usuario Creacion',
			'cotizacion_id' => 'Cotizacion',
			'no_embarque' => 'No Embarque',
			'id_cliente' => 'Id Cliente',
			'id_routing_type' => 'Id Routing Type',
			'days' => 'Days',
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

		$criteria->with=array('idCliente','idTransporte','idUsuarioCreacion','trackingsLast');

		$condition = VwPaispreembarqueController::actionWhere(2);
		$criteria->addCondition($condition);
		
		$criteria->addSearchCondition('"idCliente".nombre_cliente', $this->nombre_cliente, true, 'AND', 'ILIKE');	
		
		$criteria->addSearchCondition('"idTransporte".descripcion', $this->nombre_transporte, true, 'AND', 'ILIKE');	
		
		$criteria->addSearchCondition('"idUsuarioCreacion".pw_gecos', $this->nombre_usuario, true, 'AND', 'ILIKE');	
						
		$criteria->addSearchCondition('t.routing', $this->routing, true, 'AND', 'ILIKE');
				
		$criteria->compare('cast(fecha as text)',$this->fecha,true,'ILIKE');
		
		$criteria->compare('COALESCE("trackingsLast".id, 0 )',$this->last_estatus);
		
		$criteria->compare('t.id_routing',$this->id_routing);
		$criteria->compare('t.borrado',$this->borrado);
		$criteria->compare('routing_int',$this->routing_int);
		//$criteria->compare('routing',$this->routing,true,'ILIKE');
		$criteria->compare('id_pais',$this->id_pais,true,'ILIKE');
		$criteria->compare('id_pais_origen',$this->id_pais_origen,true,'ILIKE');
		$criteria->compare('id_pais_destino',$this->id_pais_destino,true,'ILIKE');
		//$criteria->compare('fecha',$this->fecha,true,'ILIKE');
		$criteria->compare('order_no',$this->order_no,true,'ILIKE');
		$criteria->compare('id_transporte',$this->id_transporte,true,'ILIKE');
		$criteria->compare('t.import_export',$this->import_export);
		$criteria->compare('id_usuario_creacion',$this->id_usuario_creacion,true,'ILIKE');
		$criteria->compare('cotizacion_id',$this->cotizacion_id,true,'ILIKE');
		$criteria->compare('no_embarque',$this->no_embarque,true,'ILIKE');
		$criteria->compare('id_cliente',$this->id_cliente,true,'ILIKE');
		$criteria->compare('id_routing_type',$this->id_routing_type,true,'ILIKE');
		$criteria->compare('days',$this->days);
		Yii::app()->session['VwPaispreembarque_records'] = $criteria;		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,			
			'sort'=>array(
			    'defaultOrder'=>'days DESC',
			),				
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),				
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VwPaispreembarque the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
