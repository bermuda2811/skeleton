<?php
define('PROJECT_NAME','skeleton');
define('URL','http://localhost/'.PROJECT_NAME.'/');
define('PUBLIC_HTML_URL', URL.'/assets/');
define('BOOTSTRAP_URL', PUBLIC_HTML_URL.'/bootstrap/');

//define path
define('DS','/');
define('ROOT',dirname(dirname(__FILE__)).DS.PROJECT_NAME.DS);
define('APPLICATION_PATH',ROOT.DS.'applications'.DS);
define('VIEW_PATH', ROOT.DS.'views'.DS);
define('MODEL_PATH', ROOT.DS.'models'.DS);
define('LIB_PATH', ROOT.DS.'libs'.DS);
define('PUBLIC_HTML_PATH', ROOT.DS.'assets'.DS);

/* config error */
function config_error_log($path) {
    ini_set("log_errors", 1);
    ini_set("error_log", $path);
}
config_error_log(ROOT."log/php-error.log");


/**
 * @todo auto load class
 * @param $class
 */
function my_auto_load ($class) {
    $file = ROOT.DIRECTORY_SEPARATOR.str_replace('\\', '/', $class).'.php';
    if(file_exists($file) && is_readable($file)) {
        include_once($file);
    }
}

spl_autoload_register('my_auto_load');