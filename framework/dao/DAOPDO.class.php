<?php
namespace framework\dao;
use framework\dao\I_DAO;
use PDO;
/**
 * 〈一句话功能简述〉
 * 〈功能详细描述〉
 * @author[作者]
 */
class DAOPDO implements I_DAO {
    //数据库类私有属性
    private $_host;
    private $_user;
    private $_pwd;
    private $_port;
    private $_charset;
    private $_dbname;
    
    //影响的行数
    private $_affectRows;
    //数据库连接的属性
    private $_pdo_dao;
    //保存数据库类的对象
    static private $_instance;
    
    /**
     * 〈私有化构造函数，并初始化数据库属性，和连接数据库〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    private function __construct($config) {
        //初始化数据库属性
        $this -> initConfig($config);
        
        //初始化连接数据库，并判断是否连接成功
        $this -> initPDO();
    }
    
    /**
     * 〈单例生产数据库对象〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    static public function getSinglton(array $config) {
       
        //如果当前没有该对象
        if(!self::$_instance instanceof self) {
            
            self::$_instance = new self($config);
            
        }
        //返回该对象
        return self::$_instance;

    }
    
    /**
     * 〈初始化数据库属性〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    private function initConfig($config) {
        
        //初始化数据库属性
        $this->_host = isset($config['host']) ? $config['host'] : '';
        $this->_user = isset($config['user']) ? $config['user'] : '';
        $this->_pwd  = isset($config['pwd'])? $config['pwd']  : '';
        $this->_port  = isset($config['port']) ? $config['port'] : 3306;
        $this->_dbname = isset($config['dbname']) ? $config['dbname'] : '';
        $this->_charset =isset($config['charset']) ? $config['charset'] : '';
    }
    
    /**
     * 〈连接数据库，并判断是否连接成功〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    private function initPDO() {
        //连接数据库，并判断是否连接成功

        $dsn = "mysql:host={$this->_host};port={$this->_port};dbname={$this->_dbname}";
        $user = $this->_user;
        $pwd = $this->_pwd;
        $this -> _pdo_dao = new PDO($dsn,$user,$pwd);
        
        if(!$this -> _pdo_dao) {  #连接失败提示
            echo '<br>数据库连接失败';
            $err = $this->_pdo_dao ->errorInfo();
            echo '<br>失败原因：'.$err[2];
            return false;
        }
        
    }
    /**
     * 〈私有化克隆函数〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    private function __clone() {}
    
    /**
     * 〈执行非查询语句〉
     * 〈执行DML语句操作〉
     * @param [$sql]     [执行的DMLsql语句]
     * @return[int:返回影响的行数]
     */
    public function exec($sql) {
  
       $res =  $this->_pdo_dao->exec($sql);
       
        //错误处理
        if($res === false) {
            echo '<br>执行非查询失败';
            echo '<br>失败语句：'.$sql;
            $err = $this->_pdo_dao ->errorInfo();
            echo '<br>失败原因：'.$err[2];
            return false;
        }
        //保存影响的行数
        $this-> _affectRows = $res;
        //正确则返回影响的行数
        return $res;
    }
    
    /**
     * 〈执行查询语句〉
     * 〈执行DQL语句操作〉
     * @param [$sql]     [执行的DQLsql语句]
     * @return[pdo_statement:数据库结果对象]
     */
    public function query($sql) {
        $pdo_statement = $this->_pdo_dao -> query($sql);

        //错误处理
        if(!$pdo_statement) {
            echo '<br>执行查询失败';
            echo '<br>失败语句：'.$sql;
            $err = $this -> _pdo_dao ->errorInfo();
            echo '<br>失败原因：'.$err[2];
            return false;
        }
        //返回数据库结果集
        return $pdo_statement;
    }
    
    /**
     * 〈执行传入的sql语句，返回数据库中一列数据〉
     * @param [$sql]     [执行的DMLsql语句]
     * @return[mixed:数据库中储存的结果]
     */
    public function fetchColumn($sql) {
        //执行sql语句
        $result = $this -> query($sql);
        
        $row = $result -> fetchColumn();
        
        return $row;
    }
    
    /**
     * 〈执行传入的sql语句，返回数据库中一行记录〉
     * @param [$sql]     [执行的DMLsql语句]
     * @return[array:返回数据库中的一行记录]
     */
    public function fetchRow($sql) {
        //执行sql语句
        $result = $this -> query($sql);
        
        $row = $result -> fetch(PDO::FETCH_ASSOC);
        
        return $row;
    }
    
    /**
     * 〈执行传入的sql语句，返回数据库中多行记录〉
     * @param [$sql]     [执行的DMLsql语句]
     * @return[array:返回数据库中的多行记录]
     */
    public function fetchAll($sql) {
        //执行sql语句
        $result = $this-> query($sql);
        
        $rows = $result -> fetchAll(PDO::FETCH_ASSOC);
        
        return $rows;
    }
    
    /**
     * @return[int：返回执行语句后受影响的记录数据]
     */
    public function affectRows() {
        
        $affectrows = $this -> _affectRows;
        $this -> _affectRows = null;
        return $affectrows;
    }
    
    /**
     * 〈用数据库对象执行lastInsertID函数,返回插入的主键〉
     * @return[int:插入的主键值；一般为int]
     */
    public function lastInsertID() {
        
        return $this->_pdo_dao -> lastInsertID();
    }
    
    /**
     * 〈用数据库对象执行quote函数,返回转义的字符串〉
     * @param [$str]     [需要转义的字符串]
     * @return[str:转义好的字符串]
     */
    public function quoteValue($str) {
        
        return $this->_pdo_dao->quote($str);
    }

   
    public function transaction($sql,$value) {

        $this->_pdo_dao ->beginTransaction();

        $pdo_statement = $this->_pdo_dao ->prepare($sql);

        foreach($value as $k=>$v) {
            $pdo_statement ->bindValue('?',$v);

        }
        $res = $pdo_statement ->execute();
     
        return $res;
    }
}