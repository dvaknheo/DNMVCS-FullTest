<?php
namespace UUU\Base;
use \DNMVCS\DNMVCS as DN;

class App extends \DNMVCS\DNMVCS
{
	public function onInit()
	{
		$this->assignRewrite([
			'~article/(\d+)/?(\d+)?'=>'article?id=$1&page=$2',
		]);
		
		$this->assignRoute([
			'~abc(\d*)'=>function($x){var_dump("work",$x);},
		]);

		return $this;
	}
	public function run()
	{
		return parent::run();
	}

}