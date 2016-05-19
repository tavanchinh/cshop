<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $position
 * @property integer $active
 */
class Category extends CActiveRecord
{
    private $time_cache = 86400;
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array(
                'parent_id, active',
                'numerical',
                'integerOnly' => true),
            array(
                'name, position',
                'length',
                'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, name, parent_id, position, active',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Tên danh mục',
            'parent_id' => 'Danh mục cha',
            'position' => 'Vị trí',
            'active' => 'Hiển thị',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('active', $this->active);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'parent_id ASC, position ASC, name ASC', ),
            'pagination' => array('pageSize' => Yii::app()->user->getState('pageSize', Yii::
                    app()->params['defaultPageSize']), ),
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __class__)
    {
        return parent::model($className);
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

    public function getLink($id, $title)
    {
        return Yii::app()->request->baseUrl . '/the-loai/' . CVietnameseTools::
            makeUrlFriendly($title) . '-' . $id;
    }
    public function getSlug($title)
    {
        return CVietnameseTools::makeUrlFriendly($title);
    }


    /**
     * Ham build title cho trang filter. 
     * @param string $name
     * @param int $type. = 1 Filter theo Cate hoạc Quoc Gia | = 2 Filter cứng | = 3 theo dien vien, dao dien, tag
     * @param int $year
     * @return string $title
     */
    public function buidPageTitle($name, $type = 1, $year = null)
    {
        $name = trim($name);
        $title = 'Phimbathu.com';
        if ($year == null) {
            $year = date('Y');
        }
        if ($type == 1) {
            $title = 'Xem phim ' . $name . ' hay, hot nhất ' . $year . ', phim ' .
                CVietnameseTools::removeSigns($name) . ' moi ' . $year;
        } else
            if ($type == 2) {
                if ($year == date('Y')) {
                    $title = 'Phim ' . $name . ' mới nhất, Phim ' . $name . ' hay, Phim ' . $name .
                        ' hot nhất ' . $year;
                } else {
                    $title = 'Phim ' . $name . ' ' . $year . ', Danh sách phim ' . $name .
                        ' chọn lọc ' . $year;
                }

            } else
                if ($type == 3) {
                    $title = 'Tuyển tập phim ' . $name . ' hay nhất, xem phim ' . $name . ' ' . date('Y');
                } else {
                    $title = 'Tuyển tập phim ' . $name . ' hay, xem phim ' . $name . ' hay nhất';
                }
                return $title;
    }

    public function getAllActive()
    {
        $list_cate = Yii::app()->cache->get('list_cate'); // Kiểm tra lấy từ cache
        if ($list_cate === false) {
            $list_cate = CHtml::listData(Category::model()->findAll(array('order' =>'position ASC')), 'id', 'name');
            Yii::app()->cache->set('list_cate', $list_cate, 86400);
        }

        return $list_cate;
    }
    
    
    public function getTreeFrontend(){
        $data = Yii::app()->cache->get('cate_frontend');
        if($data === false){
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
            Yii::app()->cache->set('cate_frontend',$data,$this->time_cache);
        }
        
        return $data;
    }
}
