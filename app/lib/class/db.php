<?php

/**
 * @author Doanln
 * @copyright 2017
 */

/**
 * @class db
 * class tinh
 */ 

class db{
    /**
     * @var Object $PDO doi tuong ket noi csdl
     */  
    protected static $PDO;
    
    /**
     * @var String $host 
     */
    protected static $host = 'localhost';
    
    protected static $dbname = 'test';
    
    protected static $username = 'root';
    
    protected static $password = '';
    
    protected static $dbms = 'mysql';
    
    protected static $reportLevel = 3;
    
    protected static $error_message = null;
    
    
    
    /**
     * cai dat cac tham so
     * @param mixed $host mang toan bo tham so hoac string host / server / path
     * @param string $dbname
     * @param String $username ten truy cap
     * @param String $password mat khau
     * @param String $dbms he quan tri csdl
     */ 
     
    public static function config($host = 'localhost', $dbname = 'test', $user = 'root', $pass = '', $dbms='MYSQL') {
        self::$host = $host;
        self::$dbname = $dbname;
        self::$username = $user;
        self::$password = $pass;
        self::$dbms = $dbms;
    }
    
    /**
     * cai dat cac tham so
     * @param mixed $host mang toan bo tham so hoac string host / server / path
     * @param string $dbname
     * @param String $username ten truy cap
     * @param String $password mat khau
     * @param String $dbms he quan tri csdl
     */ 
     
