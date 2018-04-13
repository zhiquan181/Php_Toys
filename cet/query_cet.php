<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<style type="text/css">
    *{margin: 0;padding: 0;border: 0;font-family: 微软雅黑;}
    @media (min-width: 450px){
        .result_box{
            width: 100%;
            max-width: 600px;
            height: 800px;
            margin: 0 auto;
            background-color: #f8f8f8;
        }
    }
    .result_box span{
        width: 100%;
        height: 35px;
        display: block;
        line-height: 35px;
        text-align: center;
        color: #fff;
        background-color: #123456;
    }

    .result_p{
        width: 95%;
        height: 35px;
        margin: 0 0 0 5%;
        line-height: 35px;
        font-size: 15px;
    }
    .result_p_detel{
        width: 90%;
        height: 35px;
        margin: 0 0 0 10%;
        color: #666;
        font-size: 15px;
        line-height: 25px;
    }
    .result_error{
        text-align: center;
    }
    .result_s{font-size: 12px;text-align: center;}
</style>

<?php
    error_reporting(0);
    include('simple_html_dom.php');
    header("Content-type:text/html,charset=utf8");
    $zkzh=$_POST['num'];
    $xm=$_POST['name'];
    // $zkzh = '445050162102530';
    // $xm = 'czq';
    $curlPost='zkzh='.$zkzh.'&xm='.$xm;
    $ch = curl_init("http://www.chsi.com.cn/cet/query?".$curlPost) ;  
    $arrMsg = array();
    for($i=0;$i<15;$i++)
    {
        curl_setopt($ch, CURLOPT_REFERER, "http://www.chsi.com.cn/cet/"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $output = curl_exec($ch) ;  
        $html = new simple_html_dom();
        $html ->load($output);
        // print_r($output);
        foreach($html->find("td") as $m) {
            array_push($arrMsg,$m->plaintext);
        }
        if($arrMsg[6]!=null) {
echo<<<begin
        <div class="result_box">
            <p class="result_p">姓名：$arrMsg[2]</p>
            <p class="result_p">学校：$arrMsg[3]</p>
            <p class="result_p">考试级别：$arrMsg[4]</p>
            <span>笔试成绩</span>
            <p class="result_p">准考证号：$arrMsg[5]</p>
            <p class="result_p">总分：$arrMsg[6]</p>
            <p class="result_p_detel">听力：$arrMsg[8]</p>
            <p class="result_p_detel">阅读：$arrMsg[10]</p>
            <p class="result_p_detel">写作和翻译：$arrMsg[10]</p>
            <span>口试成绩</span>
            <p class="result_p">准考证号：$arrMsg[13]</p>
            <p class="result_p">等 级：$arrMsg[14]</p>
            <br/><br/><br/>
            <p class="result_s">(以上数据来之学信网、99宿舍网)</p>
        </div>
begin;
            break;
        }
        else{
            // var_dump($arrMsg);
echo<<<begin
        <div class="result_box">
            <br/><br/>
            <p class="result_error">查询失败，请稍后重新查询。</p>
        </div>
begin;
        break;
        }
        
    }


?>