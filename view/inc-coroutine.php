<fieldset>
<legend>协程单例列表</legend>
<?php if(false){?>
<pre>
<?= \SwooleHttpd\SwooleCoroutineSingleton::DumpString();?>
</pre>
<?php }else{?>
非 swoole 环境无协程单例。
<?php }?>
</fieldset>