<?php

namespace ToDo\Microservices;


class Request
{
    private $request_method;
    private $url;
    private $controller;
    private $params;
    private $post;
    private $method;

    public function __construct()
    {
        // echo $_SERVER['REQUEST_METHOD'];

        $this->request_method = $_SERVER['REQUEST_METHOD'];

        $this->url = parse_url($_SERVER['REQUEST_URI'])['path'];

        parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $query);

        $this->params = $query;
        $this->post = $_POST;
    }

    public function getRequestMethod()
    {
        return $this->request_method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function getIntParam($param)
    {
        if (!empty($this->params[$param])) {
            return (int) $this->params[$param];
        } else {
            throw new \Exception('Undefined param');
        }
    }

    public function setRoute($route)
    {
        $route = explode('@', $route);

        if (empty($route[0])) {
            throw new \Exception('Not found controller');
        }

        $this->controller = 'ToDo\Controller\\' . $route[0];
        if (empty($route[1])) {
            throw new \Exception('Not found method controller');
        }
        $this->method = $route[1];
    }
}
