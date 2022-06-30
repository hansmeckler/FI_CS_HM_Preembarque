<?php

/**
 * This is the model class for table "vw_preeroutings_alerta".
 *
 * The followings are the available columns in table 'vw_preeroutings_alerta':
 * @property integer $id_catalogo
 * @property integer $id_routing
 * @property boolean $activo
 * @property boolean $borrado
 * @property integer $routing_int
 * @property string $routing
 * @property string $id_pais
 * @property string $id_pais_origen
 * @property string $id_pais_destino
 * @property string $fecha
 * @property string $order_no
 * @property string $import_export
 * @property string $cotizacion_id
 * @property string $no_embarque
 * @property string $id_routing_type
 * @property string $id_transporte
 * @property string $nombre_transporte
 * @property string $id_usuario_creacion
 * @property string $nombre_creacion
 * @property string $id_cliente
 * @property string $nombre_cliente
 * @property integer $days
 * @property string $transporte
 * @property integer $last_id
 * @property string $name_es
 * @property string $comentario
 * @property string $fecha_estatus
 * @property string $hora_estatus
 * @property string $fecha_alerta
 * @property integer $button
 * @property string $css
 * @property integer $bl_id
 * @property string $fechalertorder
 * @property string $no_bl
 * @property string $bl_id_fecha
 */
