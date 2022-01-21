<?php
include_once "Request.php";

class Router
{

    private Request $request;
    private string $defaultContentType;
    private string $baseRoute;

    public function __construct($defaultContentType = "application/json", $baseRoute = "")
    {
        $this->defaultContentType = $defaultContentType;
        $this->request = new Request();
        $this->baseRoute = $this->formatRoute($baseRoute);
    }

    private function formatRoute($route): string
    {
        $result = rtrim($route, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
    }

    function __call($name, $args)
    {
        list($route, $method) = $args;
        $route = $this->baseRoute.$route;

        $formattedRoute = $this->formatRoute($route);

        //        creating pattern from route in case route variable params ex: /api/patients/:id
        $pattern = preg_replace_callback("/:\w+/", function ($match) {
            $paramName = substr($match[0], 1);
            return "(?P<$paramName>\w+)";
        }, $formattedRoute);
        if ($pattern !== $formattedRoute) {
            $formattedRoute = str_replace("/", "\/", $pattern);
        }
        $this->{strtolower($name)}[$formattedRoute] = $method;
    }

    function __destruct()
    {
        $this->resolve();
    }

    function resolve()
    {
        $dictionaryKey = strtolower($this->request->requestMethod);
        if (!isset($this->{$dictionaryKey})) {
            $this->defaultRequestHandler();
            return;
        }
        $methodDictionary = $this->{$dictionaryKey};

        $queryString = $this->request->queryString ?? "";
        $formattedRoute = $this->formatRoute($this->request->requestUri);
        $formattedRoute = str_replace("?$queryString", "", $formattedRoute);


        $method = $methodDictionary[$formattedRoute] ?? null;


        if (is_null($method)) { // check for routes with variable params
            foreach ($methodDictionary as $route => $value) {
                $isDynamicRoute = str_contains($route, "\\/"); // check the route string if it has been escaped or not
                if (!$isDynamicRoute) {
                    continue;
                }
                preg_match("/$route$/", $formattedRoute, $matches);

                if (count($matches) !== 0) {
                    $this->request->params = array_slice($matches, 1);
                    $method = $value;
                    break;
                }
            }
        }

        if (is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

//        call route handler
        $contentType = $this->defaultContentType;
        header("Content-Type: $contentType");
        echo $method($this->request);
    }

    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    /**
     * create router with base path based on the current router
     * @param $basePath
     * @return Router
     */
    public function create($basePath): Router
    {
        return new Router(baseRoute: $this->baseRoute.$basePath);
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }
}