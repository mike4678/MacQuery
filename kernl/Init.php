<?PHP
error_reporting(0);

// 调整时区
if (PHP_VERSION >= '5.1') 
{
	date_default_timezone_set('PRC');
}

// 取得当前站点所在的根目录

$root_url = strtolower(dirname(HttpsCheck() . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'])) . '/';
define('ROOT_PATH', str_replace(strtolower('kernl/Init.PHP'), '', str_replace('\\', '/', strtolower(__FILE__))));

//全局通用数组
$GLOBALS[$_G];
$_G = array();

//框架运行的目录路径
$_G['SYSTEM']['PATH'] = str_replace(strtolower('kernl/Init.PHP'), '', str_replace('\\', '/', strtolower(__FILE__)));

//检测是否为https模式
function HttpsCheck()
{
   if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
   {
     return 'https://';
   }
     elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
     {
        return 'https://';
     }
     elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
     {
        return 'https://';
     }
  
        return 'http://';
 }


//配置文件检查
$file = $_G['SYSTEM']['PATH'] .'kernl/Conf.php';      

if(file_exists(strtolower($file)) != TRUE)  //如果不存在则跳转到安装界面
{  
	$jump =  HttpsCheck(). $_SERVER['HTTP_HOST'] . '/install/index.php';
	header("Location: ".$jump); //重定向浏览器
	exit;
} else {    //如果存在则引入该文件
	require_once 'Conf.php';
	}

//初始化核心模块
$arr = array('Connect','FileUtil','System','Mobile');
for ($i = 0 ; $i < count($arr); $i++)
{
	require($arr[$i].'.Class.php');
}

//Debug
if (Debug == "on") 
{
	ini_set("display_errors", "On");
	error_reporting(E_ALL | E_STRICT);
	
} else {
	
	ini_set("display_errors", "Off");
	error_reporting(0);
}

// 实例化类
$dou = new System(DBSERVER, USER, PASSWORD, DB, 'utf8');
$FileControl = new FileUtil();

//结束php部分初始化，初始化页面顶部信息
header('Cache-Control:no-cache,must-revalidate');    
header('Pragma:no-cache'); //设置无缓存
?>