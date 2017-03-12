<?php 
namespace home\model;
use framework\core\Model;
class MessageModel extends Model {

	public $_logic_table = 'message';

	public function checkMessage($phoneNum,$msm_code)
	{
		$sql = "SELECT * FROM $this->_true_table WHERE phone_num='$phoneNum' and message_code='$msm_code'";
		return $this -> _dao -> fetchRow($sql);
	}
}





 ?>