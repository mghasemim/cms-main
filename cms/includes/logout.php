<?php
session_start();

$_SESSION['username'] = null;
$_SESSION['role'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;

header("Location: ../index.php");







?>