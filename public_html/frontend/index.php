<?php
require '../../bootstrap.php';
try {
    $application = new \libs\Application('frontend');
    $application->run();
}catch (Exception $e) {
    print_r($e->getMessage());exit;
}
