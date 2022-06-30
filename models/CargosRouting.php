<?php

/**
 * This is the model class for table "cargos_routing".
 *
 * The followings are the available columns in table 'cargos_routing':
 * @property string $id_cargos_routing
 * @property string $id_routing
 * @property string $id_moneda
 * @property string $id_rubro
 * @property string $detalle
 * @property double $valor_old
 * @property boolean $local
 * @property double $costo_old
 * @property boolean $show
 * @property boolean $activo
 * @property string $id_servicio
 * @property string $observacion
 * @property string $factura_id
 * @property integer $tipo_documento
 * @property string $sobreventa
 * @property string $valor
 * @property string $costo
 * @property integer $tipo_cargo
 * @property integer $inter_company
 * @property integer $id_grupo
 * @property integer $id_rubro_ref
 * @property string $fecha_registro
 * @property string $id_routing_importado
 * @property boolean $prepaid
 *
 * The followings are the available model relations:
 * @property CargosRoutingRef[] $cargosRoutingRefs
 * @property Routings $idRouting
 * @property Rubros $idRubro
 * @property Servicios $idServicio
 */
class CargosRouting extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cargos_routing';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_routing, id_moneda, fecha_registro', 'required'),
			array('tipo_documento, tipo_cargo, inter_company, id_grupo, id_rubro_ref', 'numerical', 'integerOnly'=>true),
			array('valor_old, costo_old', 'numerical'),
			array('detalle', 'length', 'max'=>30),
			array('observacion', 'length', 'max'=>75),
			array('sobreventa, valor, costo', 'length', 'max'=>12),
			array('id_rubro, local, show, activo, id_servicio, factura_id, id_routing_importado, prepaid', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cargos_routing, id_routing, id_moneda, id_rubro, detalle, valor_old, local, costo_old, show, activo, id_servicio, observacion, factura_id, tipo_documento, sobreventa, valor, costo, tipo_cargo, inter_company, id_grupo, id_rubro_ref, fecha_registro, id_routing_importado, prepaid', 'safe', 'on'=>'search'),
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
			'cargosRoutingRefs' => array(self::HAS_MANY, 'CargosRoutingRef', 'id_cargos_routing'),
			'idRouting' => array(self::BELONGS_TO, 'Routings', 'id_routing'),
			'idRubro' => array(self::BELONGS_TO, 'Rubros', 'id_rubro'),
			'idServicio' => array(self::BELONGS_TO, 'Servicios', 'id_servicio'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cargos_routing' => 'Id Cargos Routing',
			'id_routing' => 'Id Routing',
			'id_moneda' => 'Id Moneda',
			'id_rubro' => 'Id Rubro',
			'detalle' => 'Detalle',
			'valor_old' => 'Valor Old',
			'local' => 'Local',
			'costo_old' => 'Costo Old',
			'show' => 'Show',
			'activo' => 'Activo',
			'id_servicio' => 'Id Servicio',
			'observacion' => 'Observacion',
			'factura_id' => 'Factura',
			'tipo_documento' => 'Tipo Documento',
			'sobreventa' => 'Sobreventa',
			'valor' => 'Valor',
			'costo' => 'Costo',
			'tipo_cargo' => 'Tipo Cargo',
			'inter_company' => 'Inter Company',
			'id_grupo' => 'Id Grupo',
			'id_rubro_ref' => 'Id Rubro Ref',
			'fecha_registro' => 'Fecha Registro',
			'id_routing_importado' => 'Id Routing Importado',
			'prepaid' => 'Prepaid',
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

		$criteria->compare('id_cargos_routing',$this->id_cargos_routing,true,'ILIKE');
		$criteria->compare('id_routing',$this->id_routing,true,'ILIKE');
		$criteria->compare('id_moneda',$this->id_moneda,true,'ILIKE');
		$criteria->compare('id_rubro',$this->id_rubro,true,'ILIKE');
		$criteria->compare('detalle',$this->detalle,true,'ILIKE');
		$criteria->compare('valor_old',$this->valor_old);
		$criteria->compare('local',$this->local);
		$criteria->compare('costo_old',$this->costo_old);
		$criteria->compare('show',$this->show);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('id_servicio',$this->id_servicio,true,'ILIKE');
		$criteria->compare('observacion',$this->observacion,true,'ILIKE');
		$criteria->compare('factura_id',$this->factura_id,true,'ILIKE');
		$criteria->compare('tipo_documento',$this->tipo_documento);
		$criteria->compare('sobreventa',$this->sobreventa,true,'ILIKE');
		$criteria->compare('valor',$this->valor,true,'ILIKE');
		$criteria->compare('costo',$this->costo,true,'ILIKE');
		$criteria->compare('tipo_cargo',$this->tipo_cargo);
		$criteria->compare('inter_company',$this->inter_company);
		$criteria->compare('id_grupo',$this->id_grupo);
		$criteria->compare('id_rubro_ref',$this->id_rubro_ref);
		$criteria->compare('fecha_registro',$this->fecha_registro,true,'ILIKE');
		$criteria->compare('id_routing_importado',$this->id_routing_importado,true,'ILIKE');
		$criteria->compare('prepaid',$this->prepaid);
		Yii::app()->session['CargosRouting_records'] = $criteria;		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,			
			'sort'=>array(
			    'defaultOrder'=>'id_cargos_routing ASC',
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
	 * @return CargosRouting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
