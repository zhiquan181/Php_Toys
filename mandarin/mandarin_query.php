<meta charset="utf-8">
<?php
    header("Content-type:text/html,charset=utf8");
    $url = 'http://www.cltt.org/StudentScore/ScoreResult';

    $name = $_POST['name'];
    $stuID = $_POST['stuID'];
    $idCard = $_POST['idCard'];

    $data = array (
        'name' => $name,
        'stuID' => $stuID,
        'idCard' => $idCard
    );

    $ch = curl_init();
    $timeout = 5;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt ($ch, CURLOPT_POST, 1 );//请求方式为post
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $data );//post传输的数据
    curl_setopt ($ch, CURLOPT_REFERER, 'http://www.cltt.org/studentscore');
    $contents = curl_exec($ch);

    curl_close($ch);
    print_r($contents);

?>