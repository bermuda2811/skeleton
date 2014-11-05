<?php
namespace libs;
class Session {
    /**
     * @todo start session
     */
    public static function init() {
        session_start();
    }

    /**
     * @todo set session start
     * @param $key
     * @param $value
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    /**
     * @todo get value from specify key
     * @param $key
     * @return null
     */
    public static function get($key) {
        return isset($_SESSION[$key])?$_SESSION[$key]:null;
    }

    /**
     * @todo remove a key
     * @param $key
     */
    public static function remove($key) {
        unset($_SESSION[$key]);
    }

    /**
     * @param $value
     */
    public static function setSplash($value) {
        self::set('splash',$value);
    }

    /**
     * @return null|string
     */
    public static function getSplash() {
        $splash = self::get('splash');
        return isset($splash)?$splash:'';
    }

    /**
     * @todo destroy
     */
    public static function destroy() {
        unset($_SESSION);
        session_destroy();
    }
}