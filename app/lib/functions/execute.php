<?php

/**
 * @author Le Ngoc Doan
 * @copyright 2016
 */

function cube_get_file_path($file=null,$dir=null){
    if(!is_string($file)&&!is_numeric($file)) return null;
    $d = is_string($dir)?rtrim($dir,'/').'/':rtrim(get_theme_dir(),'/').'/';
    $f = null;
    $p = $d.$file;
    $b = explode(rtrim(BASEDIR,'/'),$file);
    if(count($b)>1){
        if(file_exists($file)) $f = $file;
        elseif(file_exists($file.'.php')) $f = $file.'.php';
        elseif(file_exists($file.'.inc')) $f = $file.'.inc';
        elseif(file_exists($file.'.tpl')) $f = $file.'.tpl';
    }
    elseif(!is_dir($p)){
        if(file_exists($p)) $f = $p;
        elseif(file_exists($p.'.php')) $f = $p.'.php';
        elseif(file_exists($p.'.html')) $f = $p.'.html';
        elseif(file_exists($p.'.inc')) $f = $p.'.inc';
        elseif(file_exists($p.'.tpl')) $f = $p.'.tpl';
        
    }else{
        if(file_exists($p.'.php')) $f = $p.'.php';
        elseif(file_exists($p.'/index.php')) $f = $p.'/index.php';
        elseif(file_exists($p.'/index.html')) $f = $p.'/index.html';
        elseif(file_exists($p.'/index.inc')) $f = $p.'/index.inc';
        elseif(file_exists($p.'/index.tpl')) $f = $p.'/index.tpl';
    }
    return $f;
}
/**
 * kiem tra file truyen vao co ton tai hay ko?
 * @param String $file file hoac danh sach file, ngan cach bang dau phay (,)
 * @return Array tra ve mang danh sach file
 */
function cube_get_file_list($file=null,$dir=null){
    if(!is_string($file)&&!is_numeric($file)) return null;
    $a = array();
    if(is_string($file)){
        $b = explode(',',$file);
        $c = count($b);
        for($i=0;$i<$c;$i++){
            $d = cube_get_file_path(trim($b[$i]),$dir);
            if($d) $a[] = $d;
        }
    }
    elseif(is_array($file)){
        foreach($file as $e){
            $f = cube_get_file_path(trim($e),$dir);
            if($f) $a[] = $f;
        }
    }
    return $a;
}
function get_template_path($filename=null){
    $f = null;
    if($t = cube_get_file_path($filename,get_template_dir())){
        $f = $t;
    }
    return $f;
}

function get_system_template_path($filename=null){
    $f = null;
    if($t = cube_get_file_path($filename,get_system_template_dir())){
        $f = $t;
    }
    return $f;
}

function getTplCacheFile($filename=null,$request_uri = false, $request_query_string=false){
    if(is_file($filename)){
        $fs = explode('.',trim(str_replace(get_contents_dir(),'',$filename),'/'));
        $b = array_pop($fs);
        $f = implode('.',$fs);
        if($request_uri){
            $gg = str_dirname(getPath());
            if($gg) $f.="/".$gg;
        }
        if($request_query_string){
            $hh = str_namespace2(_server("QUERY_STRING"));
            if($hh) $f.="/".$hh;
        }
        return $f;
    }
    return null;
}

/**
 * thuc thi file template trong thu muc theme
 * @param String $file file hoac danh sach file, ngan cach bang dau phay (,)
 * @param Array $varible mang gom key ki tu la ten cac bien, key phai tuan theo ten chuan
 * @param bool $cache co su d?ng cache hay ko
 * @param int $cache_time
 * @param bool
 * @param bool
 * @return Void
 * $varible la danh sach bien rieng cho template dang thuc thi va khong bat buoc
 */ 



function display($filename=null, $varible=null, $cache=null, $cache_time=null, $request_uri = false, $request_query_string=false){
    $____flist____ = cube_get_file_list($filename);
    if($____flist____){
        $___d___ = cube::get_var();
        $___f___ = $varible;
        if(is_array($___d___)){
            extract($___d___, EXTR_PREFIX_SAME, "CUBE_");
        }
        if(is_array($___f___)){
            extract($___f___, EXTR_PREFIX_SAME, "CUBE_");
        }
        foreach($____flist____ as $___fn___){
            if($cache &&  !$_POST){
                $tf = getTplCacheFile($___fn___,$request_uri,$request_query_string);
                if($ct = cube_cache::getCache($tf,$cache_time)){
                    echo $ct;
                }else{
                    ob_start();
                    if(file_exists($___fn___)) 
                        include($___fn___);
                    $ct = ob_get_contents();
                    ob_clean();
                    cube_cache::saveCache($tf,$ct);
                    echo $ct;
                }
            }
            elseif(file_exists($___fn___)) 
                include($___fn___);
        }
    }
}
/**
 * thuc thi file template trong thu muc theme
 * @param String $file file hoac danh sach file, ngan cach bang dau phay (,)
 * @param Array $varible mang gom key ki tu la ten cac bien, key phai tuan theo ten chuan
 * @return Void
 * $varible la danh sach bien rieng cho template dang thuc thi va khong bat buoc
 */ 

