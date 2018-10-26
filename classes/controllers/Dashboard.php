<?php
namespace Elmage\controllers;
use Elmage\models;

/**
 * Dashboard class
 */
class Dashboard extends \Elmage\libs\Controller {

	public $link;
	public $_model;
	private $_pageId;
	public $pageData = [];
	
	function __construct(models\Dashboard $dashboard, \Elmage\libs\View $view) {

		parent::__construct($view);

		$this->_model = $dashboard;
		
		$this->link = 'dashboard/index';

		//set posts ppty
		$allPost = $this->getPosts();

		$this->view->posts = $allPost;

		$this->view->allPost = $allPost;

		//set categories
		$this->view->cats = $this->_model->getCategories();

		//set users
		$users = $this->_model->getUsers();

		$data['users'] = $users;

		$this->view->users = $users;

		$this->view->setPageData($data);

	}

	public function profile($userId = null) {

		if (!$userId) {
			$userId = $this->_model->getUserId();
		}
		//get user data
		$data = $this->_model->getUserData($userId);

		$data->password = 'PROTECTED';
		//set data
		$this->view->profileData = $data;

		$this->link = 'dashboard/profile';
	}

	public function updateProfile($userId) {

		if (\Elmage\libs\Input::exists()) {
			
			$fullname = $_POST['last_name'] . ' ' . $_POST['first_name'];

			$displayName = $_POST['publish_name'];

			$email = $_POST['email'];

			$bio  = $_POST['bio'];

			$loggedUser = $this->_model->getUserId();

			if ($userId == $loggedUser OR $this->_model->levelClearance(5) === true) {

				$this->_model->updateUserData($userId, array(
					'fullname' => $fullname,
					'displayName' => $displayName,
					'email' => $email,
					'bio' => $bio
				));
			}

			header('Location: ' . URL . 'dashboard/profile/' . $userId);
		}
	}

	public function userMod() {
		//get user id
		$id = $this->_model->getUserId();

		if (\Elmage\libs\Input::exists()) {
			
			$action = $_POST['action'];

			$role = $_POST['userRole'];

			$userIds = $_POST['chkbox'];

			$submit = $_POST['apply'];

			if ($action === 'remove' && $submit === 'moduser') {
				//can user delete
				if ($this->_model->levelClearance(5)) {
					
					$num = count($userIds);

					for ($i=0; $i < $num; $i++) { 
						//get user id
						$userId = $userIds[$i];

						if ($id != $userId) {
							//migrate to user deleteing post
							if ($this->_model->migratePosts($userId, $id)) {
								
								//delete user
								$this->_model->deleteUser($userId);
							}
						}

					}

					//$this->link = 'dashboard/users';
				}
				
			}

			if ($submit === 'change') {
				
				//change user role
				if ($this->_model->levelClearance(5)) {
					
					$num = count($userIds);

					for ($i=0; $i < $num; $i++) { 
						//get user id
						$userId = $userIds[$i];

						if ($id != $userId) {
							//migrate to user deleteing post
							$this->_model->changeUserRole($role, $userId);
						}

					}

					//$this->link = 'dashboard/users';
				}
			}

		}

		header('Location: ' . URL . 'dashboard/pages/users');

	}

	public function pages($name = 'index') {
		$this->link = 'dashboard/' . $name;

		if ($name == 'profile') {
			$this->link = 'dashboard/index';
		}
		
	}

	public function filter($filter = 'all') {

		$posts = $this->getPosts($filter);

		$this->view->posts = $posts;

		$this->pages('posts');

	}

