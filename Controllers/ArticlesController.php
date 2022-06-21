<?php 
namespace Controllers;

use Controllers\MainController;

class ArticlesController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $articles = $this->database->query('SELECT * FROM `articles`;');

        $this->view->renderHtml('Articles/index.php', ['articles' => $articles]);
    }
}