<?php 
namespace admin\controller;
use framework\core\Factory;
use framework\core\Controller;
use framework\tools\Page;
use framework\tools\Upload;
use framework\tools\Thumb;
/**
 * 〈分类管理控制器类〉
 * 〈功能详细描述〉
 * @author[作者]
 */
class CategoryController extends Controller {

	/**
	 * 〈展示后台分类管理列表页〉
	 * 〈获取数据库所有数据，并展示到分类管理页〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function indexAction() {
		// 实例化分类模型

		$cate_model = Factory::M('Category');
		// 分类模型获取数据库所有数据
		$cate_list = $cate_model->getAllCategory();

		/************** 分页展示 *********************/
		// 实例化分页模型对象
		$page = new Page();
		// 设置每页显示几条记录
		$page->_page_size = 5;
		// 设置点击时跳转的URL地址
		$page->_url = '?m=admin&c=Category&a=index';
		// 总的结果数
		$page->_total = count($cate_list,2);
		// 接收每页的数据
		$page->_page_now = isset($_GET['page']) ? $_GET['page'] : 1;

		//每页展示数据公式
		$page_num = ($page->_page_now-1)*$page->_page_size;
		
		// 分页展示获取数据
		$limit = "limit $page_num,$page->_page_size";
		$cate_list = $cate_model ->getPageCate($limit);
		// 制作分页
		$cate_page = $page->create();


		// 展示页面
		$this->_smarty->assign('cate_page',$cate_page);
		$this->_smarty->assign('cate_list',$cate_list);
		$this->_smarty->display('category/index.html');

	} 

	/**
	 * 〈展示添加页面〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function addAction() {
		// 实例化模型对象
		$cate_model = Factory::M('Category');
		// 分类模型获取数据库所有数据
		$cate_list = $cate_model->getAllCategory();
		//按树状结构展示数据
		$cate_tree = $cate_model->getTreeCate($cate_list);
		
		//分配变量，展示数据
		$this->_smarty->assign('cate_tree',$cate_tree);
		$this->_smarty->display('category/add.html');
	}

	/**
	 * 〈处理添加的数据〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function addHandleAction() {

		$data['cat_name'] = $_POST['cat_name'];
		$data['parent_id'] = $_POST['parent_id'];
		/********** 先判断数据是否合法*********/
		//实例化模型对象
		$cate_model = Factory::M('Category');
		//对数据进行重复，为空验证
		$res = $cate_model ->isExists($data);
		if(!$res) {
			$this->jumpURL('添加失败，失败原因'.$cate_model->showErr(),'?m=admin&c=Category&a=add');
			return;
		}

		//实例化上传对象
		//设置上传目录
		//上传文件
		$upload = new Upload();
		$upload->setUploadPath(UPLOAD_PATH.'category/');
		$filename = $upload->doUpload($_FILES['cat_logo']);

		//实例化压缩对象，设置压缩目录，压缩文件
		$thumb = new Thumb($filename);
		$thumb -> setThumbPath(THUMB_PATH.'category/');
		$thumb_path = $thumb -> makeThumb(50,50);

		//上传文件路径
		$data['cat_logo'] = $thumb_path;

		//调用自动插入方法
		$res = $cate_model -> insert($data);
		//错误/正确处理
		if($res) {
			$this->jumpURL('添加成功','?m=admin&c=Category&a=index');
		} else {
			$this->jumpURL('添加失败','?m=admin&c=Category&a=add');
		}

	}

	/**
	 * 〈删除操作〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function deleteAction() {
		
		$data['cat_id'] = $_GET['id'];
		// 实例化模型对象
		$cate_model = Factory::M('Category');
		// 判断其还有没有子分类，并执行删除操作
		$res = $cate_model ->checkSubID($data['cat_id']);
		// 判断删除成功还是失败
		if($res) {
			$this->jumpURL('删除成功','?m=admin&c=Category&a=index');
		} else {
			$this->jumpURL('删除失败,失败原因如下:<br>'.$cate_model->showErr(),'?m=admin&c=Category&a=index');
		}

	}

	/**
	 * 〈展示编辑页面〉
	 * 〈将要编辑的内容展示到页面中〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function editAction() {

		//获取要编辑的id值
		$data['cat_id'] = $_GET['id'];
		// 实例化模型对象
		$cate_model = Factory::M('Category');

		// 获取这个id的所有数据
		//自动获取一条记录
		$fileds = null;
		$where = array('cat_id'=>$data['cat_id']);
		$row = $cate_model ->selectRow($fileds,$where);
		// 获取树状标题
		$cate_list = $cate_model->getAllCategory();
		$cate_tree = $cate_model->getTreeCate($cate_list);

		// 分配变量，并展示到页面中
		$this->_smarty->assign('row',$row);
		$this->_smarty->assign('cate_tree',$cate_tree);

		$this->_smarty->display('category/edit.html');
	}


	/**
	 * 〈处理更新的数据〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function updateAction() {
		
		// 接收用户输入的数据		
		$data['cat_name'] = $_POST['cat_name'];
		$data['parent_id'] = $_POST['parent_id'];
		$data['cat_id'] = $_POST['cat_id'];
		// 对有没有上传图片进行验证
		if($_FILES['cat_logo']['error'] == 0) {	#代表有上传图片
			// 有上传，则上传，压缩，删除原图片，更新路径
			$upload = new Upload();
			$upload->setUploadPath(UPLOAD_PATH.'category/');
			$filename = $upload->doUpload($_FILES['cat_logo']);

			//实例化压缩对象，设置压缩目录，压缩文件
			$thumb = new Thumb($filename);
			$thumb -> setThumbPath(THUMB_PATH.'category/');
			$thumb_path = $thumb -> makeThumb(50,50);
			
			// 删除原图
			@unlink(THUMB_PATH.'category/'.$_POST['old_cat_logo']);
			$origin = str_replace('thumb_', '',$_POST['old_cat_logo']);
			@unlink(UPLOAD_PATH.'category/'.$origin);

			// 更新图片路径
			$data['cat_logo'] = $thumb_path;
			
		}

		// 实例化模型对象，对用户输入的数据进行验证
		$cate_model = Factory::M('Category');

		// 对更新的值是不是已有的数据做验证
		$res = $cate_model ->checkUpdate($data);

		if(!$res) {
			$this->jumpURL('更新失败，失败原因：'.$cate_model->showErr(),'?m=admin&c=Category&a=edit&id='.$_POST['cat_id']);
			return;
		}


		// 没有上传，则直接将数据插入到数据库
		
		$where = array('cat_id' =>$_POST['cat_id']);
		
		$result = $cate_model -> update($data,$where);

		if($result != false ) {
			$this->jumpURL('更新成功','?m=admin&c=Category&a=index');
		} else {
			$this->jumpURL('更新失败','?m=admin&c=Category&a=edit&id='.$data['cat_id']);
		}

	}




}









 ?>