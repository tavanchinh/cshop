<?php
 
/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property string $id
 * @property string $display_name
 * @property string $user_name
 * @property string $password
 * @property string $email
 * @property string $phone_number
 * @property integer $is_admin
 * @property string $address
 * @property integer $status
 * @property integer $gender
 * @property string $birthday
 * @property string $createdate
 */
class Member extends CActiveRecord
{
    public $old_password;
   public $new_password;
    
   // holds the password confirmation word
   public $repeat_password;
  
   //will hold the encrypted password for update actions.
   public $initialPassword;
    
   /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'member';
    }
 
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
         array('display_name, user_name','required','message' =>'{attribute} không được bỏ trống'),
         array('email','email','message' => 'Định dạng email không chính xác.'),
         array('old_password, new_password, repeat_password', 'required', 'on' => 'changePwd'),
         array('old_password', 'findPasswords', 'on' => 'changePwd'),
         array('repeat_password', 'compare', 'compareAttribute'=>'new_password', 'on'=>'changePwd','message' => 'Xác nhận mật khẩu không chính xác'),
         array('password, repeat_password', 'required', 'on'=>'insert'),
         array('password, repeat_password', 'length', 'min'=>6, 'max'=>40),
         array('password', 'compare', 'compareAttribute'=>'repeat_password','message' => 'Xác nhận mật khẩu không chính xác','on' => 'insert'),
            array('is_admin, status, gender', 'numerical', 'integerOnly'=>true),
            array('display_name, user_name, email', 'length', 'max'=>50),
            array('password', 'length', 'max'=>32),
            array('phone_number', 'length', 'max'=>20),
            array('address', 'length', 'max'=>150),
            array('birthday, createdate', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, display_name, user_name, password, email, phone_number, is_admin, address, status, gender, birthday, createdate', 'safe', 'on'=>'search'),
        );
    }
    
   //matching the old password with your existing password.
   public function findPasswords($attribute, $params)
   {
     $member = Member::model()->findByPk(Yii::app()->session['admin_id']);
     //CVarDumper::dump($member->initialPassword,10,true);die();
     if ($member->initialPassword != md5($this->old_password))
         $this->addError($attribute, 'Mật khẩu cũ không chính xác.');
   }
    
   public function beforeSave(){
      // in this case, we will use the old hashed password.
      if(empty($this->password) && empty($this->repeat_password) && !empty($this->initialPassword))
         $this->password=$this->repeat_password=$this->initialPassword;
       
      return parent::beforeSave();
   }
    
   public function afterFind(){
      //reset the password to null because we don't want the hash to be shown.
      $this->initialPassword = $this->password;
      $this->password = null;
       
      parent::afterFind();
   }
    
   public function saveModel($data=array()){
      //because the hashes needs to match
      if(!empty($data['password']) && !empty($data['repeat_password']))
      {
          $data['password'] = md5($data['password']);
          $data['repeat_password'] = md5($data['repeat_password']);
          //if($data)
      }
      $this->attributes=$data;     
       
      if($this->validate()){
         if($this->save()){
            return true;
         }
      }else{
         false;
      }
   }
     
 
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }
 
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
         'id' => 'ID',
         'display_name' => 'Tên hiển thị',
         'user_name' => 'Tên đăng nhập',
         'password' => 'Mật khẩu',
         'old_password' => 'Mật khẩu cũ',
         'new_password' => 'Mật khẩu mới',
         'repeat_password' => 'Xác nhận mật khẩu',
         'email' => 'Email',
         'phone_number' => 'Số điện thoại',
         'is_admin' => 'Tài khoản admin',
         'address' => 'Địa chỉ',
         'status' => 'Kích hoạt',
         'gender' => 'Giới tính',
         'birthday' => 'Ngày sinh',
         'createdate' => 'Ngày tạo',
        );
    }
 
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.
 
        $criteria=new CDbCriteria;
 
        $criteria->compare('id',$this->id,true);
        $criteria->compare('display_name',$this->display_name,true);
        $criteria->compare('user_name',$this->user_name,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('phone_number',$this->phone_number,true);
        $criteria->compare('is_admin',$this->is_admin);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('gender',$this->gender);
        $criteria->compare('birthday',$this->birthday,true);
        $criteria->compare('createdate',$this->createdate,true);
		$criteria->addCondition('status=1');
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
               'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
            
        ));
    }
 
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Member the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
   
}