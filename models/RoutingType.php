<?php

/**
 * This is the model class for table "routing_type".
 *
 * The followings are the available columns in table 'routing_type':
 * @property integer $id_routing_type
 * @property string $letra
 * @property string $descripcion
 * @property string $titulo
 *
 * The followings are the available model relations:
 * @property Routings[] $routings
 * @property RoutingTemplate[] $routingTemplates
 */
class RoutingType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'routing_type';
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
		
			array('letra', 'length', 'max'=>5),
			array('descripcion', 'length', 'max'=>35),
			array('titulo', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_routing_type, letra, descripcion, titulo', 'safe', 'on'=>'search'),
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
			'routings' => array(self::HAS_MANY, 'Routings', 'id_routing_type'),
			'routingTemplates' => array(self::HAS_MANY, 'RoutingTemplate', 'id_routing_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_routing_type' => 'Id Routing Type',
			'letra' => 'Letra',
			'descripcion' => 'Descripcion',
			'titulo' => 'Titulo',
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

		$criteria->compare('id_routing_type',$this->id_routing_type);
		$criteria->compare('letra',$this->letra,true,'ILIKE');
		$criteria->compare('descripcion',$this->descripcion,true,'ILIKE');
		$criteria->compare('titulo',$this->titulo,true,'ILIKE');
		Yii::app()->session['Agentes_records'] = $criteria;		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,			
			'sort'=>array(
			    'defaultOrder'=>'id_routing_type ASC',
			),				
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoutingType the static model class
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
