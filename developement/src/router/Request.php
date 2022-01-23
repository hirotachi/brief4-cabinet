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

        function parseFormBody(): array
        {
            $body = array();
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            return $body;
        }

        function parseJSONBody()
        {
            $input = file_get_contents("php://input");
            $body = json_decode($input, true);

            if (is_null($body)) {
                foreach (explode("&", $input) as $value) {
                    $explosion = explode("=", $value);

                    [$key, $val] = $explosion;
                    $body[$key] = $val;
                }
            }
            return $body;
        }

        $body = parseFormBody();
        if (count($body) == 0) {
            $body = parseJSONBody();
        }
        return $body;
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }
}