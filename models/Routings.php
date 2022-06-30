<?php

/**
 * This is the model class for table "routings".
 *
 * The followings are the available columns in table 'routings':
 * @property integer $id_routing
 * @property string $cotizacion_id
 * @property string $vendedor_id
 * @property string $order_no
 * @property string $reference
 * @property string $fecha
 * @property string $id_routing_type
 * @property string $id_cliente
 * @property string $id_shipper
 * @property string $id_notify
 * @property double $no_piezas_old
 * @property double $peso_old
 * @property double $volumen_old
 * @property string $ciudad_origen
 * @property string $ciudad_destino
 * @property string $no_embarque
 * @property string $id_incoterms
 * @property boolean $bodega_prov_emb
 * @property string $id_transporte
 * @property boolean $tramite_aduanal
 * @property boolean $seguro
 * @property double $porcentaje_seguro
 * @property string $lugar_entrega
 * @property string $solicitado_por
 * @property string $observaciones
 * @property string $mbl_id_shipper
 * @property string $mbl_id_cliente
 * @property string $mbl_id_notify
 * @property double $mbl_net_rate
 * @property double $mbl_selling_rate
 * @property string $mbl_rate_comment
 * @property boolean $activo
 * @property string $last_user_edit
 * @property string $last_date_edit
 * @property string $delete_user
 * @property string $delete_date
 * @property string $agente_id
 * @property string $routing_no
 * @property string $routing
 * @property string $id_pais
 * @property boolean $import_export
 * @property integer $factura_id
 * @property string $comodity_id
 * @property string $id_container_type
 * @property string $id_naviera
 * @property string $id_unidad_peso
 * @property string $id_unidad_volumen
 * @property string $id_unidad_peso_vol
 * @property double $peso_volumentrico
 * @property string $id_truck_type
 * @property string $id_tipo_paquete
 * @property string $id_pais_origen
 * @property string $id_pais_destino
 * @property string $id_puerto_embarque
 * @property string $id_puerto_desembarque
 * @property string $carrier_id
 * @property string $id_facturar
 * @property string $airportid_embarque
 * @property boolean $prepaid
 * @property string $airportid_desembarque
 * @property boolean $borrado
 * @property string $id_sales_support
 * @property string $id_usuario_creacion
 * @property string $hora_ingreso
 * @property string $notificar_a
 * @property string $pais_origen_carga
 * @property string $codigo_exportador
 * @property integer $tarifa_aplicada
 * @property integer $routing_secc
 * @property integer $routing_cli
 * @property integer $routing_int
 * @property integer $routing_eci
 * @property integer $routing_ag
 * @property integer $voyage_id
 * @property integer $source
 * @property integer $wms_bl_id
 * @property string $ancho
 * @property string $alto
 * @property string $largo
 * @property string $tmp_piezas
 * @property string $tmp_peso
 * @property string $tmp_volumen
 * @property string $piezas_entregadas_wms
 * @property integer $tipo_documento
 * @property integer $id_solicitud
 * @property string $id_shipper_cliente
 * @property string $id_tarifario_costo
 * @property string $id_coloader
 * @property string $no_piezas
 * @property string $peso
 * @property string $volumen
 * @property integer $id_colectar
 * @property integer $idbitalpemusa
 * @property string $numbitalpemusa
 * @property string $valor_flete_manifestar
 * @property string $poliza_seguro
 * @property integer $container_qty
 * @property integer $routing_seg
 * @property string $referencia
 * @property integer $routing_fac
 * @property integer $bl_id
 * @property string $no_bl
 * @property string $id_cliente_order
 * @property integer $routing_adu
 * @property integer $routing_ter
 * @property integer $routing_copy
 *
 * The followings are the available model relations:
 * @property RoutingTerrestre[] $routingTerrestres
 * @property RoutingComodities[] $routingComodities
 * @property RoutingsGrh $routingsGrh
 * @property RoutingTarifa $tarifaAplicada
 * @property UsuariosEmpresas $vendedor
 * @property Clientes $idCliente
 * @property Commodities $comodity
 * @property UnidadMedida $idUnidadPeso
 * @property UnidadMedida $idUnidadPesoVol
 * @property UnidadMedida $idUnidadVolumen
 * @property Navieras $idNaviera
 * @property TrucksType $idTruckType
 * @property TipoPaquete $idTipoPaquete
 * @property Paises $idPaisOrigen
 * @property Paises $idPaisDestino
 * @property Carriers $carrier
 * @property RoutingType $idRoutingType
 * @property Clientes $idFacturar
 * @property Incoterms $idIncoterms
 * @property Transporte $idTransporte
 * @property Paises $idPais
 * @property Clientes $idShipper
 * @property Clientes $idNotify
 * @property Agentes $agente
 * @property ContainerType $idContainerType
 * @property RoutingMaritimo $routingMaritimo
 * @property CargosRouting[] $cargosRoutings
 * @property RoutingsDua[] $routingsDuas
 */
