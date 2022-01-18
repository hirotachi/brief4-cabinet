<?php
include_once "IRequest.php";


class Router
{

    private IRequest $request;
    private array $supportedHttpMethods = array(
        "GET",
        "POST"
    );


    public function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    function __call($name, $args)
    {
        list($route, $method) = $args;

        if (!in_array(strtoupper($name), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }

        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
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
            $this->invalidMethodHandler();
            return;
        }
        $methodDictionary = $this->{$dictionaryKey};
        $formattedRoute = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$formattedRoute] ?? null;
        if (is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        echo call_user_func_array($method, array($this->request));
    }

    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }
}