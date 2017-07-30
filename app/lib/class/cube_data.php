<?php

/**
 * @author Le Ngoc Doan
 * @copyright 2016
 */

define('SD_DATA_DEF_VAL','!-->1=1500 && doan yru66 tranfg');

class cube_data{
    public $data = array();
    protected $delimiter = '.';
    public function __construct($args=null,$d=null){
        $this->setDelimiter($d);
        $this->update($args);
    }
    public function add($args,$mixed=SD_DATA_DEF_VAL){
        $stt = false;
        if(is_string($args)||is_numeric($args)){
            if($mixed!=SD_DATA_DEF_VAL){
                if(!isset($this->data[$args])){
                    $this->data[$args] = $mixed;
                    $stt = true;
                }
            }else{
                $this->data[] = $args;
                $stt = true;
            }
        }elseif(is_array($args)){
            $stt = 0;
            foreach($args as $k => $v){
                if(!isset($this->data[$k])){
                    $this->data[$k] = $v;
                    $stt++;
                }
            }
        }
        return $stt;
    }
    public function update($args = null){
        if(is_array($args)){
            foreach($args as $k => $v){
                $this->data[$k] = $v;
            }
        }
    }
    
    public function reset(){
        $this->data = array();
    }
    public function add_new($args,$val=SD_DATA_DEF_VAL){
        $this->reset();
        $this->add($args,$val);
    }
    public function setDelimiter($d = null){
        if(is_string($d)){
            $this->delimiter = $d;
        }
    }
    
    /**
     * lay phan tu trong mang hoac ca mang
     * @param string $key
     */
    
    public function get($key=null,$delimiter=null){
        if(is_null($key)) return $this->data;
        if(is_string($key)){
            $delimiter = is_string($delimiter)?$delimiter:$this->delimiter;
            $t = $this->data;
            $d = explode($delimiter,strtolower($key));
            $p = count($d);
            if(isset($t[$d[0]])){
                $t = $t[$d[0]];
                for($i = 1; $i < $p; $i++){
                    $g = $d[$i];
                    if(is_array($t)&&isset($t[$g])){
                        $t = $t[$g];
                    }else{
                        $t = null;
                        $i+=$p;
                    }
                }
            }
            else $t = null;
            return $t;
        }
        elseif(is_numeric($key)) return isset($this->data[$key])?$this->data[$key]:null;
        return $this->data?true:false;
    }
    
}

?>