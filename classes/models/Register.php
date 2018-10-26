<?php
namespace Elmage\models;

/**
 * Registration class
 */
class Register extends \Elmage\libs\Model {
	
	function __construct(\Elmage\libs\DB $db, \Elmage\libs\Validate $validation) {

		parent::__construct($db);

		$this->validate = $validation;
	}

	public function validateRegistration() {
		//
		$validation = $this->validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 6
			),
			'password' => array(
				'required' => true,
				'min' => 10
			),
			'email' => array(
				'required' => true,
				'min' => 10
			),
			'password_again' => array(
				'required' => true,
				'matches' => 'password'
			)
		));

		if ($validation->passed()) {
			
			return true;
		}

		return false;
	}

	public function register() {

		if (\Elmage\util\Token::check(\Elmage\libs\Input::get('token'))) {
			
			if ($this->validateRegistration() === true) {
				
				$username = \escape(\Elmage\libs\Input::get('username'));

				$password = \escape(\Elmage\libs\Input::get('password'));

				$email = \escape(\Elmage\libs\Input::get('email'));

				$password = \Elmage\libs\Hash::make($password, 8);

				$userType = 'Public';

				if (!$this->_db->insert('users', array(
					'username' => $username,
					'userType' => $userType,
					'password' => $password,
					'email'    => $email
				))) {
					return false;
				}


				return true;
			}
		}
	}
}

?>