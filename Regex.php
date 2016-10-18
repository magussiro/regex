<?php

/**
 * Created by PhpStorm.
 * User: Magus
 * Date: 2016/10/18
 * Time: 下午3:10
 */

class Regex
{
    //A. 檢查是不是數字
    protected static $standard_A = "/^([0-9]+)$/";
    //B. 檢查是不是小寫英文
    protected static $standard_B = "/^([a-z]+)$/";
    //C. 檢查是不是大寫英文
    protected static $standard_C = "/^([A-Z]+)$/";
    //D. 檢查是不是全為英文字串
    protected static $standard_D = "/^([A-Za-z]+)$/";
    //E. 檢查是不是英數混和字串
    protected static $standard_E = "/^([0-9A-Za-z]+)$/";
    //F. 檢查是不是中文
    protected static $standard_F = "/^([\x7f-\xff]+)$/";
    //G. 檢查是不是電子信箱格式
    //$standard_G_1 這組正則允許 "stanley.543-ok@myweb.com"
    ////但 $standard_G_2 僅允許 "stanley543ok@myweb.com" ，字串內不包含 .(點)和 -(中線)
    protected static $standard_G1 = "/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/";
    protected static $standard_G2 = "/^[\w]*@[\w-]+(\.[\w-]+)+$/";

    protected static $specialCharcters = [
        0 => "&",
        1 => "'",
        2 => '"',
        3 => "<",
        4 => ">",
        5 => "!",
        6 => "%",
        7 => "#",
        8 => "$",
        9 => "@",
        10 => "=",
        11 => "?",
        12 => "/",
        13 => "(",
        14 => ")",
        15 => "[",
        16 => "]",
        17 => "{",
        18 => "}",
        19 => ".",
        20 => "+",
        21 => "*",
        22 => "_",
        23 => "‘",
        24 => "、",
        25 => "，",
        26 => "。",
        27 => "？",
        28 => "！",
        29 => "＠",
        30 => "＃",
        31 => "＄",
        32 => "％",
        33 => "＾",
        34 => "＆",
        35 => "＊",
        36 => "（",
        37 => "）",
        38 => "＿",
        39 => "＋",
        40 => ",",
        41 => " ",
        42 => "^",
    ];


    static function filterSpecialChar($string)
    {
        return  str_replace(Regex::$specialCharcters, '', $string);
    }

    static function validEmail($email, $mode = 1)
    {
        if ($mode == 1)
            return preg_match(Regex::$standard_G1, $email);//bool
        return preg_match(Regex::$standard_G2, $email);//bool
    }

    static function validChinese($str)
    {
        return preg_match(Regex::$standard_F, $str);
    }

    static function validEnglish($str)
    {
        return preg_match(Regex::$standard_E, $str);
    }
    static function validEnMixNum($str)
    {
        return preg_match(Regex::$standard_D, $str);
    }

    static function validCaps($str)
    {
        return preg_match(Regex::$standard_C, $str);
    }

    static function validLows($str)
    {
        return preg_match(Regex::$standard_B, $str);
    }

    static function validNumber($str)
    {
        return preg_match(Regex::$standard_A, $str);
    }
    static function explodeInput($key){
        //回傳
        $str_len = strlen($key);
        $str_arr = [];
        for ($i = 0; $i < $str_len; $i++) {

            if (Regex::validEnMixNum(substr($key, $i, 1)))
                array_push($str_arr, substr($key, $i, 1) );
            else if (Regex::validChinese(substr($key, $i, 3)))
                array_push($str_arr, substr($key, $i, 3) );
        }
        return $str_arr ;
    }

}


