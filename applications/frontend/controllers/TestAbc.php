<?php
namespace applications\frontend\controllers;
class TestAbc extends Base {

    public function __construct() {
        parent::__construct();
        $this->view->setLayout('default');

    }

    public function index() {
        echo 'some think like that';exit;
    }

}