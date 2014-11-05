<?php
require '../../bootstrap.php';
try {
    $name = 'backend';
    $application = new \libs\Application($name);
    $application->run();
}catch (Exception $e) {
    print_r($e->getMessage());exit;
}
