<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<style type="text/css">
    *{margin: 0;padding: 0;border: 0;font-family: 微软雅黑;}
    body{background-color: #e9e9e9;}
    @media (min-width: 450px){
        .result_box{
            width: 100%;
            max-width: 600px;
            height: 800px;
            margin: 0 auto;
            background-color: #e9e9e9;
        }
    }
    .result_p0{
        width: 95%;
        height: 50px;
        display: block;
        padding-left: 5%;
        line-height: 50px;
        font-size: 14px;
        background-color: #e9e9e9;
        transition: background-color .5s ease; 
    }
    .result_p0:hover{
    	background-color: #fff;
    }
    .result_p1{
        width: 95%;
        height: 50px;
        display: block;
        padding-left: 5%;
        line-height: 50px;
        font-size: 14px;
        background-color: #f5f5f5;
        transition: background-color .5s ease; 
    }
    .result_p1:hover{
    	background-color: #fff;
    }
    .result_s{font-size: 12px;text-align: center;}
</style>
<?php
	header("Content-type:text/html,charset=utf8");
	include('simple_html_dom.php');
	$ip=$_GET['ip'];

	$url = 'http://ip.chinaz.com/'.$ip;

	$ch = curl_init();  
    for($i=0;$i<1;$i++)
    {
    	curl_setopt($ch, CURLOPT_URL, $url);  
    	curl_setopt($ch, CURLOPT_HEADER, 1);  
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// 这个是主要参数  
        $output = curl_exec($ch) ;  
        $html = new simple_html_dom();
        $html ->load($output);
    	curl_close($ch);  
        $arrMsg = array();     
        
        foreach($html->find('.WhoIpWrap p span') as $m) {
            array_push($arrMsg,$m->plaintext);
        }
        // var_dump($arrMsg);

        if(!empty($arrMsg)) {
echo<<<begin
    <body>
        <div class="result_box">
            <br/>
            <p class="result_p1">$arrMsg[0]</p>
            <p class="result_p0">$arrMsg[4]</p>
            <p class="result_p1">$arrMsg[1]</p>
            <p class="result_p0">$arrMsg[5]</p>
            <p class="result_p1">$arrMsg[2]</p>
            <p class="result_p0">$arrMsg[6]</p>
            <p class="result_p1">$arrMsg[3]</p>
            <p class="result_p0">$arrMsg[7]</p>
            <br/><br/>
            <p class="result_s">以上数据来之站长之家</p>
        </div>
    </body>
begin;
            break;
        }
        else{
echo<<<begin
    <div class="result_box">
        <br/>
        <p align="center">抱歉，您输入IP域名不存在-_-!! 或者输入有误。</p>
    </div>
begin;
        break;
        }
    }


?>