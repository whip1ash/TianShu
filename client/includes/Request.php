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
     * ����post����
     * @param string $url Ҫ�����url
     * @param array $data Ҫ���͵�����
     * @
     * */
    public static function post($url,$data,$debug=0){
        $data = array('data'=>$data);
        $init = curl_init($url);

        curl_setopt($init,CURLOPT_HEADER,1);
        curl_setopt($init, CURLOPT_POST, 1);
        curl_setopt($init,CURLOPT_RETURNTRANSFER,$debug);
        curl_setopt($init,CURLOPT_POSTFIELDS,$data);

        $res = curl_exec($init);
        $http_code = curl_getinfo($init,CURLINFO_HTTP_CODE);
        curl_close($init);
        if ($debug){
            echo $res;
            echo "<br>";
        }

        return $http_code;
    }
}