class VwRoutingsAlerta extends CActiveRecord
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

	/**
	 * @return array validation rules for model attributes.
	 */
	 public function rules()
 	{
 		// NOTE: you should only define rules for those attributes that
 		// will receive user inputs.
 		return array(
 			array('id_catalogo, id_routing, routing_int, days, last_id, button, bl_id', 'numerical', 'integerOnly'=>true),
 			array('routing', 'length', 'max'=>25),
 			array('id_pais, id_pais_origen, id_pais_destino', 'length', 'max'=>5),
 			array('order_no', 'length', 'max'=>100),
 			array('no_embarque', 'length', 'max'=>50),
			array('no_bl', 'length', 'max'=>75),
 			array('nombre_transporte', 'length', 'max'=>30),
 			array('nombre_creacion', 'length', 'max'=>48),
 			array('nombre_cliente', 'length', 'max'=>150),
 			array('transporte', 'length', 'max'=>2),
 			array('hora_estatus', 'length', 'max'=>8),
 			array('fecha_alerta', 'length', 'max'=>10),
			array('bl_id_fecha', 'length', 'max'=>19),
 			array('activo, borrado, fecha, import_export, cotizacion_id, id_routing_type, id_transporte, id_usuario_creacion, id_cliente, name_es, comentario, fecha_estatus, css, fechalertorder, no_bl', 'safe'),
 			// The following rule is used by search().
 			// @todo Please remove those attributes that should not be searched.
 			array('id_catalogo, id_routing, activo, borrado, routing_int, routing, id_pais, id_pais_origen, id_pais_destino, fecha, order_no, import_export, cotizacion_id, no_embarque, id_routing_type, id_transporte, nombre_transporte, id_usuario_creacion, nombre_creacion, id_cliente, nombre_cliente, days, transporte, last_id, name_es, comentario, fecha_estatus, hora_estatus, fecha_alerta, button, css, bl_id, fechalertorder, no_bl', 'safe', 'on'=>'search'),
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
			//'routingInt' => array(self::BELONGS_TO, 'Routings', 'routing_int', 'condition'=>"\"routingInt\".borrado = 'f'"),
			'trackings' => array(self::HAS_MANY, 'TrackingRoutings', 'id_routing'),
			//'trackingsLast' => array(self::HAS_ONE, 'TrackingRoutings', 'id_routing', 'order'=>'id Desc'),
			//'trackingsLast' => array(self::HAS_ONE, 'TrackingRoutings', '', 'foreignKey' => array('id'=>'last_id')),
			'trackingsToday' => array(self::HAS_MANY, 'TrackingRoutings', 'id_routing', 'condition'=>"fecha_estatus = DATE 'now'"),
			'usuario0' => array(self::BELONGS_TO, 'UsuariosEmpresas', 'id_usuario_creacion'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_catalogo' => 'Id Catalogo',
			'id_routing' => 'Ro ID',
			'activo' => 'Activo',
			'borrado' => 'Borrado',
			'routing_int' => 'Ro Int',
			'routing' => 'Routing',
			'id_pais' => 'Pais',
			'id_pais_origen' => 'Origen',
			'id_pais_destino' => 'Destino',
			'fecha' => 'Fecha',
			'order_no' => 'Order No',
			'import_export' => 'I/E',
			'cotizacion_id' => 'Cotizacion',
			'no_embarque' => 'Embarque',
			'id_routing_type' => 'Id Routing Type',
			'id_transporte' => 'Id Transporte',
			'nombre_transporte' => 'Servicio',
			'id_usuario_creacion' => 'Id Usuario Creacion',
			'nombre_creacion' => 'Creacion',
			'id_cliente' => 'Id Cliente',
			'nombre_cliente' => 'Cliente',
			'days' => 'Dias',
			'transporte' => 'Service',
			'last_id' => 'Last Status',
			'name_es' => 'Name Es',
			'comentario' => 'Comentario',
			'fecha_estatus' => 'Fecha Estatus',
			'hora_estatus' => 'Hora Estatus',
			'fecha_alerta' => 'Fecha Alerta',
			'button' => 'Button',
			'css' => 'Css',
			'bl_id' => 'Bl',
			'fechalertorder' => 'Fechalertorder',
			'no_bl' => 'No Bl',
			'bl_id_fecha' => 'Fecha Trafico',
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

		//$criteria->with=array('trackingsLast');

		$condition = Routings::actionWhere(1);
		$criteria->addCondition($condition);

		$criteria->compare('id_catalogo',$this->id_catalogo);
		$criteria->compare('cast(t.id_routing as text)',$this->id_routing,true,'ILIKE');
		$criteria->compare('activo',$this->activo);
		$criteria->compare('borrado',$this->borrado);
		$criteria->compare('routing_int',$this->routing_int);
		$criteria->compare('t.routing',$this->routing,true,'ILIKE');
		$criteria->compare('t.id_pais',$this->id_pais,true,'ILIKE');
		$criteria->compare('id_pais_origen',$this->id_pais_origen,true,'ILIKE');
		$criteria->compare('id_pais_destino',$this->id_pais_destino,true,'ILIKE');
		$criteria->compare('cast(fecha as text)',$this->fecha,true,'ILIKE');
		$criteria->compare('order_no',$this->order_no,true,'ILIKE');
		$criteria->compare('t.import_export',$this->import_export,true,'ILIKE');
		$criteria->compare('cast(t.cotizacion_id as text)',$this->cotizacion_id,true,'ILIKE');
		$criteria->compare('no_embarque',$this->no_embarque,true,'ILIKE');
		$criteria->compare('id_routing_type',$this->id_routing_type,true,'ILIKE');
		$criteria->compare('id_transporte',$this->id_transporte,true,'ILIKE');
		$criteria->compare('nombre_transporte',$this->nombre_transporte,true,'ILIKE');
		$criteria->compare('id_usuario_creacion',$this->id_usuario_creacion,true,'ILIKE');
		$criteria->compare('nombre_creacion',$this->nombre_creacion,true,'ILIKE');
		$criteria->compare('id_cliente',$this->id_cliente,true,'ILIKE');
		$criteria->compare('nombre_cliente',$this->nombre_cliente,true,'ILIKE');
		$criteria->compare('days',$this->days);
		$criteria->compare('transporte',$this->transporte,true,'ILIKE');
		$criteria->compare('last_id',$this->last_id);
		$criteria->compare('name_es',$this->name_es,true,'ILIKE');
		$criteria->compare('comentario',$this->comentario,true,'ILIKE');
		$criteria->compare('fecha_estatus',$this->fecha_estatus,true,'ILIKE');
		$criteria->compare('hora_estatus',$this->hora_estatus,true,'ILIKE');
		$criteria->compare('fecha_alerta',$this->fecha_alerta,true,'ILIKE');
		$criteria->compare('button',$this->button);
		$criteria->compare('css',$this->css,true,'ILIKE');
		$criteria->compare('bl_id',$this->bl_id);
		$criteria->compare('fechalertorder',$this->fechalertorder,true,'ILIKE');
		$criteria->compare('no_bl',$this->no_bl,true,'ILIKE');
		$criteria->compare('bl_id_fecha',$this->bl_id_fecha,true,'ILIKE');
		Yii::app()->session['VwRoutingsAlerta_records'] = $criteria;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
			    'defaultOrder'=>'days Desc',
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
	 * @return VwRoutingsAlerta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


}
