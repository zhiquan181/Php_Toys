<meta charset="utf-8">
<?php
    header("Content-type:text/html,charset=utf8"); 
    include('simple_html_dom.php');

    function query($phone='')
    {
        $url='http://www.ip138.com:8080/search.asp?action=mobile&mobile='.$phone;
        $ch = curl_init();
        $timeout = 5;  
        curl_setopt ($ch, CURLOPT_URL, $url);  
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)");  
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
        curl_setopt ($ch, CURLOPT_REFERER, 'http://www.cltt.org/studentscore');  
        $contents = curl_exec($ch);  
        $contents = mb_convert_encoding($contents, 'utf-8', 'GBK,gb18030,gb2312');
        curl_close($ch);
        return $contents;
    }

    function simple($phone='')
    {
        $contents = query($phone);
        $html = new simple_html_dom();
        $html ->load($contents);
        $arrMsg = array();          
        foreach($html->find('table tbody tr td') as $m) {
            array_push($arrMsg,$m->plaintext);
        }
        return $arrMsg;
    }

    $ph=$_GET["phone"];
    var_dump(simple($ph));
?>