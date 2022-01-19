<?php

include_once "IRequest.php";


class Request implements IRequest

{
    private array $header = [];

    public function __construct()
    {
        $this->bootstrapSelf();
    }

    private function bootstrapSelf()
    {
        foreach ($_SERVER as $key => $value) {
            $needle = "http_";
            $keyLower = strtolower($key);
            $isHeader = str_contains($keyLower, $needle);
            if ($isHeader) {
                $this->header[str_replace($needle, "", $keyLower)] = $value;
                continue;
            }
            $this->{$this->camelCase($key)} = $value;
        }
    }

    private function camelCase(int|string $key): array|string|null
    {
        return preg_replace_callback('/_(.?)/', function ($matches) {
            return ucfirst($matches[1]);
        }, strtolower($key));
    }

    public function getBody()
    {

        function parsePostBody(): array
        {
            $body = array();
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $body;
        }

        function parsePutBody()
        {
            $input = file_get_contents("php://input");
            $body = json_decode($input);

            if (is_null($body)) {
                foreach (explode("&", $input) as $value) {
                    $explosion = explode("=", $value);

                    [$key, $val] = $explosion;
                    $body[$key] = $val;
                }
            }
            return $body;
        }

        switch ($this->requestMethod) {
            case "POST":
                return parsePostBody();
            case "PUT":
                return parsePutBody();
        }
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }
}