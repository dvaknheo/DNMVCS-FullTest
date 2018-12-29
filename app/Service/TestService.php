<?php
namespace MY\Service;
use \DNMVCS\DNMVCS as DN;
use MY\Model as M;

class TestService
{
	use \DNMVCS\DNSingleton;

	public function foo()
	{
		return M\TestModel::G()->foo();
	}
}