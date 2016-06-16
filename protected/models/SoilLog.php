<?php

/**
 * This is the model class for table "soil_log".
 *
 * The followings are the available columns in table 'soil_log':
 * @property integer $id
 * @property integer $soil_id
 * @property string $soil_sn
 * @property string $content
 * @property string $pic_list
 * @property integer $shot_time
 * @property integer $created
 */
class SoilLog extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'soil_log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('soil_id, shot_time, created', 'numerical', 'integerOnly' => true),
            array('soil_sn', 'length', 'max' => 16),
            array('content', 'length', 'max' => 512),
            array('pic_list', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, soil_id, soil_sn, content, pic_list, shot_time, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'soil'=>array(self::BELONGS_TO,'Soil','soil_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'soil_id' => '地块ID',
            'soil_sn' => '地块编号',
            'content' => '内容',
            'pic_list' => '图片列表',
            'shot_time' => '拍摄时间',
            'created' => '创建时间',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('soil_id', $this->soil_id);
        $criteria->compare('soil_sn', $this->soil_sn, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('pic_list', $this->pic_list, true);
        $criteria->compare('shot_time', $this->shot_time);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SoilLog the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getList($platform = 'admin', $show_page = true, $pageSize = 10) {
        $criteria = new CDbCriteria();
        $soil_sn = Yii::app()->request->getParam('soil_sn','');
        if($soil_sn){
            $criteria->addSearchCondition('soil_sn', $soil_sn);
        }
        $pager = new CPagination($this->count($criteria));
        if ($show_page) {
            $pager->pageSize = $pageSize;
            $pager->applyLimit($criteria);
        }
        $model = SoilLog::model()->findAll($criteria);
        return array('model' => $model, 'pager' => $pager);
    }
    
    public function getSoilId(){
        $model = Soil::model()->findAll();
        $arr = array();
        foreach($model as $v){
            $arr[$v->id] = $v->soil_sn;
        }
        return $arr;
    }

}
