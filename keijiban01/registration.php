<?php 
$pdo = new PDO("mysql:host=localhost;dbname=user;charset=utf8mb4", "php_user", "phpPHP0123!",);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$error = "入力されたパスワードが一致しません。";
if(isset($_POST['submit'])){
    if($_POST['password'] == $_POST['re_password']){
        $pass = $_POST['password'];
        $re_pass = $_POST['re_password'];
        $name = $_POST['name'];
        $hash = password_hash($pass,PASSWORD_ARGON2I);
        $sql = "INSERT INTO info(username,password) VALUES(:name,'$hash')";
        $stmt = $pdo -> prepare($sql);
        $stmt -> bindValue(":name",$name,PDO::PARAM_STR);
        $stmt -> execute();

        header('Location: login.php');        
    }elseif($_POST['password'] !== $_POST['re_password']){
            echo $error;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新規登録</title>
</head>
<body>
    <h1>新規登録</h1>
    <form action = "<?php basename(__FILE__); ?>" method ="post">
    <p>登録名</p>
    <input type = "text" name = "name" required>
    <div><p>パスワード</p>
    <input type = "text" name = "password" required>
    <p>パスワード（確認用）</p>
    <input type = "text" name = "re_password" required></div>
    <input type ="submit"  name ="submit" value ="登録" >
    </form>
</body>
</html>