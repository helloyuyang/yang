<?php
namespace framework\dao;

interface I_DAO {
    
    /**
     * 〈执行非查询语句〉
     * 〈执行DML语句操作〉
     * @param [$sql]     [执行的DMLsql语句]
     * @return[int:返回影响的行数]
     */
    public function exec($sql);
    
    /**
     * 〈执行查询语句〉
     * 〈执行DQL语句操作〉
     * @param [$sql]     [执行的DQLsql语句]
     * @return[pdo_statement:数据库结果对象]
     */
    public function query($sql);
    
    /**
     * 〈执行传入的sql语句，返回数据库中一列数据〉
     * @param [$sql]     [执行的DMLsql语句]
     * @return[mixed:数据库中储存的结果]
     */
    public function fetchColumn($sql);
    
    /**
     * 〈执行传入的sql语句，返回数据库中一行记录〉
     * @param [$sql]     [执行的DMLsql语句]
     * @return[array:返回数据库中的一行记录]
     */
    public function fetchRow($sql);
    
    /**
     * 〈执行传入的sql语句，返回数据库中多行记录〉
     * @param [$sql]     [执行的DMLsql语句]
     * @return[array:返回数据库中的多行记录]
     */
    public function fetchAll($sql);
    
     /**
      * @return[int：返回执行语句后受影响的记录数据]
      */
     public function affectRows();
    
    /**
     * 〈用数据库对象执行lastInsertID函数,返回插入的主键〉
     * @return[int:插入的主键值；一般为int]
     */
    public function lastInsertID();
    
    /**
     * 〈用数据库对象执行quote函数,返回转义的字符串〉
     * @param [$str]     [需要转义的字符串]
     * @return[str:转义好的字符串]
     */
    public function quoteValue($str);
}