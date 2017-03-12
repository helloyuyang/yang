<?php 
require './framework/core/Framework.class.php';
use framework\core\Framework;

//定义常量
// 定义文件根目录
define('ROOT', str_replace('\\', '/', __DIR__).'/');
// 定义应用路径
define('APP_PATH', ROOT.'application/');
// 定义框架路径
define('FRAME_PATH', ROOT.'framework/');
// 定义公共文件路径（css，Js）
define('PUBLIC_PATH', '/project/1229static/application/public/');
// 定义上传文件路径
define('UPLOAD_PATH', './application/public/uploads/');
// 定义压缩储存路径
define('THUMB_PATH', './application/public/static/');
// 定义字体文件路径
define('FONT_PATH', './application/public/fonts/');
// 静态文件目录
define('STATIC_PATH','./application/public/static/html/');


// 入口
new Framework();

?>