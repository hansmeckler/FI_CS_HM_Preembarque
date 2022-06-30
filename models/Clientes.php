<?php

/**
 * This is the model class for table "clientes".
 *
 * The followings are the available columns in table 'clientes':
 * @property string $id_cliente
 * @property string $codigo_tributario
 * @property string $nombre_cliente
 * @property string $nombre_facturar
 * @property string $id_vendedor
 * @property integer $id_tipo_cliente
 * @property integer $id_grupo
 * @property integer $id_cobrador
 * @property integer $id_estatus
 * @property boolean $es_consigneer
 * @property boolean $es_shipper
 * @property integer $id_frecuencia
 * @property integer $id_credito
 * @property string $fecha_creacion
 * @property double $hora_creacion
 * @property string $id_clase
 * @property string $id_anterior
 * @property string $id_usuario_creacion
 * @property string $fecha_uvisita
 * @property string $usr
 * @property string $pwd
 * @property string $id_sales_support
 * @property string $ultima_fecha_descarga
 * @property integer $encuesta_id
 * @property integer $encuesta
 * @property string $id_pais
 * @property integer $id_regimen
 * @property string $codigo_tributario2
 * @property string $observacion
 * @property string $id_usuario_modificacion
 * @property string $fecha_modificacion
 * @property string $ultimo_tipo_movimiento
 * @property boolean $ultimo_movimiento_asegurado
 * @property integer $requiere_rubro_alias
 * @property string $id_vendedor_grh
 * @property string $id_sales_support_grh
 * @property string $ref_interna_pricing
 * @property boolean $con_cotizacion
 * @property integer $marca
 * @property string $email
 * @property boolean $es_coloader
 * @property boolean $incluir_saldo
 * @property integer $cto_id
 * @property string $cto_fecha
 * @property integer $id_documento
 * @property integer $id_estatus_bk
 * @property string $id_cliente_ref
 *
 * The followings are the available model relations:
 * @property VentasRegional[] $ventasRegionals
 * @property VentasRegional[] $ventasRegionals1
 * @property ClientesAduana[] $clientesAduanas
 * @property PerfilCliente[] $perfilClientes
 * @property CliTelefonos[] $cliTelefonoses
 * @property CreditoClienteBaw[] $creditoClienteBaws
 * @property CreditosClientes[] $creditosClientes
 * @property OtrosServiciosCliente[] $otrosServiciosClientes
 * @property TarifasComisiones[] $tarifasComisiones
 * @property ServicioXOrigenCliente[] $servicioXOrigenClientes
 * @property DestinosCliente[] $destinosClientes
 * @property Clientes $idCliente
 * @property Clientes $clientes
 * @property ClientesOperacionesTipo $cto
 * @property Grupos $idGrupo
 * @property Cobradores $idCobrador
 * @property Transporte $ultimoTipoMovimiento
 * @property ClasesCliente $idClase
 * @property Creditos $idCredito
 * @property Paises $idPais
 * @property RegimenTributario $idRegimen
 * @property TiposCliente $idTipoCliente
 * @property Direcciones[] $direcciones
 * @property ShippersSolicitudTemp[] $shippersSolicitudTemps
 * @property Routings[] $routings
 * @property Routings[] $routings1
 * @property Routings[] $routings2
 * @property Routings[] $routings3
 * @property ClientesCuentas[] $clientesCuentases
 * @property ShippersSolicitud[] $shippersSolicituds
 */
