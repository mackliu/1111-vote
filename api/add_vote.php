<?php
include_once "../db.php";
$sql="INSERT INTO `topics`(`subject`, `open_time`, `close_time`, `type`) 
VALUES ('{$_POST['subject']}','{$_POST['open_time']}','{$_POST['close_time']}','{$_POST['type']}')";

$pdo->exec($sql);

header("location:../backend.php");