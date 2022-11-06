<?php

namespace ToDo\Microservices\Controller;

use ToDo\Microservices\Response;
use ToDo\Microservices\Request;
use ToDo\Microservices\Model\ToDoModel;

class ToDoController
{
    private $response;

    /**
     * @var Request
     */
    private $request;

    public function __construct()
    {
        $this->response = new Response();
        $this->request = new Request();
    }

    public function all()
    {
        $todos = ToDoModel::all();
        return $this->response->json($todos);
    }

    public function get()
    {
        $id = $this->request->getIntParam('id');
        $todo = ToDoModel::find($id);
        return $this->response->json($todo);
    }

    public function add()
    {
        $id = ToDoModel::add($this->request->getPost());
        return $this->response->json([
            'id' => $id
        ]);
    }

    public function delete()
    {
        $id = $this->request->getIntParam('id');
        $todo = ToDoModel::delete($id);
        return $this->response->json($todo);
    }
}
