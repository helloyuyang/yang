<?php
/* Smarty version 3.1.29, created on 2017-01-14 22:36:40
  from "D:\wamp\Apache24\htdocs\Project\1229static\application\home\view\question\search.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_587a37784d07d1_77133389',
  'file_dependency' => 
  array (
    'dfea87ec156b0a0b03878b948cf2879b15dee692' => 
    array (
      0 => 'D:\\wamp\\Apache24\\htdocs\\Project\\1229static\\application\\home\\view\\question\\search.html',
      1 => 1484404599,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587a37784d07d1_77133389 ($_smarty_tpl) {
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
	<style type="text/css">
		*{margin: 0;padding: 0;}
		table{width: 500px;margin: 100px auto;}
		#kd{height: 35px;width: 380px;}
		#btn{height: 38px;width: 100px;}
	</style>
</head>
<body>
	<table>
	<tr>
		<td>
			<input type="text" id="kd">
			<input type="button" value="百度一下" id="btn">
		</td>
	</tr>
		
	</table>

	<?php echo '<script'; ?>
 type="text/javascript">
		// 获取元素
		var okd = document.getElementById('kd');
		var obtn = document.getElementById('btn');
		// 绑定焦点事件
		okd.onblur = function() {
			// 请求服务器，查询和关键字相关的数据
			// 获取输入框中的值
		
			$$.request({
				method:'post',
				url:'?m=home&c=Question&a=keyword',
				data:'keyword='+this.value,
				dataType:'json',
				callback:function(result){
					// 创建展示元素
					var oul = $('ul1');
					if(!oul) {
						var oul = document.createElement('ul');
						oul.id = 'ul1';
					}
					oul.style.position = 'absolute';
					// 先清空里面的内容
					oul.innerHTML = '';
					// 循环展示元素
					if(result.status) {
						// 说明查询到了结果
						var data = result.data;
						for(var i=0;i<data.length;i++) {
							var oli = document.createElement('li');
							oli.innerHTML = data[i].question_title;
							console.log(data[i].question_title)
							oli.style.listStyle = 'none';
							// 给每个li绑定绑定事件
							oli.onclick = function() {
								// 清空input中的内容
								okd.value = '';
								okd.value = oli.innerText; 
								okd.parentNode.removeChild(oul);
							}
							oli.onmouseover = function() {
								this.style.backgroundColor = '#ccc';
							}
							oli.onmouseout = function() {
								this.style.backgroundColor = '#fff';
							}
							// 确定位置
							oul.appendChild(oli);
						}
						
						okd.parentNode.appendChild(oul);
					}else{
						//没有相关的数据
						oul.innerHTML = '<li>没有相关数据</li>';
						okd.parentNode.appendChild(oul);
					}

				
				}
			});
		}

	<?php echo '</script'; ?>
>
</body>
</html><?php }
}
