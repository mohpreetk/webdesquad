<?php
try {
  $dsn = 'mysql:host=172.31.22.43;dbname=Mohpreet200448160';
  $username = 'Mohpreet200448160';
  $password = 'Jv8gctRO4B'; 
  $db = new PDO($dsn, $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch (PDOException $e) {
  $error_message = $e->getMessage(); 
  include('../errors/database_error.php');
  exit();
}
?>

