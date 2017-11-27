<?php
/**
 * Created by PhpStorm.
 * User: Whip1ash
 * Date: 25/11/2017
 * Time: 20:24
 */
define('init_correct',ture);
include_once ('includes/Request.php');
$test_json = ['id'=>1];
$test_json = json_encode($test_json);

$url= 'www.baidu.com';
$test_post = Request::post($url,$test_json,1);
echo $test_post;

