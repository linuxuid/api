<?php 

return [

    /** HomepageController */
    '~^$~' => [\Controllers\HomePageController::class, 'index'],
    
    /** ArticleController */
    '~^in-front-of-you/$~' => [\Controllers\ArticlesController::class, 'index'],
];

?>