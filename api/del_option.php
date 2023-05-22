<?php
include_once "../db.php";

$pdo->exec("delete from `options` where `id`='{$_GET['id']}'");

header("location:../backend.php");