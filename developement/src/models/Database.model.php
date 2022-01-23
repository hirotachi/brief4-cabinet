<?php

class Database
{
    public PDO $connection;

    public function __construct($uri, $username, $password)
    {
        $driver_options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        $this->connection = new PDO($uri, $username, $password, $driver_options);
    }

    public function query($str, ...$params): bool|PDOStatement
    {
        $stmt = $this->connection->prepare($str);
        preg_match_all("/:\w+/", $str, $matches);

        $stmtParams = $matches[0];
        $paramsLength = count($params);
        $arr = array();
        foreach ($stmtParams as $index => $param) {
            if ($paramsLength - 1 < $index) {
                break;
            }
            $val = $params[$index];
            $arr[$param] = $val;
        }
        $stmt->execute($arr);
        return $stmt;
    }
}