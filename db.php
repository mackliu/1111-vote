<?php

date_default_timezone_set("Asia/Taipei");

session_start();

$msg=[
    1=>"本調查為會員限定，請登入後再進行投票",
    2=>"本調查已結束，請進行其它調查"
];



class DB
{
    /**
     * 1. 自動連線資料庫
     * 2. 能夠執行CRUD的操作
     * 3. 能指定資料表
     */

    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    protected $user = "root";
    protected $pw = "";
    protected $table;
    protected $pdo;
    protected $query_result;

    function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, $this->user, $this->pw);
    }

    function all(...$arg)
    {
        $sql = "select * from $this->table ";

        if (!empty($arg)) {
            if (is_array($arg[0])) {
                foreach ($arg[0] as $key => $value) {

                    $tmp[] = "`$key`='$value'";
                }

                $sql = $sql .  " where " . join(" && ", $tmp);
            } else {

                $sql = $sql .  $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql = $sql .  $arg[1];
        }
        //echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($arg)
    {
        $sql = "select * from `$this->table`  where ";

        if (is_array($arg)) {
            foreach ($arg as $key => $value) {

                $tmp[] = "`$key`='$value'";
            }

            $sql .= join(" && ", $tmp);
        } else {

            $sql .= " `id` = '$arg' ";
        }

        //echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function save($cols){
        if(isset($cols['id'])){
            //update
            foreach($cols as $key => $value){
                if($key!='id'){
                    $tmp[]= "`$key`='$value'";
                }
            }
        
            $sql="update `$this->table` set  ".join(",",$tmp)." where `id`='{$cols['id']}'";

            return $this->pdo->exec($sql);
        }else{
            //insert
            $keys=array_keys($cols);
            $sql="insert into $this->table (`" . join("`,`", $keys) . "`) values('".join("','",$cols)."')";
                //echo $sql;
            return $this->pdo->exec($sql);
        }
    }

    function del($arg){
        $sql="delete from `$this->table` where ";
        if(is_array($arg)){
            foreach($arg as $key => $value){
    
                $tmp[]="`$key`='$value'";
            }
    
            $sql .= join(" && ",$tmp);
        }else{
    
            $sql .= " `id` = '$arg' ";
            
        }
    
        //echo $sql;

        return $this->pdo->exec($sql);
    }

    function count(...$arg){
         $sql="select count(*) from $this->table ";
     
         if(!empty($arg)){
             if(is_array($arg[0])){
                 foreach($arg[0] as $key => $value){
     
                     $tmp[]="`$key`='$value'";
                 }
         
                 $sql =$sql . " WHERE " . join(" && ",$tmp);
             }else{
     
                 $sql=$sql .  $arg[0];
             }
         }
     
         if(isset($arg[1])){
             $sql=$sql .  $arg[1];
         }

         return $this->pdo->query($sql)->fetchColumn( );
     }

     function sum($cols,...$arg){
        return $this->math('sum',$cols,...$arg);
     }
     function min($cols,...$arg){
        return $this->math('min',$cols,...$arg);
     }
     function avg($cols,...$arg){
        return $this->math('avg',$cols,...$arg);
     }
     function max($cols,...$arg){
        return $this->math('max',$cols,...$arg);
     }

     //計數用的函式
    private function math($math,$col,...$arg){
     $sql="select $math(`$col`) from $this->table ";
 
     if(!empty($arg)){
         if(is_array($arg[0])){
             foreach($arg[0] as $key => $value){
 
                 $tmp[]="`$key`='$value'";
             }
     
             $sql =$sql . " where " . join(" && ",$tmp);
         }else{
 
             $sql=$sql .  $arg[0];
             
         }
        
     }
 
     if(isset($arg[1])){
         $sql=$sql .  $arg[1];
     }
     
     //echo $sql;
     return $this->pdo->query($sql)->fetchColumn( );
 }
}


function q($sql){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


function to($url){
    header("location:".$url);
}



$Topic=new DB('topics');
$Option=new DB('options');
$Log=new DB('logs');
$User=new DB('members');

?>