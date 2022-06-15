<?php

$host = "localhost";
$user = "root";
$pwd = "";
$database = "ccfj";

$db = new mysqli($host, $user, $pwd, $database);

if ($db->connect_error) {
    die("Connection failed : " . $db->connect_error);
}
