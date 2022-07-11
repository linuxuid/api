<?php 
namespace Controllers\Admin;

use Controllers\MainController;
use Exceptions\AvailableUsersExceptions;
use Models\Users\User;
use Models\Users\UserAuthService;

class AdminPanelController extends MainController 
{
    public function __construct()
    {
        parent::__construct();      
    }

    public function index()
    {
        $users = User::findAll();
        
        $user = UserAuthService::getUserByToken() ?? null;

        if($user === null){
            return $this->view->renderHtml('/error/403.php', [], 403);  
        }

        if($user->getName() !== 'admin') {
            return $this->view->renderHtml('/error/403.php', [], 403);        
        } 
   

        $this->view->renderHtml('Admin/users.php', ['users' => $users]);
    }

    public function banUser($id)
    {
        $users = User::find($id);

        $user = UserAuthService::getUserByToken() ?? null;

        if($user === null){
            return $this->view->renderHtml('/error/403.php', [], 403);  
        }

        if($user->getName() !== 'admin') {
            return $this->view->renderHtml('/error/403.php', [], 403);        
        } 

        $users->banStatusUser();
        header('Location: /api/show-users/');
    }

    public function unbanUser($id)
    {
        $users = User::find($id);
        $user = UserAuthService::getUserByToken() ?? null;

        if($user === null){
            return $this->view->renderHtml('/error/403.php', [], 403);  
        }

        if($user->getName() !== 'admin') {
            return $this->view->renderHtml('/error/403.php', [], 403);        
        } 

        $users->unbanStatusUser();
        header('Location: /api/show-users/');
    }
}