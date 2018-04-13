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
        height: 60px;
        display: block;
        padding-left: 5%;
        line-height: 30px;
        font-size: 14px;
        background-color: #e9e9e9;
        transition: background-color .5s ease; 
    }
    .result_p0:hover{
    	background-color: #fff;
    }
    .result_p1{
        width: 95%;
        height: 60px;
        display: block;
        padding-left: 5%;
        line-height: 30px;
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
	error_reporting(0);
	include('simple_html_dom.php');
	$domain=$_GET['domain'];
	$url='http://www.beianbeian.com/search/'.$domain;


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
        // print_r($output);
    	curl_close($ch);  
    	// var_dump($output); 
        $arrMsg = array();     
        
        foreach($html->find('tbody tr td') as $m) {
            array_push($arrMsg,$m->plaintext);
        }

        if($arrMsg[0]==1) {
echo<<<begin
    <body>
        <div class="result_box">
            <br/>
            <p class="result_p1">序号： $arrMsg[0]</p>
            <p class="result_p0">主办单位名称： $arrMsg[1]</p>
            <p class="result_p1">主办单位性质： $arrMsg[2]</p>
            <p class="result_p0">网站备案/许可证号： $arrMsg[3]</p>
            <p class="result_p1">网站名称： $arrMsg[4]</p>
            <p class="result_p0">网站首页网址： $arrMsg[5]</p>
            <p class="result_p1">审核时间： $arrMsg[6]</p>
            <p class="result_p0">是否限制接入 ： $arrMsg[7]</p>
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
        <p align="center">您输入的域名未备案或者备案取消-_-!!</p>
    </div>
begin;
        break;
        }
    }


?>