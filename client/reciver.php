<?php
/**
 * Created by PhpStorm.
 * User: Whip1ash
 * Date: 27/11/2017
 * Time: 23:15
 */
require_once ('constant.php');
require_once ('includes/Request.php');
require_once ('includes/Common.php');
$json_data = json_decode($_POST['data'],1);

//oprate_code ������
//oprate_code == 0 ʲô��������
//oprate_code == 1 ɾ����������ļ�
$oprate_code = $json_data['oprate_data'];
if ($oprate_code == 0){
    //ʲô������
    exit();
}elseif($oprate_code == 1){
    //ɾ�������ļ�
    //ɾ��֮ǰ������������message ˵��Ҫɾ�������ļ���
    $message = json_encode(array(
        'message'=>'delete all'
    ));
    $http_code = Request::post(SERVER_URL,$message);

    if ($http_code != 200){
        //������ɹ��Ļ�,��ô�ͼ�¼������log�����˳�
        Common::save_log('http_error','Send message to server faild! The http_code is '.$http_code);
        //TODO:���д��ʧ�ܵĻ�,��Ҫ��¼����ԭ��,���������ʱ��һ�����͸���֤������
        exit();
    }
    //TODO:����·��ɾ�������ļ�
    //delete
    $request_dir = json_encode(array(
        'message'=>'get_dirs'
    ));
    $return_data = Request::post(SERVER_URL,$request_dir);
    Common::delete_all();

}
