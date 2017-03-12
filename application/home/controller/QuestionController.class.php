<?php 
namespace home\controller;
use framework\core\Controller;
use framework\core\Factory;
use framework\tools\HttpRequest;
/**
 * 〈问题控制器〉
 * 〈功能详细描述〉
 * @author[作者]（必须）
 */
class QuestionController extends Controller {


	/**
	 * 〈展示添加问题页〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function addAction() {
		
			// 实例化模型对象
		$cate_model = Factory::M('admin\\model\\Category');
		// 分类模型获取数据库所有数据
		$cate_list = $cate_model->getAllCategory();
		//按树状结构展示数据
		$cate_tree = $cate_model->getTreeCate($cate_list);

		// 实例化话题模型
		// 因在首页也会用到话题模型，所以在前台新建一个
		$tp_model = Factory::M('Topic');
		// 获取话题名称数据
		$topics = $tp_model->getQuestionTp();

		// 分配变量
		$this->_smarty->assign('cat_list',$cate_tree);
		$this->_smarty->assign('topics',$topics);
		// 分配视图
		$this->_smarty->display('question/add.html');
	}


	/**
	 * 〈处理添加问题的数据〉
	 * 〈对数据的合法性进行验证，并插入到数据库中〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function addHandleAction() {
		
		  /* 拼接问题表的数据*/
        $data['question_title'] = $_POST['question_title'];
        $data['cat_id'] = $_POST['cat_id'];
        $data['question_desc'] = $_POST['question_desc'];
        $data['user_id'] = $_SESSION['user']['user_id'];
        $data['pub_time'] = time();
        
        /*  数据验证*/
        $question_model = Factory::M('QuestionModel');
        $res = $question_model ->checkData($data);
        
        if($res) {
            $question_id = $question_model ->insert($data);
            
            if(isset($_POST['topic_id'])) {
                /* 保存关系到问题和话题的关系表中 */
                $m_topic_question = Factory::M('TopicQuestionModel');
                
                foreach ($_POST['topic_id'] as $v) {
                    $dd['topic_id'] = $v;
                    $dd['question_id'] = $question_id;
                    
                    $m_topic_question ->insert($dd);
                }
            }
            
          if($question_id) {
          	// 生成静态文件
          	// 根据问题id查询问题相关的信息
          	$ques = $question_model ->getAnswerUser($question_id);
          	// 将数据分配到详情页面
          	// 计算总的回复数
			$answer_count = count($ques['answer'],2);

			// 分配变量
			$this ->_smarty->assign('question',$ques['question']);
			$this ->_smarty->assign('answers',$ques['answer']);
			$this ->_smarty->assign('answer_count',$answer_count);
			// 分配视图
			$detail_html = $this ->_smarty->fetch('question/detail.html');

          	// 将替换好的内容保存到静态文件中
          	$base_dir = STATIC_PATH;
          	// 按日期格式保存子目录，如果不存在，则创建
          	$sub_dir = date('Ymd').'/';
          	if(!file_exists($base_dir.$sub_dir)) {
          		@mkdir($base_dir.$sub_dir,0777,true);
          	}

          	//文件名字，让文件名字和当前的问题的序号有一定的联系
          	$filename = 'detail_'.$question_id.'.html';
          	$file = $base_dir.$sub_dir.$filename;
          	// 将内容写入到文件中
          	$res = file_put_contents($file, $detail_html);

          	// 判断是否写入成功
          	if($res) {
          		// 将静态文件保存到数据库中，只保存日期之后的路径
          		$fileds = array('static_url'=>$sub_dir.$filename);
          		
          		$where = array('question_id'=>$question_id);
          		$result = $question_model->update($fileds,$where);
          		
	          	// 保存成功，提示发布成功
	          	if($result) {

	              $this->jumpURL('发布成功',Factory::U('home/Index/index'));
	          	}
	          	
          	}
          	
          } else {
              $this->jumpURL('发布失败',Factory::U('home/Question/add'));
          }
        } else {
            /* 提示错误信息 */
            $this->jumpURL('发布失败，原因如下：'.$question_model->showErr(),Factory::U('home/Question/add'));
        }

	}

	// 展示问题页面详情
	public function detailAction() {

		$id = $_GET['id'];
		// 实例化问题模型
		$q_model = Factory::M('Question');
		// 调用方法获取问题、用户、回答数据
		$ques = $q_model -> getAnswerUser($id);

		// 计算总的回复数
		$answer_count = count($ques['answer'],2);

		// 分配变量
		$this ->_smarty->assign('question',$ques['question']);
		$this ->_smarty->assign('answers',$ques['answer']);
		$this ->_smarty->assign('answer_count',$answer_count);
		// 展示页面
		$this ->_smarty->display('question/detail.html');
	}

	// 处理问题详情页面回复的操作
	public function replyAction() {
		// http://localhost/1227/index.php
		// var_dump($_POST);die;
		// 收集回复表单提交的数据
		$data['answer_content'] = $_POST['answer_content'];	#内容
		$data['user_id'] = $_SESSION['user']['user_id'];				#谁提交的
		$data['question_id'] = $_POST['question_id'];		#提交的问题id
		$data['reply_time'] = time();						#提交的时间

		// 将回复的内容保存到回复表中
		$answer_model = Factory::M('Answer');
		$res = $answer_model ->insert($data);


		if($res) {
			// 生成新的详情页面,取出所有数据， getAnswerUser($id)
			// 调用方法获取问题、用户、回答数据
			$q_model = Factory::M('Question');	
			$ques = $q_model -> getAnswerUser($_POST['question_id']);

			// 计算总的回复数
			$answer_count = count($ques['answer'],2);

			// 分配变量
			$this ->_smarty->assign('question',$ques['question']);
			$this ->_smarty->assign('answers',$ques['answer']);
			$this ->_smarty->assign('answer_count',$answer_count);

			// 分配到模板中并返回，生成链接
			$detail_html = $this->_smarty ->fetch('question/detail.html');

			$file = STATIC_PATH.$ques['question']['static_url'];
			// 将链接写入到文件中
			$result = file_put_contents($file, $detail_html);
			if($result) {
				$this->jumpURL('回复成功','http://localhost/project/1224login/application/public/static/html/'.$ques['question']['static_url']);
			}
		} else {

			// 回复失败
			$this ->jumpURL('回复失败','?m=home&Question&a=detail&id='.$_POST['question_id']);
		}


	}

			// 跳转到搜索demo
		public function suggestAction() {
			$this->_smarty->display('question/search.html');
		}

		// 查询结果
		public function keywordAction() {
			$kvalue = $_POST['keyword'];

			$q_model = Factory::M('Question');
			$result = $q_model -> queryQues($kvalue);
			if($result){
				$data['status'] = 1;
				$data['data']  = $result;
			}else{
				$data['status'] = 0;
			}
			// 将数据json化
			echo json_encode($data);
		}
	