class Clientes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'clientes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
			//array(Yii::app()->session['permisos'][Yii::app()->controller->id]['fields'], 'disabled'),
		
			array('id_tipo_cliente, id_grupo, id_cobrador, id_estatus, id_frecuencia, id_credito, encuesta_id, encuesta, id_regimen, requiere_rubro_alias, marca, cto_id, id_documento, id_estatus_bk', 'numerical', 'integerOnly'=>true),
			array('hora_creacion', 'numerical'),
			array('codigo_tributario', 'length', 'max'=>30),
			array('nombre_cliente, nombre_facturar', 'length', 'max'=>150),
			array('id_clase, id_pais', 'length', 'max'=>2),
			array('usr', 'length', 'max'=>40),
			array('pwd', 'length', 'max'=>35),
			array('codigo_tributario2', 'length', 'max'=>20),
			array('ref_interna_pricing', 'length', 'max'=>50),
			array('email', 'length', 'max'=>175),
			array('id_vendedor, es_consigneer, es_shipper, fecha_creacion, id_anterior, id_usuario_creacion, fecha_uvisita, id_sales_support, ultima_fecha_descarga, observacion, id_usuario_modificacion, fecha_modificacion, ultimo_tipo_movimiento, ultimo_movimiento_asegurado, id_vendedor_grh, id_sales_support_grh, con_cotizacion, es_coloader, incluir_saldo, cto_fecha, id_cliente_ref', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cliente, codigo_tributario, nombre_cliente, nombre_facturar, id_vendedor, id_tipo_cliente, id_grupo, id_cobrador, id_estatus, es_consigneer, es_shipper, id_frecuencia, id_credito, fecha_creacion, hora_creacion, id_clase, id_anterior, id_usuario_creacion, fecha_uvisita, usr, pwd, id_sales_support, ultima_fecha_descarga, encuesta_id, encuesta, id_pais, id_regimen, codigo_tributario2, observacion, id_usuario_modificacion, fecha_modificacion, ultimo_tipo_movimiento, ultimo_movimiento_asegurado, requiere_rubro_alias, id_vendedor_grh, id_sales_support_grh, ref_interna_pricing, con_cotizacion, marca, email, es_coloader, incluir_saldo, cto_id, cto_fecha, id_documento, id_estatus_bk, id_cliente_ref', 'safe', 'on'=>'search'),
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
			'ventasRegionals' => array(self::HAS_MANY, 'VentasRegional', 'id_cliente'),
			'ventasRegionals1' => array(self::HAS_MANY, 'VentasRegional', 'id_shipper'),
			'clientesAduanas' => array(self::HAS_MANY, 'ClientesAduana', 'id_cliente'),
			'perfilClientes' => array(self::HAS_MANY, 'PerfilCliente', 'id_cliente'),
			'cliTelefonoses' => array(self::HAS_MANY, 'CliTelefonos', 'id_cliente'),
			'creditoClienteBaws' => array(self::HAS_MANY, 'CreditoClienteBaw', 'ccb_id_cliente'),
			'creditosClientes' => array(self::HAS_MANY, 'CreditosClientes', 'id_cliente'),
			'otrosServiciosClientes' => array(self::HAS_MANY, 'OtrosServiciosCliente', 'id_cliente'),
			'tarifasComisiones' => array(self::HAS_MANY, 'TarifasComisiones', 'id_cliente'),
			'servicioXOrigenClientes' => array(self::HAS_MANY, 'ServicioXOrigenCliente', 'id_cliente'),
			'destinosClientes' => array(self::HAS_MANY, 'DestinosCliente', 'id_cliente'),
			'idCliente' => array(self::BELONGS_TO, 'Clientes', 'id_cliente'),
			'clientes' => array(self::HAS_ONE, 'Clientes', 'id_cliente'),
			'cto' => array(self::BELONGS_TO, 'ClientesOperacionesTipo', 'cto_id'),
			'idGrupo' => array(self::BELONGS_TO, 'Grupos', 'id_grupo'),
			'idCobrador' => array(self::BELONGS_TO, 'Cobradores', 'id_cobrador'),
			'ultimoTipoMovimiento' => array(self::BELONGS_TO, 'Transporte', 'ultimo_tipo_movimiento'),
			'idClase' => array(self::BELONGS_TO, 'ClasesCliente', 'id_clase'),
			'idCredito' => array(self::BELONGS_TO, 'Creditos', 'id_credito'),
			'idPais' => array(self::BELONGS_TO, 'Paises', 'id_pais'),
			'idRegimen' => array(self::BELONGS_TO, 'RegimenTributario', 'id_regimen'),
			'idTipoCliente' => array(self::BELONGS_TO, 'TiposCliente', 'id_tipo_cliente'),
			'direcciones' => array(self::HAS_MANY, 'Direcciones', 'id_cliente'),
			'shippersSolicitudTemps' => array(self::HAS_MANY, 'ShippersSolicitudTemp', 'id_shipper'),
			'routings' => array(self::HAS_MANY, 'Routings', 'id_cliente'),
			'routings1' => array(self::HAS_MANY, 'Routings', 'id_facturar'),
			'routings2' => array(self::HAS_MANY, 'Routings', 'id_shipper'),
			'routings3' => array(self::HAS_MANY, 'Routings', 'id_notify'),
			'clientesCuentases' => array(self::HAS_MANY, 'ClientesCuentas', 'id_cliente'),
			'shippersSolicituds' => array(self::HAS_MANY, 'ShippersSolicitud', 'id_shipper'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cliente' => 'Id Cliente',
			'codigo_tributario' => 'Codigo Tributario',
			'nombre_cliente' => 'Nombre Cliente',
			'nombre_facturar' => 'Nombre Facturar',
			'id_vendedor' => 'Id Vendedor',
			'id_tipo_cliente' => 'Id Tipo Cliente',
			'id_grupo' => 'Id Grupo',
			'id_cobrador' => 'Id Cobrador',
			'id_estatus' => 'Id Estatus',
			'es_consigneer' => 'Es Consigneer',
			'es_shipper' => 'Es Shipper',
			'id_frecuencia' => 'Id Frecuencia',
			'id_credito' => 'Id Credito',
			'fecha_creacion' => 'Fecha Creacion',
			'hora_creacion' => 'Hora Creacion',
			'id_clase' => 'Id Clase',
			'id_anterior' => 'Id Anterior',
			'id_usuario_creacion' => 'Id Usuario Creacion',
			'fecha_uvisita' => 'Fecha Uvisita',
			'usr' => 'Usr',
			'pwd' => 'Pwd',
			'id_sales_support' => 'Id Sales Support',
			'ultima_fecha_descarga' => 'Ultima Fecha Descarga',
			'encuesta_id' => 'Encuesta',
			'encuesta' => 'Encuesta',
			'id_pais' => 'Id Pais',
			'id_regimen' => 'Id Regimen',
			'codigo_tributario2' => 'Codigo Tributario2',
			'observacion' => 'Observacion',
			'id_usuario_modificacion' => 'Id Usuario Modificacion',
			'fecha_modificacion' => 'Fecha Modificacion',
			'ultimo_tipo_movimiento' => 'Ultimo Tipo Movimiento',
			'ultimo_movimiento_asegurado' => 'Ultimo Movimiento Asegurado',
			'requiere_rubro_alias' => 'Requiere Rubro Alias',
			'id_vendedor_grh' => 'Id Vendedor Grh',
			'id_sales_support_grh' => 'Id Sales Support Grh',
			'ref_interna_pricing' => 'Ref Interna Pricing',
			'con_cotizacion' => 'Con Cotizacion',
			'marca' => 'Marca',
			'email' => 'Email',
			'es_coloader' => 'Es Coloader',
			'incluir_saldo' => 'Incluir Saldo',
			'cto_id' => 'Cto',
			'cto_fecha' => 'Cto Fecha',
			'id_documento' => 'Id Documento',
			'id_estatus_bk' => 'Id Estatus Bk',
			'id_cliente_ref' => 'Id Cliente Ref',
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

		$criteria->compare('id_cliente',$this->id_cliente);
		$criteria->compare('codigo_tributario',$this->codigo_tributario,true,'ILIKE');
		$criteria->compare('nombre_cliente',$this->nombre_cliente,true,'ILIKE');
		$criteria->compare('nombre_facturar',$this->nombre_facturar,true,'ILIKE');
		$criteria->compare('id_vendedor',$this->id_vendedor);
		$criteria->compare('id_tipo_cliente',$this->id_tipo_cliente);
		$criteria->compare('id_grupo',$this->id_grupo);
		$criteria->compare('id_cobrador',$this->id_cobrador);
		$criteria->compare('id_estatus',$this->id_estatus);
		$criteria->compare('es_consigneer',$this->es_consigneer);
		$criteria->compare('es_shipper',$this->es_shipper);
		$criteria->compare('id_frecuencia',$this->id_frecuencia);
		$criteria->compare('id_credito',$this->id_credito);
		$criteria->compare('fecha_creacion',$this->fecha_creacion);
		$criteria->compare('hora_creacion',$this->hora_creacion);
		$criteria->compare('id_clase',$this->id_clase,true,'ILIKE');
		$criteria->compare('id_anterior',$this->id_anterior);
		$criteria->compare('id_usuario_creacion',$this->id_usuario_creacion);
		$criteria->compare('fecha_uvisita',$this->fecha_uvisita);
		$criteria->compare('usr',$this->usr,true,'ILIKE');
		$criteria->compare('pwd',$this->pwd,true,'ILIKE');
		$criteria->compare('id_sales_support',$this->id_sales_support);
		$criteria->compare('ultima_fecha_descarga',$this->ultima_fecha_descarga);
		$criteria->compare('encuesta_id',$this->encuesta_id);
		$criteria->compare('encuesta',$this->encuesta);
		$criteria->compare('id_pais',$this->id_pais,true,'ILIKE');
		$criteria->compare('id_regimen',$this->id_regimen);
		$criteria->compare('codigo_tributario2',$this->codigo_tributario2,true,'ILIKE');
		$criteria->compare('observacion',$this->observacion,true,'ILIKE');
		$criteria->compare('id_usuario_modificacion',$this->id_usuario_modificacion);
		$criteria->compare('fecha_modificacion',$this->fecha_modificacion);
		$criteria->compare('ultimo_tipo_movimiento',$this->ultimo_tipo_movimiento);
		$criteria->compare('ultimo_movimiento_asegurado',$this->ultimo_movimiento_asegurado);
		$criteria->compare('requiere_rubro_alias',$this->requiere_rubro_alias);
		$criteria->compare('id_vendedor_grh',$this->id_vendedor_grh);
		$criteria->compare('id_sales_support_grh',$this->id_sales_support_grh);
		$criteria->compare('ref_interna_pricing',$this->ref_interna_pricing,true,'ILIKE');
		$criteria->compare('con_cotizacion',$this->con_cotizacion);
		$criteria->compare('marca',$this->marca);
		$criteria->compare('email',$this->email,true,'ILIKE');
		$criteria->compare('es_coloader',$this->es_coloader);
		$criteria->compare('incluir_saldo',$this->incluir_saldo);
		$criteria->compare('cto_id',$this->cto_id);
		$criteria->compare('cto_fecha',$this->cto_fecha);
		$criteria->compare('id_documento',$this->id_documento);
		$criteria->compare('id_estatus_bk',$this->id_estatus_bk);
		$criteria->compare('id_cliente_ref',$this->id_cliente_ref);
		Yii::app()->session['Agentes_records'] = $criteria;		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,			
			'sort'=>array(
			    'defaultOrder'=>'id_cliente ASC',
			),				
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Clientes the static model class
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
