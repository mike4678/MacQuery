<?php
error_reporting(0);
include("qqwry.php"); // 引入代码
$demo = new QQWry('qqwry.dat'); // 初始化类
if($_SERVER['REQUEST_METHOD'] == "GET")
{
	echo '数据库版本：' . $demo->getVersion() . PHP_EOL;
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$detail = $demo->getDetail($_POST['ip']); // 调用查询函数
	echo json_encode(array('status'=>'1','message'=>'Success','Data'=>$detail ));// 输出查询结果
}
?>