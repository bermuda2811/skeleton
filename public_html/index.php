<?php
require '../bootstrap.php';
try {
    $name = 'frontend';
    $application = new \libs\Application($name);
    $application->run();
}catch (Exception $e) {
    error_log($e->getMessage());
    print_r($e->getMessage());exit;
}
