<?php
namespace MY\Base;
use Facades\MY\Base\App as FA;
use JsonRpc\MY\Service\TestSerice;

class App extends \DNMVCS\DNMVCS
{
	protected function onInit()
	{
        $this->options['ext']['DNMVCS\Ext\FacadesAutoLoader']=[
            'facades_namespace'=>'Facades',
        ];
        $this->options['ext']['DNMVCS\Ext\JsonRpcExt']=[
            'jsonrpc_backend'=>['http://test.dnmvcs.dev/json_rpc','127.0.0.1:80'],
        ];
        $this->options['error_500']='_sys/error-500';
        $this->options['error_exception']='_sys/error-exception';
        $this->options['error_debug']='_sys/error-debug';
        return parent::onInit();
	}
    protected function onRun()
    {
       return parent::onRun();
    }
	public static function ST()
	{
		var_dump("STSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTSTST");
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