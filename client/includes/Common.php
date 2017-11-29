<?php
/**
 * Created by PhpStorm.
 * User: Whip1ash
 * Date: 28/11/2017
 * Time: 00:05
 */

class Common
{
    /*
     * 出现错误的时候存储日志
     * @param string $type 存储时的文件名变量
     * @param string $message 错误信息
     * @return bool $status 是否成功
     * */
    public static function save_log($type,$message){
        $date = date("Y-m-d");
        $log_name = 'log_'.$type.'_'.$date;
        $file_handle = fopen($log_name,'a+');
        $log_message = date("Y-m-d H:i").'\t'.$message.'\n';
        $status = fwrite($file_handle,$log_message);
        fclose($file_handle);
        return $status;
    }

    /*
     * 删除所有文件
     * @param array $dir_array 储存路径的数组*/
    public static function delete_all(array $dir_array){
        foreach ($dir_array as $dir)
            if (is_dir()){
                rmdir($dir);
            }else{
                unlink($dir);
            }
    }



}