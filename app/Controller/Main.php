<?php
namespace MY\Controller;

use DNMVCS\DNMVCS as DN;
use MY\Service as S;
//use MY\Facades\Service\TestService;
use MY\Service\TestService;
class Main
{
	public function index()
	{

//var_dump(DN::SG());var_dump(DATE(DATE_ATOM));exit;
		//DN::ThrowOn(true,"JustError",123);
		$data=array();
		$data['var']=TestService::foo();
		DN::Show($data,'main');
		
	}
	public function i()
	{
		$data=array();
		DN::Show($data);
	}
}
