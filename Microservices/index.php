<?php

namespace ToDo\Microservices;

require_once '../vendor/autoload.php';

use ToDo\Microservices\Router;
use ToDo\Microservices\Request;

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(realpath('../'));
$dotenv->load();

try {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");

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
