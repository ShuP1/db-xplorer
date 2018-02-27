<?php
session_start();

$_page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'index';
$_schema = isset($_GET['schema']) ? htmlspecialchars($_GET['schema']) : null;
$_table = isset($_GET['table']) ? htmlspecialchars($_GET['table']) : null;
$_offset = isset($_GET['offset']) ? intval(htmlspecialchars($_GET['offset'])) : 0;

$config=include('config.php');
include('model.php');
include('router.php');
?>