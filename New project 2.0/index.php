<?php


require_once "vendor/autoload.php";

session_start();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $rout) {
    $rout->addRoute('GET', '/', [\App\Controllers\ApiController::class, "index"]);
    $rout->addRoute('GET', '/register', [\App\Controllers\RegistrationController::class, "showPage"]);
    $rout->addRoute('GET', '/authorization', [\App\Controllers\AuthorizationController::class, "showPage"]);
    $rout->addRoute('POST', '/register', [\App\Services\RegisterService::class, "start"]);
    $rout->addRoute('POST', '/authorization', [\App\Controllers\AuthorizationController::class, "checkLogin"]);
    $rout->addRoute('GET', '/userPage', [\App\Controllers\UserPageController::class, "pageStart"]);
    $rout->addRoute('GET', '/logout', [\App\Logout::class, "Logout"]);

});


$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);
$twig->addGlobal('session', $_SESSION);



// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars

        [$controller, $method] = $handler;
        $response = (new $controller)->{$method}($vars);



        if ($response instanceof App\Template) {
            echo $twig->render($response->getPath(), $response->getParams());
        }
        if ($response instanceof App\Navigation) {
            header("Location: " . $response->getNavigation());
        }

        break;
}






