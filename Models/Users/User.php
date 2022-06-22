<?php 
namespace Models\Users;

use Models\ActiveRecord\ActiveRecord;

class User extends ActiveRecord
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $nickname;

    /** @var string */
    protected $email;

    /** @var int */
    protected $isConfirmed;

    /** @var string */
    protected $role;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $authToken;

    /** @var int */
    protected $createdAt;

    public static function getTableName(): string
    {
        return 'users';
    }
}