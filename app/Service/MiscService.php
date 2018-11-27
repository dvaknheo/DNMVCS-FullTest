<?php
class MiscService
{
    use \DNMVCS\DNSingleton;
    public function foo()
    {
        //TODO log something.
        $time=NoDB_MiscModel::G()->getTime();
        $ret='Now is '.$time;
        return $ret;
    }
}