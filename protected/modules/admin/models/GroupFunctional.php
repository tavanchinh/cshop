<?php

/**
 * This is the model class for table "group_functional".
 *
 * The followings are the available columns in table 'group_functional':
 * @property integer $id
 * @property integer $group_id
 * @property integer $functional_id
 */
class GroupFunctional extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'group_functional';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, functional_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_id, functional_id', 'safe', 'on'=>'search'),
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
			'group_id' => 'Group',
			'functional_id' => 'Functional',
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
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('functional_id',$this->functional_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GroupFunctional the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    /**
     * Add to table group_functional
    */
    public function QuickAdd($group_id,$list_cate,$unique = false){
        $execute = false;
        
        if(count($list_cate) > 0){
            // Kiểm tra trùng lặp
            if($unique){
                $delete_not_id = '-1';
                $sql = "INSERT IGNORE INTO group_functional(group_id,functional_id) VALUES";
                foreach($list_cate as $value){
                    if($value > 0){
                        $sql .= "($group_id,$value),";
                        $execute = true;
                        $delete_not_id .= ','.$value;
                    }
                }
                if($execute){
                    $sql = substr($sql,0,-1);
                    Yii::app()->db->createCommand($sql)->execute();
                    $sql_delete = "DELETE FROM group_functional WHERE group_id=$group_id AND functional_id NOT IN ($delete_not_id)";
                    Yii::app()->db->createCommand($sql_delete)->execute();
                }
            }else{
                $sql = "INSERT INTO group_functional(group_id,functional_id) VALUES";
                foreach($list_cate as $value){
                    if($value > 0){
                        $sql .= "($group_id,$value),";
                        $execute = true;
                    }
                }
                if($execute){
                    $sql = substr($sql,0,-1);
                    Yii::app()->db->createCommand($sql)->execute();
                }
            }
        }
    }
}
