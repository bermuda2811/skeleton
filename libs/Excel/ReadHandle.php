<?php
/**
 * Created by PhpStorm.
 * User: trungnt
 * Date: 10/13/2014
 * Time: 2:32 PM
 */
namespace libs\Excel;
use PHPExcel_IOFactory;
class ReadHandle {
    private $name;
    private $path;
    private $file_error_message = array();
    public $data = array();

    function __construct($path = null) {
        if(null !== $path) {
            $this->setPath($path);
            $result = $this->load();
            $this->data = $result;
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    public function valid () {
        try {
            if($this->getPath() == '') {
                $this->file_error_message[] = 'File path must be set';
            }
            if (!file_exists($this->getPath())) {
                $this->file_error_message[] = 'File not exist';
            }
            $support_type = array('xls','xlsx','csv');
            $info = new \SplFileInfo($this->getPath());
            $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

            if(!in_array($extension, $support_type)) {
                $this->file_error_message[] = 'File type is not supported!';
            }
        }catch (Exception $e) {
            print_r($e->getMessage());exit;
        }
    }

    public function load () {
        try {
            $this->valid();
            if(!empty($this->file_error_message)){
                throw new Exception(implode('/',$this->file_error_message));
            }
            $objPHPExcel = PHPExcel_IOFactory::load($this->path);

            return $objPHPExcel->getActiveSheet()->toArray();

        } catch (Exception $e) {
            print_r($e->getMessage());
        }
        return false;
    }
}