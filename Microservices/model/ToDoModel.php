<?php

namespace ToDo\Microservices\Model;

use ToDo\Microservices\Model\Model;


class ToDoModel extends Model
{
    public $table = 'todos';
    public $key = 'id';

    public $getAttributes = [
        'id',
        'title',
        'body',
        'user_id'
    ];

    public $postAttributes = [
        'title',
        'body',
        'user_id'
    ];
}
