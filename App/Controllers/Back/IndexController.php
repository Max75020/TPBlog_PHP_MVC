<?php

namespace App\Controllers\Back;

use \Core\Controller;
use \Core\Request;
use \App\Models\Blog;

class IndexController extends Controller
{
	public function index()
	{
		$blog = new Blog;

		$this->render('Layout/back', 'Back/index', [
			'listeCategories' => $blog->findAllCategories(),
			'listeKeywords' => $blog->findAllKeywords(),
		]);
	}

	// dans le Model Blog faire les methodes suivantes :
	// - insertCategory($category)
	// - deleteCategory($id)
	// - findAllCategories()

	// - insertKeyword($keyword)
	// - deleteKeyword($id)
	// - findAllKeywords()

	// Dans la page Dashboard faire un form permettant d'enregistrer une une categorie, un mot clé
	// une liste ul li qui liste les categories en dessous du form, pareil pour les mots clés
	// dans cette liste un lien (avec l'id) pour déclencher la suppression

	public function addcategory()
	{
		$blog = new Blog;
		$request = new Request;

		$errors = [];
		if ($request->isPost()) {
			$category = $request->input('category');

			if (empty($category)) {
				$errors[] = 'La catégorie est obligatoire';
			}

			if (empty($errors) && $blog->checkCategory('category', $category)) {
				$errors[] = 'La catégorie existe déjà';
			}

			if (!empty($errors)) {
				$this->session->set('errors', $errors);
				header('location:' . ROOT_URL . '/admin');
				exit;
			}

			$result = $blog->insertCategory($category);
			if ($result) {
				$this->session->set('success', ['Nouvelle catégorie enregistrée']);
			} else {
				$this->session->set('errors', ['Une erreur imprévue s\'est produite.']);
			}
			header('location:' . ROOT_URL . '/admin');
		}
	}

	public function addkeyword()
	{
		$blog = new Blog;
		$request = new Request;

		$errors = [];
		if ($request->isPost()) {
			$keyword = $request->input('keyword');

			if (empty($keyword)) {
				$errors[] = 'Le mot clé est obligatoire';
			}

			if (empty($errors) && $blog->checkKeyword('keyword', $keyword)) {
				$errors[] = 'Le mot clé existe déjà';
			}

			if (!empty($errors)) {
				$this->session->set('errors', $errors);
				header('location:' . ROOT_URL . '/admin');
				exit;
			}

			$result = $blog->insertKeyword($keyword);
			if ($result) {
				$this->session->set('success', ['Nouveau mot clé enregistré']);
			} else {
				$this->session->set('errors', ['Une erreur imprévue s\'est produite.']);
			}
			header('location:' . ROOT_URL . '/admin');
		}
	}

	public function deletecategory($id_category)
	{
		$blog = new Blog;
		// $errors = [];

		$result = $blog->deleteCategory($id_category);

		if ($result) {
			$this->session->set('success', ['La catégorie a bien été supprimé']);
		} else {
			$this->session->set('errors', ['Une erreur imprévue s\'est produite.']);
		}
		header('location:' . ROOT_URL . '/admin');
	}

	public function deletekeyword($id_keyword)
	{
		$blog = new Blog;
		// $errors = [];

		$result = $blog->deleteKeyword($id_keyword);

		if ($result) {
			$this->session->set('success', ['Le mot clé a bien été supprimé']);
		} else {
			$this->session->set('errors', ['Une erreur imprévue s\'est produite.']);
		}
		header('location:' . ROOT_URL . '/admin');
	}


	// Faire un formulaire de création d'article avec :
	// - title : input
	// - content : textarea
	// - main_image : input type="file"
	// - keyword : select (simple ou multiple name="keyword[]") 
	// - category : select (simple ou multiple name="category[]") 
	// - submit

	// Lors de la validation
	// - addpost()
	// title, content, main_image
	// + date_created => NOW()
	// user_id => $user = $this->session->get('user') : on récupère le array, ensuite : $user['id_user']

	// Ensuite il faut récupérer le dernier id inséré dans la bdd
	// Ensuite faire une insertion dans les tables post_keyword et post_category
	// post_id sera l'id récupéré ensuite une insertion pour chaque categorie et/ou mot clé

	public function addpost()
	{
		$blog = new Blog;
		$request = new Request;

		$errors = [];
		if ($request->isPost()) {
			$title = $request->input('title');
			$content = $request->input('content');
			$mainImg = $request->file('main_img');
			$category = $request->input('category');
			$keyword = $request->input('keyword');

			$userInfos = $this->session->get('user');
			$userId = $userInfos['id_user'];

			// on transforme les retours à la ligne du textarea en <br> (PHP_EOL reconnait les différents caractères de retour à la ligne)
			$content = str_replace(PHP_EOL, '<br>', $content);

			if (empty($title)) {
				$errors[] = 'Le titre est obligatoire';
			}
			if (empty($content)) {
				$errors[] = 'Le contenu est obligatoire';
			}
			if (empty($mainImg)) {
				$errors[] = 'L\'image est obligatoire';
			}
			if ($mainImg && !$request->validateImageFile('main_img')) {
				$errors[] = 'Attention, formats acceptés pour l\'avatar : png, jpg, jpeg, gif et webp.';
			}

			if (!empty($errors)) {
				$this->session->set('errors', $errors);
				header('location:' . ROOT_URL . '/admin');
				exit;
			}


			$mainImgPath = uniqid() . '.' . pathinfo($mainImg['name'], PATHINFO_EXTENSION);
			move_uploaded_file($mainImg['tmp_name'], ROOT_PATH . '/img/post/' . $mainImgPath);


			$result = $blog->insertPost($title, $content, $mainImgPath, $userId);
			if ($result) {
				// $this->session->set('success', ['Nouveau mot clé enregistré']);

				$postId = $blog->getLastInsertId();
				if (!empty($category)) {
					if (is_array($category)) {
						foreach ($category as $categoryId) {
							$result = $blog->insertPostCategory($postId, $categoryId);
						}
					} else {
						$result = $blog->insertPostCategory($postId, $category);
					}
				}

				if (!empty($keyword)) {
					if (is_array($keyword)) {
						foreach ($keyword as $keywordId) {
							$result = $blog->insertPostKeyword($postId, $keywordId);
						}
					} else {
						$result = $blog->insertPostKeyword($postId, $keyword);
					}
				}
				$this->session->set('success', ['Article enregistré']);
				header('location:' . ROOT_URL . '/admin');
			} else {
				$this->session->set('errors', ['Une erreur imprévue s\'est produite.']);
			}
			header('location:' . ROOT_URL . '/admin');
		}
	}
}
