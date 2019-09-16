<?php
namespace MY\Controller;

use MY\Base\App as DN;
use MY\Base\Helper\ControllerHelper as C;
use MY\Service\TestService;
use DNMVCS\Ext\JsonRpcExt;

class Main
{
	public function index()
	{
        //return;
        //
        //$t=TestService::G(JsonRpcExt::Wrap(TestService::class))->foo();
        //var_dump($t);
//var_dump(DN::SG());var_dump(DATE(DATE_ATOM));exit;
		//DN::ThrowOn(true,"JustError",123);
		$data=array();
		$data['var']=TestService::foo();
		C::Show($data,'main');
	}
    public function json_rpc()
    {
        
        $ret= JsonRpcExt::G()->onRpcCall(DN::SG()->_POST);
        C::ExitJson($ret);
    }
	public function i()
	{
		$data=array();
		C::Show($data);
	}
}
