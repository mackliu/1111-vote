<?php

$sql="select * from `logs` where `topic_id`='{$_GET['sub_id']}'";
$logs=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

?>
<style>
.vote-items{
    border-collapse: collapse;
    width:500px;
    margin:auto;
}
.vote-items div{
    padding:10px 25px;
    border:1px solid #ccc;
}

</style>

<table class="vote-items">
    <tr>
        <td>會員</td>
        <td>投票時間</td>
        <td>操作</td>
    </tr>
    <?php
    foreach($logs as $log){
    ?>
    <tr>
        <td><?=$log['mem_id'];?></td>
        <td><?=$log['vote_time'];?></td>
        <td><button>刪除</button></td>
    </tr>
    <?php
    }
    ?>
</table>