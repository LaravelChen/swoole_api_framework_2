<?php

namespace App\HttpController;


use FastRoute\RouteCollector;
use  EasySwoole\Core\Http\AbstractInterface\Router as BaseRouter;

class Router extends BaseRouter
{
    function register(RouteCollector $routeCollector)
    {
        // TODO: Implement register() method.
        $routeCollector->addRoute('GET', '/', '/User/UsersController/index');
        $routeCollector->addRoute('GET', '/list', '/User/UsersController/userList');
        $routeCollector->addRoute('POST', '/getOne', '/User/UsersController/getOne');
        $routeCollector->addRoute('POST', '/login', '/User/UsersController/login');
    }
}