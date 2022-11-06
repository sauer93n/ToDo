<?php

namespace ToDo\Microservices;

require_once './vendor/autoload.php';

use \ToDo\Microservices\Router;

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(realpath('./'));
$dotenv->load();

error_reporting(E_ERROR | E_PARSE);

try {
    $router = Router::getInstance();

    $router->get('todos/', 'ToDoController@all');
    $router->get('todo/', 'ToDoController@get');
    $router->post('todo/add/', 'ToDoController@add');
    $router->get('todo/delete/', 'ToDoController@delete');

    $current_request = $router->getCurrent();

    $controller_class = $current_request->getController();

    $controller = new $controller_class();

    $response = $controller->{$current_request->getMethod()}();
    $response->render();
} catch (\Exception $e) {
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
