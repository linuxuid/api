<?php 
namespace Controllers;

use Controllers\MainController;

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
}

?>