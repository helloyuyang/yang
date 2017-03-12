<?php 
namespace home\controller;
use framework\core\Controller;
use framework\core\Factory;
use framework\tools\Page;
/**
 * 〈首页控制器〉
 * 〈功能详细描述〉
 * @author[作者]（必须）
 */
class IndexController extends Controller {

	/**
	 * 〈展示首页数据〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function indexAction() {
		
		// 验证防跳墙
		$this -> isLogin();

		// 获取顶部分类数据
		$cate_model = Factory::M('admin\\model\\Category');
		$cat_list = $cate_model->getCatename();

		// 获取底部问题数据
		// 实例化问题模型
		$q_model = Factory::M('Question');
		// 通过问题模型调用连表查询方法,返回二维数组
		$res = $q_model -> showAllQues();

		/************** 分页展示 *********************/
		// 实例化分页模型对象
		$page = new Page();
		// 设置每页显示几条记录
		$page->_page_size = 3;
		// 设置点击时跳转的URL地址
		$page->_url = '/project/1229static/home/Index/index';
		// 总的结果数
		$page->_total = count($res,2);
		// 接收每页的数据
		$page->_page_now = isset($_GET['page']) ? $_GET['page'] : 1;

		//每页展示数据公式
		$page_num = ($page->_page_now-1)*$page->_page_size;
		
		// 分页展示获取数据
		$limit = "limit $page_num,$page->_page_size";
		$res = $q_model ->showAllQues($limit);
		// 制作分页
		$cate_page = $page->create();


		// 分配问题变量
		$this->_smarty ->assign('all_question',$res);		
		// 分配分类变量
		$this->_smarty->assign('cat_list',$cat_list);
		// 分配分页变量
		$this ->_smarty ->assign('cate_page',$cate_page);

		// 展示模板页
		$this->_smarty->display('index.html');
	}
}



 ?>