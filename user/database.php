<?php

session

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "task_easy_registration_login";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

define("SITEURL", "http://localhost/task-manager/");