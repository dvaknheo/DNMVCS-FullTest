<?php
namespace MY\Service;
use MY\Base\Service;
use MY\Model as M;

class TestService extends Service
{
	use \DNMVCS\DNSingleton;

	public function foo()
	{
		return M\TestModel::G()->foo();
	}
}