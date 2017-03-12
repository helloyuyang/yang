<?php 
namespace home\model;
use framework\core\Model;
/**
 * 〈话题模型〉
 * 〈生产前台所需数据〉
 * @author[作者]（必须）
 */

class TopicModel extends Model {
	// 使用到的数据表
	public $_logic_table = 'topic';
	/**
	 * 〈获取添加问题时展示的话题名称列表〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function getQuestionTp() {

		// 只需所有名称数据即可
		$sql = "select topic_id,topic_title from `$this->_true_table`";

		return $this->_dao->fetchAll($sql);
	}
}




 ?>