class Routings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'routings';
	}

	public function primaryKey(){
		return 'id_routing';
	}
/*		
	public $nombre_usuario;
	public $last_estatus;
	public $view;
	public $input_block;
	public $days;
*/

	public $button;
	public $view;
	public $css;
	public $transporte;
	public $nombre_creacion;
	public $nombre_cliente;
	public $last_id;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			//array(Yii::app()->session['permisos'][Yii::app()->controller->id]['fields'], 'disabled'),

			array('id_routing_type, id_transporte', 'required'),
			array('routing_secc, routing_cli, routing_int, routing_eci, routing_ag, voyage_id, source, wms_bl_id, tipo_documento, id_solicitud, id_colectar, idbitalpemusa, container_qty, routing_seg, routing_fac, bl_id, routing_adu, routing_ter, routing_copy', 'numerical', 'integerOnly'=>true),
			array('no_piezas_old, peso_old, volumen_old, porcentaje_seguro, mbl_net_rate, mbl_selling_rate, peso_volumentrico, import_export', 'numerical'),
			array('order_no, reference, codigo_exportador', 'length', 'max'=>100),
			array('ciudad_origen, ciudad_destino', 'length', 'max'=>60),
			array('no_embarque', 'length', 'max'=>50),
			array('lugar_entrega, solicitado_por, mbl_rate_comment', 'length', 'max'=>500),
			array('routing, referencia', 'length', 'max'=>25),
			array('id_pais', 'length', 'max'=>5),
			array('id_pais_origen, id_pais_destino, pais_origen_carga', 'length', 'max'=>2),
			array('ancho, alto, largo', 'length', 'max'=>10),
			array('tmp_piezas, tmp_peso, tmp_volumen, piezas_entregadas_wms', 'length', 'max'=>12),
			array('no_piezas, peso, volumen', 'length', 'max'=>16),
			array('numbitalpemusa', 'length', 'max'=>20),
			array('valor_flete_manifestar', 'length', 'max'=>14),
			array('poliza_seguro', 'length', 'max'=>40),
			array('no_bl', 'length', 'max'=>75),
			/*
			array('cotizacion_id, vendedor_id, fecha, id_cliente, id_shipper, id_notify, id_incoterms, bodega_prov_emb, tramite_aduanal, seguro, observaciones, mbl_id_shipper, mbl_id_cliente, mbl_id_notify, activo, last_user_edit, last_date_edit, delete_user, delete_date, agente_id, routing_no, import_export, comodity_id, id_container_type, id_naviera, id_unidad_peso, id_unidad_volumen, id_unidad_peso_vol, id_truck_type, id_tipo_paquete, id_puerto_embarque, id_puerto_desembarque, carrier_id, id_facturar, airportid_embarque, prepaid, airportid_desembarque, borrado, id_sales_support, id_usuario_creacion, hora_ingreso, notificar_a, id_shipper_cliente, id_tarifario_costo, id_coloader, id_cliente_order, nombre_cliente, nombre_transporte, nombre_usuario, last_estatus', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			/*
			array('id_routing, cotizacion_id, vendedor_id, order_no, reference, fecha, id_routing_type, id_cliente, id_shipper, id_notify, no_piezas_old, peso_old, volumen_old, ciudad_origen, ciudad_destino, no_embarque, id_incoterms, bodega_prov_emb, id_transporte, tramite_aduanal, seguro, porcentaje_seguro, lugar_entrega, solicitado_por, observaciones, mbl_id_shipper, mbl_id_cliente, mbl_id_notify, mbl_net_rate, mbl_selling_rate, mbl_rate_comment, activo, last_user_edit, last_date_edit, delete_user, delete_date, agente_id, routing_no, routing, id_pais, import_export, factura_id, comodity_id, id_container_type, id_naviera, id_unidad_peso, id_unidad_volumen, id_unidad_peso_vol, peso_volumentrico, id_truck_type, id_tipo_paquete, id_pais_origen, id_pais_destino, id_puerto_embarque, id_puerto_desembarque, carrier_id, id_facturar, airportid_embarque, prepaid, airportid_desembarque, borrado, id_sales_support, id_usuario_creacion, hora_ingreso, notificar_a, pais_origen_carga, codigo_exportador, tarifa_aplicada, routing_secc, routing_cli, routing_int, routing_eci, routing_ag, voyage_id, source, wms_bl_id, ancho, alto, largo, tmp_piezas, tmp_peso, tmp_volumen, piezas_entregadas_wms, tipo_documento, id_solicitud, id_shipper_cliente, id_tarifario_costo, id_coloader, no_piezas, peso, volumen, id_colectar, idbitalpemusa, numbitalpemusa, valor_flete_manifestar, poliza_seguro, container_qty, routing_seg, referencia, routing_fac, bl_id, no_bl, id_cliente_order, routing_adu, routing_ter, routing_copy
	, transporte, nombre_creacion, nombre_cliente, last_id
				', 'safe', 'on'=>'search'),
*/

			array('id_routing, cotizacion_id, order_no, fecha, id_routing_type, id_cliente, id_shipper, no_embarque, id_transporte, activo, routing, id_pais, import_export, id_pais_origen, id_pais_destino, borrado, id_usuario_creacion, routing_int, no_bl, transporte, nombre_creacion, nombre_cliente, last_id, button', 'safe'),

			array('id_routing, cotizacion_id, order_no, fecha, id_routing_type, id_cliente, id_shipper, no_embarque, id_transporte, activo, routing, id_pais, import_export, id_pais_origen, id_pais_destino, borrado, id_usuario_creacion, routing_int, no_bl, transporte, nombre_creacion, nombre_cliente, last_id, button', 'safe', 'on'=>'search'),

		);
	}

