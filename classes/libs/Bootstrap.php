<?php
namespace Elmage\libs;

class Bootstrap {

	private $_controller;
	public $loggedIn;

	public function __construct(Controller $controller) {

		$this->_controller = $controller;

		$this->loggedIn = $this->_controller->_model->isLoggedIn();

	}

	public function loadController($url) {

		if ($url[0] === 'Logout') {
			$this->loggedIn = false;		}

		if (isset($url[1]) && method_exists($this->_controller, $url[1])) {
			
			if (isset($url[2])) {

				$this->_controller->{$url[1]}($url[2]);

			} else {

				$this->_controller->{$url[1]}();
				
			}

		} elseif(isset($url[1]) && !method_exists($this->_controller, $url[1])) {

			$this->_controller->view->msg = "Method does not exists";

		}

	}

	public function displayPage() {
		$this->loggedIn;
		$this->_controller->loadPage($this->_controller->link, $this->loggedIn);
	}


}




?>