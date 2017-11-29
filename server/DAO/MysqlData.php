<?php
/**
 * Created by PhpStorm.
 * User: lalala
 * Date: 2017/11/28
 * Time: 16:16
 */

use Medoo\Medoo;

include_once ("../MysqlConst.php");
include_once ("../../client/includes/Common.php");

class Save
{

    private $database;
    public function __construct()
    {
        $this->database = new Medoo([
            'database_type' => database_type,
            'database_name' => database_name,
            'server' => server,
            'username' => username,
            'password' => password]);
    }

    /**
     * 查询表中行数
     * @param $table 待查询表名
     * @return mixed 行数
     */
    private function tableNumber($table){
        return $this->database->count($table,'*');
    }


    /**
     * 判断是否是第一次发心跳包
     * @param $client_id
     * @return int
     */
    private function  judgeIsFirstClient($client_id){
        if(empty($client_id)){
            return -1;
        }
        return  $this->database->count('client',[
            'id' => $client_id
        ]);

    }


    /**
     * 存储心跳包
     * @param $heartBeat[client_id,content]
     * @return bool 是否成功存储
     */
    public function saveHeartBeat($heartBeat){
        try {
            $preNumber = $this->tableNumber('client_log');
            if (!empty($heartBeat['client_id'])) {
                $client_id = $heartBeat['client_id'];

            } else {
                Common::save_http_log('[error]', 'saveHeartBeat($heartBeat)  client_id为空');
                return false;
            }

            if (!empty($heartBeat['content'])) {
                $content = $heartBeat['content'];
            } else {
                $content = "";
            }

            $saveHeartBeat_info = $this->database->insert('client_log', [
                'client_id' => $client_id,
                'content' => $content
            ]);


            $afterNumber = $this->tableNumber('client_log');

            if ($afterNumber - $preNumber == 1) {
                Common::save_http_log('[info]', 'saveHeartBeat($heartBeat) 成功插入 sql ：' . json_encode($saveHeartBeat_info));
                return true;
            } else {
                Common::save_http_log('[error]', 'saveHeartBeat($heartBeat) 插入数据失败');
                return false;
            }
        } catch (Exception $e) {
            Common::save_http_log('[error]', 'saveHeartBeat($heartBeat) '.$e->getMessage());
            return false;
        }
    }

    /**
     * 插入Client
     * @param $client[id(client_id),type,money,money_percent]
     * @return bool 是否成功插入
     */
    public function saveClient($client){

        try {
            if (!empty($client['id'])) {
                $client_id = $client['id'];
            } else {
                Common::save_http_log('[error]', 'saveClient($client) client_id 为空');
                return false;
            };

            if ($this->judgeIsFirstClient($client['id']) > 0) {
                Common::save_http_log('[error]', 'saveClient($client) client_id不唯一');
                return false;
            }

            if (!empty($client["type"]) && $client["type"] < 3) {
                $type = $client["type"];
            } else {
                $type = 0;
            }

            if (!empty($client["money"]) && $client["money"] > 0) {
                $money = $client["money"];
            } else {
                Common::save_http_log('[error]', 'saveClient($client)  未付款金额错误');
                return false;
            }

            if (!empty($client["money_percent"])) {
                $money_percent = $client["money_percent"];
            } else {
                $money_percent = 0;
            }

            $preNumber = $this->tableNumber('client');

            $saveClient = $this->database->insert('client', [
                'id' => $client_id,
                'type' => $type,
                'money' => $money,
                'money_percent' => $money_percent
            ]);


            $afterNumber = $this->tableNumber('client');
            if ($afterNumber - $preNumber == 1) {
                Common::save_http_log('[info]', 'saveClient($client) 成功插入数据 ：' . json_encode($saveClient));
                return true;
            } else {
                Common::save_http_log('[error]', 'saveClient($client) 插入数据失败'. json_encode($saveClient));
                return false;
            }
        } catch (Exception $e) {
            Common::save_http_log('[error]', 'saveClient($client) '.$e->getMessage());
            return false;
        }

    }


    /**
     * 更新应付金钱
     * @param $client[id(client_id),money]
     * @return bool 是否成功更新
     */
    public function updateMoney($client){
        try {
            if ($this->judgeIsFirstClient($client["id"]) > 0) {
                Common::save_http_log('[error]', 'setMoney($client) client_id为空');
                return false;
            }

            if (!empty($client["money"]) && $client["money"] > 0) {
                $updateMoney = $this->database->update('client', [
                    'money' => $client["money"]
                ],
                    [
                        'id' => $client["id"]
                    ]
                );
            } else {
                Common::save_http_log('[error]', 'setMoney($client) money错误');
                return false;
            }

            if ($updateMoney) {
                Common::save_http_log('[info]', 'setMoney($client) 成功更新money'.json_encode($updateMoney));

                return true;
            } else {
                Common::save_http_log('[error]', 'setMoney($client) 更新money错误'.json_encode($updateMoney));
                return false;
            }
        } catch (Exception $e) {
            Common::save_http_log('[error]', 'setMoney($client)'.$e->getMessage());
            return false;
        }
    }

    /**
     * 更新应付金钱百分比
     * @param $client[id(client_id),money_percent]
     * @return bool 是否成功更新
     */
    public function  updateMoneyPer($client){
        try {
            if ($this->judgeIsFirstClient($client["id"]) > 0) {
                Common::save_http_log('[error]', 'updateMoneyPer($client) client_id为空');
                return false;
            }

            if (!empty($client["money_percent"]) && $client["money_percent"] > 0) {
                $updateMoney = $this->database->update('client', [
                    'money_percent' => $client["money_percent"]
                ],
                    [
                        'id' => $client["id"]
                    ]
                );
            } else {
                Common::save_http_log('[error]', 'updateMoneyPer($client) money_percent错误');
                return false;
            }

            if ($updateMoney) {
                Common::save_http_log('[info]', 'updateMoneyPer($client) 成功更新money_percent'.json_encode($updateMoney));

                return true;
            } else {
                Common::save_http_log('[error]', 'updateMoneyPer($client) 更新money错误'.json_encode($updateMoney));
                return false;
            }
        } catch (Exception $e) {
            Common::save_http_log('[error]', 'updateMoneyPer($client)'.$e->getMessage());
            return false;
        }
    }


}

?>