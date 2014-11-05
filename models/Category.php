<?php
namespace models;
use libs\Model;

class Category extends Model {
    const table = 'category';
    public function __construct() {
        parent::__construct();

        $this->setName('213213');
        echo $this->getName();
    }

}