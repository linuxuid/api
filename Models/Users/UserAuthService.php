<?php 
namespace Models\Users;

use Models\Users\User;
use \View\View;

class UserAuthService 
{
    public static function createToken(User $user): void 
    {
        $token = $user->getId() . ':' . $user->getAuthToken();
        setcookie('token', $token, 0, '/', '');
    }

    public static function getUserByToken(): ?User 
    {
        $token = $_COOKIE['token'] ?? '';

        if(empty($token)){
            return null;
        }

        [$userId, $authToken] = explode(':', $token, 2);

        $user = User::find((int) $userId);

        if($user === null) 
        {
            return null;
        }

        if($user->getAuthToken() !== $authToken){
            return null;
        }

        return $user;
    }

    /** logout user */
    public static function deleteToken()
    {
        setcookie('token', '', false, '/', '', false, true);
    }
}