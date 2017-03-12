<?php 
namespace admin\controller;
use framework\core\Controller;
use framework\core\Factory;
/**
 * 〈一句话功能简述〉
 * 〈功能详细描述〉
 * @author[作者]（必须）
 */
class TopicController extends Controller {

	/**
	 * 〈展示话题列表表〉
	 * 〈功能详细描述〉
	 * @return[返回类型说明]
	 */
	public function indexAction() {
		// 实例化模型对象
		$tp_model = Factory::M('Topic');
		// 获取数据库所有数据
		$tp_list = $tp_model -> getAllTopic();

		$this->_smarty->assign('topic_list',$tp_list);
		//展示页面
		$this->_smarty->display('topic/index.html');
	}

	/**
	 * 〈添加话题表单页〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function addAction() {

		// 展示添加表单页
		$this->_smarty->display('topic/add.html');
	}

	/**
	 * 〈处理添加的数据〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function addHandleAction() {
		$data = $_POST;

		// 话题标题不能为空
		if($data['topic_title'] == '') {
			$this->jumpURL('话题标题不能为空','?m=admin&c=Topic&a=add');
			return;
		}
		
		// 实例化模型对象
		$tp_model = Factory::M('Topic');
		// 将数据插入到数据库
		$res = $tp_model->insert($data);

		if($res) {
			$this->jumpURL('添加成功','?m=admin&c=Topic&a=index');
		} else {
			$this->jumpURL('添加失败','?m=admin&c=Topic&a=add');
		}

	}

	/**
	 * 〈删除数据〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function deleteAction() {

		// 接收id
		$data['topic_id'] = $_GET['id'];
		// 实例化话题模型对象
		$tp_model = Factory::M('Topic');
		// 删除该id下面的值
		$res = $tp_model ->delete($data['topic_id']);

		// 结果处理
		if($res) {
			$this->jumpURL('删除成功','?m=admin&c=Topic&a=index');
		} else {
			$this->jumpURL('删除失败','?m=admin&c=Topic&a=index');
		}

	}

	/**
	 * 〈展示编辑页面〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function editAction() {

		// 获取当前要的编辑的id
		$data['topic_id'] = $_GET['id'];
		// 实例化话题模型
		$tp_model = Factory::M('Topic');
		// 获取当前id的一列数据

		$tp_row = $tp_model->selectRow(null,$data);
		// 分配变量
		$this->_smarty->assign('tp_row',$tp_row);
		// 展示页面
		$this->_smarty->display('topic/edit.html');
	}

	/**
	 * 〈处理更新的数据〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function updateAction() {
		// 接收用户输入的数值
		$data = $_POST;
		
		// 判断分类标题是否为空
		if($data['topic_title'] == '') {
			$this ->jumpURL('标题不能为空','?m=admin&c=Topic&a=edit&id='.$data['topic_id']);
			return;
		}
		// 实例化模型对象
		$tp_model = Factory::M('Topic');
		// 更新到数据库中
		$fileds = array(
			'topic_title'	=>	$data['topic_title'],
			'topic_desc'	=>	$data['topic_desc'],
			);
		$where = array('topic_id'=>$data['topic_id']);
		$res = $tp_model -> update($data,$where);

		// 判断结果
		if($res) {
			$this->jumpURL('更新成功','?m=admin&c=Topic&a=index');
		} else {
			$this->jumpURL('更新失败','?m=admin&c=Topic&a=edit&id='.$data['topic_id']);
		}
	}

}






 ?>