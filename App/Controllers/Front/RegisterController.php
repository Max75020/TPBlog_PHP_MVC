<?php 

namespace App\Controllers\Front;

use \Core\Controller;
use \Core\Request;
use \App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        // $user = new User;       
        
        $this->render('Layout/main', 'Front/register');
    }

    public function signup()
    {
        // Faire le form dans le template (attention à ne pas oublier l'attribut enctype="")
        // Dans cette methode, on demande si post n'est pas vide
        // on récupère les valeurs du form dans des variable (->input('username'))

        // Les contrôles :
            // username, password et email sont obligatoire 
            // le username on bloque les caractères (regex) pour autoriser : les lettres et les chiffres
            // le username on vérifie s'il est disponible
            // le mdp devra être hash via password_hash(..., PASSWORD_DEFAULT)
            // password + de 4 caractères avec au moins 1 minuscule 1 majuscule, 1 chiffre et 1 caractère spécial
            // if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{4,}$/', $password)) {}
            // l'email on vérifie le format 
            // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {}
            // l'email on vérifie s'il est disponible

            // s'il y a une ou des erreurs, on reste sur la page register et on affiche les erreurs 
            // S'il n'y a pas d'erreur : créer une methode insert([liste_des_colonnes, liste_une_valeur]), faire l'enregistrement
            // Status : ROLE_USER
            // si l'enregistrmeent est ok : on redirige vers /login

            // Pour l'image on enregistre le nom de l'image en bdd (il faut retravailler le nom pour ne pas écraser une image déjà existante)

        $request = new Request;
        $user = new User;

        $errors = [];

        if($request->isPost()) {
            $username = $request->input('username');
            $password = $request->input('password');
            $email = $request->input('email');
            $userpicture = $request->file('userpicture');

            if(!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $errors[] = 'Attention, le pseudo est obligatoire, caractères autorisés : les lettres et les chiffres.';
            }

            if(empty($errors) && $user->checkBy('username', $username)) {
                $errors[] = 'Attention, pseudo indisponible.';
            }

            if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{4,}$/', $password)) {
                $errors[] = 'Attention, le mot de passe doit avoir 4 caractères minimum, doit contenur au moins un chiffre, une lettre minuscule et majuscule ainsi qu\'un caractères spécial';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Attention, format de l\'email incorrect, l\'email est obligatoire';
            }

            if($user->checkBy('email', $email)) {
                $errors[] = 'Attention, email indisponible.';
            }

            if($userpicture && !$request->validateImageFile('userpicture')) {
                $errors[] = 'Attention, formats acceptés pour l\'avatar : png, jpg, jpeg, gif et webp.';
            }

            if(!empty($errors)) {
                $this->session->set('errors', $errors);
                header('location:' . ROOT_URL . '/register');
                exit();
            }

            if(empty($userpicture['name'])) {
                // pas d'image chargée et pas d'erreur : on met un avatar par défaut
                $userpicturePath = 'default_avatar.png';
            } else {
                $userpicturePath = uniqid() . '.' . pathinfo($userpicture['name'], PATHINFO_EXTENSION);
                move_uploaded_file($userpicture['tmp_name'], ROOT_PATH . '/img/avatar/' . $userpicturePath);
            }

            $password = password_hash($password, PASSWORD_DEFAULT);

            $result = $user->insertUser($username, $password, $email, $userpicturePath);

            if($result) {
                $this->session->set('success', ['Votre compte a été créé avec succès, vous pouvez vous connecter']);
                header('location:' . ROOT_URL . '/login');
                // $this->render('Layout/main', 'Front/login');
            } else {
                $this->render('Layout/main', 'Front/register');
            }

        }

        
        
    }


}