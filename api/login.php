<?php include_once "../db.php";

$sql="select count(*) from `members` where `acc`='{$_POST['acc']}' && `pw`='{$_POST['pw']}'";

$chk=$pdo->query($sql)->fetchColumn();

if($chk){
    $_SESSION['login']=$_POST['acc'];
    header("location:../index.php");
}else{
    header("location:../index.php?do=login&error=1");
}