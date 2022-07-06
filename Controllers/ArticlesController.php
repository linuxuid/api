<?php 
namespace Controllers;

use Controllers\MainController;
use Models\Articles\Article;
use Models\Users\User;

class ArticlesController extends MainController 
{
    public function __construct()
    {
        parent::__construct();
    }

}

/**
 *      $article = new Article();
        $article->setName('Новый статья');
        $article->setText('Новый текста');
        $article->authorId = '1';
        $article->createdAt = date(c);
        $article->save();
 */