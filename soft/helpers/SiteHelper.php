<?php

namespace soft\helpers;

use Yii;
/**
 * Class SiteHelper
 * Saytda ishlatish ba'zi funksiyalar
 * @package soft\components
 */

class SiteHelper
{


    public static function setLanguage()
    {
        $params = Yii::$app->params;
        $lang = Yii::$app->request->get($params['languageParam'], $params['defaultLanguage'] );
        if (!array_key_exists($lang, $params['languages'])){
            $lang = $params['defaultLanguage'];
        }
        Yii::$app->language = $lang;
    }
    
    public static function clearPhoneNumber($phoneNumber = '')
    {
        $tel = trim($phoneNumber);
        return strtr($tel, [
            "+" => '',
            " " => '',
            "(" => '',
            ")" => '',
            "-" => '',
        ]);
    }

    /**
     * Telefon raqamdan davlat kodi (+998) ni olib tashlaydi
     * @param string $phoneNumber
     * @return false|string|null
     */
    public static function removeCountryCode($phoneNumber='')
    {
        if (empty($phonenumber)){
            return null;
        }

        $phoneNumber = self::clearPhoneNumber($phoneNumber);

        $length = strlen($phoneNumber);
        if ($length > 9){
            $start = $length - 9;
            $phoneNumber = substr($phoneNumber, $start);
        }

        return $phoneNumber;
    }

    /**
     * Sistemani aniqlash
     * @return string
     */
    public static function getOsName()
    {
        return strtoupper(substr(PHP_OS, 0, 3));
    }


     public static function userDefaultAvatar()
    {
        return "/images/user-default-avatar.png";
    }



}


?>