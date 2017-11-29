<?php
/**
 * Created by PhpStorm.
 * User: Whip1ash
 * Date: 28/11/2017
 * Time: 22:48
 */

define('SERVER_URL','123.206.83.137/server/controller/SortMessage.php');
define('CLIENT_ID','123asdgae32');

function post($url,$data){
    $data = array('data'=>$data);
    $init = curl_init($url);

    //是否输出response header
//    curl_setopt($init,CURLOPT_HEADER,1);
    curl_setopt($init, CURLOPT_POST, 1);
    //是否返回数据
    //如果是0 则print到屏幕上 1则返回到response中
    curl_setopt($init,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($init,CURLOPT_POSTFIELDS,$data);

    $res = curl_exec($init);
    $http_code = curl_getinfo($init,CURLINFO_HTTP_CODE);
    curl_close($init);



    $return_data = array(
        'response' => $res,
        'http_code' => $http_code
    );
    return $return_data;
}

function save_log($message){
    $date = date("Y-m-d");
    $log_name = 'log_error_log.log';
    $file_handle = fopen($log_name,'a+');
    $log_message = date("Y-m-d H:i")."\t".$message."\n";
    $status = fwrite($file_handle,$log_message);
    fclose($file_handle);
    return $status;
}

function analysis_log($file){
    $error_data = array(
        'http_error_data'=>array()
    );
    $filesize = filesize($file);
    $fhandle = fopen($file,'r');
    while ($fhandle){
        $content = fgets($fhandle);
        echo $content;
        echo "<br>";

        //进行内容的匹配
        preg_match('/^(.*)request error: Code is (\d*)/',$content,$match_http_error);

        if (!empty($match_http_error)&&!empty($match_http_error[2])){
            array_push($error_data['http_error_data'],$match_http_error[2]);
        }
        if (ftell($fhandle) == $filesize||ftell($fhandle)>$filesize){
            break;
        }
    }

    return $error_data;

}

$json = json_encode(['client_id'=>CLIENT_ID]);
$response_data = post(SERVER_URL,$json);

//var_dump($response_data);
if ($response_data['http_code']!=200){
    try {
        save_log('request error: Code is ' . $response_data['http_code']);
    }catch (Exception $e){
        echo $e->getMessage();
    }
}else{
    //如果探测网络通畅,本地分析给server回过去以前那里有问题
    if (file_exists("log_error_log.log")){
        $error_data = analysis_log("log_error_log.log");
        $json = json_encode($error_data);
        post(SERVER_URL,$json);
    }
}

