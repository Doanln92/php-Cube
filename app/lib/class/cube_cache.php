<?php

/**
 * @author Le Ngoc Doan
 * @copyright 2016
 */

class cube_cache{
    protected static $timeout = 300;
    protected static $cachedir = '';
    protected static $ext = 'txt';
    protected static $currentTime = 0;
    protected static $status = true;
    /**
     * @param Int
     */
    
    public function __construct(){
        
    }
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
    
    public static function saveCache($filename=null,$content=null){
        if(!self::$status) return false;
        if(is_string($filename) && $f = self::getFilePath($filename)){
            return sd_save_file_contents($content,$f,self::$ext);
        }
        return false;
            
    }
    
    /**
     * @param String
     */
    
    public static function getCache($filename=null,$time=null){
        if(!self::$status) return null;
        if(self::checkFileTime($filename,$time)){
            $f = self::getFilePath($filename);
            return sd_get_file_contents($f,self::$ext);
        }
        return null;
    }
    
    /**
     * @param void
     */
    
    public static function updateCurrentTime(){
        self::$currentTime = time();
    }
    
    /**
     * @param String
     */
    
    public static function checkFileTime($filename=null,$time=null){
        if($a = self::getFilePath($filename) && self::cache_exists($filename)){
            if(!is_numeric($time)) $time = self::$timeout;
            if(self::$currentTime - self::getFileTime($filename) <= $time){
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
        if($a = self::cache_exists($filename) && self::cache_exists($filename)){
            if(!is_numeric($time)) $time = self::$timeout;
            if(self::$currentTime - self::getFileTime($filename) <= $time){
                return false;
            }
            return true;
        }
        return 1;
    }
        
    /**
     * @param String
     */
    
    public static function getFileTime($filename=null){
        if($a = self::getFilePath($filename)){
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
    
    protected static function getFilePath($filename=null){
        if(is_string($fn = self::getParseFilename($filename)) && self::$cachedir){
            if($f = sd_join_url(self::$cachedir,$fn)){
                return $f;
            }
        }
        return null;
    }
    
    public static function cache_exists($filename=null){
        return is_file(self::getFilePath($filename))?true:false;
    }
    
    /**
     * @param String
     */
    
    protected static function getParseFilename($filename=null){
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
    
    public static function setCacheDir($dirName=null){
        if(is_string($dirName) && is_dir($dirName)){
            self::$cachedir = $dirName;
            return true;
        }
        return false;
    }
    
    /**
     * @param Int
     */
    
    public static function setCacheTime($TimeScond=0){
        if(is_int($TimeScond)){
            self::$timeout = $TimeScond;
            return true;
        }
        return false;
    }
}
?>