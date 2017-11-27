<?php
/**
 * Created by PhpStorm.
 * User: lalala
 * Date: 2017/11/25
 * Time: 19:56
 */
   $post = json_decode($_POST);
   if (!empty($post['id'])){
       $return_data = array('success'=>true,'data'=>'test_success!','error'=>null);
       echo json_encode($return_data);
   }
?>