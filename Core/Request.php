<?php

namespace Core;

class Request
{

	public function getUrl()
	{
		// Par exemple pour cette url : 
		// 01 : http://localhost/PHP_heimdall_11/projet/?arg=valeur&arg2=valeur2
		// 02 : http://localhost/PHP_heimdall_11/projet/login/signout/

		// on récupère ce qui se trouve après le nom de domaine :
		// /PHP_heimdall_11/projet/?arg=valeur&arg2=valeur2
		$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		// echo '01 : ';
		// var_dump($url);
		// C:\wamp64\www\PHP_heimdall_11\projet\Core\Request.php:17:string '/PHP_heimdall_11/projet/' (length=24)

		// on enlève les potentielles informations GET
		// 01 : /PHP_heimdall_11/projet/
		// 02 : /PHP_heimdall_11/projet/login/signout/
		$url = strtok($url, '?');

		// echo '02 : ';
		// var_dump($url);
		// C:\wamp64\www\PHP_heimdall_11\projet\Core\Request.php:24:string '/PHP_heimdall_11/projet/' (length=24)

		// Si on change de serveur, logiquement on aura que le nom de domaine. Dans le cadre de notre travail en local, on enlève l'arborescence d'accès à notre projet
		// 01 : on obtient : /
		// 02 : on obtient : /login/signout
		// CHEMIN A MODIFIER
		if (strpos($url, '/TPBlog') === 0) {
			$url = substr($url, strlen('/TPBlog'));
		}
		// CHEMIN A MODIFIER
		// echo '03 : ';
		// var_dump($url);
		// C:\wamp64\www\PHP_heimdall_11\projet\Core\Request.php:35:string '/' (length=1)

		return $url;
	}
	public function isPost()
	{
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}

	public function isGet()
	{
		return $_SERVER['REQUEST_METHOD'] === 'GET';
	}

	public function input($key, $default = null)
	{
		if (isset($_POST[$key]) && is_array($_POST[$key])) {
			return isset($_POST[$key]) ? $_POST[$key] : $default;
		}
		return isset($_POST[$key]) ? trim($_POST[$key]) : $default;
	}

	public function get($key, $default = null)
	{
		return isset($_GET[$key]) ? trim($_GET[$key]) : $default;
	}

	public function file($key)
	{
		return !empty($_FILES[$key]['name']) ? $_FILES[$key] : null;
	}

	public function validateImageFile($field, $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'webp'])
	{
		// si une image a bien été chargée
		if (!isset($_FILES[$field]) || $_FILES[$field]['error'] != 0) {
			return false;
		}

		$fileInfo = new \finfo(FILEINFO_MIME_TYPE);
		// On récupère le type mime du fichier
		$fileMimeType = $fileInfo->file($_FILES[$field]['tmp_name']);
		// on récupère l'extension du fichier
		$fileExtension = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));

		// on défini les type mime acceptés
		$allowedMimeTypes = [
			'png' => 'image/png',
			'jpg' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'gif' => 'image/gif',
			'webp' => 'image/webp'
		];

		// on vérifie si le type mime correspond à ceux autorisés
		$validMimeType = false;
		foreach ($allowedExtensions as $extension) {
			if (isset($allowedMimeTypes[$extension]) && $allowedMimeTypes[$extension] === $fileMimeType) {
				$validMimeType = true;
				break;
			}
		}

		// on renvoie true/false selon le type mine + true/false selon si l'extension est autorisées
		return $validMimeType && in_array($fileExtension, $allowedExtensions);
	}
}
