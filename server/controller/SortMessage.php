<?php
/**
 * Created by PhpStorm.
 * User: lalala
 * Date: 2017/11/25
 * Time: 19:56
 */
include_once ("../DAO/MysqlData.php");

try {
    $data = json_decode($_POST['data'], 1);
    $db = new Save();

    $result = $db->saveClient($data);
    if ($result) {
        Common::save_http_log('[info]', '调用saveClient($client) 成功');
        return json_encode(['success' => 'true']);
    } else {
        Common::save_http_log('[error]', '调用saveClient($client) 失败');
        return json_encode(['error' => '服务器内部错误']);
    }
    $result = $db->saveHeartBeat($data);
    if ($result) {
        Common::save_http_log('[info]', '调用saveHeartBeat($client) 成功');
        return json_encode(['success' => 'true']);
    } else {
        Common::save_http_log('[error]', '调用saveHeartBeat($client) 失败');
        return json_encode(['error' => '服务器内部错误']);
    }
} catch (Exception $e) {
    Common::save_http_log('[error]', 'SortMessage.php 出现异常');
    return json_encode(['error' => '服务器内部错误']);
}



?>