<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>姓名判断</title>
    <link rel="stylesheet" href="//localhost/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    
</head>
<body>
    <div class="container">
    <h1 class="cover-heading">姓名判断</h1>
    <form action = "<?php $this->config->base_url();?>name" method = 'post'>
        <p>姓名判断プログラム</p>
        <input type ="text" name ="name" required>
        <input type ="submit" name ="submit" value ="占う" class='submit'>
    </form>
    </div>
</body>
</html>