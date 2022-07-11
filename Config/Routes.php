<?php 

return [

    /** HomepageController */
    '~about-me/~' => [\Controllers\HomePageController::class, 'description'],
    '~^read-me/$~' => [\Controllers\HomePageController::class, 'index'],
    '~^main-page/$~' => [\Controllers\HomePageController::class, 'create'],
    '~whoami/~' => [\Controllers\HomePageController::class, 'moreAboutMe'],
   
    /** ArticleController */
    '~^delete/(\d+)$~' => [\Controllers\HomePageController::class, 'delete'],

    /** Authentification */
    /** register */
    '~^register/$~' => [\Controllers\Auth\RegisterController::class, 'create'],
    '~^stored-data/$~' => [\Controllers\Auth\RegisterController::class, 'store'],
    /** activate account */
    '~^account/(\d+)/activate/(.+)$~' => [\Controllers\Auth\UsersController::class, 'activate'],
    /** login */
    '~^login/$~' => [\Controllers\Auth\LoginController::class, 'create'],
    /** logout */
    '~^logout/$~' => [\Controllers\Auth\LogOutController::class, 'exit'],

    /** Personal area 
     * set user attributes 
     */
    /** password */
    '~^your-account/$~' => [\Controllers\Personal\UsersAccountController::class, 'index'],
    '~^change-password/$~' => [\Controllers\Personal\UsersAccountController::class, 'storePasswordAttribute'],
    /** email */
    '~^change-email/$~' => [\Controllers\Personal\UsersAccountController::class, 'createEmailAttribute'],
    '~^change-email/(\d+)/confirm/(.+)$~' => [\Controllers\Personal\UsersAccountController::class, 'confirmEmailAttribute'],
    '~change-email/verify~' => [\Controllers\Personal\UsersAccountController::class, 'storeEmailAttribute'],
    /** password */
    '~^forget-password/$~' => [\Controllers\Personal\UsersAccountController::class, 'createResetPasswordAttribute'],
    '~^restore-password/(\d+)/confirm/(.+)$~' => [\Controllers\Personal\UsersAccountController::class, 'confirmResetPasswordAttribute'],
    '~set-password/verify/~' => [\Controllers\Personal\UsersAccountController::class, 'setNewPasswordAttribute'],

    /** Admin Panel */
    '~^show-users/$~' => [\Controllers\Admin\AdminPanelController::class, 'index'],
    '~^change-status-user-to-ban/(\d+)/$~' => [\Controllers\Admin\AdminPanelController::class, 'banUser'],
    '~change-status-user-to-unban/(\d+)/~' => [\Controllers\Admin\AdminPanelController::class, 'unbanUser']
];

?>