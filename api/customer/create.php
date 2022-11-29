<?php
include_once(DOC_ROOT_PATH . "/backend/api/customer/index.php");

$data = json_decode(file_get_contents("php://input"));

$customerController->createCustomer($data);
