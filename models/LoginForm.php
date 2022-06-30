<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	//public expired;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Usuario',
			'password'=>'Contraseña',
			'rememberMe'=>'Guardar Contraseña',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$res = $this->_identity->authenticate();
			switch ($res) {
				case 0:
					break;
				case 1:
					$this->addError('username','Usuario no registrado.');
					break;
				case 2:
					$this->addError('password','Contraseña incorrecta.');
					break;
				case 98:
					//$this->expired = 98;
					$this->addError('username','La contraseña ha vencido.');
					break;
				case 99:
					$this->addError('username','Usuario sin permisos para este modulo.');
					break;

				case 97:
					$this->addError('username','Usuario no tiene permisos para pre embarque.');
					break;
				default:
					$this->addError('username','Error no catalogado (' . $res . ').');
					break;
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
