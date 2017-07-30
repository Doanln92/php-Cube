<?php

/**
 * @author Le Ngoc Doan
 * @copyright 2016
 */

/** paging */

/**
 * cai dat thong so
 * @param Integer $total tong so
 * @param Integer $per_page so item moi trang
 * @param Integer $current_page trang hiern tai
 * @param Integer $max_page_item so trang hien thi toi da
 */ 

function sd_paging_setup($total=0,$per_page=10,$current_page=1,$max_page_item=5){
    global $SD;
    return $SD->paging->setup($total,$per_page,$current_page,$max_page_item);
}
function sd_paging_reset(){
    global $SD;
    return $SD->paging->reset();
}
/**
 * lay ds url page
 * @param String URL mau
 */ 

function sd_get_paging_buttons($url='http://localhost/'){
    global $SD;
    return $SD->paging->get_buttons($url);
}

/**
 * @param string
 * @param Nomber
 * @param Nomber
 * @param Nomber
 */
function sd_get_limit_item($type='string',$total=null,$per_page=null,$current_page=null){
    global $SD;
    return $SD->paging->get_limit_item($type,$total,$per_page,$current_page);
}

function sd_paging_buttons($args=null){
    static $btns;
    if(!is_null($args)) $btns = $args;
    else return $btns;
}


function sd_get_data($file=null,$type='json'){
    if(!is_string($file) && !is_numeric($file)) return true;
    global $SD;
    $data = null;
    switch(strtolower($type)){
        case 'json';
            $data = $SD->data->json($file);
        break;
        case 'html';
            $data = $SD->data->html($file);
        break;
        case 'text';
            $data = $SD->data->text($file);
        break;
        
    }
    return $data;
}

function sd_throw_error($code=null,$message=null){
    if((is_string($code) || is_numeric($code)) && !is_null($message)){
        global $SD;
        $SD->errors->push($code,$message);
        return true;
    }
    return true;
}
function sd_catch_error($code=null){
    global $SD;
    return $SD->errors->get($code);
}






























//page
class sd_page{
    public $data;
    /**
     * @param array
     */ 
    public function __construct($args){
        if(is_array($args)){
            if(isset($args['id'])){
                global $SD;
                $args['urrl'] = get_home_url('support/'.$args['slug'].$SD->pages->get_ext());
                $this->data = $args;
            }
        }
    }
    /**
     * @param string
     */
    public function get($kry=null){
        $d = new arr($this->data);
        return $d->get($kry);
    }
    public function set($key, $val = null){
        if(is_string($key) || is_numeric($key)){
            $d = new arr($this->data);
            $d->push($key,$val);
            $this->data = $d->get();
        }
        return $this;
    }
    public function prop($key=null,$val=null){
        $k = 'property'.((is_string($key)||is_numeric($key))?'.'.$key:'');
        if(is_null($val)){
            return $this->get($k);
        }
        $this->set($key,$val);
        return $this;
    }
}

class page_active{
    public static $d;
    public static $s=false;
    /**
     * @param array
     */ 
    public static function setup($args=null){
        if(is_array($args)){
            if(isset($args['id'])){
                self::$d = new sd_page($args);
                self::$s = true;
                return true;
            }
        }
        self::$d = null;
        self::$s = false;
        return false;
    }
    /**
     * @param string
     */ 
    public static function get($key=null){
        if(self::$s){
            $d = self::$d;
            return $d->get($key);
        }return null;
    }
    public static function set($key, $val = null){
        if(self::$s){
            $d = self::$d;
            $d->set($key,$val);
            self::$d = $d;
            return true;
        }return false;
    }
    public static function prop($key=null,$val=null){
        if(self::$s){
            $d = self::$d;
            if(!is_null($val)){
                return $d->prop($key);
            }
            $d->prop($key,$val);
            self::$d = $d;
            return true;
        }return false;
    }
    public static function reset(){
        self::$d = null;
        self::$s = false;
    }
}

function setup_page_data($data=null){
    page_active::setup($data);
}
function reset_page_data(){
    page_active::reset();
}
function get_page_detail($key=null){
    return page_active::get($key);
}
function _gpd($key=null){
    return page_active::get($key);
}
function _gpp($key=null,$val=null){
    return page_active::prop($key,$val);
}


function get_page_id(){
    return _gpd('id');
}
function get_page_title($length=null){
    $a = _gpd('title');
    if(is_int($length)){
        $a = subtext($a,0,$length);
    }
    return $a;
}
function get_page_slug(){
    return _gpd('slug');
}
function get_page_description($length=null){
    $a = _gpd('description');
    if(is_int($length)){
        $a = subtext($a,0,$length);
    }
    return $a;
}
function get_page_content(){
    return _gpd('content');
}
function get_page_rank(){
    return _gpd('rank');
}
function get_page_status(){
    return _gpd('status');
}
function get_page_link(){
    return _gpd('url');
}
function get_page_url(){
    return _gpd('url');
}
function get_edit_page_link(){
    return reqURL(get_home_url('support/edit'),'id',_gpd('id'));
}
function get_delete_page_link(){
    return reqURL(get_home_url('support/delete'),'id',_gpd('id'));
}
function get_page_property($key=null){
    return _gpp($key);
}




function _page_id(){
    echo get_page_id();
}
function _page_title($length=null){
    echo get_page_title($length);
}
function _page_slug(){
    echo get_page_slug();
}
function _page_description($length=null){
    echo get_page_description($length);
}
function _page_content(){
    echo _gpd('content');
}
function _page_rank(){
    echo _gpd('rank');
}
function _page_status(){
    echo _gpd('status');
}
function _page_link(){
    echo _gpd('url');
}
function _page_url(){
    echo _gpd('url');
}
function _page_edit_link(){
    echo get_edit_page_link();
}
function _page_delete_link(){
    echo get_delete_page_link();
}
function _page_property($key=null){
    return _gpp($key);
}

/**
 * @param array
 * @param string
 */ 
    
function get_pages($args=null,$select='*'){
    global $SD;
    return $SD->pages->get($args,$select);
}
function get_page($args=null,$select='*'){
    global $SD;
    return $SD->pages->get_page($args,$select);
}

?>