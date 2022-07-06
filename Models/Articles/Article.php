<?php 
namespace Models\Articles;

use Models\ActiveRecord\ActiveRecord;

class Article extends ActiveRecord
{
    /** @var int */
    protected $id;

    /** @var int */
    private $authorId;

    /** @var string */
    private $name;

    /** @var string */
    private $text;

    /** @var string */
    private $createdAt;


    /**
    * @return int
    */
    public function getId() : int 
    {
        return $this->id;
    }
        

    /**
     * @param int
     */
    public function setAuthorId(int $num)
    {
        $this->authorId = $num;
    }

    /**
     * @param string
     */
    public function setCreatedAt(string $date)
    {
        $this->createdAt = $date;
    }

    /**
     * @return string
     */
    public function getName() : string 
    {
        return $this->name;
    }

    /**
     * @param $name 
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getText() : string 
    {
        return $this->text;
    }

    /**
     * @param $text
     */
    public function setText(string $text) 
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public static function getTableName() : string 
    {
        return 'articles';
    }


}

