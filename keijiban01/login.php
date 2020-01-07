<?php
//データベースに接続
$pdo = new PDO("mysql:host=localhost;dbname=user;charset=utf8mb4", "php_user", "phpPHP0123!",);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//サブミットされた時の挙動
if(isset($_POST["submit"])){
    if (isset($_POST["name"],$_POST["password"])) {
        //SQLインジェクション対策
    $name = htmlspecialchars($_POST["name"]);
    $pass = htmlspecialchars($_POST["password"]);

    //データベースに格納されているデータを引っ張ってくる
    $sql = "SELECT * FROM info WHERE username = '$name' ";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute();
    
    //引っ張ってきたデータを一行ずつ取ってくる
    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        //カラム名がキー名になる
    
    $password = $row["password"];//[password]というカラムに格納されているデータ一覧
    
    if( password_verify($pass,$password)){
        //POSTされてきたユーザ名と格納されているユーザ名、POSTされてきたパスワードとハッシュ化され格納されているパスワードが一致しているか確認する。
        $_SESSION["NAME"] = $name;
        header("Location: index.php");
        exit;
    }else{
        echo "ユーザ名もしくはパスワードが間違っています。";
    }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン</title>
</head>
<body>
    <form action = "<?= basename(__FILE__) ?>" method = "POST">
    <h1>ログイン</h1>
    <p>名前</p>
    <input type ="text" name = "name" >
    <p>password</P>
    <input type = "text" name = "password">
    <div><input type = "submit" name = "submit" value = "ログイン"></div>
    </form>
</body>
</html>