//nombre_cliente, nombre_transporte, nombre_usuario, last_estatus, input_block

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.

		//$condition = str_replace("fecha",'"t".fecha',Routings::actionWhere(2));

		return array(
			/*
			'routingTerrestres' => array(self::HAS_MANY, 'RoutingTerrestre', 'id_routing'),
			'routingComodities' => array(self::HAS_MANY, 'RoutingComodities', 'id_routing'),
			'routingsGrh' => array(self::HAS_ONE, 'RoutingsGrh', 'id_routing'),
			'tarifaAplicada' => array(self::BELONGS_TO, 'RoutingTarifa', 'tarifa_aplicada'),
			'vendedor' => array(self::BELONGS_TO, 'UsuariosEmpresas', 'vendedor_id'),

			'comodity' => array(self::BELONGS_TO, 'Commodities', 'comodity_id'),
			'idUnidadPeso' => array(self::BELONGS_TO, 'UnidadMedida', 'id_unidad_peso'),
			'idUnidadPesoVol' => array(self::BELONGS_TO, 'UnidadMedida', 'id_unidad_peso_vol'),
			'idUnidadVolumen' => array(self::BELONGS_TO, 'UnidadMedida', 'id_unidad_volumen'),
			'idNaviera' => array(self::BELONGS_TO, 'Navieras', 'id_naviera'),
			'idTruckType' => array(self::BELONGS_TO, 'TrucksType', 'id_truck_type'),
			'idTipoPaquete' => array(self::BELONGS_TO, 'TipoPaquete', 'id_tipo_paquete'),
			'idPaisOrigen' => array(self::BELONGS_TO, 'Paises', 'id_pais_origen'),
			'idPaisDestino' => array(self::BELONGS_TO, 'Paises', 'id_pais_destino'),
			'carrier' => array(self::BELONGS_TO, 'Carriers', 'carrier_id'),
			'idRoutingType' => array(self::BELONGS_TO, 'RoutingType', 'id_routing_type'),
			'idFacturar' => array(self::BELONGS_TO, 'Clientes', 'id_facturar'),
			'idIncoterms' => array(self::BELONGS_TO, 'Incoterms', 'id_incoterms'),

			'idShipper' => array(self::BELONGS_TO, 'Clientes', 'id_shipper'),
			'idNotify' => array(self::BELONGS_TO, 'Clientes', 'id_notify'),
			'agente' => array(self::BELONGS_TO, 'Agentes', 'agente_id'),
			'idContainerType' => array(self::BELONGS_TO, 'ContainerType', 'id_container_type'),
			'routingMaritimo' => array(self::HAS_ONE, 'RoutingMaritimo', 'id_routing'),
			'cargosRoutings' => array(self::HAS_MANY, 'CargosRouting', 'id_routing'),
			'routingsDuas' => array(self::HAS_MANY, 'RoutingsDua', 'id_routing'),
			'routingCli' => array(self::BELONGS_TO, 'Routings', 'routing_cli'),
			//'routingInt' => array(self::BELONGS_TO, 'Routings', 'routing_int'),

			//'trackingsRed' => array(self::HAS_ONE, 'TrackingRoutings', 'id_routing', 'foreignKey' => array('id_catalogo'=>'agente_id'),'condition'=>"catalogo = 'AGENTE'", 'order'=>'id ASC'),

			*/


			'trackings' => array(self::HAS_MANY, 'TrackingRoutings', 'id_routing'),

			'trackingsToday' => array(self::STAT, 'TrackingRoutings', 'id_routing', 'condition'=>"fecha_estatus = DATE 'now'", 'select' => 'COUNT(id)'),

			'idCliente' => array(self::BELONGS_TO, 'Clientes', 'id_cliente', 'select' => 'id_cliente, nombre_cliente', 'joinType' => 'INNER JOIN'),
			
			'idTransporte' => array(self::BELONGS_TO, 'Transporte', '', 
				'on' => '"t".id_transporte = "idTransporte".id_transporte AND "idTransporte".id_transporte NOT IN (6,8,9)', 
			'select' => 'letra, descripcion', 'joinType' => 'INNER JOIN'),

			'idUsuarioCreacion' => array(self::BELONGS_TO, 'UsuariosEmpresas', 'id_usuario_creacion', 'select'=>'pw_gecos', 'joinType' => 'INNER JOIN'),

			'idDivisiones' => array(self::BELONGS_TO, 'ContactosDivisiones', '', 'on' => "area ILIKE '%preembarque%' AND status = 'Activo' AND id_catalogo = ".Yii::app()->user->id, 'select' => false, 'joinType' => 'INNER JOIN'),

			'trackingsLast' => array(self::BELONGS_TO, 'TrackingRoutings', '', 'on' => '"t".id_routing = "trackingsLast".id_routing AND "trackingsLast".last_id = true', 'select' => 'id, fecha_alerta, name_es, comentario, fecha_estatus, hora_estatus, usuario', 'joinType' => 'LEFT JOIN'),
			
			'routingInt' => array(self::HAS_ONE, 'Routings', '', 'on' => '"t".routing_int="routingInt".id_routing AND "routingInt".borrado = false', 'select' =>'bl_id, no_bl, bl_id_fecha, routing', 'joinType' => 'LEFT JOIN'),

			'idShipper' => array(self::BELONGS_TO, 'Clientes', 'id_shipper'),

			'idPais' => array(self::BELONGS_TO, 'Paises', 'id_pais'),

			'idTransporte2' => array(self::BELONGS_TO, 'Transporte', 'id_transporte'),

			//'routingInt' => array(self::BELONGS_TO, 'Routings', 'routing_int', 'condition' => '"routingInt".borrado = false', 'select' =>'bl_id, no_bl, bl_id_fecha', ),

		);
	}