function cube_include($filename=null, $varible=null, $cache=null, $cache_time=null, $request_uri = false, $request_query_string=false){
    $____flist____ = cube_get_file_list($filename);
    if($____flist____){
        $___d___ = cube::get_var();
        $___f___ = $varible;
        if(is_array($___d___)){
            extract($___d___, EXTR_PREFIX_SAME, "CUBE_");
        }
        if(is_array($___f___)){
            extract($___f___, EXTR_PREFIX_SAME, "CUBE_");
        }
        foreach($____flist____ as $___fn___){
            if($cache && !$_POST){
                $tf = getTplCacheFile($___fn___,$request_uri,$request_query_string);
                if($ct = cube_cache::getCache($tf,$cache_time)){
                    echo $ct;
                }else{
                    ob_start();
                    if(file_exists($___fn___)) 
                        include($___fn___);
                    $ct = ob_get_contents();
                    ob_clean();
                    cube_cache::saveCache($tf,$ct);
                    echo $ct;
                }
            }
            elseif(file_exists($___fn___)) 
                include($___fn___);
        }
    }
}

/**
 * thuc thi file template trong thu muc theme
 * @param String $file file hoac danh sach file, ngan cach bang dau phay (,)
 * @param Array $varible mang gom key ki tu la ten cac bien, key phai tuan theo ten chuan
 * @return Void
 * $varible la danh sach bien rieng cho template dang thuc thi va khong bat buoc
 */ 

function cube_require($filename=null, $varible=null, $cache=null, $cache_time=null, $request_uri = false, $request_query_string=false){
    $____flist____ = cube_get_file_list($filename);
    if($____flist____){
        $___d___ = cube::get_var();
        $___f___ = $varible;
        if(is_array($___d___)){
            extract($___d___, EXTR_PREFIX_SAME, "CUBE_");
        }
        if(is_array($___f___)){
            extract($___f___, EXTR_PREFIX_SAME, "CUBE_");
        }
        foreach($____flist____ as $___fn___){
            if($cache && !$_POST){
                $tf = getTplCacheFile($___fn___,$request_uri,$request_query_string);
                if($ct = cube_cache::getCache($tf,$cache_time)){
                    echo $ct;
                }else{
                    ob_start();
                    if(file_exists($___fn___)) 
                        include($___fn___);
                    $ct = ob_get_contents();
                    ob_clean();
                    cube_cache::saveCache($tf,$ct);
                    echo $ct;
                }
            }
            elseif(file_exists($___fn___)) 
                include($___fn___);
        }
    }
}
/**
 * thuc thi file template trong thu muc theme
 * @param String $file file hoac danh sach file, ngan cach bang dau phay (,)
 * @param Array $varible mang gom key ki tu la ten cac bien, key phai tuan theo ten chuan
 * @return Void
 * $varible la danh sach bien rieng cho template dang thuc thi va khong bat buoc
 */ 

function get_template($filename=null, $varible=null, $cache=null, $cache_time=null, $request_uri = false, $request_query_string=false){
    $____flist____ = cube_get_file_list($filename,get_template_dir());
    if($____flist____){
        $___d___ = cube::get_var();
        $___f___ = $varible;
        if(is_array($___d___)){
            extract($___d___, EXTR_PREFIX_SAME, "CUBE_");
        }
        if(is_array($___f___)){
            extract($___f___, EXTR_PREFIX_SAME, "CUBE_");
        }
        foreach($____flist____ as $___fn___){
            if($cache &&  !$_POST){
                $tf = getTplCacheFile($___fn___,$request_uri,$request_query_string);
                if($ct = cube_cache::getCache($tf,$cache_time)){
                    echo $ct;
                }else{
                    ob_start();
                    if(file_exists($___fn___)) 
                        include($___fn___);
                    $ct = ob_get_contents();
                    ob_clean();
                    cube_cache::saveCache($tf,$ct);
                    echo $ct;
                }
            }
            elseif(file_exists($___fn___)) 
                include($___fn___);
        }
    }
}


function get_header($ext = null,$cache=null,$cache_time=0){
    $ex = '';
    if(is_string($ext)||is_numeric($ext)){
        $ex = '-'.$ext;
    }
    cube_include('header'.$ex,null,$cache,$cache_time,true,true);
}
function get_footer($ext = null,$cache=null,$cache_time=0){
    $ex = '';
    if(is_string($ext)||is_numeric($ext)){
        $ex = '-'.$ext;
    }
    cube_include('footer'.$ex,null,$cache,$cache_time,true);
}
function get_sidebar($ext = null,$cache=null,$cache_time=0){
    $ex = '';
    if(is_string($ext)||is_numeric($ext)){
        $ex = '-'.$ext;
    }
    cube_include('sidebar'.$ex,null,$cache,$cache_time);
}


?>