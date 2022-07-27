<?php


function loadEnv($name, $default = null){
    return $_ENV[$name] ?? $default;
}




class Database
{
    public PDO $connection;

    public function __construct(
    ) {
        $config = [
            "host" => loadEnv("DB_HOST", "localhost"),
            "dbname" => loadEnv("DB_NAME", "app_db"),
            "port" => loadEnv("DB_PORT", 6033),
            "username" => loadEnv("DB_USER", "root"),
            "password" => loadEnv("DB_PASSWORD", "root"),
        ];
        $port = $config["port"];
        $host = $config["host"];
        $dbname = $config["dbname"];
        $username = $config["username"];
        $password = $config["password"];

        $uri = "mysql:host=$host:$port;dbname=$dbname";
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