/* esta fue la alternativa a el where de la vista vw_routings
(
	(	
		\"idDivisiones\".pais ILIKE '%\"' || \"t\".id_pais || '\"%' OR
		replace(\"idDivisiones\".pais, 'LTF', '') ILIKE '%\"' || \"t\".id_pais_origen || '\"%' OR		 
		replace(\"idDivisiones\".pais, 'LTF', '') ILIKE '%\"' || \"t\".id_pais_destino || '\"%'
    ) AND (
        CASE
            WHEN (\"idDivisiones\".tipo_persona = 'SuperPreembarque') THEN \"t\".id_usuario_creacion
            WHEN (\"idDivisiones\".tipo_persona IN ('Contacto','Soporte')) THEN
		        CASE WHEN  \"idDivisiones\".pais NOT ILIKE '%\"' || \"t\".id_pais || '\"%' 
AND (
		(\"idDivisiones\".pais ILIKE '%LTF\"%' AND \"t\".id_pais ILIKE '%LTF%') 
		OR
		(\"idDivisiones\".pais NOT ILIKE '%LTF\"%' AND \"t\".id_pais NOT ILIKE '%LTF%')
	)
		        THEN 
		        	\"t\".id_usuario_creacion
		       	ELSE 
		            \"idDivisiones\".id_catalogo
		        END
            ELSE \"t\".id_usuario_creacion
        END = \"t\".id_usuario_creacion
	) 
)
*/

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
			//'activo' => 'Activo',
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
			'routingInt', 			
		);

		$condition = str_replace("fecha",'"t".fecha',Routings::actionWhere(2));
		$criteria->addCondition($condition);
		$criteria->addCondition("((COALESCE(\"trackingsLast\".id,0) > 0 AND \"t\".borrado = true) OR \"t\".borrado = false) AND 
(\"t\".id_routing_type = 1) AND (\"t\".id_transporte NOT IN (6,8,9)) AND
((((
    CASE
        WHEN (\"idDivisiones\".pais ILIKE '%LTF\"%') THEN 'LTF'
        ELSE '***'
    END = \"substring\"((\"t\".id_pais), 3, 3)) AND 
    ((\"idDivisiones\".pais ILIKE (('%\"' || (\"t\".id_pais)) || '\"%')) OR 
    (\"idDivisiones\".pais ILIKE (('%\"' || (\"t\".id_pais_origen)) || 'LTF\"%')) OR 
    (\"idDivisiones\".pais ILIKE (('%\"' || (\"t\".id_pais_destino)) || 'LTF\"%')))) 
OR ((
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
    ((\"idDivisiones\".pais ILIKE (('%\"' || (\"t\".id_pais)) || '\"%')) OR 
    (replace(\"idDivisiones\".pais, 'LTF', '') ILIKE (('%\"' || (\"t\".id_pais_origen)) || '\"%')) OR 
    (replace(\"idDivisiones\".pais, 'LTF', '') ILIKE (('%\"' || (\"t\".id_pais_destino)) || '\"%'))))) 
AND (
    CASE
        WHEN ((\"idDivisiones\".tipo_persona) = 'SuperPreembarque') THEN \"t\".id_usuario_creacion
        WHEN ((\"idDivisiones\".tipo_persona) IN ('Contacto','Soporte')) THEN
        CASE WHEN 
        	((replace(\"idDivisiones\".pais, 'LTF', '')  NOT ILIKE (('%\"' || (\"t\".id_pais)) || '%')) AND 
            ((replace(\"idDivisiones\".pais, 'LTF', '') ILIKE (('%\"' || (\"t\".id_pais_origen)) || '%')) OR 
            (replace(\"idDivisiones\".pais, 'LTF', '') ILIKE (('%\"' || (\"t\".id_pais_destino)) || '%')))) THEN 
            	\"t\".id_usuario_creacion
            ELSE 
            	(\"idDivisiones\".id_catalogo)::bigint
        END
        ELSE \"t\".id_usuario_creacion
    END = \"t\".id_usuario_creacion))");
		
		$criteria->compare('CASE WHEN "t".borrado = true THEN \'A\' 
			ELSE
				CASE WHEN "t".routing_int > 0 THEN 
					CASE WHEN COALESCE("routingInt".bl_id,0) > 0 THEN \'B\' ELSE \'C\' END
				ELSE \'D\' END 
			END',$this->button);

		$criteria->compare('t.id_routing',$this->id_routing);
		$criteria->compare('routing_int',$this->routing_int);
		$criteria->compare('t.routing', $this->routing, true, 'ILIKE');
		$criteria->compare('t.id_pais',$this->id_pais);
		$criteria->compare('t.id_pais_origen',$this->id_pais_origen);
		$criteria->compare('t.id_pais_destino',$this->id_pais_destino);
		$criteria->compare('cast(t.fecha as text)',$this->fecha);
		$criteria->compare('order_no',$this->order_no,true,'ILIKE');
		$criteria->compare('"idTransporte".letra',$this->transporte,true,'ILIKE');
		$criteria->compare('t.import_export',$this->import_export);
		$criteria->compare('"idUsuarioCreacion".pw_gecos',$this->nombre_creacion,true,'ILIKE');
		$criteria->compare('cast(t.cotizacion_id as text)',$this->cotizacion_id,true,'ILIKE');
		$criteria->compare('"idCliente".nombre_cliente',$this->nombre_cliente,true,'ILIKE');
		$criteria->compare('no_embarque',$this->no_embarque,true,'ILIKE');
		$criteria->compare('COALESCE("trackingsLast".id,0)',$this->last_id);

		Yii::app()->session['Routings_records'] = $criteria;

		return $criteria;

	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		return new CActiveDataProvider($this, array(
			'criteria'=>$this->getSearchCriteria(),	
			'sort'=>array(
				'defaultOrder'=>"CASE WHEN (CAST(CASE WHEN (\"trackingsLast\".fecha_alerta IS NOT NULL) THEN (\"trackingsLast\".fecha_alerta) ELSE '1970-10-16' END AS DATE) >= CURRENT_DATE) THEN (\"trackingsLast\".fecha_alerta) ELSE '1970-10-16' END || (\"t\".fecha) || (\"t\".id_routing) DESC",			    
			),
			'pagination'=>array('pageSize'=>10),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Routings the static model class
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


    public function Dias($data, $row) {
        //en base a esta funcion se elaboro la vista vw_preembarque_days
        $dias = 0;
        $dia = "|";

		//$region = "'BZ','CR','GT','HN','BZLTF','CRLTF','GTLTF','HNLTF','NILTF','PALTF','SVLTF','NI','N1','PA','SV'";
		$region = Yii::app()->session['region'];

		$pais_o = $data->id_pais_origen;
		$pais_d = $data->id_pais_destino;

        if ($data->import_export == 't') { //import

			$EsDestinoRegion = strpos("*$region","'$pais_d");
			if ($EsDestinoRegion > -1) { //pais destino es pais de la region ?

		        $paises=Paises::model()->findByPk($pais_o);

		        //$paises->descripcion
		        //$paises->region

		        $sql = "SELECT pais_destino FROM paises_preembarque_dias WHERE (pais = '$pais_o' OR (region = '".$paises->id_region."' and pais = '')) AND id_transporte LIKE '%".$data->id_transporte."%'";
		        $pais_destino = Yii::app()->db->createCommand($sql)->queryScalar();
		        if ($pais_destino) {
		        	$pais_destino = "{".substr($pais_destino,0,-1)."}";
					$dias = json_decode($pais_destino,true);

					//echo "<pre>";
					//print_r($dias);
					//echo "</pre>";

					if (isset($dias[$pais_d]))
						$dias = $dias[$pais_d];

					//if (isset($dias[$pais_d]))
					//	$dia = $dias[$pais_d];
				}
			}

		} else {
			//export
			$EsOrigenRegion = strpos("*$region","'$pais_o");
			if ($EsOrigenRegion > -1) //pais origen es pais de la region ?
				$dias = 1;
			//else
			//	$dia = $EsOrigenRegion;
		}



		//$dia = $data->import_export;

		if ($dias > 0) {
			//date(cast('2016-12-26' as date) + interval '15' day),
			$sql2 = "select CURRENT_DATE - (date(cast('".$data->fecha."' as date) + interval '$dias' day)) as dias";
			$dia = Yii::app()->db->createCommand($sql2)->queryScalar();
		}

		return $dia;
    }


	//funcion comun para admin de VwRoutings / VwRoutingsAlerta
	public static function actionWhere($no) {

		if (!isset(Yii::app()->session['fecha_i']) || !isset(Yii::app()->session['fecha_f'])) {
			$sql2 = "SELECT to_date(cast(CURRENT_DATE - interval '3' month as varchar),'yyyy-mm-dd') as fecha_i, CURRENT_DATE as fecha_f";
			$row = Yii::app()->db->createCommand($sql2)->queryAll();
			Yii::app()->session['fecha_i'] = $row[0]['fecha_i'];
			Yii::app()->session['fecha_f'] = $row[0]['fecha_f'];
		}

		//$c = "id_catalogo = ".Yii::app()->user->id." AND t.fecha >= '".Yii::app()->session['fecha_i']."' AND t.fecha <= '".Yii::app()->session['fecha_f']."' ";

		$c = " fecha >= '".Yii::app()->session['fecha_i']."' AND fecha <= '".Yii::app()->session['fecha_f']."' ";

		/*if ($no == 2) {
				$c .= " AND (\"trackingsLast\".id > 0 AND \"t\".borrado = 't' OR \"t\".borrado = 'f')";
		}*/

		return $c;
	}


}
