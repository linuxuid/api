<?php 
error_reporting(E_ALL); 
ini_set('display_errors', 'on');

try {
require_once __DIR__ . '/Autoload/Autoload.php'; // Use autoload

$route = $_GET['route'] ?? '';
$routes = require_once __DIR__ . '/Config/Routes.php'; 

$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches);
    if (!empty($matches)) {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound) {
    $view = new \View\View(__DIR__ . '/Templates/error/');
    $view->renderHtml('404.php', [], 403) ;
}

unset($matches[0]);

$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);

} catch(\Exceptions\AvailableUsersExceptions $e) {
    $view = new \View\View(__DIR__ . '/Templates/error/');
    $view->renderHtml('banned.php', ['error' => $e->getMessage()], 403) ;
} catch (ArgumentCountError){
    return null;
}

?>