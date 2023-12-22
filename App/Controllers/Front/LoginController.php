<?php

namespace App\Controllers\Front;

use \Core\Controller;
use \Core\Request;
use \App\Models\User;

class LoginController extends Controller
{
	public function index()
	{
		$this->render('Layout/main', 'Front/login');
	}

	public function signin()
	{
		$request = new Request;
		$user = new User;
		$errors = [];
		if ($request->isPost()) {
			$username = $request->input('username');
			$password = $request->input('password');

			if (empty($username) || empty($password)) {
				$errors[] = 'Veuillez remplir tous les champs';
			} else {
				$userInfos = $user->findUser('username', $username);
				if ($userInfos) {
					// pseudo ok
					if (password_verify($password, $userInfos->password)) {
						// mdp ok

						$infos = [];
						foreach ($userInfos as $prop => $val) {
							if ($prop != 'password') {
								$infos[$prop] = $val;
							}
						}

						$this->session->set('user', $infos);
						header('location:' . ROOT_URL . '/profile');
						exit;
					} else {
						// mdp nok
						$errors[] = 'Erreur sur le pseudo et/ou le mdp';
					}
				} else {
					// pseudo nok
					$errors[] = 'Erreur sur le pseudo et/ou le mdp';
				}
			}
		}
		$this->session->set('errors', $errors);
		$this->render('Layout/main', 'Front/login');
	}
	public function signout()
	{
		$this->session->remove('user');
		header('location:' . ROOT_URL . '/login');
		exit;
	}
}
