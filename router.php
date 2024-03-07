<?php

class Router {
    protected $routes = [];


//create a method/new route to automatically inject each function depending on request
    public function registerRoute($method, $uri, $controller) {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }

//Load error Page
//setting the parameter to a default of 404
    public function error($httpCode = 404){
        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit;
    }

//Add a GET route

    public function get($uri, $controller) {
        $this->registerRoute('GET', $uri, $controller);
    }
//POST
    public function post($uri, $controller) {
        $this->registerRoute('POST', $uri, $controller);
    }
//PUT
    public function put($uri, $controller) {
        $this->registerRoute('PUT', $uri, $controller);
    }
//delete
    public function delete($uri, $controller) {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    //NOW, we need to Route the request

    public function route($uri, $method) {
        //now need to loop through all possible routes because all routes are added in an array and we need to see if it matches all the arguments'
        foreach($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                require basePath($route['controller']);
                return;
            }
        }
        //now if that is not there, lets handle an error response. And do it outside of the loop
  $this->error();
    }
};