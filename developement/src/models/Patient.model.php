<?php


class Patient extends Base
{
    private array $searchFields = ["email", "firstName", "lastName", "sickness"];

    public function __construct(Database $db, $tableName = "Patient")
    {
        parent::__construct($db, $tableName);
    }

    public function getCount($search = "%%")
    {
        return $this->db->query("select count(id) as patients_count from ".$this->tableName." where ".$this->generateSearchFilters(),
            ["search" => $search])->fetchColumn();

    }

    private function generateSearchFilters($paramName = "search"): string
    {
        return implode(" or ", array_map(function ($v) use ($paramName) {
            return "$v like :$paramName";
        }, $this->searchFields));
    }

    public function search($count = 10, $page = 1, $search = "%%")
    {
        $offset = $count * ($page - 1);
        return $this->db->query("select * from ".$this->tableName." where ".$this->generateSearchFilters()." limit :offset, :count",
            ["search" => $search, "offset" => $offset, "count" => $count])->fetchAll();
    }

}