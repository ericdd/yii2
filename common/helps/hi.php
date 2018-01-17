<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/17
 * Time: 15:18
 */

namespace common\helps;

class hi
{
    function __construct()
    {
        echo __FILE__,'<br />';
    }

    public static function foo()
    {
        echo "it is me.".rand(),'<br />';
    }
}