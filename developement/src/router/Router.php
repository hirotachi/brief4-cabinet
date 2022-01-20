<?php
include_once "IRequest.php";


class Router
{

    private IRequest $request;
//    private array $supportedHttpMethods = array(
//        "GET",
//        "POST",
//        "PUT",
//        "DELETE"
//    );


    public function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    function __call($name, $args)
    {
        list($route, $method) = $args;

//        if (!in_array(strtoupper($name), $this->supportedHttpMethods)) {
//            $this->invalidMethodHandler();
//        }

//        creating pattern from route in case route variable params ex: /api/patients/:id
        $formattedRoute = $this->formatRoute($route);
        $formattedRoute = preg_replace_callback("/:\w+/", function ($match) {
            $paramName = substr($match[0], 1);
            return "(?P<$paramName>\w+)";
        }, $formattedRoute);
        $formattedRoute = str_replace("/", "\/", $formattedRoute);

        $this->{strtolower($name)}[$formattedRoute] = $method;
    }

    private function formatRoute($route): string
    {
        $result = rtrim($route, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
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
        echo $method($this->request);
    }

    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }
}