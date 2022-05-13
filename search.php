<?php 
// 搜索核心驱动模块	
//error_reporting(0);
require("kernl/Init.php"); //初始化基础参数
$dou -> CheckServerState();//网站状态检查
$searchdata = empty($_POST['searchdata']) ? '' : $_POST['searchdata'];  // 搜索内容

//MAC地址分析
$pattern = "/^([A-Fa-f0-9]{2}[-,:]){5}[A-Fa-f0-9]{2}$/"  ;
if(!preg_match($pattern, $searchdata)){
	echo json_encode(array('status'=>'-1','message'=>'不是一个有效的MAC地址！'));
	exit;
}

//处理传入值
if(strpos($searchdata,"-") != FALSE) 
{
	$replace1 = str_replace("-","",$searchdata);
} else {
	if(strpos($searchdata,":") != FALSE) 
	{
		$replace1 = str_replace(":","",$searchdata);
	}	
}
$querydata = substr($replace1,0,6);
$sql = 'select * from mac_addr where OUI_HEX LIKE "%'.$querydata.'%"';
$row = $dou -> fetch_array($dou -> query($sql));
$count = $dou -> affected_rows();
switch($count)
{
	case 0:
		echo json_encode(array('status'=>'-1','message'=>'查询无果','test'=>$querydata));
		exit;
			
	case 1:
		echo json_encode(array('status'=>'0','message'=>'Success','mac'=>$searchdata,'mac_q'=>$querydata,'regcompy'=>$row['Organization'])); 
		exit;
		
	default:
		echo json_encode(array('status'=>'-1','message'=>'查询无果','test'=>$querydata));
		exit;
}
?>
c'=>$searchdata,'mac_q'=>$querydata,'regcompy'=>$row['Organization'])); 
			exit;
		
			default:
			echo json_encode(array('status'=>'-1','message'=>'查询无果','test'=>$querydata));
			exit;
		}
		break;
		
	case 'ip':
		if($_POST['software_alive'] == 'get')
		{
			if($searchdata="local")
			{
				$demo = new QQWry('qqwry.dat'); // 初始化类
				$detail = $demo->getDetail($demo->ip()); // 调用查询函数
				$UserIP = $demo->ip(); // 调用查询函数
				echo json_encode(array('status'=>'1','message'=>'Success','UserIP'=>$UserIP,'Data'=>$detail ));// 输出查询结果
			
			}
		} else {
			//IP地址分析
			$pattern = '/((2(5[0-5]|[0-4]\d))|[0-1]?\d{1,2})(\.((2(5[0-5]|[0-4]\d))|[0-1]?\d{1,2})){3}/'  ;
			if(!preg_match($pattern, $searchdata))
			{
				echo json_encode(array('status'=>'-1','message'=>'不是一个有效的ip地址！'));
				exit;
			}
			$demo = new QQWry('qqwry.dat'); // 初始化类
			$detail = $demo->getDetail($searchdata); // 调用查询函数
			$UserIP = $demo->ip(); // 调用查询函数
			echo json_encode(array('status'=>'1','message'=>'Success','UserIP'=>$UserIP,'Data'=>$detail ));// 输出查询结果
		}
		break;
}
?>
