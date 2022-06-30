<?php

/**
 * This is the model class for table "usuarios_empresas".
 *
 * The followings are the available columns in table 'usuarios_empresas':
 * @property string $id_usuario
 * @property string $pw_name
 * @property string $pw_passwd
 * @property integer $pw_uid
 * @property integer $pw_gid
 * @property string $pw_gecos
 * @property string $pw_dir
 * @property string $pw_shell
 * @property integer $tipo_usuario
 * @property string $pais
 * @property string $dominio
 * @property integer $level
 * @property integer $pw_activo
 * @property string $pw_codigo_tributario
 * @property integer $pw_correo
 * @property integer $id_usuario_reg
 * @property string $modificado
 * @property string $locode
 * @property integer $planilla_numero
 * @property string $pw_ultimo_acceso
 * @property integer $pw_passwd_dias
 * @property string $pw_passwd_fecha
 * @property string $pw_user_ip
 * @property integer $pw_sis_id
 * @property integer $id_puesto
 * @property boolean $pw_user_ip_bloqueada
 *
 * The followings are the available model relations:
 * @property ContactosUsersMenu[] $contactosUsersMenus
 * @property CreditosClientes[] $creditosClientes
 * @property Avisos[] $avisoses
 * @property NavierasCredito[] $navierasCreditos
 * @property DefinicionUsuario $tipoUsuario
 * @property UsuariosEmpresas $idUsuarioReg
 * @property UsuariosEmpresas[] $usuariosEmpresases
 * @property UsuariosPaises $pais0
 * @property UsuariosEmpresasPuestos $idPuesto
 * @property UsuariosEmpresasLog[] $usuariosEmpresasLogs
 * @property Creditos[] $creditoses
 * @property Creditos[] $creditoses1
 * @property Catalogos[] $catalogoses
 * @property Agentes[] $agentes
 * @property Agentes[] $agentes1
 * @property Routings[] $routings
 * @property PerfilesUsuariosEmpresas $perfilesUsuariosEmpresas
 * @property CarriersCredito[] $carriersCreditos
 * @property UsuariosEmpresasPasswds[] $usuariosEmpresasPasswds
 */
