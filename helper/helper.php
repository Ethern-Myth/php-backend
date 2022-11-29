<?php
include_once(DOC_ROOT_PATH . "/backend/index.php");
include_once(DOC_ROOT_PATH . "/backend/config/Database.php");

// Initialize DB and CN
$database = new Database;
$db = $database->connect();
