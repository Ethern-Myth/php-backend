<?php
include_once(DOC_ROOT_PATH . "/backend/api/customer/index.php");

$id = intval($_GET['id']);
if ($id > 0) {
    $customerController->deleteCustomer($id);
} else {
    echo "ID cannot be zero";
}
