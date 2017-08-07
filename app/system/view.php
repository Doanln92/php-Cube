<?php

/**
 * @author Doanln
 * @copyright 2017
 */

class view{
    protected static $timeout = 300;
    protected static $cachedir = '';
    protected static $ext = 'html';
    protected static $current_time = 0;
    protected static $status = true;
    protected static $viewdir = '';
    
    public static function init($args=null){
        $a = new arr($args);
        if(is_numeric($a->e('timeout'))) self::$timeout = $a->e('timeout');
        if(is_string($a->e('cache_dir'))) self::$cachedir = $a->e('cache_dir');
        if(is_string($a->e('view_dir'))) self::$viewdir = $a->e('view_dir');
        if(is_string($a->e('ext'))) self::$ext = $a->e('ext');
        self::update_current_time();
    }
    
    
    
    /**
     * @param Int
     */
    
    
    
    public static function is_enable(){
        return self::$status;
    }
    public static function is_disable(){
        return (self::$status)?false:true;
    }
    
    public static final function enable(){
        self::$status = true;
    } 
    public static final function disable(){
        self::$status = false;
    } 
    
    /**
     * 
     */
    
    /**
     * 
     */
    
    /**
     * 
     */
    
    /**
     * @param String
     * @param String
     */
    
    public static function save_cache($filename=null,$content=null){
        if(!self::$status) return false;
        if(is_string($filename) && $f = self::get_cache_path($filename)){
            return cube::save_file_contents($content,$f,self::$ext);
        }
        return false;
            
    }
    
    /**
     * @param String
     */
    
    public static function get_cache($filename=null,$time=null){
        if(!self::$status) return null;
        if(self::check_file_time($filename,$time)){
            $f = self::get_cache_path($filename);
            return cube::get_file_contents($f,self::$ext);
        }
        return null;
    }
    
    /**
     * @param void
     */
    
    public static function update_current_time(){
        self::$current_time = time();
    }
    
    /**
     * @param String
     */
    
    public static function check_file_time($filename=null,$time=null){
        if($a = self::get_cache_path($filename) && self::cache_exists($filename)){
            if(!is_numeric($time)) $time = self::$timeout;
            if(self::$currentTime - self::get_file_time($filename) <= $time){
                return true;
            }
            return false;
        }
        return null;
    }
    /**
     * @param String
     */
    
    public static function is_timeout($filename=null){
        if($a = self::get_cache_path($filename) && self::cache_exists($filename)){
            if(!is_numeric($time)) $time = self::$timeout;
            if(self::$currentTime - self::get_file_time($filename) <= $time){
                return false;
            }
            return true;
        }
        return 1;
    }
        
    /**
     * @param String
     */
    
    public static function get_file_time($filename=null){
        if($a = self::get_cache_path($filename)){
            if(file_exists($a)){
                $time = filemtime($a);
                return $time;
            }
        }
        return null;
    }
    
    /**
     * @param String
     */
    
    protected static function get_cache_path($filename=null){
        if(is_string($fn = self::get_parse_filename($filename)) && self::$cachedir){
            if($f = cube_join_url(self::$cachedir,$fn)){
                return $f;
            }
        }
        return null;
    }
    
    public static function cache_exists($filename=null){
        return is_file(self::get_cache_path($filename))?true:false;
    }
    
    /**
     * @param String
     */
    
    protected static function get_parse_filename($filename=null){
        if(is_string($filename)){
            $a = explode('.',$filename);
            $e = array_pop($a);
            if(strtolower($e) != strtolower(self::$ext)){
                $filename.=".".(self::$ext);
            }
            return $filename;
        }
        return null;
    }
    
    /**
     * @param String
     */
    
    public static function set_view_dir($dirName=null){
        if(is_string($dirName) && is_dir($dirName)){
            self::$viewdir = $dirName;
            return true;
        }
        return false;
    }
    /**
     * @param String
     */
    
    public static function set_cache_dir($dirName=null){
        if(is_string($dirName) && is_dir($dirName)){
            self::$cachedir = $dirName;
            return true;
        }
        return false;
    }
    
    public static function get_view_dir(){
        return self::$viewdir;
    }
    public static function get_cache_dir(){
        return self::$cachedir;
    }
    
    
    
    /**
     * @param Int
     */
    
