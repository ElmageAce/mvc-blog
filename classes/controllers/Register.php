<?php
namespace Elmage\controllers;

use Elmage\models;

/**
* Index page controller
*/
class Register extends \Elmage\libs\Controller {

	public $link;
	public $_model;
	
	function __construct(models\Register $registerModel, \Elmage\libs\View $view) {

		parent::__construct($view);

		$this->link = 'register/index';

		$this->_model = $registerModel;

	}

	public function run() {

		if (isset($_POST)) {
			$this->_model->login();
		}

		if ($this->_model->isLoggedIn()) {
			header('Location: ' . URL . 'index');
		}
	}

	public function addUser() {

		$register = false;

		if (isset($_POST)) {
			$register = $this->_model->register();
		}

		if ($register) {
			header('Location: ' . URL . 'dashboard/pages/users');
		}
	}
	
}


?>