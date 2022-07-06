<?php 
namespace Controllers\Auth;

use Config\Database;
use Controllers\MainController;
use Exceptions\InvalidArgumentException;
use Models\Articles\Article;
use Models\Users\User;
use Models\Users\UsersActivationService;
use Services\EmailSenderLetters;

class RegisterController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create view page register
     */
    public function create()
    {
        return $this->view->renderHtml('Auth/register.php');
    }

    /**
     * Store data to DB
     */
    public function store()
    {
        if(!empty($_REQUEST)) {
            try {
                $users = User::usersData($_REQUEST);
            } catch (InvalidArgumentException $e) {
                return $this->view->renderHtml('Auth/register.php', ['errors' => $e->getMessage()]);
            }

            if($users instanceof User){
                $code = UsersActivationService::createActivationCode($users);

                EmailSenderLetters::sendLetter($users, 'Activate', 'mail.php', [
                    'userId' => $users->getLastId(),
                    'code' => $code,
                ]);

                return $this->view->renderHtml('Auth/success.php');
            }
        }
    }
}