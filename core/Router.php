<?php

namespace Core;

use Exception;

class Router {
    
    public function __construct(protected array $routes = [
        'POST' => [],
        'GET'  => []
    ]) {}

    public function dispact(): array
    {
        $url = $_SERVER['REQUEST_URI'] ?? $_SERVER['REDIRECT_URL']; // Catturo l'url.

        $segment = parse_url($url, PHP_URL_PATH);
        $segment = $segment ?: '/';

        $method = $_SERVER['REQUEST_METHOD']; // Salvo il metodo

        $urls = $this->routes[$method];


        if (array_key_exists($segment, $urls)) {
            return $urls[$segment];
        } 

        $ret =  $this->matchRoute($urls, $segment);
        if(!$ret) {
            throw new Exception('No routes matched');
        }
        return $ret;
    }

    protected function matchRoute(array $urls, string $segment)
    {
        $ret = [];
        foreach ($urls as $seg => $classArray) {

            if(!str_contains($seg, ':')){
                continue;
            }

            $seg = preg_quote($seg);
            $pattern = preg_replace('/\\\:[a-zA-Z0-9\-\_]+/', '([a-zA-Z0-9\-\_]+)', $seg);

            if( preg_match('@^'.$pattern.'$@', $segment, $matches)) {
               
                array_shift($matches);
                 $classArray[] = $matches;
                 $ret = $classArray;
                
                break;
               
            }
        }
        return $ret;
    }

    public function loadRoute(array $routes): void
    {
        $this->routes = $routes;
    }

    public function getRoute(): array
    {
        return $this->routes;
    }
}
