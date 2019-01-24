404
<?php if($this->isDev){ ?>
<pre>
<?php debug_print_backtrace(); ?>
</pre>
<?php }?>
<pre>

<?php
var_dump(\DNMVCS\DNRoute::G());
//var_dump(\DNMVCS\DNMVCS::G());
?>
</pre>