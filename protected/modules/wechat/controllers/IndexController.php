<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author Administrator
 */
class IndexController extends WechatBaseController {

    public function actionIndex() {
        $cookie = Yii::app()->request->getCookies();
        if(!isset($cookie['openid']->value) && empty($cookie['openid']->value)){
            $this->redirect('wechat/login/index');
        }
        $this->render('index');
    }

}
