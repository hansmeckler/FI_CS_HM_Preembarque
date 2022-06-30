<?php

/**
 * This is the model class for table "aimartrackings".
 *
 * The followings are the available columns in table 'aimartrackings':
 * @property integer $id
 * @property string $estatus
 * @property integer $air
 * @property integer $ocean
 * @property integer $land
 * @property integer $local_land
 * @property integer $import
 * @property string $grupo
 * @property string $estatus_es
 * @property integer $activo
 * @property integer $nb
 * @property integer $notificar_agente
 * @property integer $notificar_cliente
 * @property integer $notificar_shipper
 * @property integer $publico
 * @property integer $aduana
 *
 * The followings are the available model relations:
 * @property TrackingRoutings[] $trackingRoutings
 */
class Aimartrackings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'aimartrackings';
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
		
			array('air, ocean, land, local_land, import, activo, nb, notificar_agente, notificar_cliente, notificar_shipper, publico, aduana', 'numerical', 'integerOnly'=>true),
			array('estatus, estatus_es', 'length', 'max'=>1000),
			array('grupo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, estatus, air, ocean, land, local_land, import, grupo, estatus_es, activo, nb, notificar_agente, notificar_cliente, notificar_shipper, publico, aduana', 'safe', 'on'=>'search'),
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
			'trackingRoutings' => array(self::HAS_MANY, 'TrackingRoutings', 'id_estatus'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'estatus' => 'Estatus',
			'air' => 'Air',
			'ocean' => 'Ocean',
			'land' => 'Land',
			'local_land' => 'Local Land',
			'import' => 'Import',
			'grupo' => 'Grupo',
			'estatus_es' => 'Estatus Es',
			'activo' => 'Activo',
			'nb' => 'Nb',
			'notificar_agente' => 'Notificar Agente',
			'notificar_cliente' => 'Notificar Cliente',
			'notificar_shipper' => 'Notificar Shipper',
			'publico' => 'Publico',
			'aduana' => 'Aduana',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('estatus',$this->estatus,true,'ILIKE');
		$criteria->compare('air',$this->air);
		$criteria->compare('ocean',$this->ocean);
		$criteria->compare('land',$this->land);
		$criteria->compare('local_land',$this->local_land);
		$criteria->compare('import',$this->import);
		$criteria->compare('grupo',$this->grupo,true,'ILIKE');
		$criteria->compare('estatus_es',$this->estatus_es,true,'ILIKE');
		$criteria->compare('activo',$this->activo);
		$criteria->compare('nb',$this->nb);
		$criteria->compare('notificar_agente',$this->notificar_agente);
		$criteria->compare('notificar_cliente',$this->notificar_cliente);
		$criteria->compare('notificar_shipper',$this->notificar_shipper);
		$criteria->compare('publico',$this->publico);
		$criteria->compare('aduana',$this->aduana);
		Yii::app()->session['Agentes_records'] = $criteria;		

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
	 * @return Aimartrackings the static model class
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
