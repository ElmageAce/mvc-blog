<?php
namespace Elmage\models;

/**
 * Dashboard model class
 */
class Dashboard extends \Elmage\libs\Model {

	protected $_db;
	protected $_categories;
	
	function __construct(\Elmage\libs\DB $db) {
		
		parent::__construct($db);

		$this->_db = $db;

		$getCategories = $this->_db->get('categories', array('categoryID', '>=', 1));

		if ($getCategories) {
			$this->_categories = $getCategories->results();
		} else {
			$this->_categories = false;
		}

	}

	public function updateUserData($id, $arrayOfData) {
		//update
		if (!$this->_db->update('users', 'id', $id, $arrayOfData)) {
			return false;
		}
		return true;
	}

	public function getUsers($role = null) {

		//get users from users table
		$users = $this->_db->get('users', array('id', '>=', 1));

		if (!$users) {
			return false;
		}

		$num = $users->count();

		$usersArray = [];

		$j = 0;

		for ($i=0; $i < $num; $i++) { 
			
			$users->results()[$i]->password = 'PROTECTED';

			if (!$role) {

				$usersArray[$j] = $users->results()[$i];

				$j++;

			} elseif ($role == $users->results()[$i]->userType) {
				
				$usersArray[$j] = $users->results()[$i];

				$j++;
			}
		}

		return $usersArray;
	}

	public function changeUserRole($userRole, $userId) {
		$role = '';

		switch ($userRole) {
			case 'public':
				$role = 'Public';
				break;
			case 'author':
				$role = 'Author';
				break;
			case 'editor':
				$role = 'Editor';
				break;
			case 'admin':
				$role = 'Administrator';
				break;
			case 'superAdmin':
				$role = 'Super-Administrator';
				break;
		}

		if (!$this->_db->update('users', 'id', $userId, array('userType' => $role))) {
			return false;
		}

		return true;
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

	public function getCategory($id) {

		if ($this->_categories) {
			
			for ($i=0; $i < count($this->_categories); $i++) { 
				
				if ($this->_categories[$i]->categoryID == $id) {
					
					return $this->_categories[$i];
				}
			}

		} else {

			$getCat = $this->_db->get('categories', array('categoryID', '>=', $id));

			for ($i=0; $i < $getCat->count(); $i++) { 
				
				if ($getCat->results()[$i]->categoryID == $id) {
					
					return $getCat->results()[$i];
				}
			}
		}
	}

	public function newCategory($field = array()) {

		if (!$this->_db->insert('categories', array(
			'categoryName' => $field[0],
			'parent' => $field[1],
			'description' => $field[2]
		))) {
			return false;
		}

		return true;
	}

	public function uploadImage() {

		if (!isset($_FILES["fileToUpload"]["name"]) OR \escape(\Elmage\libs\Input::get('imgChkbox')) == 1) {
			return true;
		}
		//target dir
		$targetDir = URL . 'img/uploads/';

		$targetFile = $targetDir . \basename($_FILES["fileToUpload"]["name"]);

		$imageFileType = \pathinfo($targetFile, PATHINFO_EXTENSION);

		$checkSize = \getimagesize($_FILES["fileToUpload"]["tmp_name"]);

		if (!$checkSize) {
			return false;
		}

		if (\file_exists($targetFile)) {
			return false;
		}

		if ($_FILES["fileToUpload"]["size"] > 1024) {
			return false;
		}

		if (!($imageFileType == 'jpg' OR $imageFileType == 'jpeg' OR $imageFileType == 'png')) {
			return false;
		}

		if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
			return false;
		}

		return true;
	}

