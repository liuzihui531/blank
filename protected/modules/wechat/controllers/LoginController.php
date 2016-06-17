<?php

class LoginController extends WechatBaseController {

    //put your code here
    public $openid = 99;

    public function actionIndex() {

        if (Yii::app()->request->isAjaxRequest) {
            $tel = Yii::app()->request->getPost('tel', '');
            $model = Soil::model()->find('mobile = :tel', array(':tel' => $tel));
            if ($model) {
                $model->is_bind = 1;
                $model->openid = $this->openid;
                $model->save();
                if ($model->hasErrors()) {
                    $this->handleResult(0, '操作失败,原因:' . Utils::getFirstError($model->errors));
                } else {
                    $cookie = new CHttpCookie('openid', $this->openid);
                    $cookie->expire = time() + 60 * 60 * 24 * 30; //有限期30天 
                    Yii::app()->request->cookies['openid'] = $cookie;
                    $this->handleResult(1, '操作成功', $this->createUrl('index/index'));
                }
            }
        }
        $cookie = Yii::app()->request->getCookies();
        if(isset($cookie['openid']->value) && !empty($cookie['openid']->value)){
            $this->redirect('/wechat/index/index');
        }
        $this->render('index');
    }

}
