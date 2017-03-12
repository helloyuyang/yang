<?php
namespace framework\core;
use Smarty;

class Controller {
    //保存模板
    protected $_smarty;
    
    /**
     * 〈构造函数，初始化模板〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    public function __construct() {
        
        $this->initSmarty();

        $this->initSession();
    }
    
    /**
     * 〈初始化模板〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    private function initSmarty() {
        
        $this->_smarty =  new Smarty();
        
        //设置模板目录;全路径
        $this->_smarty->setTemplateDir(APP_PATH.MODULE.'/view/');
        //设置编译目录
        $this->_smarty->setCompileDir(APP_PATH.'runtime/');
        
        //设置定界符
        $this->_smarty->left_delimiter = '<{';
        $this->_smarty->right_delimiter = '}>';
    }
    // 基础开启session_start()
    public function initSession() {
        session_start();
    }

    // 防跳墙验证
    public function isLogin() {
     
        // 判断有没有session
        if(!isset($_SESSION['user'])) {
            // 判断有没有设置cookie，都没有跳去登录
            if(isset($_COOKIE['uname'])) {
                // 判断密码存不存在
                $user_model = Factory::M('User');
                $res = $user_model -> checkUser($_COOKIE['uname'],$_COOKIE['pwd']);
                if($res) {
                    // 用户名和密码存在,登录后台，保存到session
                    $_SESSION['user'] = $res;
                } else {
                      // 没有设置cookie
                    $this ->jumpURL('登录时间超长...请重新登录','?m=home&c=User&a=login');
                }
           
            } else {
                // session和cookie都不存在
                $this -> jumpURL('请登录后查看更多内容','?m=home&c=User&a=login');
            }
            
        }

    }
    
    /**
     * 〈跳转功能〉
     * 〈功能详细描述〉
     * @param [参数1]     [参数1说明]
     * @param [参数2]     [参数2说明]
     * @return[返回类型说明]
     */
    public function jumpURL($message='',$url,$delay=3) {
        echo $message.'<br>';
        header("Refresh:$delay;url=$url");
        return;
    }
}