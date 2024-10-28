<?php
include_once('header.php');
unset($_SESSION['user']);
header('location: index.php');
exit;