class UsuariosEmpresas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios_empresas';
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
		
			array('pw_name, pw_ultimo_acceso', 'required'),
			array('pw_uid, pw_gid, tipo_usuario, level, pw_activo, pw_correo, id_usuario_reg, planilla_numero, pw_passwd_dias, pw_sis_id, id_puesto', 'numerical', 'integerOnly'=>true),
			array('pw_name', 'length', 'max'=>32),
			array('pw_passwd', 'length', 'max'=>40),
			array('pw_gecos', 'length', 'max'=>48),
			array('pw_dir', 'length', 'max'=>160),
			array('pw_shell', 'length', 'max'=>20),
			array('pais', 'length', 'max'=>5),
			array('dominio, pw_codigo_tributario', 'length', 'max'=>30),
			array('locode', 'length', 'max'=>3),
			array('pw_user_ip', 'length', 'max'=>15),
			array('modificado, pw_passwd_fecha, pw_user_ip_bloqueada', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, pw_name, pw_passwd, pw_uid, pw_gid, pw_gecos, pw_dir, pw_shell, tipo_usuario, pais, dominio, level, pw_activo, pw_codigo_tributario, pw_correo, id_usuario_reg, modificado, locode, planilla_numero, pw_ultimo_acceso, pw_passwd_dias, pw_passwd_fecha, pw_user_ip, pw_sis_id, id_puesto, pw_user_ip_bloqueada', 'safe', 'on'=>'search'),
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
			'contactosUsersMenus' => array(self::HAS_MANY, 'ContactosUsersMenu', 'id_usuario'),
			'creditosClientes' => array(self::HAS_MANY, 'CreditosClientes', 'id_usuario'),
			'avisoses' => array(self::HAS_MANY, 'Avisos', 'id_usuario'),
			'navierasCreditos' => array(self::HAS_MANY, 'NavierasCredito', 'id_usuario'),
			'tipoUsuario' => array(self::BELONGS_TO, 'DefinicionUsuario', 'tipo_usuario'),
			'idUsuarioReg' => array(self::BELONGS_TO, 'UsuariosEmpresas', 'id_usuario_reg'),
			'usuariosEmpresases' => array(self::HAS_MANY, 'UsuariosEmpresas', 'id_usuario_reg'),
			'pais0' => array(self::BELONGS_TO, 'UsuariosPaises', 'pais'),
			'idPuesto' => array(self::BELONGS_TO, 'UsuariosEmpresasPuestos', 'id_puesto'),
			'usuariosEmpresasLogs' => array(self::HAS_MANY, 'UsuariosEmpresasLog', 'user_id'),
			'creditoses' => array(self::HAS_MANY, 'Creditos', 'id_usuario_autoriza'),
			'creditoses1' => array(self::HAS_MANY, 'Creditos', 'id_usuario_crea'),
			'catalogoses' => array(self::MANY_MANY, 'Catalogos', 'usuarios_catalogos(id_usuario, id_catalogo)'),
			'agentes' => array(self::HAS_MANY, 'Agentes', 'id_usuario_creacion'),
			'agentes1' => array(self::HAS_MANY, 'Agentes', 'id_usuario_modificacion'),
			'routings' => array(self::HAS_MANY, 'Routings', 'vendedor_id'),
			'perfilesUsuariosEmpresas' => array(self::HAS_ONE, 'PerfilesUsuariosEmpresas', 'id_usuario'),
			'carriersCreditos' => array(self::HAS_MANY, 'CarriersCredito', 'id_usuario'),
			'usuariosEmpresasPasswds' => array(self::HAS_MANY, 'UsuariosEmpresasPasswds', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'Id Usuario',
			'pw_name' => 'Pw Name',
			'pw_passwd' => 'Pw Passwd',
			'pw_uid' => 'Pw Uid',
			'pw_gid' => 'Pw Gid',
			'pw_gecos' => 'Pw Gecos',
			'pw_dir' => 'Pw Dir',
			'pw_shell' => 'Pw Shell',
			'tipo_usuario' => 'Tipo Usuario',
			'pais' => 'Pais',
			'dominio' => 'Dominio',
			'level' => 'Level',
			'pw_activo' => 'Pw Activo',
			'pw_codigo_tributario' => 'Pw Codigo Tributario',
			'pw_correo' => 'Pw Correo',
			'id_usuario_reg' => 'Id Usuario Reg',
			'modificado' => 'Modificado',
			'locode' => 'Locode',
			'planilla_numero' => 'Planilla Numero',
			'pw_ultimo_acceso' => 'Pw Ultimo Acceso',
			'pw_passwd_dias' => 'Pw Passwd Dias',
			'pw_passwd_fecha' => 'Pw Passwd Fecha',
			'pw_user_ip' => 'Pw User Ip',
			'pw_sis_id' => 'Pw Sis',
			'id_puesto' => 'Id Puesto',
			'pw_user_ip_bloqueada' => 'Pw User Ip Bloqueada',
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

		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('pw_name',$this->pw_name,true,'ILIKE');
		$criteria->compare('pw_passwd',$this->pw_passwd,true,'ILIKE');
		$criteria->compare('pw_uid',$this->pw_uid);
		$criteria->compare('pw_gid',$this->pw_gid);
		$criteria->compare('pw_gecos',$this->pw_gecos,true,'ILIKE');
		$criteria->compare('pw_dir',$this->pw_dir,true,'ILIKE');
		$criteria->compare('pw_shell',$this->pw_shell,true,'ILIKE');
		$criteria->compare('tipo_usuario',$this->tipo_usuario);
		$criteria->compare('pais',$this->pais,true,'ILIKE');
		$criteria->compare('dominio',$this->dominio,true,'ILIKE');
		$criteria->compare('level',$this->level);
		$criteria->compare('pw_activo',$this->pw_activo);
		$criteria->compare('pw_codigo_tributario',$this->pw_codigo_tributario,true,'ILIKE');
		$criteria->compare('pw_correo',$this->pw_correo);
		$criteria->compare('id_usuario_reg',$this->id_usuario_reg);
		$criteria->compare('modificado',$this->modificado);
		$criteria->compare('locode',$this->locode,true,'ILIKE');
		$criteria->compare('planilla_numero',$this->planilla_numero);
		$criteria->compare('pw_ultimo_acceso',$this->pw_ultimo_acceso);
		$criteria->compare('pw_passwd_dias',$this->pw_passwd_dias);
		$criteria->compare('pw_passwd_fecha',$this->pw_passwd_fecha);
		$criteria->compare('pw_user_ip',$this->pw_user_ip,true,'ILIKE');
		$criteria->compare('pw_sis_id',$this->pw_sis_id);
		$criteria->compare('id_puesto',$this->id_puesto);
		$criteria->compare('pw_user_ip_bloqueada',$this->pw_user_ip_bloqueada);
		Yii::app()->session['Agentes_records'] = $criteria;		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,			
			'sort'=>array(
			    'defaultOrder'=>'id_usuario ASC',
			),				
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuariosEmpresas the static model class
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
