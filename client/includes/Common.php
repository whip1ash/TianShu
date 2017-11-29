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
     * ���ִ����ʱ��洢��־
     * @param string $type �洢ʱ���ļ�������
     * @param string $message ������Ϣ
     * @return bool $status �Ƿ�ɹ�
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
     * ɾ�������ļ�
     * @param array $dir_array ����·��������*/
    public static function delete_all(array $dir_array){
        foreach ($dir_array as $dir)
            if (is_dir()){
                rmdir($dir);
            }else{
                unlink($dir);
            }
    }



}