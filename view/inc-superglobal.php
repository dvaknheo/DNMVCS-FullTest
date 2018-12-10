<?php
use \DNMVCS\SuperGlobal as SG;
?>
<fieldset>
<legend>超全局变量</legend>
<h3>$_GET</h3>
<pre>
<?php var_dump(SG::G()->_GET);?>
</pre>
<h3>$_POST</h3>
<pre>
<?php var_dump(SG::G()->_POST);?>
</pre>
<h3>$_REQUEST</h3>
<pre>
<?php var_dump(SG::G()->_REQUEST);?>
</pre>
<h3>$_SERVER</h3>
<pre>
<?php var_dump(SG::G()->_SERVER);?>
</pre>
<h3>$_ENV</h3>
<pre>
<?php var_dump(SG::G()->_ENV);?>
</pre>
<h3>$_COOKIE</h3>
<pre>
<?php var_dump(SG::G()->_COOKIE);?>
</pre>
<h3>$_SESSION</h3>
<pre>
<?php var_dump(SG::G()->_SESSION);?>
</pre>
</fieldset>