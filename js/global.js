/*!
 * Source Global Function
 * Date: 2019-01-01
 * 
 * (c) 2009-2029 Source, http://bbs.csource.com.cn
 *
 */
var script=document.createElement("script"); 
	script.type="text/javascript"; 
	script.src="../js/jquery-1.9.1.js"; 
	document.getElementsByTagName('head')[0].appendChild(script); 

//var arr = Array('iframeTools.js','artDialog.js?skin=default');
//for (i = 0 ; i < arr.length; i++)
//{
	///var script=document.createElement("script"); 
	//script.type="text/javascript"; 
	//script.src="../js/" + arr[i]; 
	//document.getElementsByTagName('head')[0].appendChild(script); 
//}

//后台消息框函数
//type 类型 : 1.信息框 2.网页框  3.弹窗
//data 内容 : 信息框对应弹出内容，网页框则为网址
//icon 图标，type为1生效
//title 标题
//height 高度
//weight 宽度

function SystemBox(type,data,icon,title,height,width) 
{
	switch(type)
	{
		case 1:
			var dialog = art.dialog({
									title: title,
    								content: data,
									icon: icon,
									});
			break;
			
		case 2:
			art.dialog.open( data, {
									title: title, 
									width: width, 
									height: height
							});
			break;
		
		case 3:
			art.dialog.tips(data);
			break;
			
	}
}
