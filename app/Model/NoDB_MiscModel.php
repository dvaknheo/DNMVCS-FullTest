<?php
class NoDB_MiscModel
{
    use \DNMVCS\DNSingleton;
    public function getTime()
    {
        return DATE(DATE_ATOM);
    }
}