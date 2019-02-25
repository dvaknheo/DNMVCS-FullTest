<?php
/**
 * description...
 * 
 * @author Dvaknheo
 * @category DnToolkit
 * @copyright Copyright(c) 2012 
 * @version $Id$
 */

/** 这个文件的详细介绍
 *  Bug debug_backtrace 的问题
 *  Log 的复杂性：和  Pid, ,Log 的目录，log 的 文件名， session 
 *  依赖性:
 *  作为很底层的类，本类不依赖其他类。
 *  
 */
if(!function_exists('_log')){

function _log() {
	//if (empty($GLOBALS['DEBUG'])) {
	//	return;
	//}
	$logger = DnDebug :: Self();
	$logger->captureBacktrace();
	$args = func_get_args();
	return call_user_func_array(array (
		$logger,
		'logData'
	), $args);
}
function _logfile($filename) {
	$logger = DnDebug :: Self();
	$logger->captureBacktrace();
	$args = func_get_args();
	return call_user_func_array(array (
		$logger,
		'logToFile'
	), $args);
}

function _dumptrace() {
	$logger = DnDebug :: Self();
	$logger->captureBacktrace();
	$args = debug_backtrace();
	$b=array();
	foreach($args as $a){
		@$b[]=$a['function'].":".$a['line']."\t\t\t\t".$a['file']."\n";
	}
	return call_user_func_array(array (
		$logger,
		'logData'
	), $b);
}

}
/**
 * description...
 * 
 * @author Administrator
 * @category  
 * @package DnDebug
 */
class DnDebug {
	public $is_log_pid = false;
	public $is_log_uid = false;
	public $is_log_date = false;
	public $is_log_date_dir = false;

	public $is_log_backtrace = true;
	
	public $init_time;
	public $log_requesttime=false;

	public $is_inited = false;
	public $log_dir = '';
	public $log_file = '';
	
	public $last_log_time;
	protected $is_logbegin = false;

	protected $last_backtrace = array ();
	///////////////////////////////////////////////////////////////////////////
	public static function GetInstance() {
		return self :: Self();
	}
	public static function Self($obj = null) {
		$classname = __CLASS__;
		$mustbe_childclass = false;
		$key = 'Dvaknheo_' . $classname;
		if ($obj) {
			if ($mustbe_childclass && !is_a($obj, $classname)) {
				$GLOBALS[$key] = $GLOBALS[$key] ? $GLOBALS[$key] : new $classname ();
			} else {
				$GLOBALS[$key] = $obj;
			}
		} else
			if (!isset ($GLOBALS[$key])) {
				$GLOBALS[$key] = new $classname ();
			}
		return $GLOBALS[$key];
	}
	public function __construct() {
		if (isset ($GLOBALS['Dn_InitTime'])) {
			$this->init_time = $GLOBALS['Dn_InitTime'];
		} else {
			$this->init_time = microtime(true);
		}
		$this->last_log_time = $this->init_time;
		$this->init();
	}
	public function init($options = null) {
		if (isset ($GLOBALS['Dn_Debug_IsLogDate'])) {
			$this->is_log_date = $GLOBALS['Dn_Debug_IsLogDate'];
		}
		if (isset ($GLOBALS['Dn_Debug_IsLogDateDir'])) {
			$this->is_log_date_dir = $GLOBALS['Dn_Debug_IsLogDateDir'];
		}
		if (isset ($GLOBALS['Dn_Debug_IsLogBackTrace'])) {
			$this->is_log_backtrace = isset ($GLOBALS['Dn_Debug_IsLogBackTrace']);
		}

		if (isset ($GLOBALS['Dn_Debug_IsLogPid'])) {
			$this->is_log_pid = $GLOBALS['Dn_Debug_IsLogPid'];
		}
		if (isset ($GLOBALS['Dn_Debug_IsLogUid'])) {
			$this->is_log_uid = $GLOBALS['Dn_Debug_IsLogUid'];
		}
		if (isset ($GLOBALS['Dn_Debug_LogDir'])) {
			$this->log_dir = $GLOBALS['Dn_Debug_LogDir'];
		}
		if (isset ($GLOBALS['Dn_Debug_LogRequestTime'])) {
			$this->log_requesttime = $GLOBALS['Dn_Debug_LogRequestTime'];
		}
		
		$this->log_file = $this->getLogFilename();
		ini_set('log_errors', true);
		ini_set('error_log', $this->log_file);
		if($this->log_requesttime && !empty($GLOBALS['Dn_Debug_Shutdown'])){
			$GLOBALS['Dn_Debug_Shutdown']=true;
			register_shutdown_function(array(__CLASS__,'OnExit'));
		}
		
		$this->is_inited = true;
	}
	public static function OnExit()
	{
		chdir(dirname($_SERVER['SCRIPT_FILENAME'])); // 这是为了阻止一个bug
		$str=str_repeat('/',80);
		$costtime = microtime(true) - $GLOBALS['Tw_InitTime'];
		$total=sprintf('%2.3f',$costtime);
		$url="($total)END ".$_SERVER['REQUEST_URI']." ";
		$l=strlen($url);
		if($l>=80){
			$str="-----".$url;
		}else{
			$l2=floor((80-$l)/2);
			$str=str_repeat('=',$l2).$url.str_repeat('=',(80-$l-$l2));
		}
		
		self::Log($str);
	}
	///////////////////////////////////////////////////////////////////////////
	public function captureBacktrace() {
		$a = ($this->is_log_backtrace) ? debug_backtrace() : array ();
		$this->last_backtrace = $a;
	}

