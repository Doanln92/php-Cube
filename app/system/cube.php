<?php

/**
 * @author Doanln
 * @copyright 2017
 */

class cube{
    /**
     * @var $vars cac bien se dc khai bao
     */
    protected static $_vars;
    
    /**
     * @var $_path 
     */
    protected static $_path;
    
    /**
     * @var $_files doi tuong xu ly file
     */
    protected static $_files;
    
    /**
     * @var $_template
     */
    protected static $_templates;
    
    /**
     * @var $_map
     */
    public static $_map;
    
    /**
     * @var $_datas
     */
    protected static $_datas;
    
    /**
     * @param Array
     */
     
    protected static $_config = array();
    
    /**
     * ham config thiet lap thong so
     * 
     * 
     * @param Array
     */ 
    
    public static function config($args=null){
        self::$_config = $args;
    }
    
    /**
     * bat dau phien lam viec
     * 
     * @param Array
     */
     
    public static function start($args = null){
        if(!$args) $args = self::$_config;
        $c = new arr($args);
        self::$_files = new files(array('dir'=>BASEDIR));
        self::$_path = new cube_path();
        self::$_vars = new cube_vars();
        self::$_map  = new cube_map($c->e('map'));
        db::config($c->get('db'));
        view::init($c->e('map'));
    }
    
    
    
    //var
    
    /**
     * Ham khai bao bien cho template
     * @param String $name phai la ten khong giam hop le
     * @param mixed
     */ 
    public static function set_var($name=null,$var=SD_VAR_DEF_VAL){
        return self::$_vars->set($name,$var);
    }
    
    public static function remove_var($name=null,$d=null){
        return self::$_vars->remove($name,$d);
    }
    
    public static function get_var($name=null,$d=null){
        return self::$_vars->get($name,$d);
    }
    public static function is_var($name=null,$d=null){
        return self::$_vars->is($name,$d);
    }



    
    //path
    
    public function get_path($pos=null){
        return self::$_path->get($pos);
    }
    public function get_lower_path($pos=null){
        return self::$_path->get_lower($pos);
    }
    
    public function update_path($path=null){
        return self::$_path->update($path);
    }
    
    //file 
    
    

    /**
     * @param mixed
     * @param String
     * @param String
     */ 
    
    public function make_dir($dir=null){
        return self::$_files->make_dir($dir);
    }
    /**
     * @param String
     * @param String
     * @param String
     */ 
    
    public function save_file_contents($contents, $filename, $ext=null){
        return self::$_files->save_contents($contents,$filename,$ext);
    }
    /**
     * @param String
     * @param String
     * @param String
     */ 
    
    public function get_file_contents($filename, $ext=null){
        return self::$_files->get_contents($filename,$ext);
    }
    /**
     * @param String
     * @param String
     * @param String
     */ 
    
    
    public function upload_files($tmp_name='',$new_file=null){
        return self::$_files->upload_files($tmp_name,$new_file);
    }
    
    public function delete_tree($dirname=null){
        return self::$_files->delete($dirname);
    }
    
    
    public function get_file_list($dir=null,$ext=null,$sort = false){
        return self::$_files->get_list($dir,$ext,$sort);
    }
    
    
    public function set_file_dir($dir=null){
        return self::$_files->setDir($dir);
    }
    
    public function set_default_extension($ext=null){
        return self::$_files->setDefaultExtension($ext);
    }
    
    public function set_chmod_code($code=0777){
        return self::$_files->setChmodCode($code);
    }
    
    public function file_catch_error(){
        return self::$_files->catch_error();
    }
    // end file
    

}

?>