<?php
namespace Elmage\models;

/**
 * Dashboard model class
 */
class Page extends \Elmage\libs\Model {

	protected $_db;
	protected $_categories;
	
	function __construct(\Elmage\libs\DB $db) {
		
		parent::__construct($db);

		$this->_db = $db;

	}

	public function getPost($id) {

		//get post content
		$postContent = $this->_db->get('posts', array('postID', '=', $id));

		if (!$postContent) {
			return false;
		}

		return $postContent->first();

	}

	public function AuthorData($id) {

		//get post content
		$author = $this->_db->get('users', array('id', '=', $id));

		if (!$author) {
			return false;
		}

		return $author->first();
	}

	public function getPostAuthor($id) {

		return $this->AuthorData($id)->displayName;
	}

}

?>