<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=vote";
$pdo=new PDO($dsn, 'root', '');

date_default_timezone_set("Asia/Taipei");

session_start();

$msg=[
    1=>"本調查為會員限定，請登入後再進行投票",
    2=>"本調查已結束，請進行其它調查"
];



function all($table){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');

    $sql="select * from $table ";

    $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}

function find($table,$arg){

    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');

    $sql="select * from `$table`  where ";

    if(is_array($arg)){
        foreach($arg as $key => $value){

            $tmp[]="`$key`='$value'";
        }

        $sql .= join(" && ",$tmp);
    }else{

        $sql .= " `id` = '$arg' ";
        
    }

    //echo $sql;

    $row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    return $row;
}

//一次更新一筆
function update($table,$cols){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');

    //['subject'=>'今天天氣很好吧?',
    // 'open_time'=>'2023-05-29',
    // 'close_time'=>'2023-06-05',
    //]

    foreach($cols as $key => $value){
        if($key!='id'){
            $tmp[]= "`$key`='$value'";
        }
    }

    //`subject`='今天天氣很好吧?',`open_time`='2023-05-29',`close_time`='2023-06-05'

    $sql="update `$table` set  ".join(",",$tmp)." where `id`='{$cols['id']}'";

    $result=$pdo->exec($sql);


    return $result;
}

function insert($table,$cols){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');
    $col=array_keys($cols);

/*     $sql ="insert into $table (`";
    $sql .=join("`,`", $col);
    $sql .="`) values('";
    $sql .=join("','",$cols);
    $sql .="')"; */

    $sql="insert into $table (`" . join("`,`", $col) . "`) values('".join("','",$cols)."')";
    //echo $sql;

    $result=$pdo->exec($sql);

    return $result;
}


function del($table,$arg){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');

    $sql="delete from `$table` where ";
    if(is_array($arg)){
        foreach($arg as $key => $value){

            $tmp[]="`$key`='$value'";
        }

        $sql .= join(" && ",$tmp);
    }else{

        $sql .= " `id` = '$arg' ";
        
    }

    //echo $sql;
    return $pdo->exec($sql);
}

function save($table,$cols){

    if(isset($cols['id'])){
        update($table,$cols);
    }else{
        insert($table,$cols);
    }
}
?>