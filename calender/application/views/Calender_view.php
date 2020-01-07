<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="jquery/js/jQuery-3.3.1.min.js" ></script> -->
    
    <title>カレンダー</title>
</head>
<body>
    <?php echo $calender ; ?>
    <?php
    $year=$this->uri->segment(3);
    $month=$this->uri->segment(4);
    ?>
    <script>
    $("td").on('click',function(){
            var str_obj = $(this).text();
            var len = str_obj.length;
            var number =$(this).text();
            if(len<2){
            var number= 0 + $(this).text();
            }
            var day = "<?= $year;?>"+"<?= $month;?>"+number;
            var plans = prompt("予定を入力して下さい");
            
            $.ajax({
                url:"http://[::1]/SAMPLE/calender/index.php/calender/screen",
                type:"POST",
                data:{
                    day: day,
                    plans: plans
                }
            })
            .then(
                function(data){
                    alert("予定の書き込みに成功しました");
                },
                function(){
                    alert("予定の書き込みに失敗しました");
                }
            )
        });
    </script>
</body>
</html>