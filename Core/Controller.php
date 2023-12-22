<?php 

namespace Core;

class Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = new Session;
    }

    // methode pour gérer les appels du layout, du template et des paramètres
    public function render($layout, $template, $params = [])
    {
        /*
        render('Layout/main', 'Front/index', [
            'listeArticle' => $listeArticle,
            'listeCategory' => ... 
        ]);
        */

        extract($params); // crée une variable pour chaque indice (obligatoirement en string) avec la valeur correspondante

        $content = '';

        // $template = 'Front/index'
        $templatePath = ROOT_PATH . '/../App/Views/' . $template . '.php';
        if(file_exists($templatePath)) {
            // permet de différer les affichages, ils sont placés dans une zone de mise en tampon
            ob_start();
            require $templatePath;
            $content = ob_get_clean(); // place les affichages dans cette variable. 
        }

        // $layout = 'Layout/main'
        $layoutPath = ROOT_PATH . '/../App/Views/' . $layout . '.php';
        if(file_exists($layoutPath)) {
            ob_start();
            require $layoutPath;
            ob_end_flush();
        } else {
            $content;
        }
    }

    // Rajoutez ici toutes les methodes que l'on pourrait trouver sur plusieurs controllers
    // displayMessages()
    // userIsConnected()
    // userIsAdmin()
    // getMenu()
    // ...

    public function displayMessages()
    {
        $displayUserMessage = '';

        if($this->session->has('errors')) {
            $displayUserMessage .= '<div class="alert alert-danger mb-3"><ul class="m-0">';
            foreach($this->session->get('errors') AS $msg) {
                $displayUserMessage .= '<li>' . $msg . '</li>';
            }
            $displayUserMessage .= '</ul></div>';
        }

        if($this->session->has('success')) {
            $displayUserMessage .= '<div class="alert alert-success mb-3"><ul class="m-0">';
            foreach($this->session->get('success') AS $msg) {
                $displayUserMessage .= '<li>' . $msg . '</li>';
            }
            $displayUserMessage .= '</ul></div>';
        }

        $this->session->remove('errors');
        $this->session->remove('success');

        return $displayUserMessage;

    }

    public function userIsConnected()
    {
        return $this->session->has('user');
    }

    public function userIsAdmin()
    {
        if($this->userIsConnected()) {
            $user = $this->session->get('user');
            return $user['status'] == 'ROLE_ADMIN';
        }
        return false;        
    }

    public function getMenu()
    {
        $menu = [
            // 'Accueil' => '/',
            // possibilité de rajouter des liens de menu par défaut
        ];
        if($this->userIsAdmin()) {
            $menu['Gestion'] = ROOT_URL . '/admin';
        }

        if($this->userIsConnected()) {
            $menu['Profil'] = ROOT_URL . '/profile';
            $menu['Déconnexion'] = ROOT_URL . '/login/signout';
        } else {
            $menu['Connexion'] = ROOT_URL . '/login';
            $menu['Inscription'] = ROOT_URL . '/register';
        }

        return $menu;
    }

    



}