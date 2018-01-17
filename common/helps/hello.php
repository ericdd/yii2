<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/17
 * Time: 15:24
 */

namespace common\helps;


class hello
{
    function __construct()
    {
        echo "你好".'<br />';
    }

    public function foo()
    {
        echo __FILE__,mt_rand(),'<br />';
    }
}