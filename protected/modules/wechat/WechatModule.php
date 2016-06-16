<?php

class WechatModule extends CWebModule {

    public function init() {
        $this->defaultController = 'index';
        $this->setImport(array(
            'wechat.models.*',
            'wechat.components.*',
        ));
        Yii::app()->setComponents(array(
            'user' => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
                'stateKeyPrefix' => 'wechat',
            )
        ));
    }

    public function beforeControllerAction($controller, $action) {
        $controller->layout = 'application.modules.wechat.views.layouts.main';
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

}
