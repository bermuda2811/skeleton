<?php
namespace libs;
abstract class Controller {
    public function __construct() {
        $this->view = new View();
        $this->request = new Request();
    }

    public function get($name, $default = null) {
        return $this->request->get($name, $default);
    }

    public function post($name, $default = null) {
        return $this->request->post($name, $default);
    }

}