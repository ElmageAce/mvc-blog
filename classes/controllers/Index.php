<?php
namespace Elmage\controllers;


/**
* Index page controller
*/
class Index extends \Elmage\libs\Controller {

	public $link;
	public $_model;
	
	function __construct(\Elmage\libs\Model $model, \Elmage\libs\View $view) {

		parent::__construct($view);

		$this->_model = $model;

		$this->link = 'index/index';

		$this->posts('all');

	}

	public function setStatus() {
		$this->isLoggedIn = $this->_model->_isLoggedIn;
	}

	public function posts($cat = 'all') {

		$posts = $this->_model->listPost($cat);

		if (is_array($posts)) {
			
			$this->view->postList = $posts;

			$num = count($posts);

			$authorName = [];

			$j = 0;

			for ($i=0; $i < $num; $i++) { 
				
				$authorName = $this->_model->getUserData($posts[$i]->creatorID);

				$authorArr[$j] = $authorName;

				$j++;
			}

			$this->view->allAuthors = $authorArr;
		}
	}

}


?>