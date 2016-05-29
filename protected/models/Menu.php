<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $slug
 * @property integer $type
 * @property integer $position
 */
class Menu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, type, position', 'numerical', 'integerOnly'=>true),
			array('title, slug', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, title, slug, type, position', 'safe', 'on'=>'search'),
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
			'parent_id' => 'Parent',
			'title' => 'Title',
			'slug' => 'Slug',
			'type' => '0 - Trang chủ |  1 Page | 2 - Cate',
			'position' => 'Position',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('position',$this->position);

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
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    /**
     * Tra ve danh sach page bao gom id va name
    */
    public function getListSimple(){
        $list = array();
        $sql = "SELECT id, title FROM page ORDER BY id DESC";
        $response = Yii::app()->db->createCommand($sql)->queryAll();
        if(count($response) > 0){
            foreach($response as $value){
                $list[$value['id']] = $value['name'];
            }
        }
        return $list;
    }
    
    /**
     * Get all category
     */
    public function getAll()
    {
        $return = array();
        $object = $this->findAll(array(
            'order' => 'position ASC',
        ));
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
                $trees[$value['id']] = $delimiter . $value['title'];
                $trees = $this->getTree($all_cate, $value['id'], $trees, $delimiter . '--');
            }

        }
        return $trees;
    }
    
    public function getMultilevel(){
        $data = array();
        $list = $this->getAll();
        $tmp = array();
        foreach($list as $key=>$value){            
            if($value['parent_id'] == 0){
                $data[$key] = $value;
            }else{
                $tmp[$value['parent_id']][$value['id']] = $value;
                
                $data[$value['parent_id']]['sub'] = $tmp[$value['parent_id']];
            }
        }
        return $data;
    }
    
    
    public function buidMenuTreeBackend(){
        $all = $this->getMultilevel();
        $html = '';
        if(count($all) > 0){
            $html .= '<div class="dd"><ol class="dd-list">';
            foreach($all as $value){
                $html .= '<li class="dd-item" data-id="'.$value['id'].'">';
                    $html .= '<span class="uk-float-right btn-delete-menu" title="Xóa" data-id="'.$value['id'].'"><i class="material-icons">delete</i></span>';
                    $html .= '<div class="dd-handle">'.$value['title'].'</div>';
                    if(isset($value['sub'])){
                        $html .= '<ol class="dd-list">';
                        $list_sub = $value['sub'];
                        if(count($list_sub) >  0){
                            foreach($list_sub as $sub){
                                $html .= '<li class="dd-item" data-id="'.$sub['id'].'">';
                                    $html .= '<span class="uk-float-right btn-delete-menu" title="Xóa" data-id="'.$sub['id'].'"><i class="material-icons">delete</i></span>';
                                    $html .= '<div class="dd-handle">'.$sub['title'].'</div>';
                                $html .= '</li>';
                            }
                        }
                        $html .= '</ol>';
                        
                    }
                $html .= '</li>';
            }        
                    
            $html .= '</ol></div>';
        }
        return $html;
    }
}
