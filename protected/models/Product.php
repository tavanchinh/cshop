<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $sku
 * @property double $price
 * @property integer $sale
 * @property string $create_date
 * @property string $modify_date
 * @property integer $create_by
 * @property integer $modify_by
 * @property integer $feature
 * @property string $sapo
 * @property string $description
 * @property integer $status
 * @property integer $stock
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sale, create_by, modify_by, feature, status, stock', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('title, image, sku', 'length', 'max'=>255),
			array('sapo', 'length', 'max'=>500),
			array('create_date, modify_date, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, image, sku, price, sale, create_date, modify_date, create_by, modify_by, feature, sapo, description, status, stock', 'safe', 'on'=>'search'),
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
			'title' => 'Tên',
			'image' => 'Ảnh',
			'sku' => 'Sku',
			'price' => 'Giá',
			'sale' => 'Sale',
			'create_date' => 'Ngày tạo',
			'modify_date' => 'Ngày cập nhật',
			'create_by' => 'Tạo bởi',
			'modify_by' => 'Cập nhật bởi',
			'feature' => 'Đặc biệt',
			'sapo' => 'Tóm tắt',
			'description' => 'Chi tiết',
			'status' => 'Trạng thái',
			'stock' => 'Tình trạng',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('sku',$this->sku,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('sale',$this->sale);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('modify_date',$this->modify_date,true);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('modify_by',$this->modify_by);
		$criteria->compare('feature',$this->feature);
		$criteria->compare('sapo',$this->sapo,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('stock',$this->stock);

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
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
