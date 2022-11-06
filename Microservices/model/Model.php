<?php

namespace ToDo\Microservices\Model;

class Model
{
    public $connect;

    public function __construct()
    {
        $this->connect = new \PDO("sqlite:" . realpath(getenv('SQLITE_FILE')));
        $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // $this->connect->exec("SET CHARACTER SET utf8");
    }

    static public function all()
    {
        $model = new static;
        $result = $model->execute('SELECT * FROM ' . $model->table);

        return $result;
    }

    static public function find($id, $key = false)
    {
        $model = new static;
        if (!$key) {
            $key = $model->key;
        }
        $result = $model->execute('SELECT * FROM ' . $model->table . ' WHERE ' . $key . ' = ?', [$id]);
        return $result;
    }

    static public function add($data)
    {
        $model = new static;
        $result = $model->execute('INSERT INTO ' . $model->table . '(' . implode(', ', $model->postAttributes) . ')' . ' VALUES (' . implode(', ', $data) . ')');

        return $result;
    }

    static public function delete($id, $key = false)
    {
        $model = new static;
        if (!$key) {
            $key = $model->key;
        }
        $result = $model->execute('DELETE FROM ' . $model->table . ' WHERE ' . $key . ' = ?', [$id]);
        return $result;
    }

    public function execute($sql, $params = [])
    {
        $attributes = array_flip($this->getAttributes);
        $result = [];
        $statement = $this->connect->prepare($sql);
        $statement->execute($params);

        foreach ($statement as $row) {

            $result[] = array_filter($row, function ($data) use ($attributes) {
                return isset($attributes[$data]);
            }, ARRAY_FILTER_USE_KEY);
        }
        return $result;
    }
}
