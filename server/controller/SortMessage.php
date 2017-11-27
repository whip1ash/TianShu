<?php
/**
 * Created by PhpStorm.
 * User: lalala
 * Date: 2017/11/25
 * Time: 19:56
 */
   $data = json_decode($_POST['data'],1);
   echo "<br>";
   var_dump($data);
   if (!empty($data['id'])){
       $return_data = array('success'=>true,'data'=>'test_success!','error'=>null);
       echo json_encode($return_data);
   }
?>