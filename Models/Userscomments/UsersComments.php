<?php 
namespace Models\Userscomments;

use Exceptions\InvalidArgumentException;
use Models\ActiveRecord\ActiveRecord;

class UsersComments extends ActiveRecord {
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $textuser;

    /** @var string */
    protected $createdAt;

    /**
     * @return string 
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTextUser() : string {
        return $this->textuser;
    }

    /**
     * @return string
     */
    public function getDate() : string
    {
        return $this->createdAt;
    }

    /**
     * @return UsersComments
     */
    public static function validateComments(array $data): UsersComments
    {
        if(empty($data['name'])){
            throw new InvalidArgumentException('field "names" is empty');
        }

        if(mb_strlen($data['name']) < 3 or mb_strlen($data['name']) > 10){
            throw new InvalidArgumentException('name should be min 4 and max 10');
        }

        if(empty($data['comment'])){
            throw new InvalidArgumentException('field "comment" is empty');
        }

        if(mb_strlen($data['comment']) > 300){
            throw new InvalidArgumentException('field "comment" should ne no more than 300 symbols');
        }

        $usersComments = UsersComments::findUniqueValues('name', $data['name']);
        if($usersComments !== null) {
            throw new InvalidArgumentException('please choose other name');
        }

        $usersComments = new UsersComments();
        $usersComments->name = $data['name'];
        $usersComments->textuser = $data['comment'];
        $usersComments->createdAt = date("Y-m-d H:i:s");
        $usersComments->save();

        return $usersComments;

    }
   
    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'users_comments';
    }
}