    public static function set_cache_time($TimeScond=0){
        if(is_int($TimeScond)){
            self::$timeout = $TimeScond;
            return true;
        }
        return false;
    }
    
    
    public static function get_file_path($file=null,$dir=null){
        if(!is_string($file)&&!is_numeric($file)) return null;
        $d = is_string($dir)?rtrim($dir,'/').'/':rtrim(self::get_view_dir(),'/').'/';
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
    public static function get_file_list($file=null,$dir=null){
        if(!is_string($file)&&!is_numeric($file)) return null;
        $a = array();
        if(is_string($file)){
            $b = explode(',',$file);
            $c = count($b);
            for($i=0;$i<$c;$i++){
                $d = self::get_file_path(trim($b[$i]),$dir);
                if($d) $a[] = $d;
            }
        }
        elseif(is_array($file)){
            foreach($file as $e){
                $f = self::get_file_path(trim($e),$dir);
                if($f) $a[] = $f;
            }
        }
        return $a;
    }
    public static function get_template_path($filename=null){
        $f = null;
        if($t = self::get_file_path($filename,get_template_dir())){
            $f = $t;
        }
        return $f;
    }
    
    public static function get_system_template_path($filename=null){
        $f = null;
        if($t = self::get_file_path($filename,get_system_template_dir())){
            $f = $t;
        }
        return $f;
    }
    
    public static function getTplCacheFile($filename=null,$request_uri = false, $request_query_string=false){
        if(is_file($filename)){
            $fs = explode('.',trim(str_replace(self::$viewdir,'',$filename),'/'));
            $b = array_pop($fs);
            $f = implode('.',$fs);
            if($request_uri){
                $gg = str_dirname(cube::get_path());
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
     * @param Array $variable mang gom key ki tu la ten cac bien, key phai tuan theo ten chuan
     * @param bool $cache co su d?ng cache hay ko
     * @param int $cache_time
     * @param bool
     * @param bool
     * @return Void
     * $variable la danh sach bien rieng cho template dang thuc thi va khong bat buoc
     */ 
    
    
    
    public static function display($filename=null, $variable=null, $cache=null, $cache_time=null, $request_uri = false, $request_query_string=false){
        $____flist____ = self::get_file_list($filename);
        if($____flist____){
            $___d___ = cube::get_var();
            $___f___ = $variable;
            if(is_array($___d___)){
                extract($___d___, EXTR_PREFIX_SAME, "CUBE_");
            }
            if(is_array($___f___)){
                extract($___f___, EXTR_PREFIX_SAME, "CUBE_");
            }
            foreach($____flist____ as $___fn___){
                if($cache &&  !$_POST){
                    $tf = self::getTplCacheFile($___fn___,$request_uri,$request_query_string);
                    if($ct = self::get_cache($tf,$cache_time)){
                        echo $ct;
                    }else{
                        ob_start();
                        if(file_exists($___fn___)) 
                            include($___fn___);
                        $ct = ob_get_contents();
                        ob_clean();
                        self::save_cache($tf,$ct);
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
     * @param Array $variable mang gom key ki tu la ten cac bien, key phai tuan theo ten chuan
     * @return Void
     * $variable la danh sach bien rieng cho template dang thuc thi va khong bat buoc
     */ 
    
    public static function tpl_include($filename=null, $variable=null, $cache=null, $cache_time=null, $request_uri = false, $request_query_string=false){
        $____flist____ = self::get_file_list($filename);
        if($____flist____){
            $___d___ = cube::get_var();
            $___f___ = $variable;
            if(is_array($___d___)){
                extract($___d___, EXTR_PREFIX_SAME, "CUBE_");
            }
            if(is_array($___f___)){
                extract($___f___, EXTR_PREFIX_SAME, "CUBE_");
            }
            foreach($____flist____ as $___fn___){
                if($cache &&  !$_POST){
                    $tf = self::getTplCacheFile($___fn___,$request_uri,$request_query_string);
                    if($ct = self::get_cache($tf,$cache_time)){
                        echo $ct;
                    }else{
                        ob_start();
                        if(file_exists($___fn___)) 
                            include($___fn___);
                        $ct = ob_get_contents();
                        ob_clean();
                        self::save_cache($tf,$ct);
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
     * @param Array $variable mang gom key ki tu la ten cac bien, key phai tuan theo ten chuan
     * @return Void
     * $variable la danh sach bien rieng cho template dang thuc thi va khong bat buoc
     */ 
    
    public static function tpl_require($filename=null, $variable=null, $cache=null, $cache_time=null, $request_uri = false, $request_query_string=false){
        $____flist____ = self::get_file_list($filename);
        if($____flist____){
            $___d___ = cube::get_var();
            $___f___ = $variable;
            if(is_array($___d___)){
                extract($___d___, EXTR_PREFIX_SAME, "CUBE_");
            }
            if(is_array($___f___)){
                extract($___f___, EXTR_PREFIX_SAME, "CUBE_");
            }
            foreach($____flist____ as $___fn___){
                if($cache &&  !$_POST){
                    $tf = self::getTplCacheFile($___fn___,$request_uri,$request_query_string);
                    if($ct = self::get_cache($tf,$cache_time)){
                        echo $ct;
                    }else{
                        ob_start();
                        if(file_exists($___fn___)) 
                            require($___fn___);
                        $ct = ob_get_contents();
                        ob_clean();
                        self::save_cache($tf,$ct);
                        echo $ct;
                    }
                }
                elseif(file_exists($___fn___)) 
                    require($___fn___);
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
    
    public static function template($filename=null, $varible=null, $cache=null, $cache_time=null, $request_uri = false, $request_query_string=false){
        $____flist____ = self::get_file_list($filename,get_template_dir());
        if($____flist____){
            $___d___ = self::get_var();
            $___f___ = $varible;
            if(is_array($___d___)){
                extract($___d___, EXTR_PREFIX_SAME, "CUBE_");
            }
            if(is_array($___f___)){
                extract($___f___, EXTR_PREFIX_SAME, "CUBE_");
            }
            foreach($____flist____ as $___fn___){
                if($cache &&  !$_POST){
                    $tf = self::getTplCacheFile($___fn___,$request_uri,$request_query_string);
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
    
    
    public static function header($ext = null,$cache=null,$cache_time=0){
        $ex = '';
        if(is_string($ext)||is_numeric($ext)){
            $ex = '-'.$ext;
        }
        self::tpl_include('header'.$ex,null,$cache,$cache_time,true,true);
    }
    public static function footer($ext = null,$cache=null,$cache_time=0){
        $ex = '';
        if(is_string($ext)||is_numeric($ext)){
            $ex = '-'.$ext;
        }
        self::tpl_include('footer'.$ex,null,$cache,$cache_time,true);
    }
    public static function sidebar($ext = null,$cache=null,$cache_time=0){
        $ex = '';
        if(is_string($ext)||is_numeric($ext)){
            $ex = '-'.$ext;
        }
        self::tpl_include('sidebar'.$ex,null,$cache,$cache_time);
    }
}

?>