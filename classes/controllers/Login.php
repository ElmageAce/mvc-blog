<?php
namespace Elmage\controllers;

use Elmage\models;

/**
* Index page controller
*/
class Login extends \Elmage\libs\Controller {

	public $link;
	public $_model;
	
	function __construct(models\Login $loginModel, \Elmage\libs\View $view) {

		parent::__construct($view);

		$this->link = 'login/index';

		$this->_model = $loginModel;

	}

	public function run() {

		if (isset($_POST)) {
			$this->_model->login();
		}

		if ($this->_model->isLoggedIn()) {
			header('Location: ' . URL . 'index');
		}
	}
	
}


?>