<?php 
namespace Controllers;

use \View\View; // use view
use \Config\Database; // use database

class MainController 
{
    /** @var view */
    protected $view;

    /** @var Db */
    protected $database;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../Templates');
        $this->database = new Database();
    }
}