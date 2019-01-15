<?php
namespace MY\Controller;

use DNMVCS\DNMVCS as DN;
use MY\Service as S;
use MY\Facade\Service\TestService;
class DNController
{
	public function index()
	{
		$data=array();
		$data['var']=TestService::foo();
		DN::Show($data,'main');
		
	}
	public function i()
	{
		phpinfo();
	}
}
