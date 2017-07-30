<?php
/**
 * @author Doanln
 * @copyright 2017
 */ 

/**
 * tao doi tuong bang
 */ 



//define('TBVALUNENULL','<!-- THIS VALUE IS NULL. DO NOT USE THIS FOR VALUE OF FIELDS -->');
//define('TBVALUNENULL','DBNULL');

class Table{
    public $name;
    public $tableName;
    public $nickName = null;
    public $fields = array();
    public $idField = '';
    public $fieldTypes = array();
    protected $_join = array();
    protected $_where = array();
    protected $_groupby = array();
    protected $_having = array();
    protected $_orderby = array();
    protected $_limit = null;
    protected $_conditions = null;
    //protected $_preQuery = '';
    //protected $_lastQuery = '';
    
    
    
    /**
     * ham khoi tao bang de thao tac voi mysql
     * @param String $tableName ten bang, co the bao gom mat na viet sau dau cach
     * @param String $nickNam mat na cua bang
     * 
     */ 
    public function __construct($tableName='table',$nickName='') {
        $a = explode('--', preg_replace('/\s+/', '--', trim($tableName)));
        $this->name = $tableName;
        $this->tableName = $a[0];
        if(count($a)>1){
            $this->nickName = $a[count($a)-1];
        }
        if(preg_match('/^[A-z]{1}[A-z0-9_]+$/',$nickName)){
            $this->nickName = $nickName;
        }
        $p = db::getPrefix();
        $fields = array();
        $types = array();
        $stmt = db::query("DESCRIBE {$p}{$a[0]}");
        if($tableFields = $stmt->fetchAll(PDO::FETCH_ASSOC)){
            foreach($tableFields as $column){
                $f = $column['Field'];
                if($column['Key']=='PRI'){
                    $this->idField = $f;
                }
                $fields[] = $f;
                $b = explode('(', $column['Type']);
                $types[$f] = $b[0];
            }
        }
        $this->fields = $fields;
        $this->fieldTypes = $types;
    }
    
    public function resetCondition(){
        $this->_having = array();
        $this->_where = array();
        $this->_conditions = array();
        $this->_groupby = array();
        $this->_orderby = array();
        $this->_limit = null;
        return $this;
    }
    public function resetJoin(){
        $this->_join = array();
        return $this;
    }
    
    public function resetAll(){
        return $this->resetCondition()->resetJoin();
    }
    
    
    
    /**
     * lay ve du lieu cua bang hien hanh
     * cco the thiet lap cac dieu kien truoc do
     * 
     * 
     * @param mixed $args tham so condition
     * @param String $Select danh sach cac cot
     * @param bool $reset lam rong cac bien dieu kien
     * 
     * @return Array
     */
    
    public function get($args=null,$select='*',$reset=false){
        $this->buildCondition();
        $rs = db::get($this->name,$select,$args);
        if($reset) $this->resetAll();
        return $rs;
    }
    
    /**
     * lay ve dong du lieu dau tien cua bang hien hanh
     * cco the thiet lap cac dieu kien truoc do
     * 
     * 
     * @param mixed $args tham so condition
     * @param String $Select danh sach cac cot
     * @param bool $reset lam rong cac bien dieu kien
     * 
     * @return Array
     */
    
    public function getOne($args=null,$select='*',$reset=false){
        $this->buildCondition();
        $rs = db::getOne($this->name,$select,$args);
        if($reset) $this->resetAll();
        return $rs;
    }
    
    /**
     * dem so ban ghi cua bang hien  hanh
     * cco the thiet lap cac dieu kien truoc do
     * 
     * 
     * @param mixed $args tham so condition
     * @param bool $reset lam rong cac bien dieu kien
     * 
     * @return int
     */
    
    public function count($args=null,$reset=false){
        $this->buildCondition();
        $rs = db::count($this->name,$args);
        if($reset) $this->resetAll();
        return $rs;
    }
    
    
    /**
     * ham chem them du lieu vao bang
     * @param Array $data       Nang du lieu
     * 
     * @return int
     */ 
    
    public function insert($data){
        $id = null;
        if($d = $this->parseData($data)){
            if(db::insert($this->tableName,$d)){
                $stmt = db::getPDO();
                $id = $stmt->lastInsertId($this->idField);
            }
        }
        return $id;
    }
    
    /**
     * cap nhat du lieu bang
     * @param Array $data       Nang du lieu
     * 
     * @return int
     */ 
    
    public function update($data, $args = null){
        $num = null;
        if($d = $this->parseData($data)){
            $a = $args;
            if(is_numeric($args)) $a = "$this->idField = $args";
            if($a && !db::getVal($this->tableName,$this->idField,$a)) return null;
            if($n = db::update($this->tableName,$d, $a)){
                $num = $n;
            }
        }
        return $num;
    }
    
    
    /**
     * xoa du lieu khoi bang
     * @param Array $data       Nang du lieu
     * 
     * @return int
     */ 
    
    
    public function delete($args = null){
        $num = 0;
        $a = $args;
        if(is_numeric($args)) $a = "$this->idField = $args";
        if($a && !db::getVal($this->tableName,$this->idField,$a)) return null;
        if($n = db::delete($this->tableName,$a)) $num = $n;
        return $num;
    }
    
    
    
    
    /**
     * ham them dieu kien cho menh de where
     * 
     * @param mixed ten thuoc tinh hoac bieu thuc hoac array
     * @param mixed gia tri String hoac array
     * @param String
     * @param String
     */ 
    
    public function where($prop, $value = PDODBNULL, $operator = '=', $cond = 'AND'){
        $this->_where[] = array($prop,$value,$operator,$cond);
        return $this;
    }
    /**
     * ham them dieu kien cho menh de where
     * @param mixed ten thuoc tinh hoac bieu thuc hoac array
     * @param mixed gia tri String hoac array
     * @param String
     */  
    
