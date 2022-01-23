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
//        todo: implement create patient
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