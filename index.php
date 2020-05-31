<?php
require("kernl/Init.php"); //初始化基础参数
if($value -> status == '2')
{
	echo $dou -> Sys_ErrorPage(500);
	exit;
}
//开始加载首页
$dou -> CheckServerState(); //网站状态检查


if($dou -> Info("index_status") == 1 ) //网站状态检查
{
	echo $dou -> Index_ErrorPage(404);
	
} else 
	{
		if($dou -> Info("index_page") != NULL)
		{
			$file = $_G['SYSTEM']['PATH'] . $dou -> Info("index_page"); 
			if(file_exists(strtolower($file)) != TRUE)  //检查页面是否存在
			{  
				
				echo $dou -> Index_ErrorPage(307);
				
			} else 
				{     
					$fh = file_get_contents( HttpsCheck(). $_SERVER['HTTP_HOST'] .  '/' . $dou -> Info("index_page") );
					preg_match_all("|{(.*)}|U", $fh, $out, PREG_PATTERN_ORDER); //寻找文本中的{}字段内容
					$tlist = 0;
					while ($tlist <= count($out[1]) - 1)  
					{
						$name = "{".$out[1][$tlist]."}";
						$HeadData = $dou -> Info($out[1][$tlist]);
						$fh = str_ireplace($name,$HeadData,$fh);	
						$tlist = $tlist + 1;
	
					} 
					//生成结束
					$PageData = $fh;
					echo $PageData;
					//header('Location: '. $dou -> Info("index_page")); //返回页面不存在
					//exit;
				}
		} else 
			{
				
				echo $dou -> Index_ErrorPage(301);

			}

	}
?>