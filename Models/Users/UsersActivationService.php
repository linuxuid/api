<?php 
namespace Models\Users;

use Config\Database;
use Models\Users\User;

class UsersActivationService 
{
    /** @var const TABLE_NAME 'users_activation_codes' */
    private const TABLE_ACTIVATE = 'users_activation_codes';

    /** @var const TABLE_NAME 'users_change_email_codes' */
    private const TABLE_CHANGE = 'users_change_email_codes';

    /** @var const TABLE_NAME 'users_reset_password_code' */
    private const TABLE_RESET = 'users_reset_password_code';

    /** 2 methods to activate users by email */

    /**
     * @param User
     * @return string
     */
    public static function createActivationCode(User $users) : string 
    {
        $code = bin2hex(random_bytes(16));

        $database = Database::getInstance();

        $database->query(
            'INSERT INTO ' . self::TABLE_ACTIVATE . ' (user_id, code) VALUES (:user_id, :code)',
            [
                'user_id' => $users->getLastId(),
                'code' => $code
            ]
        );
        
        return $code;
    }

    /**
     * @param User
     * @param string
     * @return bool
     */
    public static function checkActivationCode(User $users, string $code) : bool 
    {
        $database = Database::getInstance();

        $result = $database->query(
            'SELECT * FROM ' . self::TABLE_ACTIVATE . ' WHERE user_id = :user_id AND code = :code', ['user_id' => $users->getLastId(), 'code' => $code]
        );

        return !empty($result);
    }

    /** 2 methods to change email */

     /**
     * @param User
     * @return string
     */
    public static function createChangeEmailcode(User $users) : string
    {
        $changeEmailcode = bin2hex(random_bytes(16));

        $users = UserAuthService::getUserByToken(); // get user who logged in
        $database = Database::getInstance(); 

        $database->query(
            'INSERT INTO ' . self::TABLE_CHANGE . ' (user_id, code) VALUES (:user_id, :code)', 
            [
                'user_id' => $users->getId(),
                'code' => $changeEmailcode,
            ]
        );

        return $changeEmailcode;
    }

    /**
     * @param User
     * @param string
     * @return bool|null
     */
    public static function checkChangeEmailcode(User $users, string $code) : bool
    {

        $database = Database::getInstance();

        $result = $database->query(
            'SELECT * FROM ' . self::TABLE_CHANGE . ' WHERE user_id = :user_id AND code = :code', 
            [
                'user_id' => $users->getId(),
                'code' => $code,
            ]
        );
        return !empty($result);
    }

    /** 2 methods to reset password if you forgot */
    
    /**
     * @param string
     * @return string
     */
    public static function createResetPasswordCode(User $users) : string
    {
        $resetPasswordCode = bin2hex(random_bytes(16));

        $database = Database::getInstance();

        $database->query(
            'INSERT INTO ' . self::TABLE_RESET . ' (user_id, code) VALUES (:user_id, :code)',
            [
                'user_id' => $users->getId(),
                'code' => $resetPasswordCode,
            ]
        );

        return $resetPasswordCode;
    }

    /**
     * 
     */
    public static function checkResetPasswordCode(User $users, string $code) : bool 
    {
        $database = Database::getInstance();

        $result = $database->query(
            'SELECT * FROM ' . self::TABLE_RESET . ' WHERE user_id = :user_id AND code = :code',
            [
                'user_id' => $users->getId(),
                'code' => $code,
            ]);

            return !empty($result);
    }
}