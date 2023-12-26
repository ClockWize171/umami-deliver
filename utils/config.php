<?php
session_start();
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWD = '';
$DB_NAME = 'umami_deliver';

$connect = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);

if (mysqli_connect_errno()) {
  exit('Error connect to database' . mysqli_connect_error());
}
?>