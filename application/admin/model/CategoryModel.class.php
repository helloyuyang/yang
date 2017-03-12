<?php 
namespace admin\model;
use framework\core\Model;
/**
 * 〈分类管理模型类〉
 * 〈获取数据库所有数据，〉
 * @author[作者]（必须）
 */
class CategoryModel extends Model {
	
	// 分类模型使用到的数据表
	public $_logic_table = 'category';
	/**
	 * 〈获取数据库所有数据〉
	 * 〈功能详细描述〉
	 * @param [$where]     [分页显示的条件：limit 起始页数，每页展示多少]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function getAllCategory() {

		$sql = "SELECT * FROM `$this->_true_table`";
		
		$cate_list = $this->_dao ->fetchAll($sql);

		return $cate_list;
	}

	/**
	 * 〈分页获取数据〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function getPageCate($limit) {
		$sql = "SELECT * FROM `$this->_true_table` $limit";
		
		$cate_list = $this->_dao ->fetchAll($sql);

		return $cate_list;
	}

	/**
	 * 〈产生数状结构〉
	 * 〈功能详细描述〉
	 * @param [$cate_list]     [数据库中所有数据]
	 * @param [$p_id]     [当前标题的cat_id]
	 * @param [$level]     [当前标题的等级]
	 * @return[array:分好组的数组]
	 */
	public function getTreeCate($cate_list,$p_id=0,$level=0) {
		//保存分组好的数据
		static $arr = array();
		foreach($cate_list as $v) {
			//如果当前标题的父类属于$p_id
			if($v['parent_id'] == $p_id) {
				// 当前标题的等级
				$v['level'] = $level;
				// 储存进数组
				$arr[] = $v;

				//继续执行
		$this->getTreeCate($cate_list,$v['cat_id'],$level+1);
			}

		}
		return $arr;
	}

	/**
	 * 〈验证cat_id在数据库是否还存在相同的parent_id〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function checkSubID($id) {

		$sql = "select 1 from `$this->_true_table` where parent_id=$id";

		$res = $this->_dao->fetchRow($sql);

		//判断结果
		//返回1，代表有子类，不能删除
		//返回0，代表没有子类，可以执行删除操作
		if($res) {
			$this->_error[] = '该标题下面还有子标题，暂时不能删除';
			return false;
		} else {
			//执行删除操作
			$res = $this->delete($id);
			return $res;
		}
	}

	/**
	 * 〈校验插入的数据〉
	 * 〈对添加的数据进行不能与其他标题和父类同时重复，且不能为空〉
	 * @param [$data]     [包含除路径外的全部数据]
	 * @return[true/false:通过返回true,校验不通过返回false]
	 */
	public function isExists($data) {

			// 判断是否为空
		if($data['cat_name'] == '') {
			$this->_error[] = '标题不能为空！';
			return false;
		}
		$cat_name = $data['cat_name'];
		$parent_id = $data['parent_id'];
		//sql语句判断是否存在标题和父类相同的值
		// 本身要更新的除外
		$sql = "select 1 from `$this->_true_table` where cat_name='$cat_name' and parent_id=$parent_id";

		$res = $this->_dao->fetchColumn($sql);
		if($res) {
			// 有相同的数据
			$this->_error[] = '标题重复啦！';
			return false;
		} else {
			return true;
		}
	}

	/**
	 * 〈校验更新的数据〉
	 * 〈对更新的数据进行不能与其他标题和父类同时重复，且不能为空〉
	 * @param [$data]     [包含除路径外的全部数据]
	 * @return[true/false:通过返回true,校验不通过返回false]
	 */
	public function checkUpdate($data) {
		// 判断是否为空
		if($data['cat_name'] == '') {
			$this->_error[] = '标题不能为空！';
			return false;
		}
		$cat_name = $data['cat_name'];
		$parent_id = $data['parent_id'];
		$cat_id = $data['cat_id'];
		//sql语句判断是否存在标题和父类相同的值
		// 本身要更新的除外
		$sql = "SELECT 1 FROM `$this->_true_table` WHERE cat_name='$cat_name' and parent_id=$parent_id and cat_id<>$cat_id";
		
		$res = $this->_dao->fetchColumn($sql);
		
		if($res != 0) {
			// 代表有相同的值
			$this->_error[]	='已经存在相同的标题，请重试';
			return false;
		} else {
			return true;
		}

	}

	/**
	 * 〈前台获取分类名称,图标数据〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function getCatename() {

		$sql = "select cat_name,cat_logo from `$this->_true_table`";

		return $this->_dao->fetchAll($sql);
	}

}








 ?>