<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 2016-05-29
 * Time: 22:42
 */

namespace App\Services;


class WechatService
{
    const AppID="wx4202b2ce9ff46370";
    const AppSecrect="5b657cd302250fcc681d264101198cd6";

    public static function getAccessToken(){
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".self::AppID."&secret=".self::AppSecrect;
        $data=json_decode(self::getUrlData($url));
        return $data->access_token;
    }

    public static function getUrlData($url){
        $ch = curl_init();
        $timeout = 60;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }

//{
//"touser":"OPENID",
//"msgtype":"text",
//"text":
//{
//"content":"Hello World"
//}
//}
    public static function sendMessage($openId,$message,$accessToken){
        $data=array(
          'touser'=>$openId,
          'msgtype'=>'text',
          'text'=>array(
              'content'=>$message,
          )
        );

        $url="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$accessToken;
        $data_string=json_encode($data,JSON_UNESCAPED_UNICODE);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        ob_start();
        curl_exec($ch);
        $return_content = ob_get_contents();
        ob_end_clean();

        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return array($return_code, $return_content);
    }
}