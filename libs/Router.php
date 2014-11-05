<?php
namespace libs;
class Router {
    public $controller, $method, $params;
    public $type;
    public static $instance;

    public function __construct($applicationType = null) {
        if($applicationType !=null) {
            $this->type = $applicationType;
        }
        $this->parseUrl();
        self::setInstance($this);
    }

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

    /**
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return isset($this->method)?$this->method:'index';
    }

    public function parseUrl() {

        $url = Request::get('url','index');

        $url = rtrim($url,'/');
        $url = explode('/',$url);

        if(isset($url[0])) {
            $this->setController($url[0]);
        }
        if(isset($url[1])) {
            $this->setMethod($url[1]);
        }
    }

}