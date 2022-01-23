<?php

class Base
{
    protected Database $db;
    protected string $tableName;

    public function __construct(Database $db, $tableName)
    {
        $this->tableName = $tableName;
        $this->db = $db;
    }

    public function fetchAll(int $count = 10, int $page = 0, string $search = "")
    {
        return $this->db->query("select * from ".$this->tableName." limit ".($count * ($page - 1)).", :count",
            $count)->fetchAll();
    }

    public function fetchById(int $id)
    {
        return $this->db->query("select * from ".$this->tableName." where id = :id", ["id" => $id])->fetch();
    }
}
