<?php
include_once "../db.php";

$pdo->exec("delete from `topics` where `id`='{$_GET['id']}'");
$pdo->exec("delete from `options` where `subject_id`='{$_GET['id']}'");

header("location:../backend.php");