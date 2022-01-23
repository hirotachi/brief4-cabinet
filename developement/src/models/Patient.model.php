<?php


class Patient extends Base
{
    public function __construct(Database $db, $tableName)
    {
        parent::__construct($db, $tableName);
    }

    public function searchPatients($count = 10, $page = 1, $search = "%%")
    {
        return $this->db->query("select * from ".$this->tableName." where email like :search limit ".($count * ($page - 1).", $count"),
            $search)->fetchAll();
    }

    public function create($data)
    {
        $keys = implode(", ", array_keys($data));
        $values = implode(", ", array_map(function ($v) {
            return "'$v'";
        }, $data));
        $query = $this->db->query("insert into ".$this->tableName."($keys) values ($values)");
        $id = $this->db->connection->lastInsertId();
        $data["id"] = $id;
        return $data;
    }

    public function update()
    {
//        todo: implement update patient
    }

    public function remove()
    {
//        todo: implement remove patient
    }
}