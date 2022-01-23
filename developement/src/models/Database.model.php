<?php

class Database
{
    public PDO $connection;

    public function __construct($uri, $username, $password)
    {
        $driver_options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        $this->connection = new PDO($uri, $username, $password, $driver_options);
    }

    public function query($str, $params = []): bool|PDOStatement
    {
        $stmt = $this->connection->prepare($str);

        foreach ($params as $param => $val) {
            $paramType = match (gettype($val)) {
                "integer" => PDO::PARAM_INT,
                default => PDO::PARAM_STR,
            };
            $stmt->bindValue($param, $val, $paramType);
        }
        $stmt->execute();
        return $stmt;
    }
}