<?php

/**
 * This is the model class for table "web_config".
 *
 * The followings are the available columns in table 'web_config':
 * @property integer $id
 * @property string $web_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property integer $page_size_hom
 * @property integer $number_related
 * @property string $post_rule
 * @property string $contact_ads
 * @property string $cooperate_content
 * @property string $copyright_content
 * @property string $general_rule
 * @property int $allow_feedback
 * @property integer $show_box_like
 * @property string $tag_footer_homepage
 * @property integer $allow_comment_fb
 * @property integer $allow_comment_system
 * @property string $text_suggest_click_ads
 */
class WebConfig extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'web_config';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'page_size_home, number_related, allow_feedback, show_box_like, allow_comment_fb, allow_comment_system',
                'numerical',
                'integerOnly' => true),
            array(
                'web_title',
                'length',
                'max' => 255),
            array(
                'meta_description, meta_keyword',
                'length',
                'max' => 512),
            array('post_rule, contact_ads, cooperate_content, copyright_content, general_rule, tag_footer_homepage, text_suggest_click_ads',
                    'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, web_title, meta_description, meta_keyword, page_size_home, number_related, allow_feedback, post_rule, contact_ads, cooperate_content, copyright_content, general_rule, tag_footer_homepage, allow_comment_fb, allow_comment_system, text_suggest_click_ads',
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
            'web_title' => 'Web Title',
            'meta_description' => 'Meta Description',
            'meta_keyword' => 'Meta Keyword',
            'page_size_home' => 'Số tin trên trang',
            'number_related' => 'Số tin liên quan',
            'post_rule' => 'Quy định đăng tin',
            'contact_ads' => 'Liên hệ quảng cáo',
            'cooperate_content' => 'Hợp tác nội dung',
            'copyright_content' => 'Bản quyền nội dung',
            'general_rule' => 'Điều khoản chung',
            'allow_feedback' => 'Cho phép gửi phản hồi',
            'show_box_like' => 'Show Box Like',
            'tag_footer_homepage' => 'Tag footer homepage',
            'allow_comment_fb' => 'Allow Comment FB',
            'allow_comment_system' => 'Allow Comment System',
            'text_suggest_click_ads' => 'Text Suggest Click Ads',
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
        $criteria->compare('web_title', $this->web_title, true);
        $criteria->compare('meta_description', $this->meta_description, true);
        $criteria->compare('meta_keyword', $this->meta_keyword, true);
        $criteria->compare('page_size_home', $this->page_size_home);
        $criteria->compare('number_related', $this->number_related);
        $criteria->compare('post_rule', $this->post_rule, true);
        $criteria->compare('contact_ads', $this->contact_ads, true);
        $criteria->compare('cooperate_content', $this->cooperate_content, true);
        $criteria->compare('copyright_content', $this->copyright_content, true);
        $criteria->compare('general_rule', $this->general_rule, true);
        $criteria->compare('allow_feedback', $this->allow_feedback, true);
        $criteria->compare('show_box_like', $this->show_box_like);
        $criteria->compare('tag_footer_homepage', $this->tag_footer_homepage, true);
        $criteria->compare('allow_comment_fb', $this->allow_comment_fb);
        $criteria->compare('allow_comment_system', $this->allow_comment_system);
        $criteria->compare('text_suggest_click_ads', $this->text_suggest_click_ads, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return WebConfig the static model class
     */
    public static function model($className = __class__)
    {
        return parent::model($className);
    }
    
    public function getInfo(){
        $web_config = Yii::app()->cache->get('web_config'); // Kiểm tra lấy từ cache
        if($web_config===false){
            $web_config = WebConfig::model()->findByPk(1);
            Yii::app()->cache->set('web_config', $web_config, 86400);
        }
        return $web_config;
    }
}
