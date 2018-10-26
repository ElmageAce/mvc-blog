<?php
namespace Elmage\models;

/**
* Login_model
*/
public $loginStatus;
protected $_categories;

class Index extends \Elmage\libs\Model {
	
	function __construct(\Elmage\libs\DB $db) {

		parent::__construct($db);

		$this->loginStatus = $this->getStatus();

	}

	public function getStatus() {
		return $this->_isLoggedIn;
	}

	public function getCategories() {

		if (!empty($this->_categories)) {
			return $this->_categories;
		}

		$getCat = $this->_db->get('categories', array('categoryID', '>=', 1));

		if ($getCat) {
			
			return $getCat->results();
		}

		return false;
	}

	

}
?>