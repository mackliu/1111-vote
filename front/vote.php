<h1>投票</h1>
<?php

$topic=$pdo->query("select * from `topics` where `id`='{$_GET['id']}'")->fetch(PDO::FETCH_ASSOC);


?>

<h2><?=$topic['subject'];?></h2>
