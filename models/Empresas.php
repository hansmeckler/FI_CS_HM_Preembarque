<?php

/**
 * This is the model class for table "empresas".
 *
 * The followings are the available columns in table 'empresas':
 * @property integer $id_empresa
 * @property string $pais_iso
 * @property string $nombre_empresa
 * @property string $nombre_pais
 * @property boolean $activo
 *
 * The followings are the available model relations:
 * @property NavierasCredito[] $navierasCreditos
 * @property Paises $paisIso
 * @property EmpresasTransportesServicios[] $empresasTransportesServicioses
 * @property AgentesRebates[] $agentesRebates
 * @property CarriersCredito[] $carriersCreditos
 */
class Empresas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empresas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_empresa', 'required'),
			array('id_empresa', 'numerical', 'integerOnly'=>true),
			array('pais_iso', 'length', 'max'=>5),
			array('nombre_empresa, nombre_pais', 'length', 'max'=>50),
			array('activo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_empresa, pais_iso, nombre_empresa, nombre_pais, activo', 'safe', 'on'=>'search'),
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
			'navierasCreditos' => array(self::HAS_MANY, 'NavierasCredito', 'id_empresa'),
			'paisIso' => array(self::BELONGS_TO, 'Paises', 'pais_iso'),
			'empresasTransportesServicioses' => array(self::HAS_MANY, 'EmpresasTransportesServicios', 'id_empresa'),
			'agentesRebates' => array(self::HAS_MANY, 'AgentesRebates', 'id_empresa'),
			'carriersCreditos' => array(self::HAS_MANY, 'CarriersCredito', 'id_empresa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_empresa' => 'Id Empresa',
			'pais_iso' => 'Pais Iso',
			'nombre_empresa' => 'Nombre Empresa',
			'nombre_pais' => 'Nombre Pais',
			'activo' => 'Activo',
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

		$criteria->compare('id_empresa',$this->id_empresa);
		$criteria->compare('pais_iso',$this->pais_iso,true,'ILIKE');
		$criteria->compare('nombre_empresa',$this->nombre_empresa,true,'ILIKE');
		$criteria->compare('nombre_pais',$this->nombre_pais,true,'ILIKE');
		$criteria->compare('activo',$this->activo);
		Yii::app()->session['Empresas_records'] = $criteria;		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,			
			'sort'=>array(
			    'defaultOrder'=>'id_empresa ASC',
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
	 * @return Empresas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
