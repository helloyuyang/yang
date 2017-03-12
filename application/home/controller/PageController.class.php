<?php 
namespace home\controller;
use framework\core\Controller;
use framework\core\Factory;
use framework\tools\HttpRequest;
class PageController extends Controller {
	public function dispageAction() {
			$this->_smarty->display('Question/page.html');
		}
		// 展示分页
		public function getpageAction() {

			//当前是第几页
			$page = isset($_GET['page'])?$_GET['page']:1;
			// 将首页分页数据展示
			//查询问题列表
			$model = Factory::M('QuestionModel');
			//对问题列表进行分页显示，所以分页的代码写到这里
			//查询总的记录数（在模型中定义一个方法返回总的记录数）
			$total_nums = $model -> getTotalNums();
			$total_num = count($total_nums);
			
			//确定每页显示多少条记录
			$page_size= 4;
			//点击分页导航时跳转到哪里去
			$page_url = Factory::U('home/Questioin/getpage');
			

			$max = ceil($total_num/$page_size);
			//分页导航条
			$page_start = ($page - 1)*$page_size;
			$limit = $page_size;		
			
			$questions = $model -> getAllQuestions($page_start,$limit);

			if($questions) {
				$data['status'] = 1;
				$data['data'] = $questions;
			} else {
				$data['status'] = 0;
			}
		echo json_encode($data);

	//循环显示列表
		// while ($questions as $v) {
		// 	echo "<tr>";
	 //    	echo "<td>".$v['question_title']."</td>";
	 //    	echo "<tr>";
		// }
		// 	echo '<a href="javascript:shoPage({$page_url}&page=1)">首页</a>';
		// 	echo '<a href="javascript:shoPage({$page_url}&page={$page-1})">上一页</a>';
		// 	echo '<a href="javascript:shoPage({$page_url}&page={$page+1})">下一页</a>';
		// 	echo '<a href="javascript:shoPage({$page_url}&page={$max})">末页</a>';
		// 	echo "</table>";
				
		 	}
}
 ?>