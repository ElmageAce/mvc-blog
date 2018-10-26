<?php
namespace Elmage\controllers;

use Elmage\models;

/**
* Index page controller
*/
class Page extends \Elmage\libs\Controller {

	public $link;
	public $_model;
	
	function __construct(models\Page $pageModel, \Elmage\libs\View $view) {

		parent::__construct($view);

		$this->link = 'post/content';

		$this->_model = $pageModel;

	}

	public function pages($id) {

		//get post
		$post = $this->_model->getPost($id);
		//set post
		$this->view->post = $post;

		$author = $this->_model->getPostAuthor($post->creatorID);

		$this->view->author = $author;
	}

	public function authors($id) {

		$authorData = $this->_model->AuthorData($id);

		$this->view->authorData = $authorData;

		$this->link = 'about/index';
	}
	
}


?>