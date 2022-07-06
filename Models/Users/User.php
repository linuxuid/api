<?php 
namespace Models\Users;

use Config\Database;
use Exceptions\InvalidArgumentException;
use Exceptions\CheckEmailException;
use Exceptions\CheckPasswordException;
use Models\ActiveRecord\ActiveRecord;
use Models\UsersCode\UserResetPasswordCode;

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

    public function getLastId() : int
    {
        $database = Database::getInstance();
        $ids = $database->query( 'SELECT id FROM users  ORDER BY id desc limit 0, 1;', [], User::class);

        foreach($ids as $id) {
           return $id->getId();
        }
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAuthToken() : string
    {
        return $this->authToken;
    }

    /**
     * @return string
     */
    public function getPasswordHash() : string 
    {
        return $this->passwordHash;
    }

    /**
     * @return User
     */
    public static function usersData(array $usersData) : User
    {
        /** check if field is empty */
        if(empty($usersData['nickname'])){
            throw new InvalidArgumentException('field nickname is empty');
        }

        if(empty($usersData['email'])){
            throw new InvalidArgumentException('field email is empty');
        }

        if(empty($usersData['password'])){
            throw new InvalidArgumentException('field password is empty');
        }

        /** validation */
        if(!preg_match('~^[a-zA-Z0-9]+$~', $usersData['nickname'])){
            throw new InvalidArgumentException('nickname must be contain only latin symbols');
        }

        if(!filter_var($usersData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('email is incorrect');
        }

        if(mb_strlen($usersData['password']) < 8){
            throw new InvalidArgumentException('password is too short, min 8 symbols');
        }

        /** search unique values */
        if(static::findUniqueValues('nickname', $usersData['nickname']) !== null) {
            throw new InvalidArgumentException('this nickname is already taken');
        }

        if(static::findUniqueValues('email', $usersData['email']) !== null) {
            throw new InvalidArgumentException('this email is already taken');
        }

        /** create a new user */
        $user = new User();
        $user->nickname = $usersData['nickname'];
        $user->email = $usersData['email'];
        $user->passwordHash = password_hash($usersData['password'], PASSWORD_DEFAULT);
        $user->isConfirmed = 0;
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->createdAt = date("Y-m-d H:i:s");
        $user->save();    

        return $user;
    }

    /**
     * @param arrray
     * @return User
     */
    public static function login(array $loginData) : User 
    {
        /** check field is empty */
        if(empty($loginData['email']))
        {
            throw new InvalidArgumentException('field email is empty');
        }

        if(empty($loginData['password'])) 
        {
            throw new InvalidArgumentException('field password is empty');
        }

        /** check if user exists */
        $user = User::findUniqueValues('email', $loginData['email']);
        if($user === null) {
            throw new InvalidArgumentException('no user with this email address');
        }

        /** check password */
        if(!password_verify($loginData['password'], $user->getPasswordHash())){ 
            throw new InvalidArgumentException('invalid password');
        }

        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    /** reset password if you forgot */

    /**
     * @param array
     * @return User
     */
    public static function resetPasswordAttribute(array $resetPassword) : User
    {
        $user = User::findUniqueValues('email', $resetPassword['user_email']);
        if($user === null) {
            throw new CheckEmailException('this email does not exists');
        }

        if(empty($resetPassword['user_email'])){
            throw new CheckEmailException('field is empty');
        }

        if(!filter_var($resetPassword['user_email'], FILTER_VALIDATE_EMAIL)) {
            throw new CheckEmailException('email is invalid');
        }

        $user->email = $resetPassword['user_email'];
        return $user;
    } 

    /**
     * @param array
     * @return User
     */
    public static function setNewPasswordAttribute(int $id, array $setPassword) : User 
    {
        $id = User::find($id);
        if(empty($setPassword['reset_password']))
        {
            throw new InvalidArgumentException('');
        }

        if(empty($setPassword['confirm_password']))
        {
            throw new InvalidArgumentException('Confirmation error');
        }

        if(mb_strlen($setPassword['reset_password']) < 6) {
            throw new InvalidArgumentException('password is too short, min 6 symbols');
        }

        /** check validation */
        if($setPassword['reset_password'] !== $setPassword['confirm_password'])
        {
            throw new InvalidArgumentException('The new password does not match in the confirmation');
        }

        $id->passwordHash = password_hash($setPassword['reset_password'], PASSWORD_DEFAULT);
        $id->save();
        return $id;

    }

    /** change password in your account */

    /**
     * @return User
     */
    public static function setPasswordAttribute(array $password) : User
    {
        /** get user who logged in in order to change his password */
        $users = UserAuthService::getUserByToken();

        /** check field is empty */
        if(empty($password['old_password']) and empty($password['new_password']) and empty($password['confirm']))
        {
            throw new InvalidArgumentException('');
        }

        if(empty($password['old_password']))
        {
            throw new InvalidArgumentException('field "old password" is empty');
        }

        if(empty($password['new_password'])) 
        {
            throw new InvalidArgumentException('field "new password" is empty');
        }

        if(empty($password['confirm']))
        {
            throw new InvalidArgumentException('Confirmation error');
        }

        /** check validation */
        if($password['new_password'] !== $password['confirm'])
        {
            throw new InvalidArgumentException('The new password does not match in the confirmation');
        }

        if(!password_verify($password['old_password'], $users->getPasswordHash()))
        {
            throw new InvalidArgumentException('Old password is wrong');
        }

        if($password['old_password'] === $password['new_password'])
        {
            throw new InvalidArgumentException('Old password does match in the new password');
        }

        if(mb_strlen($password['new_password']) < 6){
            throw new InvalidArgumentException('password is too short, min 6 symbols');
        }

        /** change password */
        $users->passwordHash = password_hash($password['new_password'], PASSWORD_DEFAULT);
        $users->save();

        return $users;
    }

    /** change email address in your account */

    /**
     * @param array
     * @return User
     */
    public static function validateEmailAttribute(array $emailAttribute) : User
    {
        /** get user who logged in in order to change his password */
        $users = UserAuthService::getUserByToken();

        if(empty($emailAttribute['old_email'])){
            throw new CheckEmailException('');
        }

        $user = User::findUniqueValues('email', $emailAttribute['old_email']);
        if($user === null) {
            throw new CheckEmailException('this email does not exists');
        }


        if(!filter_var($emailAttribute['old_email'], FILTER_VALIDATE_EMAIL)) {
            throw new CheckEmailException('email is invalid');
        }

        if($user){
            throw new CheckEmailException('please write new email address');
        }
    
        // $users->email = $emailAttribute['old_email'];
        $users->email = $emailAttribute['old_email'];
        return $users;
    }

    /**
     * @param array
     * @return User
     */
    public static function setEmailAttribute(array $setEmail) : User
    {
        $users = UserAuthService::getUserByToken();
    
        if(empty($setEmail['new_email'])){
            throw new CheckEmailException('');
        }

        if(!filter_var($setEmail['new_email'], FILTER_VALIDATE_EMAIL)) {
            throw new CheckEmailException('email is invalid');
        }

        $user = User::findUniqueValues('email', $setEmail['new_email']);

        if($user){
            throw new CheckEmailException('please write new email address');
        }

        $users->email = $setEmail['new_email'];
        $users->save();
        return $users;
    }

    /**
     * Confirm user
     */
    public function activate() : void 
    {
        $this->isConfirmed = 1;
        $this->save();
    }

    public static function getTableName(): string
    {
        return 'users';
    }

    private function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }
}