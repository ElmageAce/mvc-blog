<?php
namespace Elmage\libs;

class Controller implements IController {

	protected $_model;
	public $view;
	public $isLoggedIn;
	
	function __construct(View $view) {

		$this->view = $view;
		
	}

	public function loadPage($link, $isLoggedIn) {

		$this->view->render($link, $isLoggedIn);
		
	}

}

?>