<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=vote";
$pdo=new PDO($dsn, 'root', '');

date_default_timezone_set("Asia/Taipei");

session_start();

$msg=[
    1=>"本調查為會員限定，請登入後再進行投票",
    2=>"本調查已結束，請進行其它調查"
];



//計數用的函式
function math($table,$math,$col,...$arg){
    $pdo=pdo();
 
     $sql="select $math(`$col`) from $table ";
 
     if(!empty($arg)){
         if(is_array($arg[0])){
             foreach($arg[0] as $key => $value){
 
                 $tmp[]="`$key`='$value'";
             }
     
             $sql =$sql . " where " . join(" && ",$tmp);
         }else{
 
             $sql=$sql . " where " . $arg[0];
             
         }
     }
 
     if(isset($arg[1])){
         $sql=$sql . " where " . $arg[1];
     }
     
     //echo $sql;
     $rows=$pdo->query($sql)->fetchColumn( );
 
     return $rows;
 }
//計數用的函式
function _count($table,...$arg){
    $pdo=pdo();
 
     $sql="select count(*) from $table ";
 
     if(!empty($arg)){
         if(is_array($arg[0])){
             foreach($arg[0] as $key => $value){
 
                 $tmp[]="`$key`='$value'";
             }
     
             $sql =$sql . " where " . join(" && ",$tmp);
         }else{
 
             $sql=$sql .  " where " .$arg[0];
             
         }
     }
 
     if(isset($arg[1])){
         $sql=$sql . " where " . $arg[1];
     }
 
     $rows=$pdo->query($sql)->fetchColumn( );
 
     return $rows;
 }



/* 
 * all($table) => 全部資料表的內容
 * 例:select * from `topics` => all('topics')
 * ---------------------------------------------------------------
 * all($table,$array) => 以and為基礎的符合條件資料
 * 例: select * from `topics` where `type`='1' && `login`=1; => all('topics',['type'=>1,'login'=>1]) ;
 * ---------------------------------------------------------------
 * all($table,$sql) => 以sql字串為條件的資料
 * 例: select * from `topics` where open_time <= '2023/06/02' order by `id` desc
 * all(`topcis`,"where open_time <= '2023/06/02' order by `id` desc")
 * ---------------------------------------------------------------
 * all($table,$array,$sql) => 符合複雜條件的資料
 * 例: select * from `topics` where `type`=1 && `login`=1  order by `id` desc
 * all(`topcis`,['type'=>1,,'login'=>1], " order by `id` desc")
 */
function all($table,...$arg){
   $pdo=pdo();

    $sql="select * from $table ";

    if(!empty($arg)){
        if(is_array($arg[0])){
            foreach($arg[0] as $key => $value){

                $tmp[]="`$key`='$value'";
            }
    
            $sql =$sql .  " where " . join(" && ",$tmp);
        }else{

            $sql=$sql . " where " . $arg[0];
            
        }
    }

    if(isset($arg[1])){
        $sql=$sql .  " where " . $arg[1];
    }
    //echo $sql;
    $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}

function find($table,$arg){
    $pdo=pdo();

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
    $pdo=pdo();

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
    $pdo=pdo();
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
    $pdo=pdo();

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


function q($sql){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function pdo(){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');
    
    return $pdo;
}

function to($url){
    header("location:".$url);
}
?>