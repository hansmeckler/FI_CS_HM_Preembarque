<?php

/**
 * This is the model class for table "vw_preembarque_days".
 *
 * The followings are the available columns in table 'vw_preembarque_days':
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
 * @property boolean $activo
 * @property string $bl_id_fecha
 */
class RoutingsAlert extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vw_preembarque_days';
	}

	public function primaryKey(){
        return 'routing';
  	}

	public $transporte;
	public $nombre_creacion;
	public $nombre_cliente;
	public $last_id;
	public $view;

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
			array('borrado, fecha, id_transporte, import_export, id_usuario_creacion, cotizacion_id, id_cliente, id_routing_type, activo, bl_id_fecha, transporte, nombre_creacion, nombre_cliente, last_id', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_routing, borrado, routing_int, routing, id_pais, id_pais_origen, id_pais_destino, fecha, order_no, id_transporte, import_export, id_usuario_creacion, cotizacion_id, no_embarque, id_cliente, id_routing_type, days, activo, bl_id_fecha, transporte, nombre_creacion, nombre_cliente, last_id', 'safe', 'on'=>'search'),
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

			'trackings' => array(self::HAS_MANY, 'TrackingRoutings', 'id_routing'),

			'trackingsToday' => array(self::BELONGS_TO, 'TrackingRoutings', 'id_routing', 
				'condition'=>"fecha_estatus = DATE 'now'", 
			),	

			'idCliente' => array(self::BELONGS_TO, 'Clientes', 'id_cliente', 'select' => 'id_cliente, nombre_cliente', 'joinType' => 'INNER JOIN'),
			
			'idTransporte' => array(self::BELONGS_TO, 'Transporte', '', 
				'on' => '"t".id_transporte = "idTransporte".id_transporte AND "idTransporte".id_transporte NOT IN (6,8,9)', 'select' => 'letra, descripcion', 'joinType' => 'INNER JOIN'),

			'idUsuarioCreacion' => array(self::BELONGS_TO, 'UsuariosEmpresas', 'id_usuario_creacion', 'select'=>'pw_gecos', 'joinType' => 'INNER JOIN'),

			'idDivisiones' => array(self::BELONGS_TO, 'ContactosDivisiones', '', 
				'on' => "area ILIKE '%preembarque%' AND status = 'Activo' AND id_catalogo = ".Yii::app()->user->id, 
           	'select' => false, 'joinType' => 'INNER JOIN'),

			'trackingsLast' => array(self::HAS_ONE, 'TrackingRoutings', '', 'on' => '"t".id_routing = "trackingsLast".id_routing AND "trackingsLast".last_id = true', 'select' => 'id, fecha_alerta, name_es, comentario, fecha_estatus, hora_estatus, usuario', 'joinType' => 'LEFT JOIN'),	
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
			'id_pais' => 'Pais',
			'id_pais_origen' => 'Origen',
			'id_pais_destino' => 'Destino',
			'fecha' => 'Fecha',
			'order_no' => 'Order No',
			'id_transporte' => 'Transporte',
			'import_export' => 'ImpExp',
			'id_usuario_creacion' => 'Propietario',
			'cotizacion_id' => 'Cotizacion',
			'no_embarque' => 'No Embarque',
			'id_cliente' => 'Cliente',
			'id_routing_type' => 'Type',			
			'nombre_cliente' => 'Cliente',			
			'nombre_creacion' => 'Propietario',			
			'last_id' => 'Last Status',			
			'activo' => 'Activo',
			//'bl_id_fecha' => 'Bl Id Fecha',
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


	public function getSearchCriteria()
	{

		$criteria=new CDbCriteria;

		$criteria->with=array(
			'idCliente' , 
			'idTransporte', 
			'idUsuarioCreacion', 
			'idDivisiones', 			
			'trackingsLast', 
		);

		$condition = str_replace("fecha",'"t".fecha',Routings::actionWhere(2));
		$criteria->addCondition($condition);
		$criteria->addCondition("((\"trackingsLast\".id > 0 AND \"t\".borrado = true) OR \"t\".borrado = false) AND 
(\"t\".id_routing_type = 1) AND (\"t\".id_transporte NOT IN (6,8,9)) AND (\"t\".routing_int = 0) AND (\"t\".borrado = false) AND 
(((
    CASE
        WHEN (\"idDivisiones\".pais ILIKE '%LTF\"%') THEN 'LTF'
        ELSE '***'
    END = \"substring\"((\"t\".id_pais), 3, 3)) AND 
    ((\"idDivisiones\".pais ILIKE (('%\"' || (\"t\".id_pais)) || '\"%')) OR 
    (\"idDivisiones\".pais ILIKE (('%\"' || (\"t\".id_pais_origen)) || 'LTF\"%')) OR 
    (\"idDivisiones\".pais ILIKE (('%\"' || (\"t\".id_pais_destino)) || 'LTF\"%')))) OR 
    ((
    CASE
        WHEN (\"idDivisiones\".pais ILIKE '%\"GT\"%') THEN 2
        WHEN (\"idDivisiones\".pais ILIKE '%\"SV\"%') THEN 2
        WHEN (\"idDivisiones\".pais ILIKE '%\"HN\"%') THEN 2
        WHEN (\"idDivisiones\".pais ILIKE '%\"NI\"%') THEN 2
        WHEN (\"idDivisiones\".pais ILIKE '%\"CR\"%') THEN 2
        WHEN (\"idDivisiones\".pais ILIKE '%\"PA\"%') THEN 2
        WHEN (\"idDivisiones\".pais ILIKE '%\"BZ\"%') THEN 2
        WHEN (\"idDivisiones\".pais ILIKE '%\"N1\"%') THEN 2
        ELSE 0
    END = length((\"t\".id_pais))) AND 
    (\"idDivisiones\".pais ILIKE (('%\"' || (\"t\".id_pais)) || '\"%')))) 
    AND (
    CASE
        WHEN ((\"idDivisiones\".tipo_persona) = 'SuperPreembarque') THEN \"t\".id_usuario_creacion
        WHEN ((\"idDivisiones\".tipo_persona) IN ('Contacto','Soporte')) THEN \"idDivisiones\".id_catalogo
        ELSE \"t\".id_usuario_creacion
    END = \"t\".id_usuario_creacion)");

		$criteria->compare('days',$this->days);
		$criteria->compare('t.id_routing',$this->id_routing);
		$criteria->compare('routing_int',$this->routing_int);
		$criteria->compare('t.routing', $this->routing, true, 'ILIKE');
		$criteria->compare('t.id_pais',$this->id_pais);
		$criteria->compare('t.id_pais_origen',$this->id_pais_origen);
		$criteria->compare('t.id_pais_destino',$this->id_pais_destino);
		$criteria->compare('cast(t.fecha as text)',$this->fecha);
		$criteria->compare('order_no',$this->order_no,true,'ILIKE');
		$criteria->compare('"idTransporte".letra',$this->transporte,true,'ILIKE');
		$criteria->compare('t.import_export',$this->import_export);//,true,'ILIKE');
		$criteria->compare('"idUsuarioCreacion".pw_gecos',$this->nombre_creacion,true,'ILIKE');
		$criteria->compare('cast(t.cotizacion_id as text)',$this->cotizacion_id,true,'ILIKE');
		$criteria->compare('"idCliente".nombre_cliente',$this->nombre_cliente,true,'ILIKE');
		$criteria->compare('no_embarque',$this->no_embarque,true,'ILIKE');
		$criteria->compare('COALESCE("trackingsLast".id,0)',$this->last_id);		

		Yii::app()->session['RoutingsAlert_records'] = $criteria;				

		return $criteria;
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.	
		return new CActiveDataProvider($this, array(
			'criteria'=>$this->getSearchCriteria(),	
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
	 * @return RoutingsAlert the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
