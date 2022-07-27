<?php
include_once "Request.php";

class Router
{

    public string $baseRoute;
    private Request $request;
    private string $defaultContentType;
    private $middleware;

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
        $middleware = $args[2] ?? $this->middleware ?? null;


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
        $this->{strtolower($name)}[$formattedRoute] = function ($req) use ($middleware, $method) {
            // run middleware if there is any before running the method
            $canRunMethod = !$middleware;
            if ($middleware && !$canRunMethod) {
                $canRunMethod = $middleware($req);
            }

            if (!$canRunMethod) {
                return;
            }
            return $method($req);
        };

    }

    public function useMiddleware($method)
    {
        $this->middleware = $method;
    }

    function __destruct()
    {
        $this->resolve();
    }

    function resolve()
    {
        $dictionaryKey = strtolower($this->request->requestMethod);
        var_dump($dictionaryKey);
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
     * @return SubRouter
     */
    public function create($basePath): SubRouter
    {
        return new SubRouter($this, $basePath);
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }
}

class SubRouter
{
    private Router $router;
    private string $baseRoute;
    private $middleware;

    public function __construct($router, $baseRoute = "")
    {
        $this->router = $router;
        $this->baseRoute = $baseRoute;
    }

    function __call($name, $args)
    {
        $route = $this->baseRoute.$args[0];
        $args[] = $this->middleware;
        $this->router->{$name}($route, ...array_slice($args, 1));
    }

    public function create(string $basePath): SubRouter
    {
        return $this->router->create($this->baseRoute.$basePath);
    }

    public function useMiddleware($method)
    {
        $this->middleware = $method;
    }
}