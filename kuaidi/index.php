<html>
<head>
    <title>快递查询</title>
    <meta charset="utf-8">
    <meta name="description" content="快递查询">
    <style type="text/css">
        *{margin: 0;padding: 0;border: 0;}
        body{background-color: rgb(240,240,240);font-family: Microsoft YaHei;}
        p{padding-bottom: 10px;}
        .p_input{width: 100%;height: 50px;outline: 0;padding-left: 50px;font-family: Microsoft YaHei;font-size: 16px;}
        .p_sub{width: 100%;height: 50px;font-family: Microsoft YaHei;background-color: rgb(90,215,0);color: #fff;font-size: 16px;}

        .result_p{width: 95%;padding-left: 5%;height: 60px;display: block;line-height: 60px;background-color: #f8f8f8;}
        .result_p0{
            width: 95%;
            height: 40px;
            display: block;
            padding-left: 5%;
            line-height: 40px;
            font-size: 14px;
            background-color: #fff;
            transition: background-color .5s ease; 
        }
        .result_p1{
            width: 95%;
            height: 60px;
            display: block;
            padding-left: 5%;
            line-height: 32px;
            font-size: 14px;
            background-color: #f8f8f8;
            transition: background-color .5s ease; 
        }
        .result_s{font-size: 12px;text-align: center;margin-top: 20px;}
    </style>
</head>

<body>
    <form method="post">
        <p><input class="p_input" name="kuaidi" type="number" placeholder="请输入单号" maxlength="30" value=""></p>
        <p><input id='show-toast' class="p_sub" name="submit" type="submit" value="查询" onclick="return form_onsubmit(this.form)"/></p>
    </form>
    <script type="text/javascript">
        function form_onsubmit(obj){   
            if(obj.kuaidi.value == "") {
                alert("亲~请输入单号");
                return false;
            }  
            else{
                // $(document).on("click", "#show-toast", function() {
                //     $.toast("操作成功", function() {
                //         console.log('close');
                //     });
                // })
                return true;
            }
        }
    </script>
    <!-- <script>
    $(function() {
    FastClick.attach(document.body);
    });
    </script> -->
</body>
</html>

<?php 
    error_reporting(0);
    if(isset($_POST['submit'])){
        include 'search.php';
        $k = new kuaidi_query($_POST['kuaidi']);
        $res = $k->kuaidi_query_number();
        // var_dump($res);
        
        if ($res['message']=='ok') {
            $res01 = $res['data'];
            echo("<p class='result_p'>快递单号：$_POST[kuaidi]</p>");
            foreach ($res01 as $key => $value) {
                // var_dump ($key);
                $res02 = $value;
                echo("<p class='result_p0'>$res02[time]</p>");
                echo("<p class='result_p1'>$res02[context]</p>");
            }
            echo ("<p class='result_s'>以上数据来之快递100、快递查询网</p>");
        }
        else {
        // echo $jsondata['msg'];
echo<<<begin2
        <br/>
        <p align="center">抱歉，您输入的快递单号有误或者服务器繁忙!</p>
begin2;
        }
    }

?>

<p align="center" style="font-size: 12px;margin-top: 20px;">by 赛亚王子_Vegeta</p>