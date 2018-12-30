<?php

function is_ajax() {
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    return $isAjax;
}

function redirect($url){
    $base_url = 'http://' . $_SERVER['SERVER_NAME'];
    if($url[0] != '/')
        $url = '/'.$url;

    header("Location: ".$base_url.$url);
    exit();
}

function conf($path)
{
    $a = explode('.', $path);
    $file = $a[0];
    $key = $a[1];

    $content = include __DIR__ . '/../config/' . $file . '.php';
    return $content[$key];
}

function view($file, $params = [])
{

    foreach ($params as $_k => $param) {
        $$_k = $param;
    }

    include('views/' . $file . '.php');
}

function asset($path = '/')
{
    $base_url = 'http://' . $_SERVER['SERVER_NAME'];
    if($path[0] != '/'){
        $path = '/'.$path;
    }

    return $base_url . '/public'.$path;
}

function view_path($path = null)
{
    $base_url = $_SERVER['DOCUMENT_ROOT'];
    if($path && $path[0] != '/'){
        $path = '/'.$path;
    }

    return $base_url . '/views'.$path;
}

function url($url = null)
{
    $base_url = 'http://' . $_SERVER['SERVER_NAME'];
    $return = $base_url;
    if($url){
        if($url[0] != '/')
            $return .= '/'.$url;
        else
            $return .= $url;
    }

    return $return;
}

function set_flash_errors($data){
    if(!is_array($data)){
        $_SESSION['flash']['errors'] = [$data];
    }
    else{
        $_SESSION['flash']['errors'] = $data;
    }
}
function get_flash_errors(){
    if(isset($_SESSION['flash']['errors']))
        return $_SESSION['flash']['errors'];
    else
        return null;
}
function set_flash_message($data){
    if(!is_array($data)){
        $_SESSION['flash']['messages'] = [$data];
    }
    else{
        $_SESSION['flash']['messages'] = $data;
    }
}
function get_flash_message(){
    if(isset($_SESSION['flash']['messages']))
        return $_SESSION['flash']['messages'];
    else
        return null;
}