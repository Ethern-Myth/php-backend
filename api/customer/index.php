<?php
include_once(DOC_ROOT_PATH . "/backend/controllers/customer/CustomerController.php");
include_once(DOC_ROOT_PATH . "/backend/services/CustomerService.php");
//Add controllers
$customerService = new CustomerService($db, "customer");

$customerController  = new CustomerController($customerService);
