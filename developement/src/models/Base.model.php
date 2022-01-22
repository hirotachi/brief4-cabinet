<?php

class Base
{
    private Database $db;
    private string $tableName;

    public function __construct(Database $db, $tableName)
    {
        $this->tableName = $tableName;
        $this->db = $db;
    }

    public function fetchAll(int $count = 10, int $page = 0)
    {
        return $this->db->query("select * from ".$this->tableName." limit ".($count * ($page - 1)).", :count",
            $count)->fetchAll();
    }

    public function fetch(int $id)
    {
        return $this->db->query("select * from ".$this->tableName." where id = :id", $id)->fetch();
    }
}
