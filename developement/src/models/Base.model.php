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

    public function fetchAll(int $count = 10, int $page = 1)
    {
        $offset = $count * ($page - 1);
        return $this->db->query("select * from ".$this->tableName." limit :offset, :count",
            ["count" => $count, "offset" => $offset])->fetchAll();
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
        $row = $this->fetchById($id);
        if (!$row) {
            return false;
        }
        $keys = implode(", ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($updates)));
        $this->db->query("update ".$this->tableName." set $keys where id = :id",
            [...$updates, "id" => $id]);
        return [...$row, ...$updates];
    }

    public function fetchById(int $id)
    {
        return $this->db->query("select * from ".$this->tableName." where id = :id", ["id" => $id])->fetch();
    }

    public function removeById(int $id): bool
    {
        $deletedCount = $this->db->query("delete from ".$this->tableName." where id = :id", ["id" => $id])->rowCount();
        return $deletedCount !== 0;
    }

    public function findOne(array $filters)
    {
//        todo: add dynamic filters option (and,or,in...)
        $filterQuery = implode(" and ", array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($filters)));
        return $this->db->query("select * from ".$this->tableName." where $filterQuery limit 1", $filters)->fetch();
    }
}
