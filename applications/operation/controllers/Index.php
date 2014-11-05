<?php
namespace applications\operation\controllers;


use models\Category;

class Index extends Base {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->view->setLayout('default');
        $this->view->setView('index/index');


        $variable = array(
            'name'=>'Nguyen Thanh Trung',
            'age'=>'27',
            'author'=>'trungnt'
        );


        $this->view->setVariable($variable);
        return $this->view->render();
    }
}