<?php
namespace libs;
class Connection extends \PDO {
    public static $instance = array();
    public static $db;


    public $db_type, $db_host, $db_name, $db_user, $db_pass;

    function initConfig($key) {

        try {
            $config = array(
                'default'=>array(
                    'db_type'=>DB_TYPE,
                    'db_host'=>DB_HOST,
                    'db_name'=>DB_NAME, //database orderhang
                    'db_user'=>DB_USER,
                    'db_pass'=>DB_PASS
                )
            );
            $key = isset($key)?$key:'default';
            $main_config = $config[$key];
            if(empty($main_config)) {
                throw new \Exception('Config not found !');
            }
            $this->db_type = $main_config['db_type'];
            $this->db_host = $main_config['db_host'];
            $this->db_name = $main_config['db_name'];
            $this->db_user = $main_config['db_user'];
            $this->db_pass = $main_config['db_pass'];
        }catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }

    function __construct() {}

    public static function getConnection($db_key = null) {
        $connection =  new self;
        $connection->initConfig($db_key);

        $dsn = $connection->db_type.':host='.$connection->db_host.';dbname='.$connection->db_name;

        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $db = new \PDO($dsn, $connection->db_user, $connection->db_pass, $options);
        self::setInstance($db_key, $db);
        return $db;
    }

    public static function getInstance($db_key = null) {
        if(!isset(self::$instance[$db_key])) {
            self::$instance[$db_key] = self::getConnection($db_key);
        }
        return self::$instance[$db_key];
    }

    public static function setInstance($db_key, $db) {
        self::$instance[$db_key] = $db;
    }
}