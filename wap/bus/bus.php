<?php
header("Content-type: text/html; charset=utf-8");
$uk=$_GET["uk"];
$shareid=$_GET["shareid"];
$fid_list=$_GET["fid_list"];
$downloadsign=$_GET["downloadsign"];
$timestamp=$_GET["timestamp"];
$vcode=$_GET["vcode"];
$input=$_POST["input"];
$url="http://pan.baidu.com/share/download?bdstoken=null&web=5&app_id=250528&logid=MTQ4NzA2NzE5MDU0NzAuMDg2MzE0ODYwNzMxMzYzMw==&channel=chunlei&clienttype=5&uk={$uk}&shareid={$shareid}&fid_list={$fid_list}&sign={$downloadsign}&timestamp={$timestamp}&input={$input}&vcode={$vcode}";
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$content = curl_exec($ch);
curl_close($ch);
$link=json_decode($content,1);
$zh = curl_init($link["dlink"]);
curl_setopt($zh,CURLOPT_USERAGENT,'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba');
curl_setopt($zh,CURLOPT_RETURNTRANSFER,1);
curl_setopt($zh,CURLOPT_HEADER,1);
$link1 = curl_exec($zh);
curl_close($zh);
preg_match_all("/Location:(.+?)\n/u",$link1,$json);
echo '<title>百度网盘直链获取工具</title>';
echo '<meta name="keywords" content="百度网盘,KDWNIL," />';
echo '<h1>百度网盘直链获取工具</h1>';
echo '<meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">';
echo "下载地址(如果空白请检查验证码是否输入错误或连接是否失效并回去重新获取):<a href=\"{$json[1][0]}\"\"target=\"_blank\">{$json[1][0]}</a><br><a href=\"./\">继续获取</a>";