    public function orWhere($prop, $value = PDODBNULL, $operator = '='){
        return $this->where($prop,$value,$operator,'OR');
    }
    
    /**
     * ham them dieu kien cho menh de having
     * @param mixed ten thuoc tinh hoac bieu thuc hoac array
     * @param mixed gia tri String hoac array
     * @param String
     * @param String
     */ 
    
    public function having($prop, $value = PDODBNULL, $operator = '=', $cond = 'AND'){
        $this->_having[] = array($prop,$value,$operator,$cond);
        return $this;
    }
    /**
     * ham them dieu kien cho menh de having
     * @param mixed ten thuoc tinh hoac bieu thuc hoac array
     * @param mixed gia tri String hoac array
     * @param String
     */ 
    
    public function orHaving($prop, $value = PDODBNULL, $operator = '='){
        return $this->where($prop,$value,$operator,'OR');
    }
    
    
    /**
     * ham set dieu kien cho viect truy van
     * @param mixed
     * @return Object 
     */ 
    
    public function setCondition($args = null){
        $this->_conditions = $args;
        return $this;
    }
    
    /**
     * This method allows you to concatenate joins for the final SQL statement.
     *
     * @uses Table->join('table1', 'field1 <> field2', 'LEFT')
     *
     * @param string $joinTable The name of the table.
     * @param string $joinCondition the condition.
     * @param string $joinType 'LEFT', 'INNER' etc.
     * 
     * @return Table
     */
    public function join($joinTable, $joinCondition, $joinType = '')
    {
        $allowedTypes = array('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER');
        $joinType = strtoupper(trim($joinType));

        if ($joinType && !in_array($joinType, $allowedTypes)) {
            return $this;
        }
        $this->_join[] = Array($joinTable, $joinCondition, $joinType);
        return $this;
    }
    public function leftJoin($joinTable, $joinCondition){
        return $this->join($joinTable,$joinCondition, 'left');
    }
    public function rightJoin($joinTable, $joinCondition){
        return $this->join($joinTable,$joinCondition, 'right');
    }
    public function outerJoin($joinTable, $joinCondition){
        return $this->join($joinTable,$joinCondition, 'outer');
    }
    public function innerJoin($joinTable, $joinCondition){
        return $this->join($joinTable,$joinCondition, 'inner');
    }
    public function leftOuterJoin($joinTable, $joinCondition){
        return $this->join($joinTable,$joinCondition, 'left outer');
    }
    public function rightOuterJoin($joinTable, $joinCondition){
        return $this->join($joinTable,$joinCondition, 'right outer');
    }
    
    public function groupBy($groupByField)
    {
        $groupByField = preg_replace("/[^-a-z0-9\.\(\),_\*]+/i", '', $groupByField);

        $this->_groupby[] = $groupByField;
        return $this;
    }
    
    public function orderBy($orderByField, $orderbyDirection = "DESC", $customFieldsOrRegExp = null)
    {
        $this->_orderby[] = array($orderByField, $orderbyDirection, $customFieldsOrRegExp);
    }
    
    
    public function limit($limit=null, $to = null){
        $lm = array();
        if(is_null($limit)) $lm = null;
        if(is_array($limit)){
            if(isset($limit['limit'])){
                $lm = $limit['limit'];
                if(is_array($lm)){
                    if(isset($lm[0])&&isset($lm[1]))
                        $lm = array($lm[0],$lm[1]);
                    elseif(isset($lm[0]))
                        $lm = $lm[0];
                }
            }
            elseif(isset($limit[0])&&isset($limit[1]))
                $lm = array($limit[0], $limit[1]);
            elseif(isset($limit[0]))
                $lm = $limit[0];
        }
        elseif(is_numeric($limit)){
            $lm = $limit;
            if(is_numeric($to)){
                $lm = [$limit,$to];
            }
        }
        elseif(count(explode(',',$limit))==2){
            $e = explode(',',str_replace(' ','',$limit));
            $lm = $e;
        }
        if(!$lm) $lm = null;
        $this->_limit = $lm;
        return $lm;
    }
    
    protected function buildCondition(){
        if($this->_conditions){
            db::setCondition($this->_conditions);
        }
        if($this->_where){
            foreach($this->_where as $wh){
                db::where($wh[0],$wh[1],$wh[2],$wh[3]);
            }
        }
        
        if($this->_groupby){
            db::groupBy(implode(',',$this->_groupby));
        }
        
        if($this->_having){
            foreach($this->_having as $having){
                db::having($having[0],$having[1],$having[2],$having[3]);
            }
        }
        
        if($this->_orderby){
            foreach($this->_orderby as $o){
                db::orderBy($o[0],$o[1],$o[2]);
            }
        }
        if($this->_limit){
            db::limit($this->_limit);
        }
    }
    
    
    
    /**
     * ham validate data field cua bang
     * kiem tra xem cac du lieu co khop voi cac cot cua bang hay ko
     * 
     * @param Array $data        mang du lieu
     */
    
    protected function parseData($data){
        $d = array();
        if(is_string($data)){
            try{
                parse_str($data,$arr);
                $d = $arr;
            }catch(Exception $e){
                //del lam gi ca
            }
        }elseif(is_array($data)){
            $d = $data;
        }
        if(!$d) return null;
        unset($d[$this->idField]);
        $r = array();
        foreach($d as $f => $v){
            if(in_array($f, $this->fields)) $r[$f] = $v;
        }
        return $r;
    }
    
    
    
    
    
    

   
    
}
