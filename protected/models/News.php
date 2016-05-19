<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $title
 * @property string $avatar
 * @property integer $cat_id
 * @property string $sapo
 * @property string $content
 * @property string $create_date
 * @property string $publish_date
 * @property string $modify_date
 * @property integer $status
 * @property integer $create_by
 * @property string $last_update_by
 */
class News extends CActiveRecord
{
	
    public $list_status = array('Chờ duyệt','Xuất bản','Từ chối');
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, avatar, content', 'required'),
			array('cat_id, status, create_by', 'numerical', 'integerOnly'=>true),
			array('title, avatar', 'length', 'max'=>255),
			array('sapo, create_date, publish_date, modify_date, last_update_by', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, avatar, cat_id, sapo, content, create_date, publish_date, modify_date, status, create_by, last_update_by', 'safe', 'on'=>'search'),
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
            
            'categories' => array(
                self::MANY_MANY,
                'Category',
                'news_category(news_id, cat_id)'),
            );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Tiêu đề',
			'avatar' => 'Ảnh',
			'cat_id' => 'Chuyên mục',
			'sapo' => 'Tóm tắt',
			'content' => 'Nội dung',
			'create_date' => 'Ngày tạo',
			'publish_date' => 'Ngày xuất bản',
			'modify_date' => 'Ngày cập nhật',
			'status' => 'Trạng thái',
			'create_by' => 'Tạo bởi',
			'last_update_by' => 'Cập nhật bởi',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('sapo',$this->sapo,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('publish_date',$this->publish_date,true);
		$criteria->compare('modify_date',$this->modify_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('last_update_by',$this->last_update_by,true);

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
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
