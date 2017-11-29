<?php
/**
 * Created by PhpStorm.
 * User: Whip1ash
 * Date: 28/11/2017
 * Time: 00:05
 */

class Common
{
    public static function save_http_log($type,$message){
        $date_tmp = date("Y-m-d");
        $log_name = 'log_'.$type.'_'.$date_tmp;
        $file_handle = fopen($log_name,'a+');
        $log_message = date("Y-m-d H:i")."\t".$message."\n";
        fwrite($file_handle,$log_message);
        fclose($file_handle);
    }

}