<?php
namespace libs;
class Request {
    public static $instance;

    /**
     * @param mixed $instance
     */
    public static function setInstance($instance)
    {
        self::$instance = $instance;
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }


    public function __construct(){

    }

    public static function isPost(){
        return isset($_POST);
    }

    public static function get($name, $default = null){
        return isset($_GET[$name])?$_GET[$name]:$default;
    }

    public static function post($name, $default = null){
        return isset($_POST[$name])?$_POST[$name]:$default;
    }

    public static function redirect($url){
        header('location:'.$url);
    }
}