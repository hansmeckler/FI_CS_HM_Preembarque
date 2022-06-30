<?php

/**
 * This is the model class for table "contactos_divisiones".
 *
 * The followings are the available columns in table 'contactos_divisiones':
 * @property integer $id
 * @property integer $id_catalogo
 * @property integer $id_contacto
 * @property string $catalogo
 * @property string $nombre
 * @property string $email
 * @property string $telefono
 * @property string $area
 * @property string $impexp
 * @property string $carga
 * @property string $tranship
 * @property string $pais
 * @property string $fecha
 * @property string $usuario
 * @property string $status
 * @property string $area_enum
 * @property string $impexp_enum
 * @property string $carga_enum
 * @property string $tipo_persona
 * @property string $copia
 * @property string $rechazo
 * @property string $contactoxpais
 * @property string $fax
 * @property string $cargo
 *
 * The followings are the available model relations:
 * @property ContactosEnums $areaEnum
 * @property ContactosEnums $cargaEnum
 * @property ContactosEnums $catalogo0
 * @property ContactosEnums $copia0
 * @property ContactosEnums $impexpEnum
 * @property ContactosEnums $rechazo0
 * @property ContactosEnums $status0
 * @property ContactosEnums $tipoPersona
 */
class ContactosDivisiones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contactos_divisiones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_catalogo, id_contacto, nombre, email, area, impexp, carga, tranship, pais, fecha, usuario, status, area_enum, impexp_enum, carga_enum, tipo_persona, copia, rechazo, contactoxpais', 'required'),
			array('id_catalogo, id_contacto', 'numerical', 'integerOnly'=>true),
			array('tranship', 'length', 'max'=>1),
			array('fax, cargo', 'length', 'max'=>60),
			array('catalogo, telefono', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_catalogo, id_contacto, catalogo, nombre, email, telefono, area, impexp, carga, tranship, pais, fecha, usuario, status, area_enum, impexp_enum, carga_enum, tipo_persona, copia, rechazo, contactoxpais, fax, cargo', 'safe', 'on'=>'search'),
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
			'areaEnum' => array(self::BELONGS_TO, 'ContactosEnums', 'area_enum'),
			'cargaEnum' => array(self::BELONGS_TO, 'ContactosEnums', 'carga_enum'),
			'catalogo0' => array(self::BELONGS_TO, 'ContactosEnums', 'catalogo'),
			'copia0' => array(self::BELONGS_TO, 'ContactosEnums', 'copia'),
			'impexpEnum' => array(self::BELONGS_TO, 'ContactosEnums', 'impexp_enum'),
			'rechazo0' => array(self::BELONGS_TO, 'ContactosEnums', 'rechazo'),
			'status0' => array(self::BELONGS_TO, 'ContactosEnums', 'status'),
			'tipoPersona' => array(self::BELONGS_TO, 'ContactosEnums', 'tipo_persona'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_catalogo' => 'Id Catalogo',
			'id_contacto' => 'Id Contacto',
			'catalogo' => 'Catalogo',
			'nombre' => 'Nombre',
			'email' => 'Email',
			'telefono' => 'Telefono',
			'area' => 'Area',
			'impexp' => 'Impexp',
			'carga' => 'Carga',
			'tranship' => 'Tranship',
			'pais' => 'Pais',
			'fecha' => 'Fecha',
			'usuario' => 'Usuario',
			'status' => 'Status',
			'area_enum' => 'Area Enum',
			'impexp_enum' => 'Impexp Enum',
			'carga_enum' => 'Carga Enum',
			'tipo_persona' => 'Tipo Persona',
			'copia' => 'Copia',
			'rechazo' => 'Rechazo',
			'contactoxpais' => 'Contactoxpais',
			'fax' => 'Fax',
			'cargo' => 'Cargo',
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
		$criteria->compare('id_catalogo',$this->id_catalogo);
		$criteria->compare('id_contacto',$this->id_contacto);
		$criteria->compare('catalogo',$this->catalogo,true,'ILIKE');
		$criteria->compare('nombre',$this->nombre,true,'ILIKE');
		$criteria->compare('email',$this->email,true,'ILIKE');
		$criteria->compare('telefono',$this->telefono,true,'ILIKE');
		$criteria->compare('area',$this->area,true,'ILIKE');
		$criteria->compare('impexp',$this->impexp,true,'ILIKE');
		$criteria->compare('carga',$this->carga,true,'ILIKE');
		$criteria->compare('tranship',$this->tranship,true,'ILIKE');
		$criteria->compare('pais',$this->pais,true,'ILIKE');
		$criteria->compare('fecha',$this->fecha,true,'ILIKE');
		$criteria->compare('usuario',$this->usuario,true,'ILIKE');
		$criteria->compare('status',$this->status,true,'ILIKE');
		$criteria->compare('area_enum',$this->area_enum,true,'ILIKE');
		$criteria->compare('impexp_enum',$this->impexp_enum,true,'ILIKE');
		$criteria->compare('carga_enum',$this->carga_enum,true,'ILIKE');
		$criteria->compare('tipo_persona',$this->tipo_persona,true,'ILIKE');
		$criteria->compare('copia',$this->copia,true,'ILIKE');
		$criteria->compare('rechazo',$this->rechazo,true,'ILIKE');
		$criteria->compare('contactoxpais',$this->contactoxpais,true,'ILIKE');
		$criteria->compare('fax',$this->fax,true,'ILIKE');
		$criteria->compare('cargo',$this->cargo,true,'ILIKE');
		Yii::app()->session['ContactosDivisiones_records'] = $criteria;		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,			
			'sort'=>array(
			    'defaultOrder'=>'id ASC',
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
	 * @return ContactosDivisiones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
