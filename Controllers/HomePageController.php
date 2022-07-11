<?php 
namespace Controllers;

use Controllers\MainController;
use Exceptions\AvailableUsersExceptions;
use Models\Articles\Article;
use Models\Users\UserAuthService;

class HomePageController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function description()
    {
        $this->view->renderHtml('Homepage/about.php');
    }

    public function moreAboutMe()
    {
        $this->view->renderHtml('Homepage/more-about.php');
    }

    public function index()
    {
        $this->view->renderHtml('Homepage/main.php');
    }

    public function create()
    {
        $this->view->renderHtml('Homepage/present.php');
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