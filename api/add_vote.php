<?php
include_once "../db.php";

/* echo "<pre>";
print_r($_POST);
echo "</pre>"; */

$sql_chk_subject="select count(*) from `topics` where subject='{$_POST['subject']}'";
$chk=$pdo->query($sql_chk_subject)->fetchColumn();
if($chk>0){
    echo "此主題已被使用過,請修改主題內容";
    echo "<a href='../back/add_vote.php'>返回新增主題</a>";
}else{
    $sql="INSERT INTO `topics`(`subject`, `open_time`, `close_time`, `type`,`login`) 
        VALUES ('{$_POST['subject']}','{$_POST['open_time']}','{$_POST['close_time']}','{$_POST['type']}','{$_POST['login']}')";
    $pdo->exec($sql);

    //寫入選項
    $sql_subject_id="select `id` from `topics` where `subject`='{$_POST['subject']}'";
    //echo $sql_subject_id;
    $subject_id=$pdo->query($sql_subject_id)->fetchColumn();
    
    //echo $subject_id;

    foreach($_POST['description'] as $desc){
        if($desc!=''){
            $sql_option="INSERT INTO `options`(`description`,`subject_id`) 
                       VALUES ('$desc','$subject_id')";
            $pdo->exec($sql_option);
        }
    }
}
header("location:../backend.php");