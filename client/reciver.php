<?php
/**
 * Created by PhpStorm.
 * User: Whip1ash
 * Date: 27/11/2017
 * Time: 23:15
 */
require_once ('constant.php');
require_once ('includes/Request.php');
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
    $http_code = Request::post(SERVER_URL);

    if ($http_code != 200){
        //������ɹ��Ļ�,��ô�ͼ�¼������log�����˳�
        Common::save_http_log('http_error','Send message to server faild! The http_code is '.$http_code);
        exit();
    }
    //TODO:����·��ɾ�������ļ�
}
