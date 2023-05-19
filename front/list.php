<ul>
<?php
$sql="select * from `topics`";
$rows=$pdo->query($sql)->fetchAll();
foreach($rows as $row){
?>
<li><?=$row['subject'];?></li>
<?php
}
?>
</ul>