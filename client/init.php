<?php
/**
 * Created by PhpStorm.
 * User: Whip1ash
 * Date: 25/11/2017
 * Time: 20:24
 */
define('init_correct',true);
include_once ('includes/Request.php');
$test_json = ['id'=>1];
$test_json = json_encode($test_json);
echo $test_json;
echo '<br>';
$url= '123.206.83.137/server/controller/SortMessage.php';
$test_post = Request::post($url,$test_json,1);
echo $test_post;

