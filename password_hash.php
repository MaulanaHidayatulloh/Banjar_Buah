<?php
$password_plain = "admin123"; 
$password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);
echo $password_hashed;
?>
