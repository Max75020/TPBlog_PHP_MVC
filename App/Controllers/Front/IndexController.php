<?php 

namespace App\Controllers\Front;

use \Core\Controller;
use \App\Models\Blog;

class IndexController extends Controller
{
    public function  index()
    {
        $blog = new Blog;
        // echo 'Hello';
        $exemple = 'Lorem ipsum';
        $listeProduit = ['pantalon', 'tshirt', 'echarpe'];
        $this->render('Layout/main', 'Front/index', [
            'affichage' => $exemple,
            'listeProduit' => $blog->findAll(),
        ]);
    }



}