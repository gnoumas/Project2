<?php

require('headerp.php');

session_start();
session_destroy();
header('Location: login.php'); 
exit;

require('footerp.php');
?>