<?php

class Database
{
    private PDO $pdo;

    public function __construct($uri, $username, $password)
    {
        $driver_options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        $this->pdo = new PDO($uri, $username, $password, $driver_options);
    }

    public function query($str, ...$params): bool|PDOStatement
    {
        $stmt = $this->pdo->prepare($str);
        preg_match_all("/:\S+/", $str, $matches);
        $stmtParams = $matches[0];
        $paramsLength = count($params);
        foreach ($stmtParams as $index => $param) {
            if ($paramsLength - 1 < $index) {
                break;
            }
            $val = $params[$index];
            $paramType = match (gettype($val)) {
                "string" => PDO::PARAM_STR,
                "integer", "double" => PDO::PARAM_INT,
                "boolean" => PDO::PARAM_BOOL,
            };
            $stmt->bindParam($param, $val, $paramType);
        }
        $stmt->execute();
        return $stmt;
    }
}