<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexBaseController
 *
 * @author Dell
 */
class IndexBaseController extends Controller {

    //put your code here
    public function init() {
        parent::init();
        $searchbot = Utils::getNapsBot();
        if ($searchbot) {
            $agent = addslashes($_SERVER['HTTP_USER_AGENT']);
            $url = @$_SERVER['HTTP_REFERER'];
            $request_method = $_SERVER['REQUEST_METHOD'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $redirect_status = $_SERVER['REDIRECT_STATUS'];
            $date = date('Ymd');
            $file = dirname(Yii::app()->basePath) . "/protected/runtime/web_log/$date.log";
            $time = time();
            $data = array($searchbot, $time, $request_method, $url, $ip, $agent, $redirect_status);
            file_put_contents($file, serialize($data) . PHP_EOL, FILE_APPEND);
        }
    }

}
