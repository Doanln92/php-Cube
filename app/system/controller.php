<?php

/**
 * @author Le Ngoc Doan
 * @copyright 2016
 */

$path_list = get_list_path();
if(!$path_list) $path_list = array('index');
if($path_list){
    $p1 = get_path(1,$path_list[0]);
    $sp = false;
    $t = count($path_list);
    for($i=0;$i<$t;$i++){
        $p = $path_list[$i];
        $pe = cube_exists($p);
        if($p1=='ajax'){
            if(cube_get_file_path($p)){
                display($pl);
                $i += ($t+100);
                $sp = true;
            }elseif($pe){
                get_cube($p);
                $sp = true;
                $i += ($t+100);
            }
        }
        elseif($pe){
            get_cube($p);
            $sp = true;
            $i+= ($t+100);
        }
    }
    if(!$sp){
        if($p1=='ajax'){
            echo '{}';
        }
        else{
            get_cube('404');
        }
    }
}else{
    get_cube('404');
}
?>