<?php 

namespace Core;

class Router
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function route()
    {
        $url = $this->getRequest()->getUrl();

        if ($this->parseBackOfficeRoute($url)) {
            return;
        }

        $this->parseFrontOfficeRoute($url);
    }

    // private function redirectToIndex()
    // {
    //     $indexController = new \App\Controllers\Front\IndexController();
    //     $indexController->index();
    // }

    public function parseFrontOfficeRoute($url)
    {  
        // Supprimez les caractères non autorisés de l'URL
        $url = preg_replace('/[^a-zA-Z0-9\/_-]/', '', $url);

        // Divisez l'URL en segments (controller, action, ...)
        // /
        // /index/filtre
        // /article/index/123
        $segments = explode('/', trim($url, '/'));
        // var_dump($segments);

        // Déterminez le contrôleur et l'action
        $controllerName =  !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'IndexController';
        $actionName =  !empty($segments[1]) ? $segments[1] : 'index';

        // récupération des arguments à la suite du controller et de l'action depuis l'url
        $params = array_slice($segments, 2);
        // var_dump($params);
        $controllerPath = sprintf('%s/App/Controllers/Front/%s.php', __DIR__ . '/..', $controllerName);
        if (!file_exists($controllerPath)) {
            // $this->redirectToIndex();
            header('Location:' . ROOT_URL);
            return;
        }

        // Utilisez l'espace de noms pour le contrôleur
        $controllerClass = "App\\Controllers\\Front\\" . $controllerName;

        // Instanciez le contrôleur et appelez l'action
        $controller = new $controllerClass();

        if (!method_exists($controller, $actionName)) {
            //$this->redirectToIndex();
            //return;
            $actionName = 'index';
        }

        // $controller->$actionName();
        call_user_func_array([$controller, $actionName], $params);
        return true;
    }

    public function parseBackOfficeRoute($url)
    {
        
        if (substr($url, 0, 6) !== '/admin') {
            return false;
        }

        // Supprimez les caractères non autorisés de l'URL
        $url = preg_replace('/[^a-zA-Z0-9\/_-]/', '', $url);

        // Divisez l'URL en segments (controller, action, ...)
        $segments = explode('/', trim(substr($url, 6), '/'));
        /*
        0 => controller
        1 => action
        2 => arg1
        3 => arg2
        ...
        */
        
        $controllerName =  !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'IndexController';
        $actionName =  !empty($segments[1]) ? $segments[1] : 'index';

        $params = array_slice($segments, 2);
        /*
        0 => arg1
        1 => arg2
        ...
        */

        $controllerPath = sprintf('%s/App/Controllers/Back/%s.php', __DIR__ . '/..', $controllerName);
        if (!file_exists($controllerPath)) {
            // $this->redirectToIndex();
            header('Location:' . ROOT_URL);
            return;
        }

        // Utilisez l'espace de noms pour le contrôleur
        $controllerClass = "App\\Controllers\\Back\\" . $controllerName;

        // Instanciez le contrôleur et appelez l'action
        $controller = new $controllerClass();

        if (!method_exists($controller, $actionName)) {
            //$this->redirectToIndex();
            //return;
            $actionName = 'index';
        }

        // $controller->$actionName();
        call_user_func_array([$controller, $actionName], $params);
        return true;
    }
}