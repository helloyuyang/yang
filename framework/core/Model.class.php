<?php

namespace framework\core;

use framework\dao\DAOPDO;

/**
 * 〈一句话功能简述〉
 * 〈功能详细描述〉
 * @author[作者]
 */
class Model {
    //保存数据库对象
    protected $_dao;
    //保存继承该类的数据表
    protected $_true_table;
    //保存数据表中的主键字段
    protected $_true_pk;
    //保存错误信息的数组
    public $_error = array();
    
    /**
     * 〈构造方法〉
     * 〈初始化数据库，表，主键字段〉
     * @return[返回类型说明]
     */
    public function __construct() {
        
         $this -> initDAO();
        
         $this -> initTable();
        
         $this -> initPK();
    }
    
    /**
     * 〈新建数据库对象〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    private function initDAO() {
        
        //配置数组=全局配置文件数组
        $config = $GLOBALS['config'];
        
        //新建数据库对象
        $this -> _dao = DAOPDO::getSinglton($config);
    }
    
    /**
     * 〈初始化数据表〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    private function initTable() {
        //$logic_table为每个模型类使用的数据表
        $this -> _true_table = $GLOBALS['config']['prefix'].$this -> _logic_table;
    }
    
    /**
     * 〈初始化主键字段〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    private function initPK() {
        //准备sql语句
        $sql = "DESC `$this->_true_table`";
        //返回所有字段
        $rows = $this -> _dao ->fetchAll($sql);
        
        //遍历找出主键字段
        foreach ($rows as $v) {
            
            if($v['Key'] == 'PRI') {
                $this -> _true_pk = $v['Field']; 
            }
            
        }        
    }
    
    /**
     * 〈遍历错误数组信息〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    public function showErr() {
        $err_str ='';
        foreach ($this -> _error as $v) {
            
            $err_str .= $v;
        }
        
        return $err_str;
    }
    
    /**
     * 〈自动插入数据〉
     * 〈传入的关联数组字段和值，添加进数据库中〉
     * @param [$data]     [包含字段和值的关联数组]
     * @return[int:插入的主键]
     */
    public function insert($data) {
        
        //将数组里的键解析为索引数组。
        $f_key = array_keys($data);  
        //将字段加上反引号
        $f_key = array_map(function($v) {
            return '`'.$v.'`';
        }, $f_key);
        //将数组转换为字符串,并加上括号
        $keys = '('.implode(',', $f_key).')';
        
        //将数组里的值解析为索引数组
        $f_values = array_values($data);  
        
        //用户输入信息，须进行转义
        $values = array_map(array($this->_dao,"quoteValue"), $f_values);

        //将数组转换为字符串,并加上括号
        $values = '('.implode(',', $values).')';
        
        //拼接sql语句
        $sql = "INSERT INTO `$this->_true_table` $keys VALUES$values";
         
        $res = $this -> _dao -> exec($sql);
        if($res == false) { #执行失败，返回false
            return false;
        }
        //返回插入的主键
         $this -> _dao -> affectRows();
         return  $this ->_dao->lastInsertID();
    }
    
    /**
     * 〈自动更新操作〉
     * 〈将传入的字段和值关联数组 和条件关联数组拼接成sql语句，并执行，返回影响的行数〉
     * @param [$data]     [包含要更新字段和值的关联数组]
     * @param [$where]     [where条件的字段和值的关联数组,只有一对,条件不用转义]
     * @return[int：返回影响的行数]
     */
    public function update($data,$where=null) {
//         $data = array('cat_name'=>'tang','parent_id');
//         $where = array('cat_id'=>'11');
        /* 判断有无where条件 ,无条件直接返回*/
        if(is_null($where)) {
            return false;
        } else {
            //将条件数组解析为键和值
            $where_key = array_keys($where);
            $where_value = array_values($where);
            //将条件的值做转义处理
            //$where_value = array_map(array($this ->_dao,"quoteValue"), $where_value);
            //拼接条件语句,一般只有一个条件语句,样式为：cat_id='4'
            $where_str = $where_key[0].'='.$where_value[0];         
        }
        
        /* 解析data数组为键和值的索引数组 */
        $f_key = array_keys($data);
        $f_values = array_values($data);
        //将字段加上反引号
        $key = array_map(function($v) {
            return '`'.$v.'`';
        }, $f_key);
       //将值进行转义
        $values = array_map(array($this->_dao,"quoteValue"), $f_values);
       //拼接更新字段和值
        $fileds ='';
        foreach ($key as $k =>$v) {
          $fileds .=  $v.'='.$values[$k].',';
       }
      
        //去除最后一个点
        $fileds = substr($fileds,0, -1);
        
        //拼接sql语句
        $sql = "update `$this->_true_table` set $fileds WHERE $where_str";
        
        //返回受影响的行数
        return $this->_dao->exec($sql);

    }
    
    /**
     * 〈自动删除操作〉
     * 〈根据传入的id值,执行删除操作；条件的键一般为主键〉
     * @param [$id]     [删除的主键id值]
     * @return[int：返回受影响的行数]
     */
    public function delete($id) {
        $sql = "DELETE FROM `$this->_true_table` WHERE `$this->_true_pk` = $id";
        
        return $this->_dao -> exec($sql);
    }
    
    /**
     * 〈自动查询操作〉
     * 〈根据传入的字段和值索引数组和条件关联数组，返回一条记录〉
     * @param [$data]     [包含字段的索引数组]
     * @param [$where]     [包含条件的字段和值的关联数组]
     * @return[array:一行记录]
     */
    public function selectRow($data,$where) {
//         $sql = "select *(cat_id,parent_id) from table where";
//         $data = array('cat_id','parent_id');
//         $where = array('cat_id'=>4);
        
        //判断查询的字段是否为空
        if(is_null($data)) {
            $fileds = '*';
        } else {
            //解析字段
            $fileds = '';
            foreach($data as $k => $v) {    #转换为字段字符串
                $fileds .= $v;
            }           
        }
        
        //解析条件
        if(is_null($where)) {
            $where_str = '';
        } else {
            //将条件数组解析为键和值
            $where_key = array_keys($where);
            $where_value = array_values($where);
            //将条件的值做转义处理
            $where_value = array_map(array($this ->_dao,"quoteValue"), $where_value);
            //拼接条件语句,一般只有一个条件语句,样式为：cat_id='4'
            $where_str = $where_key[0].'='.$where_value[0];
        }
        
        //拼接sql语句
        $sql = "SELECT $fileds FROM `$this->_true_table` WHERE $where_str";
        
        //返回一条记录
        return $this->_dao -> fetchRow($sql);
    }
  }  
    

