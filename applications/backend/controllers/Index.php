<?php
namespace applications\backend;


class Index extends Base {

    public function __construct() {
        parent::__construct();
        $this->view->setLayout('default');
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
        $this->view->render();
    }
}