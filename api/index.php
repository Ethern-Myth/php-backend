<?php
define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
include_once(DOC_ROOT_PATH . "/backend/helper/helper.php");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

enum METHOD: string
{
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case PATCH = "PATCH";
    case DELETE = "DELETE";
}

//Customer Client Request
if ($_SERVER['REQUEST_METHOD'] == METHOD::GET->value && $parts[3] == "customer" && $parts[4] == "all") {
    include_once(DOC_ROOT_PATH . "/backend/api/customer/all.php");
} else if ($_SERVER['REQUEST_METHOD'] == METHOD::GET->value && $parts[3] == "customer" && ($_GET['id'] > 0 || $_GET['id'] != null)) {
    include_once(DOC_ROOT_PATH . "/backend/api/customer/id.php");
} else if ($_SERVER['REQUEST_METHOD'] == METHOD::POST->value && $parts[3] == "customer") {
    include_once(DOC_ROOT_PATH . "/backend/api/customer/create.php");
} else if ($_SERVER['REQUEST_METHOD'] == METHOD::PUT->value && $parts[3] == "customer" && ($_GET['id'] > 0 || $_GET['id'] != null)) {
    include_once(DOC_ROOT_PATH . "/backend/api/customer/update.php");
} else if ($_SERVER['REQUEST_METHOD'] == METHOD::DELETE->value && $parts[3] == "customer" && ($_GET['id'] > 0 || $_GET['id'] != null)) {
    include_once(DOC_ROOT_PATH . "/backend/api/customer/delete.php");
}
