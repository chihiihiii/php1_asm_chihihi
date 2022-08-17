<?php
session_start();
unset($_SESSION['admin']);
header('Location: dangnhap.php');
exit;
// Tran Hoang Le Chi
