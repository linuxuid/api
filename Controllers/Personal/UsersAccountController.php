<?php 
namespace Controllers\Personal;

use Controllers\MainController;
use Exceptions\InvalidArgumentException;
use Exceptions\CheckEmailException;
use Models\Users\User;
use Models\Users\UserAuthService;
use Models\Users\UsersActivationService;
use Services\EmailSenderLetters;

class UsersAccountController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

    /** password */
    public function index() 
    {
        $this->view->renderHtml('Personal/cabinet.php');
    }

    public function storePasswordAttribute()
    {
        if(!empty($_REQUEST)){
            try {
                $users = User::setPasswordAttribute($_REQUEST);
            } catch(InvalidArgumentException $e) {
                return $this->view->renderHtml('Personal/change-password.php', ['errors' => $e->getMessage()]);
            }   
        }

        if($users instanceof User){
            $this->view->renderHtml('Success/password.php');
            return;
        }

        $this->view->renderHtml('Personal/change-password.php');
    }

    /** email */
    public function createEmailAttribute()
    {
        $authUser = UserAuthService::getUserByToken();
        if(!empty($_REQUEST)){
            try {
                $users = User::validateEmailAttribute($_REQUEST);
            } catch(CheckEmailException $e){
                $this->view->renderHtml('Personal/change-email.php', ['errors' => $e->getMessage()]);
                return;
            }

            if($users instanceof User){
                $code = UsersActivationService::createChangeEmailcode($users);

                EmailSenderLetters::sendLetter($users, 'Change Your Email', 'verify-change-email.php', [
                    'userId' => $authUser->getId(),
                    'code' => $code,
                ]);
            }
        
            $this->view->renderHtml('Personal/change-email.php');
        }
    }

    public function confirmEmailAttribute(int $userId, string $confirmCode)
    {
        $user = User::find($userId);
        $isCheckCode = UsersActivationService::checkChangeEmailcode($user, $confirmCode);
        if($isCheckCode){
            $this->view->renderHtml('Personal/change-email-after-verify.php');
        } else {
            $this->view->renderHtml('error/404.php');
        }
    }

    public function storeEmailAttribute()
    {
        $authUser = UserAuthService::getUserByToken();
        if(!empty($_REQUEST)){
            try{
                $users = User::setEmailAttribute($_REQUEST);
            } catch(CheckEmailException $e) {
                $this->view->renderHtml('Personal/change-email-after-verify.php', ['errors' => $e->getMessage()]);
                return;
            }   

        if($users instanceof User){
            EmailSenderLetters::sendLetter($users, 'Your email has been changed!', 'email-changed.php', [
                'userId' => $authUser->getId(),
            ]);

            $this->view->renderHtml('Success/password.php');
            return;
            }
        }
    }

    /** reset password */
    public function createResetPasswordAttribute()
    {
        if(!empty($_POST)){
            try {
               $users = User::resetPasswordAttribute($_POST);
            } catch(CheckEmailException $e){
                return $this->view->renderHtml('Auth/reset-password.php', ['errors' => $e->getMessage()]);
            }
            

            if($users instanceof User){
                $code = UsersActivationService::createResetPasswordCode($users);

                EmailSenderLetters::sendLetter($users, 'Reset-password', 'reset-password.php', [
                    'userId' => $users->getId(),
                    'code' => $code,
                ]); 
            }
        }
        $this->view->renderHtml('Auth/reset-password.php');
    }

    public function confirmResetPasswordAttribute(int $userId, string $confirmCode)
    {
        $user = User::find($userId);
        $isCheckCode = UsersActivationService::checkResetPasswordCode($user, $confirmCode);
        if($isCheckCode){

            if(!empty($_REQUEST)){
                try {
                    $user = User::setNewPasswordAttribute($userId, $_REQUEST);
                } catch(InvalidArgumentException $e) {
                    $this->view->renderHtml('Personal/change-password-after-verify.php', ['errors' => $e->getMessage()]);
                    return;
                }
            }

            if($user instanceof User){
                $this->view->renderHtml('Success/password.php');
                return;
            }

            $this->view->renderHtml('Personal/change-password-after-verify.php');

        } else {
            $this->view->renderHtml('error/404.php');
        }
    }
}