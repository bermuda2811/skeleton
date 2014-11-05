<?php
namespace libs;
class View {
    public $layout, $view;
    public static $instance;
    public $variable = array();

    public $view_path = '';

    public function __construct() {
        $application = Application::getInstance();
        $this->view_path = ROOT.'applications/'.$application->getAppName().'/views/';
    }

    public static function setInstance() {

    }

    public function setVariable($variable)
    {
        if(!empty($this->variable)){
            $this->variable = array_merge($this->variable, $variable);
        }else{
            $this->variable = $variable;
        }
    }

    /**
     * @return array
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->view;
    }

    /* render layout and view */
    public function render() {
        try {


            if(!file_exists($path = $this->view_path.$this->getLayout().'.php')) {
                throw new \Exception('layout not found');
            }
            $variable = $this->getVariable();
            $variable['main_content'] = $this->getBuffer();

            extract($variable);
            include $path;


        } catch (\Exception $e){
            print_r($e->getMessage());
        }
        return true;
    }

    /**
     * @return string
     */
    public function getBuffer() {
        try {
            if(empty($this->view)) {
                throw new \Exception('view must be set');
            }
            if(!file_exists($path = $this->view_path.$this->getView().'.php')) {
                throw new \Exception('view path not found');
            }
            extract($this->getVariable());
            /* begin : get content */
            ob_start();
            include $path;
            $content = ob_get_contents();
            ob_end_clean();
            /* end get content*/

            return $content;
        }catch (\Exception $e) {
            print_r($e->getMessage());
        }
        return '';
    }

    /**/

    public static function loadView($name, $data = array()) {
        try {
            $odm = new self;
            $path = $odm->view_path.$name.'.php';
            if(!file_exists($path)) {
                throw new \Exception('name or path must be set to load !');
            }
            extract($data);
            include $path;
        }catch (\Exception $e) {
            print_r($e->getMessage());exit;
        }
    }
}