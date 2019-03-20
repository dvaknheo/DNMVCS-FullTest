<?php
namespace MY\Base;
class App extends \DNMVCS\DNMVCS
{
	public function init($options=array())
	{
		//\DNMVCS\DNSwooleExt::Server(\DNMVCS\SwooleHttpd::G());
		$options['ext']['use_strict_db']=true;
		$options['ext']['use_facade']=true;
		$options['ext']['facade_map']=[
			'MY\Service\TestService'=>'MY\Service\DebugService',
		];
		parent::init($options);
		return $this;
	}
	public static function ST()
	{
		var_dump("x");
	}

	public function foo()
	{
		var_dump("foo");
	}
	
	public function foo2()
	{
		var_dump("foo2");
	}
}