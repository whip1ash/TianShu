<?php
/**
 * Created by PhpStorm.
 * User: Whip1ash
 * Date: 25/11/2017
 * Time: 21:07
 */

class Request
{
    /* *
     * 发送post请求
     * @param string $url 要请求的url
     * @param array $data 要发送的数据
     * @
     * */
    public static function post($url,$data,$return_data=0,$debug=0){
        $data = array('data'=>$data);
        $init = curl_init($url);

        //是否输出response header
        curl_setopt($init,CURLOPT_HEADER,$debug);
        curl_setopt($init, CURLOPT_POST, 1);
        //是否返回数据
        curl_setopt($init,CURLOPT_RETURNTRANSFER,$return_data);
        curl_setopt($init,CURLOPT_POSTFIELDS,$data);

        $res = curl_exec($init);
        $http_code = curl_getinfo($init,CURLINFO_HTTP_CODE);
        curl_close($init);
        if ($return_data){
            return $res;
        }elseif ($debug){
            echo $res;
            echo "<br>";
        }

        return $http_code;
    }
}