<?php
//データベース接続
$pdo = new PDO("mysql:host=localhost;dbname=login;charset=utf8mb4", "php_user", "phpPHP0123!",);
//エラー検出
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$created_at = date("Y-m-d H:i:s");

//サブミットされた時の挙動
if(isset($_POST["submit"])){
    if(isset($_POST["name"]) && isset($_POST["comment"])){
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        //データを書き込む
        $sql = "INSERT INTO info(name,comment,create_at) VALUES(:name,:comment,:time)";
        $stmt = $pdo -> prepare($sql);
        //変数をバインドする
        $stmt -> bindvalue(":name",$name,PDO::PARAM_STR);
        $stmt -> bindvalue(":comment",$comment,PDO::PARAM_STR);
        $stmt -> bindvalue(":time",$created_at,PDO::PARAM_STR);
        $stmt -> execute();
        
        
    }
}

//格納されたデータの数を調べる
$sql ="SELECT COUNT(*) FROM info ";
$c_stmt =$pdo ->prepare($sql);
$c_stmt -> execute();
$result = $c_stmt -> fetch(PDO::FETCH_ASSOC);
$c_result = intval($result['COUNT(*)']);

//最大ページ数
$max_page = ceil($c_result / 5);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$st_offset = ($page - 1) * 5;
$sql = "SELECT * FROM info ORDER BY 'id' LIMIT 5 OFFSET {$st_offset}";
$stmt = $pdo -> prepare($sql);
$stmt -> execute();





?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ひと言掲示板</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="keijiban.css">
</head>
<body>
    <h1>ひと言掲示板</h1>
    <form action = "<?= basename(__FILE__) ?>" method = 'post'>
        <p>名前</p>
        <input type ="text" name ="name" required>
        <p>ひとことコメント</p>
        <textarea name ="comment" size ='60' required></textarea>
        <input type ="submit" name ="submit" value ="送信">
        <div class="sample">
            <img src="keijiban.jpg" width="800" height="500">
            <div class="bun">
                <ul>
                    <?php while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) :?>
                        <tr>
                            <th>id</th>
                            <th>名前</th>
                            <th>コメント</th>
                            <th>日時</th>
                        </tr>
                        <tr>
                            <div><?php echo htmlspecialchars($row['id'], ENT_QUOTES, "UTF-8") ; ?>:
                                <?php echo htmlspecialchars($row['name'], ENT_QUOTES, "UTF-8") ; ?>さん
                                <?php echo htmlspecialchars($row['comment'], ENT_QUOTES, "UTF-8") ; ?>ー
                                <?php echo htmlspecialchars($row['create_at'], ENT_QUOTES, "UTF-8") ; ?>
                            </div>
                        </tr>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </form>
        
    <?php for($i = 1;$i <= $max_page; $i++): ?>
        <a href = '<?php  echo basename(__FILE__). "?page=$i"  ; ?>' > <?php echo $i; ?> </a>
    <?php endfor; ?>
</body>
</html>
    
        