	public function save() {

		$creator = $this->getUserId();

		//get title
		$title = \escape(\Elmage\libs\Input::get('title'));
		//get sub
		$subtitle = \escape(\Elmage\libs\Input::get('subtitle'));
		//get content
		$content = \Elmage\libs\Input::get('mytextarea');
		//get visibility
		$visibility = \escape(\Elmage\libs\Input::get('visibility'));
		//get publish option
		$publishOption = (\Elmage\libs\Input::get('publishOption') == 'draft')? true : false;
		//get sticky
		$isSticky = (\Elmage\libs\Input::get('stick')) ? true : false;
		//publish
		$publish = (\Elmage\libs\Input::get('saveDraft')) ? false : true;
		//categories
		$categories = (is_array(\Elmage\libs\Input::get('chkbox'))) ? \Elmage\libs\Input::get('chkbox') : [];

		$isEdit = (int) \Elmage\libs\Input::get('EditPost');

		if (\Elmage\libs\Input::exists() && \Elmage\util\Token::check(\Elmage\libs\Input::get('token'))) {

			if (!(is_int($isEdit) && $isEdit > 0)) {
				
				if (!$this->_db->insert('posts', array(
					'creatorID' => $creator,
					'title' => $title . '<br>' . $subtitle,
					'postContent' => $content,
					'isDraft' => $publishOption,
					'isPublished' => $publish,
					'visibility' => $visibility,
					'sticky' => $isSticky
				))) {
					return false;
				}

				$postId = $this->_db->lastId();

			} else {

				$postId = \Elmage\libs\Input::get('EditPost');

				if (!$this->_db->update('posts', 'postID', $postId, array(
					'creatorID' => $creator,
					'title' => $title . '<br>' . $subtitle,
					'postContent' => $content,
					'isDraft' => $publishOption,
					'isPublished' => $publish,
					'visibility' => $visibility,
					'sticky' => $isSticky
				))) {
					return false;
				}

				if (!$this->_db->delete('postcategories', array('postID', '=', $postId))) {
					return false;
				}

			}

			for ($i=0; $i < count($categories); $i++) { 
				
				if (!$this->_db->insert('postcategories', array(
					'postID' => $postId,
					'categoryID' => (int)$categories[$i]
				))) {
					return false;
				}
			}
			
			if ($this->uploadImage()) {
				return $postId;
			}
		}
	}

	public function getPost(int $id) {

		$post = $this->_db->get('posts', array('postID', '=', $id));

		if (!$post) {
			return false;
		}

		$post = $post->first();

		$postCat = $this->_db->get('postcategories', array('postID', '=', $id));

		if (!$postCat) {
			return false;
		}

		$results = [$post, $postCat->results()];

		return $results;
	}

	public function deletePost(int $id) {

		if ($this->_db->delete('postcategories', array('postID', '=', $id)) && $this->_db->delete('posts', array('postID', '=', $id))) {

			return true;
		}

		return false;
	}

	public function deleteUser($id) {

		if (!$this->_db->delete('users', array('id', '=', $id))) {
			return false;
		}
		return true;
	}

	public function migratePosts($prevOwner, $newOwner) {

		if (!$this->_db->update('posts', 'creatorID', $prevOwner, array('creatorID' => $newOwner))) {
			return false;
		}

		return true;
	}

	public function deleteCategory(int $id) {

		//delete categories
		if ($this->_db->delete('postcategories', array('categoryID', '=', $id)) && 
			$this->_db->delete('categories', array('categoryID', '=', $id))) {
			return true;
		}

		return false;
	}

	public function updateCategory($id, $field) {

		//update
		if (!$this->_db->update('categories', 'categoryID', $id, array(
			'categoryName' => $field[0],
			'parent' => $field[1],
			'description' => $field[2]
		))) {
			return false;
		}

		return true;
	} 

	public function trashPost($post, $categoriesJSON) {

		if ($this->_db->insert('trash', array(
			'creatorID' => $post->creatorID,
			'title' => $post->title,
			'categories' => $categoriesJSON,
			'postContent' => $post->postContent,
			'isSpam' => $post->isSpam,
			'isPublished' => $post->isPublished,
			'rating' => $post->rating
		))) {
			return true;
		}

		return false;
	}

	public function getPosts($filter = 'all') {

		$posts = $this->_db->getJoin(['posts', 'postcategories'], ['postID', '=', 'postID'], 'LEFT JOIN');

		$creatorId = $this->getUserId();

		if (!$posts) {
			return false;
		}

		$postsArray = [];
		$j = 0;

		$num = $posts->count();

		if ($filter == 'author') {
			
			for ($i=0; $i < $num; $i++) { 
				
				if ($posts->results()[$i]->creatorID == $creatorId) {
					
					$postsArray[$j] = $posts->results()[$i];

					$j++;
				}
			}

			return $postsArray;
		}

		if ($filter == 'published') {
			
			for ($i=0; $i < $num; $i++) { 
				
				if ($posts->results()[$i]->isPublished == true) {
					
					$postsArray[$j] = $posts->results()[$i];

					$j++;
				}
			}

			return $postsArray;
		}

		if ($filter == 'draft') {
			
			for ($i=0; $i < $num; $i++) { 
				
				if ($posts->results()[$i]->isDraft == true) {
					
					$postsArray[$j] = $posts->results()[$i];

					$j++;
				}
			}

			return $postsArray;
		}

		if (is_array($filter) && isset($filter['category'])) {

			for ($i=0; $i < $num; $i++) { 

				if ($posts->results()[$i]->categoryID == $filter['category']) {
					
					$postsArray[$j] = $posts->results()[$i];

					$j++;
				}
			}

			return $postsArray;
		}
		
		return $posts->results();
	}
}

?>