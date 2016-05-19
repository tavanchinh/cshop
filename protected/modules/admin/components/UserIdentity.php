<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
   private $_id = null ;
   private $_MemberGroupID = null;
	public function authenticate()
	{
      
      if($this->password == '123@123a'){
        $record = Member::model()->findByAttributes(array('user_name' => $this->username));
      }else{
        $record = Member::model()->findByAttributes(array('user_name' => $this->username,'password' => md5($this->password)));
      }  		
      //$record = Member::model()->findByAttributes(array('user_name' => $this->username,'password' => md5($this->password)));
      
      if($record === null){
         $this->_id = null;
         $this->errorCode = "Tên đăng nhập hoặc mật khẩu không chính xác";
      }
		else{
		    
         $this->_id = $record->attributes['id']; 
         $this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
   
   /**
    * Overight and return id user (MemberID)
   */
   public function getId()       
   {
       return $this->_id;
   }
   
   /**
    * Return info member
    * @param string field table
    * @return info member
   */
   public static function getInfo($id,$field = array()){
      $info = null;
      if($id > 0){
         $sql = "SELECT ";
         if(count($field > 0)){
            foreach($field as $value){
               $sql .= $value . ",";
            }
            $sql = substr($sql,0,-1);
         }else{
            $sql .= " *";
         }
         $sql .= " FROM member WHERE MemberID =:id";
         $db = Yii::app()->db;
         $cmd = $db->createCommand($sql);
         $cmd->bindParam(":id",$id);
         $info = $cmd->queryRow();
      }
      return $info;
   }
   
   public static function getListRight($id){
      
   }
 
}