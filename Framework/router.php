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
    public function route($uri) {

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        //now need to loop through all possible routes because all routes are added in an array and we need to see if it matches all the arguments'
        foreach($this->routes as $route) {

            //Split the current URI into segments
            $uriSegments = explode('/', trim($uri, '/'));
            //Split the route URI into segments
            $routeSegments = explode('/', trim($route['uri'], '/'));
            //compare each segment
            $match = true;

            // check if the number of segments matches
            if(count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $requestMethod)){
                //if true create a params array
                $params = [];

                //match would be true and then would want to loop uri segments
                $match = true;
                //the preg_match is confusing, but what it's doing is looking for text inside parentheses 
                for($i = 0; $i < count($uriSegments); $i++) {
                    //If the uri's do not match and there is no params (meaning value between curly braces
                    if ($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        //now if this condition doesnt match, set match to false
                        $match = false;
                        break;
                    }
                    //now write condition if it DOES match   Check for the param and add to $Params array
                    if(preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                       
                    }
                }
                if($match) {

                $controller = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];
                //instantiate the controller and call the method
                $controllerInstance = new $controller();
                //now take that instance and call the controller method
                $controllerInstance->$controllerMethod($params);
                return;
                }
            }
        }
        //now if that is not there, lets handle an error response. And do it outside of the loop
    ErrorController::notFound();
    }
};