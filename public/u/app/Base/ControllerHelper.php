<?php
namespace UUU\Base;

use DNMVCS\Base\ControllerHelper as Helper;

class ControllerHelper extends Helper
{
    //
    public static function Pager()
    {
        return \DNMVCS\Base\Pager::G();
    }
}
