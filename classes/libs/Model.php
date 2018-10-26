<?php
namespace Elmage\libs;

class Model {

	protected $_db = null;
	private $_data = null;
	protected $_sessionName;
	protected $_cookieName;
	public $_isLoggedIn = false;
	protected $_id;

	function __construct(\Elmage\libs\DB $db) {
		
		//connect to db
		$this->_db = $db;

		//session name
		$this->_sessionName = \get('session/session_name');

		//cookie name
		$this->_cookieName = \get('remember/cookie_name');

		if (\Elmage\util\Cookie::exists($this->_cookieName) && !\Elmage\util\Session::exists($this->_sessionName)) {

			$hash = \Elmage\util\Cookie::get($this->_cookieName);

			$hashCheck = $this->_db->get('users_session', array('hash', '=', $hash));

			if ($hashCheck->count()) {

				$user = $this->findUser($hashCheck->first()->user_id);

				if ($user) {

					$this->_id = $this->_data->id;

					$this->autoLogin();

					$this->_isLoggedIn = true;
				}
			}
		}

		if (\Elmage\util\Session::exists($this->_sessionName) && !$this->_isLoggedIn) {

			$userSession = \Elmage\util\Session::get($this->_sessionName);

			$user = $this->findUser($userSession);
			
			if($user) {

				$this->_id = $this->_data->id;

				$this->_isLoggedIn = true;
			} else {
				$this->_isLoggedIn = false;
			}
		}

	}


	public function listPost($category = 'all') {

		$posts = $this->_db->getJoin(['posts', 'postcategories'], ['postID', '=', 'postID'], 'LEFT JOIN');

		if ($posts == false) {
			return false;
		}

		$num = count($posts);

		if ($category == 'all') {
			return $posts->results();
		}

		$j = 0;

		$filteredPosts = [];

		for ($i=0; $i < $num; $i++) { 
			
			if ($posts->results()[$i]->categoryID == $category) {

				if ($i > 0 && $posts->results()[$i]->postID == $posts->results()[$i - 1]->postID) {
					continue;
				}

				$filteredPosts[$j] = $posts->results()[$i]->categoryID;

				$j++;
			}
		}

		return $filteredPosts;
	}

	public function getUserId() {
		return $this->_id;
	}

	public function getUserData($id) {

		$userData = $this->_db->get('users', array('id', '=', $id));

		if ($userData->count()) {

			return $userData->first();
		}

		return false;
	}

	public function levelClearance(int $level) {
		//get user data
		$userRole = $this->_data->userType;

		$userLevel = 1;
		
		switch ($userRole) {

			case 'Public':
				$userLevel = 1;
				break;
			case 'Author':
				$userLevel = 2;
				break;

			case 'Editor':
				$userLevel = 3;
				break;

			case 'Administrator':
				$userLevel = 4;
				break;

			case 'Super-Administrator':
				$userLevel = 5;
				break;
				
			default:
				$userLevel = 1;
				break;
		}
		
		if ($userLevel >= $level) {
			return true;
		}

		return false;

	}

	public function logout() {

		\Elmage\util\Session::delete($this->_sessionName);

		\Elmage\util\Cookie::delete($this->_cookieName);

		$this->_db->delete('users_session', array('user_id', '=', $this->_sessionName));
		
	}

	public function findUser($user) {
			
		$field = (is_numeric($user)) ? 'id' : 'username';

		$userData = $this->_db->get('users', array($field, '=', $user));

		if ($userData->count()) {
			
			$this->_data = $userData->first();

			return true;
		}

		return false;
	}

	public function data() {
		return $this->_data;
	}

	public function userExists() {
		return (!empty($this->_data)) ? true : false;
	}

	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}

	public function autoLogin() {
		\Elmage\util\Session::put($this->_sessionName, $this->data()->id);
	}



}

?>