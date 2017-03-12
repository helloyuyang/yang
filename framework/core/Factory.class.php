<?php
namespace framework\core;

class Factory {
    static $_all_model = array();
    
    static public function M($model) {
      
        //判断有没有带命名空间
        if(strstr($model, '\\')) {  #带有命名空间
            $model_name = $model;
        } else {
            $model_name = MODULE.'\\model\\'.$model;
        }
       
        //省略model 
        if(substr($model_name, -5,5) !='Model') {
            $model_name = $model_name.'Model'; 
        }
         
        //单例工厂模式生产类
        if(!isset(self::$_all_model[$model])
            ||
            self::$_all_model[$model] instanceof self) {
            
                self::$_all_model[$model] = new $model_name;
        }
        
        return self::$_all_model[$model];
    }

/**
 * 〈封装伪静态URL〉
 * 〈功能详细描述〉
 * @param [$mca]     [模块、控制器、方法]
 * @param [$parma]     [额外的参数]
 * @return[返回类型说明]
 */
    static public function U($mca,$params=array()) {

        $path = $_SERVER['SCRIPT_NAME'];

        $base_path = str_replace('index.php','',$path);

        $base_path .= $mca;

        // 判断是否有额外的参数
        if($params) {
            foreach($params as $k=>$v) {
                $base_path .= '/'.$k.'/'.$v;
            }
        }
    
        return $base_path;
    }
}