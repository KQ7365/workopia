<?php

namespace Framework;

use App\Controllers\ErrorController;

class Router {
    protected $routes = [];


//create a method/new route to automatically inject each function depending on request
    public function registerRoute($method, $uri, $action) {

    list($controller, $controllerMethod) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
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
    //This is also where we are requiring a controller!
    public function route($uri, $method) {
        //now need to loop through all possible routes because all routes are added in an array and we need to see if it matches all the arguments'
        foreach($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                //Extract controller and controller method
                $controller = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];
                //instantiate the controller and call the method
                $controllerInstance = new $controller();
                //now take that instance and call the controller method
                $controllerInstance->$controllerMethod();
                return;
            }
        }
        //now if that is not there, lets handle an error response. And do it outside of the loop
  ErrorController::notFound();
    }
};