<?php
class DNController
{
    public function foo()
    {
        $data=[];
        $data['var']=MiscService::G()->foo();
        \DNMVCS\DNMVCS::Show($data);
    }
}