<?php

if(isset($_POST['submit'])){
$array = ["グー","チョキ","パー",];
$key = array_rand($array,1);
$user = $_POST["playerHand"];
$cpu = $array[$key]; //$arrayのvalueをランダムに格納
$result = [
    "グー" => [
        "グー" => "あいこ",
        "チョキ" => "あなたの勝ち",
        "パー" => "あなたの負け",
    ],
    "チョキ" => [
        "グー" => "あなたの負け",
        "チョキ" => "あいこ",
        "パー" => "あなたの勝ち",
    ],
    "パー" => [
        "グー" => "あなたの勝ち",
        "チョキ" => "あなたの負け",
        "パー" => "あいこ"
    ]
];

}
?>
<html>
<head>
    <meta charset="utf8">
    <title>じゃんけん</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <form action ="battle.php" method ="post">
        <div id="wrapper">
            <header>
                <div class="header-logo">じゃんけんプログラム</div>
            </header>
            <select name = 'playerHand'>
                <option value ='グー'>グー</option>
                <option value ='チョキ'>チョキ</option>
                <option value ='パー'>パー</option>
            </select>
        <input type = 'submit' name = 'submit' value = '勝負'>
            <p>ユーザー:<?php if(isset($user)){ echo $user;} ?></p>
            <p>CPU:<?php if(isset($cpu)){ echo $cpu;} ?></p>
            結果：<?php if(isset($result , $user , $cpu)){ echo $result[$user][$cpu];} ?>
            <footer>
                <small>&copy;Japanese game!</small>
            </footer>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