	public function filterPost($filter = '') {
		//check if input exists
		if (\Elmage\libs\Input::exists()) {
			//get filter
			$action = (!empty($_POST['actions']))? $_POST['actions'] : false;

			$dateFilter = $_POST['dateFilter'];

			$category = (int) $_POST['cat'];

			$apply = $_POST['apply'];

			//$filter = $_POST['filter'];

			$postsID = (!empty($_POST['chkbox'])) ? $_POST['chkbox'] : false;

			if ($apply == 'post') {
				
				if ($action === 'edit' && is_array($postsID) && count($postsID) === 1) {

					$this->_pageId = (int) $postsID[0];

					$this->link = 'dashboard/newpost';
				}

				if ($action === 'trash') {
					
					$num = count($postsID);

					for ($i=0; $i < $num; $i++) { 

						$postId = (int) $postsID[$i];
						
						//get post
						$post = $this->_model->getPost($postId);
						//delete the post
						if ($this->_model->deletePost($postId) && $this->_model->trashPost($post[0], json_encode($post[1]))) {
							
							//redirect to error page
						}
					}

					$this->link = 'dashboard/posts';
				}

			} elseif ($apply == 'filter') {

				//check if categories is selected
				if (is_int($category)) {
					//get filtered posts using categories
					$posts = $this->_model->getPosts(['category' => $category]);
				} else {
					//get full posts
					$posts = $this->_model->getPosts();
				}

				//if date filter var isset, filter
				if (strlen($dateFilter) > 4) {
					
					$num = count($posts);

					$j = 0; //counter for filtered data

					$postsArray = [];

					for ($i=0; $i < $num; $i++) {

						$date = $posts[$i]->dateAdded; 
					 	
					 	$dateString = \formatDate($date, "F Y");

					 	if ($dateFilter == $dateString) {
					 		//assign to array
					 		$postsArray[$j] = $posts[$i];

					 		$j++;
					 	}
					}

					$posts = $postsArray; 
				}

				$this->view->posts = $posts;

				$this->link = 'dashboard/posts';
			}
		}
	}

	public function filterUsers($role = null) {

		//get users
		$users = $this->_model->getUsers();

		$num = count($users);

		$usersArray = [];

		$j = 0;
		//filter users
		for ($i=0; $i < $num; $i++) {

			if (!$role) {
			 	$usersArray[$j] = $users[$i];

				$j++;
			 } 
			
			if ($role == $users[$i]->userType) {
				
				$usersArray[$j] = $users[$i];

				$j++;
			}
		}

		$this->view->users = $usersArray;

		$this->link = 'dashboard/users';
	}

	public function savePost() {
		$save = $this->_model->save();

		if ($save == true) {
			header('Location: ' . URL . 'page/pages/' . $save);
		} else {
			header('Location: ' . URL . 'dashboard/pages/posts');
		}
	}

	public function loadPage($link, $isLoggedIn) {

		$data['categories'] = $this->_model->getCategories();

		$this->view->setPageData($data);

		if ($this->_pageId) {

			$postData['postData'] = $this->_model->getPost($this->_pageId);

			$this->view->setPageData($postData);
		}

		$this->view->render($link, $isLoggedIn);
		
	}

	public function getPosts($filter = 'all') {
		$posts = $this->_model->getPosts($filter);

		return $posts;
	}


	public function modCategory($moderation) {
		//get variables
		$catName = (!empty($_POST['category_name']))? $_POST['category_name'] : false;

		$parentCategory = (!empty($_POST['parent']))? $_POST['parent'] : false;

		$desc = (!empty($_POST['description']))? $_POST['description'] : false;

		$action = (!empty($_POST['actions']))? $_POST['actions'] : false;

		$categories = (!empty($_POST['categoryCheck']))? $_POST['categoryCheck'] : false;

		if ($moderation === 'moderate') {
			
			if ($action === 'editCategory' && is_array($categories)) {

				$catToEdit = $this->_model->getCategory($categories[0]);
				//edit category
				$this->view->catToEdit = $catToEdit;

				$this->link = 'dashboard/editCategory';
			}

			if ($action === 'deleteCategory' && is_array($categories)) {
				//delete category
				$num = count($categories);

				for ($i=0; $i < $num; $i++) { 
					
					$id = $categories[$i];

					$delete = $this->_model->deleteCategory($id);
				}

				header('Location:' . URL . 'dashboard/pages/editCategory');
				//$this->link = 'dashboard/editCategory';
			}
		}

		if ($moderation === 'modify') {
			
			//check if new or update
			$status = $_POST['status'];

			if ($status === 'new') {
				
				//insert new categories
				if ($this->_model->newCategory(array($catName, $parentCategory, $desc))) {//name, parent, desc
					header('Location:' . URL . 'dashboard/pages/editCategory');
				}

				$this->link = 'dashboard/editCategory';

			} else {

				$id = (int) $_POST['status'];

				//insert new categories
				if ($this->_model->updateCategory($id, array($catName, $parentCategory, $desc))) {//name, parent, desc
					header('Location:' . URL . 'dashboard/pages/editCategory');
				}

				$this->link = 'dashboard/editCategory';

			}
		}
	}
}

?>