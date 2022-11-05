<?php

namespace ToDo\Microservices;

final class Router
{

    /**
     * @var Request
     */
    private $request;
    private $baseUrl = '/microservices/';

    private static ?Router $instance = null;

    private function __construct()
    {
        $this->request = new Request();
    }

    public static function getInstance()
    {
        if (Router::$instance === null) {
            $instance = new Router();
        }

        return $instance;
    }

    /**
     * @var array request map
     */
    private $map = [];

    public function get($path, $params)
    {
        $this->map['GET'][$this->baseUrl . $path] = $params;
    }

    public function post($path, $params)
    {
        $this->map['POST'][$this->baseUrl . $path] = $params;
    }

    public function getCurrent()
    {
        if (empty($this->map[$this->request->getRequestMethod()])) {
            throw new \Exception('Not found method');
        }
        $current_map = $this->map[$this->request->getRequestMethod()];


        if (empty($current_map[$this->request->getUrl() . '/'])) {
            $current_route = $current_map['/404'];
        } else {
            $current_route = $current_map[$this->request->getUrl() . '/'];
        }

        // var_dump($current_route);

        $this->request->setRoute($current_route);

        return $this->request;
    }
}
