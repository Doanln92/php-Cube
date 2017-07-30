<?php

/**
 * @author Le Ngoc Doan
 * @copyright 2015
 */

/* make a URL small */
class bitly{
    protected $config;
    protected $data;
    protected $error;
    public function __construct($args=null){
        $this->config = $args;
    }
    public function get($url){
        $c = new arr($this->config);
        $this->error = '';
        $params = array();
        $params['access_token'] = $c->e('access_token');
        $params['longUrl'] = $url;
        $params['domain'] = 'bit.ly';
        $results = bitly_get('shorten', $params);
        if($results['status_code']==200){
            $u = $results['data']['url'];
        }else{
            $this->error = $results['status_txt'];
            $u = null;
        }
        return $u;
    }
    
    
    public function get_error(){
        return $this->error;
    }
}

?>