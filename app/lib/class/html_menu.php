<?php

/**
 * @author Doanln
 * @copyright 2017
 */

class html_menu{
    
    protected $menu_id = "";
    protected $menu_class = "";
    protected $submenu_id = "";
    protected $submenu_class = "";
    
    public function __construct() {
        //parent::__construct('Menu');
    }
    
    public function setOpt($args=null){
        if(is_array($args)){
            if(isset($args['menu_id'])) $this->menu_id = $args['menu_id'];
            if(isset($args['menu_class'])) $this->menu_class = $args['menu_class'];
            if(isset($args['submenu_id'])) $this->submenu_id = $args['submenu_id'];
            if(isset($args['submenu_class'])) $this->submenu_class = $args['submenu_class'];
        }
    }

    public function get_list($args=null){
        if(is_array($args)){
            $c = new arr($args);
            $list = array();
            $menu_form = array('slug','name','title','text','id','class','icon','type','description','submenu');
            switch(strtolower($c->e('type'))){
                case 'list':
                    $list = $c->e('data');
                break;
                case 'json':
                    //$li = new arr();
                    $data = new datas();
                    $list = $this->get_list($data->json('menus/'.$c->e('args.file')));
                break;
                default:
                    $list = null;
                break;
            }
            return $list;
        }
        return null;
    }
    
    public function get_item_parse($item=null){
        if(!is_array($item)) return $item;
        $it = new arr($item);
        if(!$it->e('item_type')) return $item;
        switch($it->e('item_type')){
            case 'defined':
                $irem = null;
                if($it->e('call')&&function_exists($it->e('call'))){
                    $args = $it->e('args');
                    $e = "\$item = ".$it->e('call')."(\$args);";
                    eval($e);
                }
            break;
        }
        return $item;
    }
    
    
    public function create($args,$url=null,$path_pos=0){
        $str_menu= "<ul".($this->menu_id?" id=\"$this->menu_id\"":"").($this->menu_class?" class=\"$this->menu_class\"":"").">";
        if(is_array($args)){
            foreach($args as $menu){
                $u = $url;
                $p = $path_pos;
                $ca = "";
                if(isset($menu['path'])){
                    $u = cube_join_url($url,$menu['path']);
                    if(is_int($path_pos) && $path_pos > 0){
                        $p++;
                        if(strtolower($menu['path']) == cube::get_lower_path($path_pos)) $ca="active";
                    }
                
                }
                elseif(isset($menu['request'])){
                    $v = isset($menu['request_val'])?$menu['request_val']:$menu['text'];
                    $u = reqURL($url,$menu['request'],isset($menu['request_val'])?$menu['request_val']:$menu['text']);
                    if(strtolower(_get($menu['request']))==strtolower($v)) $ca="active";
                }
                $c = "";
                $sm="";
                
                if(isset($menu['class'])) $c.= $menu['class']." ";
                if(isset($menu['submenu'])){
                    $s = $menu['submenu'];
                    $c.="has-child ";
                    $mn = new html_menu();
                    $mn->setOpt(array('menu_class'=>$this->submenu_class));
                    $sm = $mn->create($s,$u,$p);
                }
                $c.=$ca;
                $class = $c != "" ? " class=\"$c\"":"";
                $str_menu .= "\n<li".(isset($menu['id'])?"  id=\"$menu[id]\"":"").($class!=""?$class:"").">"
                           . "<a href=\"$u\" title=\"$menu[text]\">$menu[text]</a>"
                           . $sm
                           ."</li>";
            }
            $str_menu.="\n</ul>";
            return $str_menu;
        }
    }

}

?>