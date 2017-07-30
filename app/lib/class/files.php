<?php

/**
 * @author Le Ngoc Doan
 * @copyright 2016
 */

class files{
    protected $extensions = array(
        'php', 'html', 'txt', 'htm', 'js', 'css', 'tpl', 'json', 'sd', 'lang', 'sl', 'xml', 'asp', 'java', 'pas', 'password', 'sl'
    );
    protected $dir = '';
    protected $ext = null;
    protected $chmod = 0777;
    public $errors = array();
    /**
     * @param array $args : mang tham so
     */ 
    public function __construct($args=null){
        $this->init($args);
    }
    public function init($args=null){
        $a = new arr($args);
        $this->addExtensions($a->e('extensions'));
        $this->setDir($a->e('dir'));
        $this->setDefaultExtension($a->e('default_extension'));
        $this->setChmodCode($a->e('chmod'));
        return $this;
    }
    
    
    public function get_list($dir=null,$ext=null,$sort = false){
        if(!$dir) $dir = $this->dir;
        $list = array();
        $abc = array();
        $result = array();
        $e = is_string($ext)?strtolower($ext):null;
        if($e){
            $e = explode(',',$e);
            $b = array();
            for($i = 0; $i < count($e); $i++){
                $ei = trim($e[$i]);
                if($ei){
                    $b[] = $ei;
                }
            }
            $e = $b;
        }
        if (is_string($dir) && is_dir($dir)) {
            try{
                if ($dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        $t = 1;
                        if($e){
                            $fs = explode('.',$file);
                            $ex = strtolower($fs[count($fs)-1]);
                            if(in_array($ex,$e)){
                                $t=1;
                            }else{
                                $t = 0;
                            }
                            if($t && $file!='..' && $file!='.'){
                                $path = $this->join_url_dir($dir,$file);
                                $sd = strtolower($file);
                                $abc[] = $sd;
                                $list[$sd] = array(
                                    'type' => 'file',
                                    'filename' => $file,
                                    'path' => $path,
                                    'extension' => $ex
                                );
                            }
                        }else{
                            if($file!='..' && $file!='.'){
                                $path = $this->join_url_dir($dir,$file);
                                $fs = explode('.',$file);
                                $ex = strtolower($fs[count($fs)-1]);
                                $type = is_dir($path)?'folder':'file';
                                $sd = strtolower($file);
                                $abc[] = $sd;
                                $list[$sd] = array(
                                    'type' => $type,
                                    'filename' => $file,
                                    'extension' => $ex,
                                    'path' => $path
                                    
                                );
                            }
                            
                        }
                        
                    }
                    closedir($dh);
                }
            }catch(exception $e){
                $this->errors[__METHOD__] = $e->getMessage();
            }
        }
        if($list && $abc){
            if($sort){
                sort($abc);
            }
            $t = count($abc);
            $type_list = array(
                'folder' => array(),
                'file' => array()
            );
            
            for($i = 0; $i < $t; $i++){
                $item = $list[$abc[$i]];
                $type_list[$item['type']][] = $item;
            }
            foreach($type_list as $list_type){
                foreach($list_type as $it){
                    $result[] = $it;
                }
            }
        }
        return $result;
    }
    public function list_path($path=null){
        if(count(explode(BASEDIR,$path))<2 && $this->dir){
            $path = $this->join_url_dir($this->dir,$path);
        }
        $p = $path;
        if(!$p || $p=='/') return null;
        $f = false;
        if(substr($p,0,1)=='/') $f = true;
        $a = array();
        $b = array();
        $p = trim($p,'/');
        $d = '';
        if($f) $d = '/';
        $e = explode('/',$p);
        $t = count($e);
        for($i=0;$i<$t;$i++){
            $s = ($i>0)?'/':'';
            $d.=$s.$e[$i];
            $a[$i] = $d;
        }
        return $a;
    }
    
    public function make_dir($dir=null){
        if(is_string($dir) && $list = $this->list_path($dir)){
            foreach($list as $p){
                if(!is_dir($p)){
                    mkdir($p,0777);
                }
            }
            return true;
        }return false;
    }

    
    public function save_contents($contents, $filename, $ext=null){
        if(count(explode(BASEDIR,$filename))<2 && $this->dir){
            $filename = $this->join_url_dir($this->dir,$filename);
        }
        $parts = explode('/', ltrim($filename,'/'));
        $file = array_pop($parts);
        $fs = explode('.',$file);
        $ex = array_pop($fs);
        if($ext || $this->ext){
            if(!$ext) $ext = $this->ext;
            $ext=trim($ext,'. '); 
            if(strtolower($ex)!=strtolower($ext)){
                $file.='.'.$ext;
            }
        }
        $dir = '';
        try{
            foreach($parts as $part){
                if(!is_dir($dir .= "/$part")) mkdir($dir);
            }
            if(file_put_contents("$dir/$file", $contents)){
                return true;
            }
            
        }catch(exception $e){
            $this->errors[__METHOD__] = $e->getMessage();
            return false;
        }
        return false;
    }
    
    public function get_contents($filename, $ext=null){
        if(count(explode(BASEDIR,$filename))<2 && $this->dir){
            $filename = $this->join_url_dir($this->dir,$filename);
        }
        $fs = explode('.',$filename);
        $ex = array_pop($fs);
        if($ext || $this->ext){
            if(!$ext) $ext = $this->ext;
            $ext=trim($ext,'. '); 
            if(strtolower($ex)!=strtolower($ext)){
                $filename.='.'.$ext;
            }
        }
        try{
            if(is_file($filename)){
                return file_get_contents($filename);
            }
            return null;
            
        }catch(exception $e){
            $this->errors[__METHOD__] = $e->getMessage();
            return null;
        }
        return null;
    }
    
    
    
    public function upload_files($tmp_name='',$new_file=null){
        if($new_file && $tmp_name){
            if(count(explode(BASEDIR,$new_file))<2 && $this->dir){
                $new_file = $this->join_url_dir($this->dir,$new_file);
            }
            $s = '';
            if(substr($new_file,0,1)=='/') $s = '/';
            
            $g = explode('/',trim($new_file,'/'));
            $file = array_pop($g);
            if($this->make_dir($s.implode('/',$g))){
                try{
                    if(move_uploaded_file($tmp_name,$new_file)) return true;
                }
                catch(exception $e){
                    $this->errors[__METHOD__] = $e->getMessage();
                }
                
            }
        }
        return false;
    }
    public function delete($dirname=null){
        if(is_string($dirname)){
            if(is_file($dirname)) return unlink($dirname);
            elseif(is_dir($dirname)){
                try{
                    if($list = $this->get_list($dirname)){
                        foreach($list as $item){
                            $d = $item['path'];
                            if(is_dir($d)) $this->delete($d);
                            else unlink($d);
                        }
                    }
                    return rmdir($dirname);
                }
                catch(exception $e){
                    $this->errors[__METHOD__] = $e->getMessage();
                }
                
            }else{
                $dirname = $this->join_url_dir($this->dir,$dirname);
                if(is_file($dirname)) return unlink($dirname);
                elseif(is_dir($dirname)){
                    try{
                        if($list = $this->get_list($dirname)){
                            foreach($list as $item){
                                $d = $item['path'];
                                if(is_dir($d)) $this->delete($d);
                                else unlink($d);
                            }
                        }
                        return rmdir($dirname);
                    }
                    catch(exception $e){
                        $this->errors[__METHOD__] = $e->getMessage();
                    }
                    
                }else{
                    $this->errors[__METHOD__] = get_text(517);
                }
            }
        }return false;
    }
    
    public function _chmod($path=null,$code=null){
        $stt = false;
        if(count(explode(BASEDIR,$path))<2 && $this->dir){
            $path = $this->join_url_dir($this->dir,$path);
        }
        if(is_nan($code)) $code = $this->chmod;
        if(is_dir($path) || is_file($path)){
            try{
                $stt = true;
            }catch(exception $e){
                $this->errors[__METHOD__] = $e->getMessage();
            }
            
        }
        return $stt;
    }

    public function join_url_dir($main=null,$join=null){
        $h = is_string($main)?rtrim($main,'/'):'';
        $j = (is_string($join) || is_numeric($join))?$join:'';
        if(is_string($j)) $j = ltrim($j,'/');
        $g = '/';
        $u = $h.$g.$j;
        return $u; 
    }

    /**
     * @param Array $extensions Mang duoi file
     */ 
    public function addExtensions($extensions=null){
        if(!is_null($extensions)){
            $arr = array();
            switch(gettype($extensions)){
                case 'array':
                    $arr = $extensions;
                break;
                case 'string':
                    $ar1 = array();
                    $ext_expl = explode(',',$extensions);
                    foreach($ext_expl as $p){
                        $exs = explode(' ',$p);
                        foreach($exs as $es){
                            $e = trim($es);
                            if($e){
                                $ar1[] = $e;
                            }
                        }
                    
                    }
                    foreach($ar1 as $item){
                        $et = trim($item);
                        if($et){
                            $arr[] = $et;
                        }
                    }
                break;
            }
            foreach($arr as $ext){
                $this->addExtension($ext);
            }
        }
        return $this;
    }
    /**
     * @param String
     */
    public function addExtension($ext=null){
        if(is_string($ext) && $ext && !in_array($ext,$this->extensions)){
            $this->extensions[] = $ext;
        }
    }
    public function setDefaultExtension($ext=null){
        if(is_string($ext) && in_array($ext,$this->extensions)){
            $this->ext = $ext;
        }
    }
    /**
     * @param String $dirname duong dan director
     */ 
    public function setDir($dirname=null){
        if(is_string($dirname) && is_dir($dirname)){
            $this->dir = $dirname;
        }
        return $this;
    }
    /**
     * @param Int $code Ma chmod
     */ 
    public function setChmodCode($code=null){
        if(is_numeric($code)) $this->chmod = $code;
        return $this;
    }
    public function getErrorMessage($code=null){
        if(is_string($code)){
            return isset($this->errors[$code])?$this->errors[$code]:null;
        }
        return null;
    }
    public function catch_error(){
        $a = $this->errors;
        return array_pop($a);
    }
}

?>