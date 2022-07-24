<?php 
namespace Controllers\Anonymity;

use Controllers\MainController;

class AnonymityController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->renderHtml('Anonymity/index.php');
    }
}