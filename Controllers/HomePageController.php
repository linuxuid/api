<?php 
namespace Controllers;

use Controllers\MainController;
use Models\Articles\Article;

class HomePageController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->renderHtml('Homepage/main.php');
    }

    public function create()
    {
        $this->view->renderHtml('Homepage/present.php');
    }

    public function edit(int $id)
    {
        $articles = Article::find($id);

        if($articles === null):
            $this->view->renderHtml('error/404.php', [], 404);
            return;
        endif;
    }
/*
    public function delete(int $id)
    {
        $article = Article::find($id);

        if($article !== null):
            $article->delete();
            $this->view->renderHtml('Articles/delete.php');
        else:
            $this->view->renderHtml('error/404.php', [], 404);
        endif;
    }
*/
}

?>