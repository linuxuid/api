<?php 
namespace Controllers\Auth;

use Controllers\MainController;
use Models\Users\User;
use Models\Users\UsersActivationService;

class UsersController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Activate user
    */
    public function activate(int $userId, string $activationCode)
    {
        $user = User::find($userId);
        $isCheckCode = UsersActivationService::checkActivationCode($user, $activationCode);
        if($isCheckCode):
            $user->activate();
            echo 'OK';
        endif;
    }
}