	public function _logToFile($filename) {
		$a = $this->last_backtrace ? $this->last_backtrace : debug_backtrace();

		$sourcefile = $this->adjustSourceFilename($a[1]['file']);
		$line = $a[1]['line'];

		$args = func_get_args();
		$str = $this->get_log_string($sourcefile, $line, $args);

		$this->last_backtrace = array ();
		ini_set('error_log', $filename);
		error_log($str);
	}
	public function logData() //$args;
	{
		$a = $this->last_backtrace ? $this->last_backtrace : debug_backtrace();

		//adjust backtrace
		for ($b = array_shift($a); $b = array_shift($a); !empty ($a)) {
			if (!isset ($b['file'])) {
				$b['file'] = '';
			}
			$sourcefile = $this->adjustSourceFilename($b['file']);
			if (!isset ($b['line'])) {
				$b['line'] = '';
			}
			$line = $b['line'];
			if ($b['file']) {
				break;
			}
		}
		$args = func_get_args();
		$str = $this->get_log_string($sourcefile, $line, $args);

		$this->last_backtrace = array ();

		$filename = '';
		if ($filename) {
			$filename = $this->get_log_dir() . $filename;
			ini_set('error_log', $filename);
			@ error_log($str);
			ini_set('error_log', $this->log_file);
		} else {
			@ error_log($str);
		}
		if (defined('DN_IN_AMF') && class_exists('NetDebug')) {
			//NetDebug :: trace($str);
		}
	}
	///////////////////////////////////////////////////////////////////////////
	protected function getLogFilename() {
		$date = '';
		$uid = '';
		$pid = '';
		if ($this->is_log_date && !$this->is_log_date_dir) {
			$date = "_" . date("Y-m-d");
		}
		
		$filename = basename($_SERVER['SCRIPT_FILENAME'], '.php') . $date . $uid . $pid . '.log';
		;
		$filename = $this->get_log_dir() . $filename;
		return $filename;
	}
	protected function adjustSourceFilename($filename) {
		if (dirname($filename) == dirname(realpath($_SERVER['SCRIPT_FILENAME']))) {
			$filename = basename($filename);
		}
		if (defined('DN_BASEPATH')) {
			$dir = str_replace("\\", '/', DN_BASEPATH);
			$filename = str_replace("\\", '/', $filename);
			$l = strlen($dir);
			if (substr($filename, 0, $l) == $dir) {
				$filename = '::/' . substr($filename, $l);
			}
		}

		return $filename;
	}

	protected function get_log_dir() {
		if (!$this->log_dir) {
			$this->log_dir = dirname($_SERVER['SCRIPT_FILENAME']) . '/';
		}
		if ($this->log_dir) {
			$this->log_dir = rtrim($this->log_dir, '/') . '/';
		}
		if ($this->is_log_date && $this->is_log_date_dir) {
			$this->log_dir .= date("Y-m-d") . '/';
		}
		if (!is_dir($this->log_dir)) {
			@mkdir($this->log_dir);
		}
		return $this->log_dir;
	}
	private function get_log_string($sourcefile, $line, $args) {
		$currenttime = microtime(true);
		$costtime = $currenttime - $this->last_log_time;
		$toheretime = $currenttime - $this->init_time;
		$this->last_log_time = $currenttime;
		$sessionid = session_id();
		$mem = memory_get_usage();
		//$mem=number_format(,',');

		if (!$sessionid) {
			$session_id = $_SERVER['REMOTE_ADDR'] . "/" . $_SERVER['REMOTE_PORT'];
		}
		$prefix = sprintf("Cost:%2.3f Total:%2.3f Mem:%8d [%s] %s:%s >>>>\n", $costtime, $toheretime, $mem, $sessionid, $sourcefile, $line);

		$str = $prefix;
		foreach ($args as $arg) {
			$s = '';
			if (!is_scalar($arg)) {
				$s = var_export($arg, true);
/*
WORKAROUND for error "Nesting level too deep - recursive dependency":
ob_start();
var_dump($GLOBALS);
$dataDump = ob_get_clean();
echo $dataDump; 

*/

			} else
				if (is_bool($arg)) {
					$arg = $arg ? 'true' : 'false';
				} else {
					$s = $arg;
				}
			$str .= $s . ";";
		}
		return $str;
	}

	///////////////////////////////////////////////////////////////////////////
	public static function Log($str) //$args...
	{
		$method = 'logData';
		$me = self :: GetInstance();
		$me->captureBacktrace();
		$args = func_get_args();
		return call_user_func_array(array (
			& $me,
			$method
		), $args);
	}
	public static function LogToFile($filename) //$args...
	{
		$method = '_logToFile';
		$me = self :: GetInstance();
		$me->captureBacktrace();
		$args = func_get_args();
		return call_user_func_array(array (
			& $me,
			$method
		), $args);
	}
	public static function Trace() {
		if (!isset ($GLOBALS['DN_DEBUG_SHOW_TRACE']) || !$GLOBALS['DN_DEBUG_SHOW_TRACE']) {
			return;
		}
		$method = 'logData';
		$me = self :: GetInstance();
		$me->captureBacktrace();
		$args = func_get_args();
		return call_user_func_array(array (
			& $me,
			$method
		), $args);
	}
	public static function LogWarnning() {

	}
}