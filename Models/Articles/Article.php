<?php 
namespace Models\Articles;

use Models\ActiveRecord\ActiveRecord;

class Article extends ActiveRecord
{
    /** @var int */
    protected $id;

    /** @var int */
    protected $authorId;

    /** @var string */
    private $name;

    /** @var string */
    private $text;

    /** @var string */
    protected $createdAt;

    /**
     * @return string
     */
    public function getName() : string 
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getText() : string 
    {
        return $this->text;
    }

    public static function getTableName() : string 
    {
        return 'articles';
    }


}

