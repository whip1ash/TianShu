<?php
/**
 * Created by PhpStorm.
 * User: Whip1ash
 * Date: 25/11/2017
 * Time: 20:24
 */
define('init_correct',true);

include_once ('includes/Request.php');
include_once ('constant.php');

$test_json = ['id'=>1];
$test_json = json_encode($test_json);
echo $test_json;
echo '<br>';
$test_post = Request::post(SERVER_URL,$test_json);
echo $test_post;

