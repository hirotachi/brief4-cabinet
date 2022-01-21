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

    public function fetchAll()
    {
//        return all patients
        return $this->db->query("select * from ".$this->tableName)->fetchAll();
    }

    public function fetch(int $id)
    {
        return $this->db->query("select * from ".$this->tableName." where id = :id", $id)->fetch();
    }
}
