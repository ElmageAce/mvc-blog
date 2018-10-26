<?php
namespace Elmage\libs;

class View {

	private $_msg;
	//public $js;
	public $loginStatus;
	public $pageData = [];
	public $posts;
	public $post;
	public $cats;
	public $author;
	public $authorData;
	public $allAuthors;
	public $allPost;
	public $users;
	public $catToEdit;
	public $profileData;
	public $postList;
	
	function __construct() {
		//
	}

	public function getAuthor($id) {

		for ($i=0; $i < count($this->allAuthors); $i++) { 
			
			if ($id == $this->allAuthors[$i]->id) {
				return $this->allAuthors[$i]->displayName;
			}
		}
	}

	public function postAuthor() {
		return $this->author;
	}

	public function getPostContent($field) {

		if ($field == false OR $this->post == false) {
			return false;
		}

		$titles = explode('<br>', $this->post->title);

		if ($field === 'title') {
			
			return $titles[0];
		} elseif ($field === 'sub-title') {

			return $titles[1];
		} elseif ($field === 'author') {
			
			return $this->postAuthor();
		} elseif ($field === 'date') {
			
			return \formatDate($this->post->dateAdded, true);
		} elseif ($field === 'content') {
			
			return $this->post->postContent;
		}
	}

	public function countUsers($role = null) {

		if (empty($this->pageData['users'])) {
			return 'no data';
		}

		$num = count($this->pageData['users']);

		if (!$role) {
			return $num;
		}

		$j = 0;
		for ($i=0; $i < $num; $i++) { 
			
			if ($role == $this->pageData['users'][$i]->userType) {
				
				$j++;
			}
		}

		return $j;

	}

	public function postCount($filter = 'all') {

		$posts = $this->allPost;

		$num = count($posts);

		$creatorId = 1;

		$entryCount = 0;

		for ($i=0; $i < $num; $i++) {

			if ($i > 0 && $posts[$i]->postID === $posts[$i - 1]->postID) {
                continue;
            } 
			
			switch ($filter) {
				case 'all':
					
					$entryCount++;
					break;

				case 'author':
					
					if ($posts[$i]->creatorID == $creatorId) {
						
						$entryCount++;
					}

					break;

				case 'published':
					
					if ($posts[$i]->isPublished == true) {
						
						$entryCount++;
					}
					
					break;

				case 'draft':
					
					if ($posts[$i]->isDraft == true) {
						
						$entryCount++;
					}
					
					break;

				case 'sticky':
					
					if ($posts[$i]->sticky == true) {
						
						$entryCount++;
					}
					
					break;

				case 'pending':
					
					if ($posts[$i]->isApproved == false && $posts[$i]->isSpam == false) {
						
						$entryCount++;
					}
					
					break;
			}
		}

		return $entryCount;
	}

	public function setPageData($data = array()) {

		//$this->pageData = $data;

		$this->pageData = array_merge($this->pageData, $data);
	}

	public function getCatName($int) {

		$categories = $this->pageData['categories'];

		for ($i=0; $i < count($categories); $i++) { 
			
			if ($categories[$i]->categoryID == $int) {
				
				$parent = (int)$categories[$i]->parent;

				if ($parent === 0) {
					
					return $categories[$i]->categoryName;

				} elseif ($parent > 0) {

					return '__' . $categories[$i]->categoryName;
				}
			}
		}
	}

	public function getCategoryName($id) {

		if ($id === 0) {
			return '';
		}

		$categories = $this->cats;

		if (!$categories) {
			return false;
		}

		$num = count($categories);

		$catName = false;

		for ($i=0; $i < $num; $i++) { 
			
			if ($id == $categories[$i]->categoryID) {
				
				$catName = $categories[$i]->categoryName;

				break;
			}
		}

		return $catName;
	}

	public function getMessage() {
		return $this->_msg;
	}

	public function getHeader($name, $login) {

		if ($login === true && strpos($name, "dashboard") !== false) {
			require_once $_SERVER['DOCUMENT_ROOT'] . '/mvcblog/views/dashboard/header.php';
		} else {
			require_once $_SERVER['DOCUMENT_ROOT'] . '/mvcblog/fragments/header.inc.php';
		}
	}

	public function getFooter($name, $login) {

		if ($login === true && strpos($name, "dashboard") !== false) {
			require_once $_SERVER['DOCUMENT_ROOT'] . '/mvcblog/views/dashboard/footer.php';
		} else {
			require_once $_SERVER['DOCUMENT_ROOT'] . '/mvcblog/fragments/footer.inc.php';
		}
	}

	public function getSidebar($name, $login) {

		if ($login === true && strpos($name, "dashboard") !== false) {
			require_once $_SERVER['DOCUMENT_ROOT'] . '/mvcblog/views/dashboard/sidebar.php';
		}
	}

	public function getContent($name, $login) {

		if ($login === true && $name === 'login/index') {
			
			require_once 'views/index/index.php';

		} elseif ($login == false && strpos($name, "dashboard") !== false) {
			
			require_once 'views/login/index.php';

		} else {

			require_once 'views/' . $name . '.php';
		}

	}

	public function render($name, $login) {

		$this->getHeader($name, $login);

		$this->getSidebar($name, $login);

		$this->getContent($name, $login);

		$this->getFooter($name, $login);
		
	}

	public function sortCat(int $catId, array $post) {

		for ($i=0; $i < count($post); $i++) { 
			
			if ($catId == $post[$i]->categoryID) {
				
				return 'checked';
			}
		}

		return '';
	}
}

?>