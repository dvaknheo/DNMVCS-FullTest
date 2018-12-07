<?php
namespace MY\Controller;

use DNMVCS\DNMVCS as DN;
use MY\Service as S;
use DNMVCS\SuperGlobal;

class DNController
{
	public function index()
	{
		SuperGlobal::G();
		$data=array();
		$data['var']=S\TestService::G()->foo();
		DN::Show($data,'main');
		
	}
	public function i()
	{
		phpinfo();
	}
}
