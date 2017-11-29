<?php
/**
 * Created by PhpStorm.
 * User: Whip1ash
 * Date: 28/11/2017
 * Time: 17:17
 */
//这个文件在接受scan请求时对整个项目进行拓扑
//我先扫描这个路径

function scan($dir=''){
    if ($dir == '')
        $dir_arr = scandir(__DIR__);
    else
        $dir_arr = scandir($dir);

    $return_data = $dir_arr;

    foreach ($dir_arr as $directory){
//        if ($directory == '.' || $directory == '..') {
//            continue;
//        }elseif(is_dir($directory)) {
//            //从数组里删除这个元素
//            $key = array_search($directory, $return_data);
////            echo $key;
//            array_splice($return_data, $key, 1);
//            $return_data[$directory] = scan($directory);
//        }
        if ($directory != '.'&&$directory!='..'){
            if (is_dir($directory)){

                $key = array_search($directory, $return_data);

                array_splice($return_data, $key, 1);



                $return_data[$directory] = scan($dir.$directory);
            }
        }
    }


    return $return_data;
}

function read_dir_queue($dir=''){
    $dir = empty($dir)?__DIR__:$dir;
    $files=array();
    $queue=array($dir);
    while($data=each($queue)){
        $path=$data['value'];
        if(is_dir($path) && $handle=opendir($path)){
            while($file=readdir($handle)){
                if($file=='.'||$file=='..') continue;
                $files[] = $real_path=$path.'/'.$file;
                if (is_dir($real_path)) $queue[] = $real_path;
            }
        }
        closedir($handle);
    }
    return $files;
}

echo json_encode(read_dir_queue());

//    try{
//echo json_encode(scan('../server/'));}
//catch (Exception $e){
//    print $e;
//}

//echo is_dir('../server');