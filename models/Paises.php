<?php

/**
 * This is the model class for table "paises".
 *
 * The followings are the available columns in table 'paises':
 * @property string $codigo
 * @property string $descripcion
 * @property string $conteo_uso
 * @property string $iso_3166
 * @property boolean $oficina_aimar
 * @property integer $id_region
 * @property boolean $oficina_grh
 * @property string $factor_riesgo
 *
 * The followings are the available model relations:
 * @property Unlocode[] $unlocodes
 * @property TarifasComisiones[] $tarifasComisiones
 * @property TarifasComisiones[] $tarifasComisiones1
 * @property ServicioXOrigenCliente[] $servicioXOrigenClientes
 * @property Puertos[] $puertoses
 * @property DestinosCliente[] $destinosClientes
 * @property Carriers[] $carriers
 * @property Empresas[] $empresases
 * @property Clientes[] $clientes
 * @property NivelesGeograficos[] $nivelesGeograficoses
 * @property Routings[] $routings
 * @property Routings[] $routings1
 * @property Routings[] $routings2
 * @property Almacenes[] $almacenes
 * @property Monedas[] $monedases
 * @property Barcos[] $barcoses
 */
class Paises extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paises';
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
		
			array('codigo, descripcion', 'required'),
			array('id_region', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>5),
			array('descripcion', 'length', 'max'=>100),
			array('iso_3166', 'length', 'max'=>3),
			array('factor_riesgo', 'length', 'max'=>10),
			array('conteo_uso, oficina_aimar, oficina_grh', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('codigo, descripcion, conteo_uso, iso_3166, oficina_aimar, id_region, oficina_grh, factor_riesgo', 'safe', 'on'=>'search'),
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
			'unlocodes' => array(self::HAS_MANY, 'Unlocode', 'pais'),
			'tarifasComisiones' => array(self::HAS_MANY, 'TarifasComisiones', 'id_pais_origen'),
			'tarifasComisiones1' => array(self::HAS_MANY, 'TarifasComisiones', 'id_pais_destino'),
			'servicioXOrigenClientes' => array(self::HAS_MANY, 'ServicioXOrigenCliente', 'id_pais_origen'),
			'puertoses' => array(self::HAS_MANY, 'Puertos', 'pais'),
			'destinosClientes' => array(self::HAS_MANY, 'DestinosCliente', 'codigo_pais'),
			'carriers' => array(self::HAS_MANY, 'Carriers', 'countries'),
			'empresases' => array(self::HAS_MANY, 'Empresas', 'pais_iso'),
			'clientes' => array(self::HAS_MANY, 'Clientes', 'id_pais'),
			'nivelesGeograficoses' => array(self::HAS_MANY, 'NivelesGeograficos', 'id_pais'),
			'routings' => array(self::HAS_MANY, 'Routings', 'id_pais_origen'),
			'routings1' => array(self::HAS_MANY, 'Routings', 'id_pais_destino'),
			'routings2' => array(self::HAS_MANY, 'Routings', 'id_pais'),
			'almacenes' => array(self::HAS_MANY, 'Almacenes', 'pais'),
			'monedases' => array(self::HAS_MANY, 'Monedas', 'pais'),
			'barcoses' => array(self::HAS_MANY, 'Barcos', 'pais'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigo' => 'Codigo',
			'descripcion' => 'Descripcion',
			'conteo_uso' => 'Conteo Uso',
			'iso_3166' => 'Iso 3166',
			'oficina_aimar' => 'Oficina Aimar',
			'id_region' => 'Id Region',
			'oficina_grh' => 'Oficina Grh',
			'factor_riesgo' => 'Factor Riesgo',
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

		$criteria->compare('codigo',$this->codigo,true,'ILIKE');
		$criteria->compare('descripcion',$this->descripcion,true,'ILIKE');
		$criteria->compare('conteo_uso',$this->conteo_uso);
		$criteria->compare('iso_3166',$this->iso_3166,true,'ILIKE');
		$criteria->compare('oficina_aimar',$this->oficina_aimar);
		$criteria->compare('id_region',$this->id_region);
		$criteria->compare('oficina_grh',$this->oficina_grh);
		$criteria->compare('factor_riesgo',$this->factor_riesgo);
		Yii::app()->session['Agentes_records'] = $criteria;		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,			
			'sort'=>array(
			    'defaultOrder'=>'codigo ASC',
			),				
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paises the static model class
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
