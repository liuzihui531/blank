<?php

class SoilLogController extends Controller{
    //put your code here
    public $page_name = '地块日志';

    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array($this->page_name . '管理');
        $data = SoilLog::model()->getList();
        $this->render('index', $data);
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加' . $this->page_name);
        $model = new SoilLog();
        $soil = SoilLog::model()->getSoilId();
        $this->is_upload = true;//用到图片上传
        $this->render('_form', array('model' => $model,'soil'=>$soil));
    }

    public function actionUpdate() {
        $this->breadcrumbs = array('修改' . $this->page_name);
        $id = Yii::app()->request->getParam('id', 0);
        $model = SoilLog::model()->findByPk($id);
        $soil = SoilLog::model()->getSoilId();
        $this->render('_form', array('model' => $model,'soil'=>$soil));
    }

    public function actionSave() {
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
            $model = SoilLog::model()->findByPk($id);
        } else {
            $model = new SoilLog();
            $model->created = time();
        }
        try {
            $model->attributes = Yii::app()->request->getPost('SoilLog');
            $model->pic_list = implode(",", Yii::app()->request->getPost('pic_list'));
              if($soil_id = $_POST['SoilLog']['soil_id']){
                $soil_sn = Soil::model()->findByPk($soil_id);
                $soil_sn = $soil_sn['soil_sn'];
                $model->soil_sn = $soil_sn;
            }
            
            $model->save();
            if ($model->hasErrors()) {
                throw new Exception(Utils::getFirstError($model->errors));
            }
            $this->handleResult(1, '操作成功', $this->createUrl('index'));
        } catch (Exception $ex) {
            $this->handleResult(0, '操作失败,原因:' . $ex->getMessage());
        }
    }

    public function actionDelete() {
        $id = Yii::app()->request->getParam('id', '');
        $id = (array) $id;
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $id);
        $res = SoilLog::model()->deleteAll($criteria);
        if ($res) {
            $this->handleResult(1, '操作成功');
        } else {
            $this->handleResult(0, '操作失败');
        }
    }
}
