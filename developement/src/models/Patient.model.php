<?php


class Patient extends Base
{
    private array $searchFields = ["email", "firstName", "lastName", "sickness"];

    public function __construct(Database $db, $tableName)
    {
        parent::__construct($db, $tableName);
    }

    public function countPatients($search = "%%")
    {
        return $this->db->query("select count(id) as patients_count from ".$this->tableName." where ".$this->searchFilters(),
            ["search" => $search])->fetchColumn();

    }

    private function searchFilters($paramName = "search"): string
    {
        return implode(" or ", array_map(function ($v) use ($paramName) {
            return "$v like :$paramName";
        }, $this->searchFields));
    }

    public function searchPatients($count = 10, $page = 1, $search = "%%")
    {
        $offset = $count * ($page - 1);
        return $this->db->query("select * from ".$this->tableName." where ".$this->searchFilters()." limit :offset, :count",
            ["search" => $search, "offset" => $offset, "count" => $count])->fetchAll();
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

    public function update(int $id, $updates)
    {
        $patient = $this->fetchById($id);
        if (!$patient) {
            return false;
        }
        $keys = implode(", ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($updates)));
        $this->db->query("update ".$this->tableName." set $keys where id = :id",
            [...$updates, "id" => $id]);
        return [...$patient, ...$updates];
    }

    public function removeById(int $id)
    {
        $deletedCount = $this->db->query("delete from ".$this->tableName." where id = :id", ["id" => $id])->rowCount();
        return $deletedCount !== 0;
    }
}