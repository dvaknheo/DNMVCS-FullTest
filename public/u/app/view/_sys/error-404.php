404
<?php if($this->isDev){ ?>
<pre>
<?php debug_print_backtrace(); ?>
</pre>
<?php }?>
<pre>

<?php
echo md5(spl_object_hash(\DNMVCS\RouteHookMapAndRewrite::G()));echo "\nxxxxxxxxxxxxxxxxxxxxxxxxxx\n";

var_dump(\DNMVCS\RouteHookMapAndRewrite::G());
echo "\n";
echo DNMVCS\SwooleCoroutineSingleton::_DumpString();

var_dump(\DNMVCS\DNRoute::G());
//var_dump(\DNMVCS\DNMVCS::G());

?>
</pre>