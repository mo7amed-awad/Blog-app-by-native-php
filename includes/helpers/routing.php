<?php

$routes = [];

if (!function_exists('route_get')) {
    function route_get($segment, $view = null)
    {
        global $routes;
        $routes['GET'][] = [
            'view' => $view,
            'segment' => "/public/" . ltrim($segment, '/'),
        ];
    }
}

if (!function_exists('route_post')) {
    function route_post($segment, $view = null)
    {
        global $routes;
        $routes['POST'][] = [
            'view' => $view,
            'segment' => "/public/" . ltrim($segment, '/'),
        ];
    }
}

if (!function_exists('route_init')) {
    function route_init()
    {
        global $routes;

        $GET_ROUTES = isset($routes['GET']) ? $routes['GET'] : [];
        $POST_ROUTES = isset($routes['POST']) ? $routes['POST'] : [];

        if (!isset($_POST['_method'])) {
            foreach ($GET_ROUTES as $rget) {
                if (segment() == $rget['segment']) {
                    view($rget['view']);
                }
            }
        }

        if (isset($_POST) && isset($_POST['_method']) && count($_POST) > 0 && strtolower($_POST['_method']) === 'post') {
            foreach ($POST_ROUTES as $rpost) {
                if (segment() == $rpost['segment']) {
                    view($rpost['view']);
                }
            }
            if ((segment()) != '/' && !in_array(segment(), array_column($POST_ROUTES, 'segment'))) {
                echo 'This Route POST Not Found';
                exit();
            }
        }
    }
}



if (!function_exists('redirect')) {
    function redirect($path)
    {
        $check_path=parse_url($path);
        if(isset($check_path['scheme']) && isset($check_path['host'])){
            header('Location: ' . $path);  
        }else{
            header('Location: ' . url($path));  
        }
        exit();
    }
}

if (!function_exists('redirect_if')) {
    function redirect_if(bool $statement, string $url)
    {
        if($statement){
            redirect($url);
        }
    }
}



if (!function_exists('back')) {
    function back()
    {
        header('Location: ' . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}



if (!function_exists('url')) {
    function url($segment)
    {
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $url .= $_SERVER['HTTP_HOST'];
        return $url . "/public/" . ltrim($segment, '/');
    }
}


if (!function_exists('aurl')) {
    function aurl($segment)
    {
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $url .= $_SERVER['HTTP_HOST'];
        return $url . "/public/" . ADMIN . '/' . ltrim($segment, '/');
    }
}


if (!function_exists('segment')) {
    function segment()
    {
        $segment = ltrim($_SERVER['REQUEST_URI'], '/');
        $removeQueryParam = explode('?', $segment)[0];
        return !empty($segment) ? '/' . $removeQueryParam : '/';
    }
}
