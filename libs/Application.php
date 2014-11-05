<?php
namespace libs;
class Application {
    const WEB_APP = 'WEB_APP';
    const CONSOLE_APP = 'CONSOLE_APP';
    static $instance;

    private $type;
    private $show_debug = false;
    /**
     * @var string
     */
    private $app_name = '';

    /**
     * @return string
     */
    public function getAppName()
    {
        return $this->app_name;
    }

    /**
     * @param string $app_name
     */
    public function setAppName($app_name)
    {
        $this->app_name = $app_name;
    }


    /**
     * @param boolean $show_debug
     */
    public function setShowDebug($show_debug)
    {
        $this->show_debug = $show_debug;
    }

    /**
     * @return boolean
     */
    public function getShowDebug()
    {
        return $this->show_debug;
    }


    /**
     * @todo create application
     * @param string $app_name
     * @param null $type
     * @param bool $debug
     */
    public function __construct($app_name = 'frontend', $type = null, $debug = false) {
        try {

            $this->app_name = strtolower($app_name);
            $this->setShowDebug($debug);
            if($type == null) {
                $this->setType(self::WEB_APP);
            }

            self::setInstance($this);

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @todo set application instance
     * @param $instance
     */
    public static function setInstance($instance) {
        self::$instance = $instance;
    }

    /**
     * @todo get application instance
     * @return mixed
     */
    public static function getInstance() {
        if(!self::$instance) {
            self::setInstance(new self);
        }
        return (object)self::$instance ;
    }
    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @todo convert from 'test_function' to 'TestFunction'
     * @param $name
     * @return string
     */
    public static function convertToExactClassName($name) {
        if(strpos($name,'_')!==false) {

            $ct = explode('_',$name);
            $name = '';
            foreach($ct as $c) {
                $name.= ucfirst(strtolower($c));
            }
            return $name;
        }
        return ucfirst(strtolower($name));

    }


    /**
     * @todo run application
     */
    public function run() {
        try {
            /* Khởi tạo session */
            Session::init();

            /* Lấy dữ liệu từ router */
            $router = new Router();
            $controller = $router->getController();
            $method = $router->getMethod();

            /* make right controllers */
            $controller = self::convertToExactClassName($controller);
            $controller = '\\applications\\'.$this->app_name.'\\controllers\\'.$controller;
            $controller = new $controller();

            /* make right method */
            $method = self::convertToExactClassName($method);

            /* execute */
            if(is_object($controller)) {
                $controller->$method();

            } else {
                throw new \Exception($controller.' not be found!');
            }

        }catch (\Exception $e) {
            if($this->getShowDebug() == true) {
                die($e->getMessage());
            }
        }
    }

}