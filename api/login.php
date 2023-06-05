<?php include_once "../db.php";

/* $sql="select count(*) from `members` where `acc`='{$_POST['acc']}' && `pw`='{$_POST['pw']}'";
$chk=$pdo->query($sql)->fetchColumn(); */

$chk=$User->count(['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);

if($chk){
    
    /* $sql_pr="select `pr` from `members` where `acc`='{$_POST['acc']}' && `pw`='{$_POST['pw']}'";    
    $pr=$pdo->query($sql_pr)->fetchColumn(); */
    $pr=$User->find(['acc'=>$_POST['acc'],'pw'=>$_POST['pw']])['pr'];

    $_SESSION['login']=$_POST['acc'];
    
    $_SESSION['pr']=$pr;

    if(isset($_SESSION['position'])){
        to($_SESSION['position']);
        unset($_SESSION['position']);
        exit();
    }

    to("../index.php");
}else{
    to("../index.php?do=login&error=1");
}