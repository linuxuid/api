<?php 
namespace Controllers\Auth;

use Controllers\MainController;
use Exceptions\InvalidArgumentException;
use Exceptions\CheckEmailException;
use Models\Users\User;
use Models\Users\UserAuthService;
use Services\EmailSenderLetters;

class LoginController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create view Login page and validate
     */
    public function create()
    {
        if(!empty($_REQUEST)){
            try{
                $user = User::login($_REQUEST);
                UserAuthService::createToken($user);
                header('Location: /api/read-me/');
                exit();
            } catch(InvalidArgumentException $e){
                return $this->view->renderHtml('Auth/login.php', ['errors' => $e->getMessage()]);
            }
        }
        $this->view->renderHtml('Auth/login.php');
    }
}