<?php

/**
 * This is the model class for table "functional".
 *
 * The followings are the available columns in table 'functional':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $controller_id
 * @property string $action_id
 * @property integer $parent_id
 */
class Functional extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'functional';
	}
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id', 'numerical', 'integerOnly'=>true),
            array('name, url', 'length', 'max'=>255),
            array('controller_id, action_id', 'length', 'max'=>50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, url, controller_id, action_id, parent_id', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'url' => 'Url',
			'controller_id' => 'Controller',
			'action_id' => 'Action',
            'parent_id' => 'Parent'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('controller_id',$this->controller_id,true);
		$criteria->compare('action_id',$this->action_id,true);
        $criteria->compare('parent_id',$this->parent_id);

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
	 * @return Functional the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
   
   public function getListUserByFunctional($controller_id,$action_id){
      $list = array();
      $sql = "SELECT user_name FROM member INNER JOIN member_group ON member.id = member_group.member_id WHERE group_id IN (
            	SELECT group_id FROM group_functional WHERE functional_id IN(
            		SELECT id FROM functional WHERE controller_id = '$controller_id' and action_id = '$action_id'
            	)
            )";
      $db = Yii::app()->db;
      $cmd = $db->createCommand($sql);
      $result = $cmd->queryAll();
      if(count($result) > 0){
         foreach($result as $value){
            $list[] = $value['user_name'];
         }
      }
      return $list;
   }
   
   public function getListActionByController($controller_id){
      $list = array();
      $result = $this->findAllByAttributes(array(
         'controller_id' => $controller_id
      ));
      if(count($result) > 0){
         foreach($result as $value){
            $list[] = $value->action_id;
         }
      }
      return $list;
   }
   
   public function getPermmision($controller_id){
      $list = array(
         array('allow',
            'users'=>array('admin','nampv','trungnd'),
         )
      );
      $list_actions = $this->getListActionByController($controller_id);
      if(count($list_actions) > 0){
         foreach($list_actions as $value){
            $list_users = $this->getListUserByFunctional($controller_id,$value);
            if(count($list_users) > 0){
                $allow = array('allow',
       				'actions'=>array($value),
       				'users'=>$list_users,
  			    );
                $list[] = $allow;
            }
            
         }
      }
      $list[] = array(
         'deny',
         'users' => array('*'),
      );
      //CVarDumper::dump($list,10,true);die();
      return $list;
      
   }
   
    /**
     * Get all category
     */
    public function getAll()
    {
        $return = array();
        $object = $this->findAll();
        if (count($object) > 0) {
            foreach ($object as $item) {
                $return[$item['id']] = $item->attributes;
            }
        }
        return $return;
    }
    /**
     * Lay danh sach cat dang cay. Su dung de quy
     */
    public function getTree($all_cate, $parent_id = 0, $trees = array(0 =>'Không chọn'), $delimiter = '')
    {
        if (!$trees) {
            $trees = array();
        }
        foreach ($all_cate as $key => $value) {
            if ($value['parent_id'] == $parent_id) {
                $trees[$value['id']] = $delimiter . $value['name'];
                $trees = $this->getTree($all_cate, $value['id'], $trees, $delimiter . '--');
            }

        }
        return $trees;
    }
    
    
    public function getMultilevel(){
        $sql = "SELECT * FROM functional";
        $data = array();
        $list_cate = $this->getAll();
        $tmp = array();
        foreach($list_cate as $key=>$value){            
            if($value['parent_id'] == 0){
                $data[$key] = $value;
            }else{
                $tmp[$value['parent_id']][$value['id']] = $value;
                $data[$value['parent_id']]['sub'] = $tmp[$value['parent_id']];
            }
        }
        return $data;
    }
    
    public function getListParent(){
        return CHtml::listData(Functional::model()->findAllByAttributes(array('parent_id' => 0)),'id','name');
    }
}
