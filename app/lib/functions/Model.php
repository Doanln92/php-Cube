<?php

/**
 * @author Doanln
 * @copyright 2017
 */

function get_model_path($model){
    $p = rtrim(MODDIR,'/').'/'.ltrim($model);
    $f = (is_file($p) && !is_dir($p)) ? $p : (is_file($p.'.php')?$p.'.php':null);
    return $f;
}


function get_model($model){
    $ar = explode('/',$model);
    $ca = array_pop($ar);
    
    if(!class_exists($ca)){
        $f = get_model_path($model);
        if(!$f) return null;
        include_once($f);
    }
    if(!class_exists($ca)){
        return null;
    }
    
    $___query___ = "";
    $args = func_get_args();
    $t = count($args);
    for($i = 1; $i < $t; $i++){
        $___query___ .= (($i>1)?",":"")."\$args[$i]";
    }
    $s = null;
    $a = "\$s = new $ca($___query___ );";
    eval($a);
    return $s;
}

?>