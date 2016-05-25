<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property string $full_name
 * @property string $phone_number
 * @property string $address
 * @property string $email
 * @property integer $user_id
 * @property integer $status
 * @property string $note
 * @property string $create_date
 */
class Orders extends CActiveRecord
{
	public $purchased;
    public $amount;
    public $list_status = array('Mới','Đang xử lý','Hoàn tất','Hủy');
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_name, phone_number, address', 'required'),
			array('user_id, status', 'numerical', 'integerOnly'=>true),
			array('full_name, address, email', 'length', 'max'=>255),
			array('phone_number', 'length', 'max'=>11),
			array('note, purchased, create_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, full_name, phone_number, address, email, user_id, status, note, create_date, purchased', 'safe', 'on'=>'search'),
		);
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
			'full_name' => 'Tên khách hàng',
			'phone_number' => 'Số điện thoại',
			'address' => 'Địa chỉ',
			'email' => 'Email',
			'user_id' => 'User',
			'status' => 'Trạng thái',
			'note' => 'Note',
            'create_date' => 'Ngày',
            'purchased' => 'Đặt mua',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('note',$this->note,true);
        $criteria->compare('create_date',$this->create_date,true);
        $criteria->compare('purchased',$this->purchased,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'id DESC',
            ),  
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    /**
     * Dem bai theo status
    */
    public function countGroupStatus(){
        $list = array(
            4 => array('text' => 'Tất cả','mode' => 'all','count' => 0),
            0 => array('text' => 'Mới','mode' => 'new','count' => 0),
            1 => array('text' => 'Đang xử lý','mode' => 'processing','count' => 0),
            2 => array('text' => 'Hoàn tất','mode' => 'complete','count' => 0),
            3 => array('text' => 'Hủy','mode' => 'cancel','count' => 0),
            
        );
        $sql = "SELECT count(1) total, status FROM orders GROUP BY status";
        $response = Yii::app()->db->createCommand($sql)->queryAll();
        $total = 0;
        if(count($response) > 0){
            foreach($response as $value){
                $list[$value['status']]['count'] = $value['total'];
                $total+= $value['total'];
            }
            $list[4]['count'] = $total;
        }
        return $list;
    }
    
    public function getListProduct($orders_id){
        $sql = "SELECT a.*,b.qty FROM product a INNER JOIN orders_product b ON a.id = b.product_id WHERE b.orders_id =".$orders_id;
        $list = Yii::app()->db->createCommand($sql)->queryAll();
        return $list;
    }
}