    public function connect($host = null, $dbname = null, $user = null, $pass = null, $dbms=null) {
        $h = is_null($host)    ? self::$host     : $host;
        $d = is_null($dbname)  ? self::$dbname   : $dbname;
        $u = is_null($user)    ? self::$username : $user;
        $p = is_null($pass)    ? self::$password : $pass;
        $m = is_null($dbms)    ? self::$dbms     : $dbms;
        try{
            self::$PDO = new PDOdb($h,$d,$u,$p,$m);
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
    }
    
    
    
    
    
    
    
    
    
    
    /**
     * dua cac tham so ve mac dinh
     */ 
    
    public function reset(){
        try{
            self::$PDO->reset();
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
    }
    
    /**
     * lay cac ban ghi trong csdl
     * @param String $tableName      ten bang
     * @param String $select         Danh sach cac cot can select
     * @param Mixed $condition       dieu kien de select (co the su dung string hoac array) bao gom ca where, group by, having, order by, limit
     * 
     * @note cach su dung tham so:
     * uu tin where. nghia la cac KEY binh thuong se duoc hieu la where.
     * vi du trong array('KEY' => 'VAL') se duoc hieu la mot phan cua menh de where: KEY = 'VAL'
     * trong chuoi request KEY=VAL cung tuong tu.
     * ngoai ra con co the su dung cac toan tu so sanh sau KEY.
     * vi du trong mang array('KEY<=' => 'VAL', 'KEY >=' => 'VAL', 'KEY like' => 'VAL', 'KEY notlike' => 'VAL')
     * chu ý la not like viet lien
     * voi chuoi cung tuong tu
     * 
     * @return Array | Obj
     */ 
    
    public function get($tableName,$select='*',$condition=null){
        $rs = null;
        try{
            $rs = self::$PDO->get($tableName,$select,$condition);
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
        return $rs;
    }
    
    /**
     * lay 1 ban ghi trong csdl
     * @param String $tableName      ten bang
     * @param String $select         Danh sach cac cot can select
     * @param Mixed $condition       dieu kien de select (co the su dung string hoac array) bao gom ca where, group by, having, order by, limit
     * 
     * @note cach su dung tham so:
     * uu tin where. nghia la cac KEY binh thuong se duoc hieu la where.
     * vi du trong array('KEY' => 'VAL') se duoc hieu la mot phan cua menh de where: KEY = 'VAL'
     * trong chuoi request KEY=VAL cung tuong tu.
     * ngoai ra con co the su dung cac toan tu so sanh sau KEY.
     * vi du trong mang array('KEY<=' => 'VAL', 'KEY >=' => 'VAL', 'KEY like' => 'VAL', 'KEY notlike' => 'VAL')
     * chu ý la not like viet lien
     * voi chuoi cung tuong tu
     * 
     * @return Array | Obj
     */ 
    
    public static function getOne($tableName,$select='*',$condition=null){
        $rs = null;
        try{
            $rs = self::$PDO->getOne($tableName,$select,$condition);
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
        return $rs;
    }
    
    
    /**
     * lay cac ban ghi trong csdl
     * @param String $tableName      ten bang
     * @param String $column         ten cot
     * @param Mixed $condition       dieu kien de select (co the su dung string hoac array) bao gom ca where, group by, having, order by, limit
     * 
     * @note cach su dung tham so:
     * uu tin where. nghia la cac KEY binh thuong se duoc hieu la where.
     * vi du trong array('KEY' => 'VAL') se duoc hieu la mot phan cua menh de where: KEY = 'VAL'
     * trong chuoi request KEY=VAL cung tuong tu.
     * ngoai ra con co the su dung cac toan tu so sanh sau KEY.
     * vi du trong mang array('KEY<=' => 'VAL', 'KEY >=' => 'VAL', 'KEY like' => 'VAL', 'KEY notlike' => 'VAL')
     * chu ý la not like viet lien
     * voi chuoi cung tuong tu
     * 
     * @return Array | Obj
     */ 
    
    public static function getVal($tableName,$column=null,$condition=null){
        $rs = null;
        try{
            $rs = self::$PDO->getVal($tableName,$column,$condition);
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
        return $rs;
    }
    
    /**
     * lay cac ban ghi trong csdl
     * @param String $tableName      ten bang
     * @param Mixed $condition       dieu kien de select (co the su dung string hoac array) bao gom ca where, group by, having, order by, limit
     * 
     * @note cach su dung tham so:
     * uu tin where. nghia la cac KEY binh thuong se duoc hieu la where.
     * vi du trong array('KEY' => 'VAL') se duoc hieu la mot phan cua menh de where: KEY = 'VAL'
     * trong chuoi request KEY=VAL cung tuong tu.
     * ngoai ra con co the su dung cac toan tu so sanh sau KEY.
     * vi du trong mang array('KEY<=' => 'VAL', 'KEY >=' => 'VAL', 'KEY like' => 'VAL', 'KEY notlike' => 'VAL')
     * chu ý la not like viet lien
     * voi chuoi cung tuong tu
     * 
     * @return int
     */ 
    
    public static function count($tableName, $condition = null){
        $rs = null;
        try{
            $rs = self::$PDO->count($tableName,$condition);
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
        return $rs;
    }
    
    /**
     * lay cac ban ghi trong csdl
     * @param String $tableName      ten bang
     * @param Mixed $condition       dieu kien de xoa (co the su dung string hoac array) bao gom ca where, group by, having, order by, limit
     * 
     * @note cach su dung tham so:
     * uu tin where. nghia la cac KEY binh thuong se duoc hieu la where.
     * vi du trong array('KEY' => 'VAL') se duoc hieu la mot phan cua menh de where: KEY = 'VAL'
     * trong chuoi request KEY=VAL cung tuong tu.
     * ngoai ra con co the su dung cac toan tu so sanh sau KEY.
     * vi du trong mang array('KEY<=' => 'VAL', 'KEY >=' => 'VAL', 'KEY like' => 'VAL', 'KEY notlike' => 'VAL')
     * chu ý la not like viet lien
     * voi chuoi cung tuong tu
     * 
     * @return int
     */ 
    
    public static function delete($tableName, $condition = null){
        $rs = null;
        try{
            $rs = self::$PDO->delete($tableName,$condition);
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
        return $rs;
    }
    
    /**
     * them du lieu vao bang
     * @param String $tableName    ten bang
     * @param Array $data          Du lieu can chen
     * 
     * @return int
     */
     
    public static function insert($tableName,$data){
        $rs = null;
        try{
            $rs = self::$PDO->insert($tableName,$data);
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
        return $rs;
    }
    /**
     * update du lieu vao bang
     * @param String $tableName    ten bang
     * @param Array $condition     dieu kien update
     * 
     * @return int
     */
     
    public static function update($tableName,$data, $condition = array()){
        $rs = null;
        try{
            $rs = self::$PDO->update($tableName,$data,$condition);
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
        return $rs;
    }
    
    /**
     * thuc thi query
     * @param string
     * 
     * @return int
     */ 
    
    public static function query($query){
        $rs = null;
        try{
            $rs = self::$PDO->query($query);
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
        return $rs;
    }
    /**
     * thuc thi query
     * @param string
     * 
     * @return int
     */ 
    
    public static function exec($query){
        $rs = null;
        try{
            $rs = self::$PDO->exec($query);
        }
        catch(Exception $e){
            self::$error_message = $e->getMessage();
            self::reportError();
        }
        return $rs;
    }
    
    /**
     * ham thuc thi chuoi truy van voi tham so truyen vao
     * @param String $query        Chuoi truy van
     * @param Array $params        Tham so
     * 
     * @return PDOStatement Obj
     */ 
    
    public static function execute($query, $params = array()){
        $stmt = null;
        try{
            $stmt = self::$PDO->execute($query,$params);
        }catch(Exception $e){
            $msg = $e->getMessage();
            $this->error_message = $msg;
            $this->reportError();
        }
        return $stmt;
    }
    
    
    
    /**
     * ham them dieu kien cho menh de where
     * @param String
     * @param mixed
     * @param String
     * @param String
     */ 
    
    public static function where($prop, $value = PDODBNULL, $operator = '=', $cond = 'AND'){
        return self::$PDO->where($prop,$value,$operator,$cond);
    }
    /**
     * ham them dieu kien cho menh de where
     * @param String
     * @param mixed
     * @param String
     */ 
    
    public static function orWhere($prop, $value = PDODBNULL, $operator = '='){
        return self::$PDO->orWhere($prop,$value,$operator);
    }
    
    /**
     * ham them dieu kien cho menh de having
     * @param String
     * @param mixed
     * @param String
     * @param String
     */ 
    
    public static function having($prop, $value = PDODBNULL, $operator = '=', $cond = 'AND'){
        return self::$PDO->having($prop,$value,$operator,$cond);
    }
    /**
     * ham them dieu kien cho menh de having
     * @param String $prop thuoc tinh hay bieu thuc
     * @param mixed
     * @param String
     */ 
    
    public static function orHaving($prop, $value = PDODBNULL, $operator = '='){
        return self::$PDO->orHaving($prop,$value,$operator);
    }
    
    /**
     * This method allows you to concatenate joins for the final SQL statement.
     *
     * @uses dv::join('table1', 'field1 <> field2', 'LEFT')
     *
     * @param string $joinTable The name of the table.
     * @param string $joinCondition the condition.
     * @param string $joinType 'LEFT', 'INNER' etc.
     * 
     * @return PDOObj
     */
    public static function join($joinTable, $joinCondition, $joinType = '')
    {
        return self::$PDO->join($joinTable, $joinCondition, $joinType);
    }
    
    public static function leftJoin($joinTable, $joinCondition){
        return self::$PDO->leftJoin($joinTable,$joinCondition);
    }
    public static function rightJoin($joinTable, $joinCondition){
        return self::$PDO->rightJoin($joinTable,$joinCondition);
    }
    public static function outerJoin($joinTable, $joinCondition){
        return self::$PDO->outerJoin($joinTable,$joinCondition);
    }
    public static function innerJoin($joinTable, $joinCondition){
        return self::$PDO->innerJoin($joinTable,$joinCondition);
    }
    public static function leftOuterJoin($joinTable, $joinCondition){
        return self::$PDO->leftOuterJoin($joinTable,$joinCondition);
    }
    public static function rightOuterJoin($joinTable, $joinCondition){
        return self::$PDO->rightOuterJoin($joinTable,$joinCondition);
    }
    
    public function groupBy($groupByField)
    {
        $groupByField = preg_replace("/[^-a-z0-9\.\(\),_\*]+/i", '', $groupByField);

        return self::$PDO->groupBy($groupByField);
    }
    
    public function orderBy($orderByField, $orderbyDirection = "DESC", $customFieldsOrRegExp = null)
    {
        return self::$PDO->orderBy($orderByField, $orderbyDirection, $customFieldsOrRegExp);
    }
    
    
    public function limit($limit=null, $to = null){
        return self::$PDO->limit($limit,$to);
    }
    
    
    
    
    /**
     * ham set dieu kien cho viect truy van
     * @param mixed
     * @return Object 
     */ 
    
    public static function setCondition($args = null){
        return self::$PDO->setCondition($args);
    }
    
    
    
    public static function getDBObj(){
        return clone self::$PDO;
    }
    
    public static function getStmt(){
        return self::$PDO->getStmt();
    }
    public static function setPrefix($prefix=''){
        return self::$PDO->setPrefix($prefix);
    }
    
    public static function getPrefix(){
        return self::$PDO->getPrefix();
    }
    public static function setFetchType($pft=PDO::FETCH_ASSOC){
        return self::$PDO->setPrefix($pft);
    }
    
    public static function getFetchType(){
        return self::$PDO->getFetchType();
    }
    public static function getPDO(){
        return self::$PDO->getPDO();
    }
    public static function getLastQuery(){
        return self::$PDO->getLastQuery();
    }
    
    
    
    
    
    
    
    /**
     * ham hien thi thong bao loi. co the tuy chinh dung code, bo qua, hay van hien thong bao va tiep tuc chay code
     * @param String $message thong bao loi
     * 
     * @return void
     */ 
    
    protected function reportError($message=null){
        $m = is_null($message) ? self::$error_message : $message;
        switch(self::$reportLevel){
            case 0:
                //nothing
            break;
            
            case 1:
                echo '<br />'.$m."<br />";
            break;
            
            case 2:
                throw new Exception($m);
            break;
            
            default:
                self::$PDO->disconnect();
                die('<br />'.$m."<br />");
        }
    }
    
    
    
    /**
     * thiet lap thong bao loi
     * @param int $level
     * 
     * @return bool
     */ 

    public static function setErrorReportingLevel($level = 0){
        if(is_int($level) && $level >= 0 && $level <= 3){
            self::$reportLevel = $level;
            return true;
        }
        return false;
    }
    public static function setPDOErrorReportingLevel($level = 0){
        if(is_int($level) && $level >= 0 && $level <= 3){
            return self::$PDO->setErrorReportingLevel($level);
        }
        return false;
    }
    
    
}

?>