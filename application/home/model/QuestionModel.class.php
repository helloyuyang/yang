<?php 
namespace home\model;
use framework\core\Model;
/**
 * 〈问题模型类〉
 * 〈功能详细描述〉
 * @author[作者]（必须）
 */
class QuestionModel extends Model {
	// 使用到的表
	public $_logic_table="question";

	/**
	 * 〈将数据添加进数据库〉
	 * 〈进行不为空验证，并添加到数据库〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[question_id:返回插入的主键]
	 */
	public function checkData($data) {

		  /* 问题标题不能为空 */
        if($data['question_title'] == '') {
            $this->_error[] = '问题标题不能为空';
            /* 问题补充不能为空 */
        } else if($data['question_desc'] == ''){
            $this->_error[] = '问题描述不能为空';
        }
        
        if(!empty($this->_error)) {
            return false;
        } else {
            return true;
        }
	} 

	/**
	 * 〈连表查询获取所有问题、分类、用户相关数据〉
	 * 〈功能详细描述〉
	 * @param [参数1]     [参数1说明]
	 * @param [参数2]     [参数2说明]
	 * @return[返回类型说明]
	 */
	public function showAllQues($limit='') {

		$sql = "SELECT q.*,c.cat_id,c.cat_name,u.username,u.user_id,u.user_pic 
				FROM ask_question as q,ask_category as c,ask_user as u 
				WHERE q.cat_id=c.cat_id and q.user_id=u.user_id $limit";

		// 执行语句
		return $this ->_dao ->fetchAll($sql);
	}

	// 获取所有问题，用户、回答数据
	public function getAnswerUser($id) {

		// 查询问题与用户表，分类表
		$sql = "SELECT u.username,u.user_pic,c.cat_name,q.question_id,q.question_title,q.pub_time,q.view_num,q.focus_num,q.static_url 
				FROM ask_user as u,ask_question as q,ask_category as c
				WHERE q.cat_id=c.cat_id and q.user_id=u.user_id and q.question_id=$id";
		$question = $this ->_dao->fetchRow($sql);

		// 查询问题，回答,用户表
		$sql = "SELECT u.username,a.answer_content,a.reply_time
				FROM ask_user as u,ask_question as q,ask_answer as a
				WHERE q.user_id=u.user_id and q.question_id=a.question_id and q.question_id=$id";

		$answer = $this->_dao->fetchAll($sql);
		return $arr = array(
			'question'=>$question,
			'answer'=>$answer,);
	}	


	// 查询搜索框中相似结果
	public function queryQues($kvalue) {
		$sql = "select question_title from ask_question where question_title like '%$kvalue%'";

		return $this->_dao->fetchAll($sql);

	}

	// 获取分页数据
	public function getTotalNums() {
		$sql = "select question_title from ask_question";
		return $this->_dao->fetchAll($sql);
	}

	public function getAllQuestions($page_start,$limit) {
		$sql = "select question_title from ask_question limit $page_start,$limit";
		return $this->_dao->fetchAll($sql);
	}
}




 ?>