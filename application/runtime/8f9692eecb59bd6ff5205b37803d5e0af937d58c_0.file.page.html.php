<?php
/* Smarty version 3.1.29, created on 2017-01-15 13:40:00
  from "D:\wamp\Apache24\htdocs\Project\1229static\application\home\view\Question\page.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_587b0b300af4e6_30971629',
  'file_dependency' => 
  array (
    '8f9692eecb59bd6ff5205b37803d5e0af937d58c' => 
    array (
      0 => 'D:\\wamp\\Apache24\\htdocs\\Project\\1229static\\application\\home\\view\\Question\\page.html',
      1 => 1484458747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587b0b300af4e6_30971629 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<?php echo '<script'; ?>
 src="<?php echo PUBLIC_PATH;?>
home/js/common.js"><?php echo '</script'; ?>
>
	<link href="<?php echo PUBLIC_PATH;?>
home/css/bootstrap.css" rel="stylesheet" type="text/css">
	<?php echo '<script'; ?>
 type="text/javascript">
	function showPage(opage) {
		// 获取元素
		var odiv = document.getElementById('result');

		var otd = document.createElement('td');
		// 展示分页跳转
		var olast = document.getElementsByClassName('last')[0];
		var onext = document.getElementsByClassName('next')[0];
	
		// 获取分页数据
		
		$$.request({
			method:'get',
			url:'?m=home&c=Page&a=getpage',
			dataType:'json',
			data:'page='+opage,
			callback:function(result) {
				// 循环遍历元素
				var otable = document.createElement('table');
				// ota.id = 'ta';
				// var otable = document.getElementById('ta');
				console.log(otable);
				var data = result.data;
				for(var i=0;i<data.length;i++) {
					var otr = document.createElement('tr');
					otr.className = 'danger';
					otr.innerHTML = data[i].question_title;
					// 确定位置关系
					otable.appendChild(otr);	
				}
				// 确定位置关系
				odiv.appendChild(otable);
			}	
		});
				olast.href = "javascript:showPage(2)";
			    onext.href = "javascript:showPage(3)";
			    console.log(olast.href);
	}
		window.onload = function() {
			showPage(page=1);
		}
	<?php echo '</script'; ?>
>

	<style type="text/css">
		*{margin: 0;padding: 0;}
		#result{width: 100%;height: 500px;}
		.table{width: 100%;}
		tr{width: 100%;height: 50px;}

	</style>
</head>
<body>
	<h2>分页</h2>
	<div id="result"></div>
	<a href="" class="last">上一页</a>
	<a href="" class="next">下一页</a>
	<?php echo '<script'; ?>
 type="text/javascript">
	
		
	<?php echo '</script'; ?>
>
</body>
</html><?php }
}
