<?php 
namespace Controllers;

use Controllers\MainController;
use Models\Articles\Article;
use Models\Users\User;

class ArticlesController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // $articles = Article::findAll();
        $users = User::findAll();

        echo "<pre>";
        var_dump($users);

        $this->view->renderHtml('Articles/index.php', ['users' => $users]);
    }

}