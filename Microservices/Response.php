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
        header('Content-Type: application/json');
        echo $this->content;
    }
}
