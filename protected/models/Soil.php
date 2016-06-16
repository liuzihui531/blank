<?php

/**
 * This is the model class for table "soil".
 *
 * The followings are the available columns in table 'soil':
 * @property integer $id
 * @property string $soil_sn
 * @property string $username
 * @property string $mobile
 * @property string $openid
 * @property integer $is_bind
 * @property integer $created
 */
class Soil extends CActiveRecord {

    public function getBindKv($key=''){
        $return = array(
            '0'=>'否',
            '1'=>'是'
        );
        if(key_exists($key, $return)){
            return $return[$key];
        }
        return $return;
    }
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'soil';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mobile,soil_sn','unique'),
            array('is_bind, created', 'numerical', 'integerOnly' => true),
            array('soil_sn, mobile', 'length', 'max' => 16),
            array('username, openid', 'length', 'max' => 64),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, soil_sn, username, mobile, openid, is_bind, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'soil_sn' => '地块编号',
            'username' => '会员姓名',
            'mobile' => '手机号码',
            'openid' => 'openid',
            'is_bind' => '是否绑定',
            'created' => '添加时间',
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
        $criteria->compare('soil_sn', $this->soil_sn, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('openid', $this->openid, true);
        $criteria->compare('is_bind', $this->is_bind);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Soil the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getList($platform = 'admin', $show_page = true, $pageSize = 10) {
        $criteria = new CDbCriteria();
        $mobile = Yii::app()->request->getParam('mobile','');
        if($mobile){
            $criteria->addSearchCondition('mobile', $mobile);
        }
        $pager = new CPagination($this->count($criteria));
        if ($show_page) {
            $pager->pageSize = $pageSize;
            $pager->applyLimit($criteria);
        }
        $model = Soil::model()->findAll($criteria);
        return array('model'=>$model,'pager'=>$pager);
    }

}
