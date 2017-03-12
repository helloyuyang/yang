<?php 
namespace admin\controller;
use framework\core\Controller;
use framework\tools\HttpRequest;
class QuestionController extends Controller {

	// 展示添加采集管理页面
	public function addAction() {

		$this ->_smarty->display('Question/add.html');
	}

	// 实现采集，网页的标题和回复
	public function addHandleAction() {
			$url = $_POST['url'];
		//echo $url;
		//开始使用curl这个工具，请求url中的资源
		$http = new HttpRequest();
		$result = $http -> send($url);
		
		if($result['status']){
			//采集成功,然后从中筛选出符合我们需要的内容
			$reg = '/<a[^>]+class="js-title-link">(.+?)<\/a>.+?
					<script[^>]+class="content">(.+?)<\/script>/su';
			preg_match_all($reg, $result['msg'],$match);
			
			//echo '<pre>';
			//var_dump($match[1]);
			//var_dump($match[2]);
			//先保存问题,将符合要求的数据保存到数据库
			foreach($match[1] as $k=>$v){
				//将问题的标题保存到问题表
				$data['question_title'] = $v;
				$data['cat_id'] = 1;
				$data['user_id'] = $_SESSION['user']['user_id'];
				$data['pub_time'] = time();
				//实例化模型对象
				$q_model = Factory::M('home\\model\\Question');
				$question_id = $q_model -> insert($data);
				
				if($question_id){
					//保证发布问题成功再来保存回复的内容
					//再将回复的内容和问题关联起来
					$answer_content = $match[2][$k];
					$d['question_id'] = $question_id;
					$d['user_id'] = $_SESSION['user']['user_id'];
					$d['reply_time'] = time();
					$d['answer_content'] = $answer_content;
					//命令回复表的模型对象保存到回复表
					$anser_model = Factory::M('Answer');
					$anser_model -> insert($d);					
				}			
			}
			$this -> jumpURL('保存成功','?m=home&c=index&a=index');
		}else{
			//采集失败
			echo $result['msg'];
		}
		
	}
}






 ?>