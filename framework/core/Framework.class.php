<?php
namespace framework\core;

class Framework {
    
    /**
     * 〈构造函数〉
     * 〈初始化〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    public function __construct() {
        
        $this->autoload();
        $config1 = $this->loadFrameConfig();
        $config2 = $this->loadCommonConfig();
        $GLOBALS['config'] = array_merge($config1,$config2);
         $this ->inintStatic();

        $this->initModule();

        $config3 = $this->loadModuleConfig();

        $GLOBALS['config'] = array_merge($GLOBALS['config'],$config3);

        $this->initCA();

        $this->initDispath();
        
    }
    
    public function autoload() {
        spl_autoload_register(array($this,"userAutoload"));
    }
    
    private function userAutoload($className) {
        if($className == 'Smarty') {
            require FRAME_PATH.'vendor/smarty/Smarty.class.php';
        }
        //判断属于平台还是框架
        $arr = explode('\\', $className);
        
        if($arr[0] == 'framework') {
            $base_dir = './';
        } else {
            $base_dir = './application/';
        }
        //转换分隔符
        $sub_dir = str_replace('\\', '/', $className);
        
        //判断后缀
        if(substr($arr[count($arr)-1], 0,2) == 'I_' ) {
            $prefix = '.interface.php';
        } else {
            $prefix = '.class.php';
        }
        //拼接目录
        $class_name = $base_dir.$sub_dir.$prefix;
        if(file_exists($class_name)) {
            require $class_name;
        }
    }
    
    public function initModule() {
        $m = isset($_GET['m']) ? $_GET['m'] : $GLOBALS['config']['default_module'];
        define('MODULE', $m);
    }
    
    public function initCA() {
        $c = isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config']['default_controller'];
        define('CONTROLLER', $c);
        $a = isset($_GET['a']) ? $_GET['a'] : $GLOBALS['config']['default_action'];
        define('ACTION', $a);
    }

    public function initDispath() {
        // 拼接控制器
        $controller_name = MODULE.'\\controller\\'.CONTROLLER.'Controller';
        // 拼接方法
        $action = ACTION.'Action';

        // 实例化控制器
        $controller = new $controller_name;
        $controller -> $action();
    }

    public function inintStatic() {
       
        if(isset($_SERVER['PATH_INFO'])) {
           
            // 去除最后的后缀
            $postfix = strrchr($_SERVER['PATH_INFO'], '.');
            $path = str_replace($postfix, '', $_SERVER['PATH_INFO']);
            // 去除第一个斜杠
            $path_info = substr($path, 1);
            // 拆分
            $path_arr = explode('/', $path_info);

            $length = count($path_arr);
            // 多参数处理
            if($length == 1) {
                $_GET['m'] = $path_arr[0];
            } else if($length == 2) {
                $_GET['m'] = $path_arr[0];
                $_GET['c'] = $path_arr[1];
            } else if($length == 3) {
                $_GET['m'] = $path_arr[0];
                $_GET['c'] = $path_arr[1];
                $_GET['a'] = $path_arr[2];
            } else {
                $_GET['m'] = $path_arr[0];
                $_GET['c'] = $path_arr[1];
                $_GET['a'] = $path_arr[2];

                for($i=3;$i<$length-1;$i+=2) {
                    $_GET[$path_arr[$i]] = $path_arr[$i+1];
                }
            }
        }

    }
    
    private function loadFrameConfig() {
        return require FRAME_PATH.'config/config.php';
    }
    
    private function loadCommonConfig() {
        return require APP_PATH.'common/config/config.php';
    }
    private function loadModuleConfig() {
        return require APP_PATH.MODULE.'/config/config.php';
    }
}
