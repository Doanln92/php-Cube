<?php

/**
 * @author Doanln
 * @copyright 2017
 */


//config database

define('DB_HOST', 'localhost'); //your db host here
define('DB_NAME', 'cubes');     //your db name here
define('DB_USER', 'root');      //your db username here
define('DB_PASS', '');          //your db password here
define('DB_PREFIX', '');        //your table name prefix




session_start();

session_set_cookie_params(strtotime("+1 year"),'/');


ini_set('magic_quotes_gpc',0);

date_default_timezone_set("Asia/Ho_Chi_Minh"); //select timezone

define('BASEDIR', dirname(__FILE__).'/');

function get_config_var(){
    if(!defined('PROTOCOL')){
        // don't change this code
        $protocols = explode('/',$_SERVER["SERVER_PROTOCOL"]);
        $dirname = realpath(dirname(__FILE__));
        $doc_root = $_SERVER['DOCUMENT_ROOT'];
        $protocol = $protocols[0];
        $site_url = $protocol .'://'. $_SERVER['SERVER_NAME'];
        define('PROTOCOL',$protocol);
        $home_url = str_replace($doc_root,$site_url,$dirname);
        $fd = $_SERVER['SCRIPT_NAME'];
        $p = explode('/',$fd);
        $rd = str_replace('/'.$p[count($p)-1],'',$fd);
        $current = strtolower(PROTOCOL).'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $home_url = strtolower(PROTOCOL).'://'.$_SERVER['HTTP_HOST'].$rd;
        
        //you can change anything here
        define('LOCALPATH',trim($rd,'/'));
        define("HOMEURL",$home_url);
        define('CURRENTURL',$current);
        define('APPDIR',BASEDIR.'app/');
        define('LIBDIR',APPDIR.'lib/');
        define('MODDIR',APPDIR.'models/');
        define('CLASSDIR',LIBDIR.'class/');
        define('FUNCDIR',LIBDIR.'functions/');
        define('CONFIGDIR',APPDIR.'config/');
        define('CUBEDIR',APPDIR.'cubes/');
        define('SYSTEMDIR',APPDIR.'system/');
        define('EXTDIR',APPDIR.'ext/');
        define('DATADIR',APPDIR.'datas/');
        define('PUBLICDIR',BASEDIR.'public/');
        define('CONTENTDIR',PUBLICDIR.'contents/');
        define('IMAGEDIR',PUBLICDIR.'images/');
        define('CSSDIR',PUBLICDIR.'css/');
        define('JSDIR',PUBLICDIR.'js/');
        define('AJAXURL',HOMEURL.'/ajax');
        define('PUBLICURL',HOMEURL.'/public');
        define('CONTENTSURL',PUBLICURL.'/contents/');
        define('IMAGESURL',PUBLICURL.'/images/');
        define('CSSURL',PUBLICURL.'/css/');
        define('JSURL',PUBLICURL.'/js/');
        
        
        
        /**
         * select theme
         */
          
        define('THEMEDIR',APPDIR.'themes/basic/');
        define('THEMEURL',HOMEURL.'/app/themes/basic');
        
        
        
    }
    
    
    
    
    $args = array(
        'db' => array(
            'host' => DB_HOST,
            'dbname' => DB_NAME,
            'user' => DB_USER,
            'pass' => DB_PASS,
            'prefix' => DB_PREFIX
        ),
        'map' => array(
            'local_path' => LOCALPATH,
            'home_url' => HOMEURL,
            'ajax_url' => AJAXURL,
            'home_dir' => BASEDIR,
            'base_dir' => BASEDIR,
            'app_dir' => APPDIR,
            'lib_dir' => LIBDIR,
            'model_dir' => MODDIR,
            'class_dir' => CLASSDIR,
            'func_dir' => FUNCDIR,
            'content_dir' => CONTENTDIR,
            'config_dir' => CONFIGDIR,
            'cube_dir' => CUBEDIR,
            'system_dir' => SYSTEMDIR,
            'ext_dir' => EXTDIR,
            'data_dir' => DATADIR,
            'public_dir' => PUBLICDIR,
            'image_dir' => IMAGEDIR,
            'css_dir' => CSSDIR,
            'js_dir' => JSDIR,
            'public_url' => PUBLICURL,
            'image_url' => IMAGESURL,
            'css_url' => CSSURL,
            'js_url' => JSURL,
            'content_url' => CONTENTSURL,
            'theme_dir' => THEMEDIR,
            'theme_url' => THEMEURL
        )
    );
    
    return $args;
}

function cube_error_reporting($code=0){
    if(!$code) $code = 0;$es = $code;
    ini_set( 'display_startup_errors',$es);
    ini_set( 'track_errors', $es );
    ini_set( 'log_errors', $es );
    ini_set( 'display_errors', $es );
    if($code!=0)error_reporting($code);
}
?>