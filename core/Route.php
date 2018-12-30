<?php
namespace core;

class Route{

    /**
     * Call the controller action
     *
     * @param $action
     * @param null $params
     */
    private static function call($action, $params = null){
        $a = explode('@', $action);
        $controller = 'Controllers\\'.$a[0];
        $action = $a[1];
        session_start();
        $obj = new $controller;
        $obj->$action();
        unset($_SESSION['flash']);
        exit();
    }

    /**
     * Check GET request
     *
     * @param $url
     * @param $action
     */
    public static function get($url, $action){

        if($_SERVER['REQUEST_METHOD'] != 'GET')
            return;

        if(! self::compareUrl($url, $action)){
            return;
        }
    }

    /**
     * Check POST request
     *
     * @param $url
     * @param $action
     */
    public static function post($url, $action){
        if($_SERVER['REQUEST_METHOD'] != 'POST')
            return;

        if(! self::compareUrl($url, $action)){
            return;
        }
    }

    /**
     * Compare request url
     *
     * @param $url
     * @param $action
     * @return bool
     */
    public function compareUrl($url, $action){
        $current_url = $_SERVER['REQUEST_URI'];

        if($url[0] == '/'){
            $formatted_url = $url;
        }
        else{
            $formatted_url = '/'.$url;
        }

        $params = array();
        if(strpos($current_url, '?') ){

            $current_url  = explode('?', $current_url)[0];
        }

        if ($current_url == $formatted_url) {
            self::call($action, $params);
        }
        else {
            return false;
        }
    }
}

