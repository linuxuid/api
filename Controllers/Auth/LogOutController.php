<?php 
namespace Controllers\Auth;

use Controllers\MainController;
use Models\Users\UserAuthService;

class LogOutController extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function exit()
    {
        UserAuthService::deleteToken();
        header('Location: /api');
    }
}