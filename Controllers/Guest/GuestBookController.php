<?php 
namespace Controllers\Guest;

use Config\Database;
use Controllers\MainController;
use Exceptions\InvalidArgumentException;
use Models\Userscomments\UsersComments;

class GuestBookController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        return $this->view->renderHtml('Guestbook/guestbook.php', 
        [
            'comments' => UsersComments::findAll(),
            'pageCount' => UsersComments::getPageCount(5)
        ]);
    }

    public function store()
    {
        if(!empty($_REQUEST)){
            try {
                UsersComments::validateComments($_REQUEST);
                header('Location: /api/guest-book/');
            } catch(InvalidArgumentException $e) {
                $this->view->renderHtml('Guestbook/guestbook.php', ['error' => $e->getMessage(), 'comments' => UsersComments::findAll()]);
                return; 
            }
        }
    }
}