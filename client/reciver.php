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

//oprate_code 操作码
//oprate_code == 0 什么都不操作
//oprate_code == 1 删除所有外包文件
$oprate_code = $json_data['oprate_data'];
if ($oprate_code == 0){
    //什么都不做
    exit();
}elseif($oprate_code == 1){
    //删除所有文件
    //删除之前给服务器发送message 说明要删除所有文件了
    $message = json_encode(array(
        'message'=>'delete all'
    ));
    $http_code = Request::post(SERVER_URL,$message);

    if ($http_code != 200){
        //如果不成功的话,那么就记录到本地log并且退出
        Common::save_log('http_error','Send message to server faild! The http_code is '.$http_code);
        //TODO:如果写入失败的话,需要记录错误原因,当有网络的时候一并发送给认证服务器
        exit();
    }
    //TODO:根据路径删除所有文件
    //delete
    $request_dir = json_encode(array(
        'message'=>'get_dirs'
    ));
    $return_data = Request::post(SERVER_URL,$request_dir);
    Common::delete_all();

}
