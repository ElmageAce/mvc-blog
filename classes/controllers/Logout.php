<?php
namespace Elmage\controllers;


/**
* Index page controller
*/
class Logout extends \Elmage\libs\Controller {

	public $link;
	public $_model;
	
	function __construct(\Elmage\libs\Model $model, \Elmage\libs\View $view) {

		parent::__construct($view);

		$this->_model = $model;

		$this->link = 'index/index';

		$this->logout();

	}

	public function logout() {
		//log out
		$this->_model->logout();
	}

}


?>