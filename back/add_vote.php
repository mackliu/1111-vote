<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增主題</title>
</head>
<body>
<h1>新增主題</h1>
<form action="../api/add_vote.php" method="post">
    <div>
        <label for="subject">主題說明：</label>
        <input type="text" name="subject" id="subject">
    </div>
    <div>
        <input type="submit" value="新增">
    </div>
</form>
</body>
</html>