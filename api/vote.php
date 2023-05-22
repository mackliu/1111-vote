<?php

include_once "../db.php";

$opt=$_POST['desc'];

/* 1.單選 $_POST['desc']=3;
   2.多選 $_POST['desc']=[1,3,6]; */

$subject_id = $_POST['subject_id'];
$subject_type=$pdo->query("select `type` from `topics` where `id`='$subject_id'")->fetchColumn();

switch($subject_type){
    case 1:
        $pdo->exec("update `options` set `total`=`total`+1 where `id`='$opt'");
    break;
    case 2:
        foreach($opt as $opt_id){
            $pdo->exec("update `options` set `total`=`total`+1 where `id`='$opt_id'");
        }
    break;
}


header("location:../index.php?do=result&id=$subject_id");