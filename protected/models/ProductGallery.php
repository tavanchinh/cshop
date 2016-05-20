<?php

/**
 * This is the model class for table "product_gallery".
 *
 * The followings are the available columns in table 'product_gallery':
 * @property integer $id
 * @property integer $product_id
 * @property string $image
 */
class ProductGallery extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_gallery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, image', 'safe', 'on'=>'search'),
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
			'product_id' => 'Product',
			'image' => 'Image',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('image',$this->image,true);

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
	 * @return ProductGallery the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    
    /**
     * Add to table product_category
    */
    public function QuickAdd($product_id,$list_image,$unique = false){
        $execute = false;
        
        if(count($list_image) > 0){
            // Kiểm tra trùng lặp
            if($unique){
                $delete_not_id = '-1';
                $sql = "INSERT IGNORE INTO product_gallery(product_id,image) VALUES";
                foreach($list_image as $value){
                    if($value != ''){
                        $sql .= "($product_id,'$value'),";
                        $execute = true;
                        $delete_not_id .= ",'".$value."'";
                    }
                }
                if($execute){
                    $sql = substr($sql,0,-1);;
                    Yii::app()->db->createCommand($sql)->execute();
                    $sql_delete = "DELETE FROM product_gallery WHERE product_id=$product_id AND image NOT IN ($delete_not_id)";
                    Yii::app()->db->createCommand($sql_delete)->execute();
                }
            }else{
                $sql = "INSERT INTO product_gallery(product_id,image) VALUES";
                foreach($list_image as $value){
                    if($value != ''){
                        $sql .= "($product_id,'$value'),";
                        $execute = true;
                    }
                }
                if($execute){
                    $sql = substr($sql,0,-1);;
                    
                    Yii::app()->db->createCommand($sql)->execute();
                }
            }
        }
    }
}
