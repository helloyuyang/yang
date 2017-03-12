<?php 
namespace admin\model;
use framework\core\Model;
/**
 * 〈话题模型类〉
 * 〈功能详细描述〉
 * @author[作者]（必须）
 */
class TopicModel extends Model {
	// 话题使用到的表
	public $_logic_table = 'topic';
	/**
	 * 〈获取话题模型所有数据〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function getAllTopic() {

		$sql = "SELECT * FROM `$this->_true_table`";

		$rows = $this->_dao->fetchAll($sql);

		return $rows;
	}
}



 ?>