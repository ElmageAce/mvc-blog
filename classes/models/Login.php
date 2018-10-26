<?php
namespace Elmage\models;

/**
* Login_model
*/
class Login extends \Elmage\libs\Model {

	//public $validate
	
	function __construct(\Elmage\libs\DB $db, \Elmage\libs\Validate $validation) {

		parent::__construct($db);

		$this->validate = $validation;
		//check login status
		//

	}

	public function validateLogin() {

		$validation = $this->validate->check($_POST, array(
			'username' => array(
				'required' => true
			),
			'password' => array(
				'required' => true
			)
		));

		if ($validation->passed()) {
			
			return true;
		}

		return false;
	}

	public function login() {

		if (\Elmage\util\Token::check(\Elmage\libs\Input::get('token'))) {
			
			//validate input
			if ($this->validateLogin() === true) {

				$username = \escape(\Elmage\libs\Input::get('username'));

				$password = \escape(\Elmage\libs\Input::get('password'));

				$remember = (\Elmage\libs\Input::get('remember') === 'on') ? true : false;
				
				//check if user has an active session
				if (!$username && !$password && $this->userExists()) {

					$this->autoLogin();

				} else {


					$user = $this->findUser($username);

					if ($user === true) {
						
						//check password
						if (\Elmage\libs\Hash::verify($password, $this->data()->password)) {
							
							//put in session
							\Elmage\util\Session::put($this->_sessionName, $this->data()->id);

							//if remember me acive
							if ($remember) {
								
								$hash = \Elmage\libs\Hash::unique();

								//check if seesion already exists in db
								$hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

								if (!$hashCheck->count()) {
									$this->_db->insert('users_session', array(
										'user_id' => $this->data()->id,
										'hash' => $hash
									));

								} else {

									$hash = $hashCheck->first()->hash;

								}

								//create cookie
								\Elmage\util\Cookie::put($this->_cookieName, $hash, \get('remember/cookie_expiry'));

							}

							$this->_isLoggedIn = true;

							return true;
						}
					}

				}


			}

			return false;
		}
	}


}
?>