<?php

namespace ToDo\Microservices;

class Response
{

    /**
     * @var string
     */
    public $content;

    public function json($data)
    {
        $data = [
            'content' => $data,
        ];
        $this->content = json_encode($data);
        return $this;
    }

    public function render()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header("Access-Control-Allow-Headers: X-Requested-With");
        header('Content-Type: application/json');
        echo $this->content;
    }
}
