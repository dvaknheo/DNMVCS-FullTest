<?php
namespace MY\Base;
class App extends \DNMVCS\DNMVCS
{
	public function init($options=array())
	{
		$options['ext']['use_strict_db_manager']=true;
		parent::init($options);
		return $this;
	}
}