<?php
    session_start();

    $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
    $ssid = isset($_SESSION['ssid']) ? $_SESSION['ssid'] : '';
    $bssid = isset($_SESSION['ap']) ? $_SESSION['ap'] : '';

    if(($id && $ssid && $bssid) == false){
    }

    require_once('../../config/wechat.php');
    $sid = session_id();
    $_SESSION['macid'] = $id;
	
?>
<!DOCTYPE HTML>
<html>
<head lang="zh-CN">
    <meta charset="UTF-8">
    <title>微信连Wi-Fi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../default/statics/images/favicon.ico" rel="icon">
    <link rel="stylesheet" href="/guest/s/default/statics/css/style-pcdemo.css">

    <link rel="stylesheet" href="/guest/s/default/statics/css/site.css">


</head>

<body>
    <div class="container">
        <div class="header">

        </div>
    
        <div class="main" style="background-image: url(../default/statics/images/background1.jpg);">
            <!--建议图片大小�?1920x1200 �?1920x1080-->
            <div class="main__content">
                <img class="mod-simple-follow-page__logo-img" src="/guest/s/default/statics/images/nophoto.gif" alt=""/>
                <h2 class="main__content-title">欢迎使用<em style="color: #139fdf;">免费Wi-Fi</em></h2>
                <?php echo $bssid; ?>
                <button style="border:0px" class="mod-simple-follow-page__attention-btn" id="applybtn" onclick="apply()">使用微信扫描二维码</button>
				<button style="display:none;" style="border:0px" class="mod-simple-follow-page__attention-btn" id="regbtn" onclick="r_apply()">先登记信息</button>
            </div>
    
        </div>
    
        <div class="footer">
            <div class="footer_copyright"><a href="http://www.ubnt.com.cn">优倍快网络咨询（上海）有限公司</a> Copyright © 2016 . All Rights Reserved.</div>
        </div>
    </div>
</body>
<script src="/guest/s/default/statics/js/jquery.js"></script>
<script type="text/javascript" src="/guest/s/default/statics/js/md5.js"></script>
<script type="text/javascript" src="/guest/s/default/statics/js/pcauth.js" ></script>
<script type="text/javascript">
var appId          = "<?php echo $appId ?>";
    var secretkey      = "<?php echo $secretkey ?>";
    var extend         = "<?php echo $extend ?>";    　　　 //开发者自定义参数集合
    var timestamp      = new Date().getTime();　　　　//时间�?毫秒)
    var shop_id        = "<?php echo $shop_id ?>";            　　  //AP设备所在门店的ID
    var authUrl        = "<?php echo $portalServer ?>/guest/callback.php?httpCode=200&sid=<?php echo $sid ?>";        //服务器回调地址 gwId当前连接的路由的设备编号
    var mac            = "<?php echo $id ?>";  　　　//用户手机mac地址 安卓设备必需
    var ssid           = "<?php echo $ssid ?>";           //AP设备信号名称，非必须
    var bssid          = "<?php echo $bssid ?>";       //AP设备mac地址，非必须

    function Wechat_GotoRedirect(appId, extend, timestamp, sign, shopId, authUrl, mac, ssid, bssid){
        //将回调函数名称带到服务器�?
        var url = "https://wifi.weixin.qq.com/operator/callWechatBrowser.xhtml?appId=" + appId
                                                                            + "&extend=" + extend
                                                                            + "×tamp=" + timestamp
                                                                            + "&sign=" + sign;
        //如果sign后面的参数有值，则是�?.1发起的流�?
        if(authUrl && shopId){
            url = "https://wifi.weixin.qq.com/operator/callWechat.xhtml?appId=" + appId
                                                                            + "&extend=" + extend
                                                                            + "×tamp=" + timestamp
                                                                            + "&sign=" + sign
                                                                            + "&shopId=" + shopId
                                                                            + "&authUrl=" + encodeURIComponent(authUrl)
                                                                            + "&mac=" + mac
                                                                            + "&ssid=" + ssid
                                                                            + "&bssid=" + bssid;

        }
        //通过dom操作创建script节点实现异步请求
        var script = document.createElement('script');
        script.setAttribute('src', url);
        document.getElementsByTagName('head')[0].appendChild(script);
    }

    function callWechatBrowser(){
        var sign = $.md5(appId + extend + timestamp + shop_id + authUrl + mac + ssid + bssid + secretkey);
        try{
            Wechat_GotoRedirect(appId, extend, timestamp, sign, shop_id, authUrl, mac, ssid, bssid);
        } catch(e){
            alert("error!");
        }
    }

    var count = 0;

    function apply(){
        $("#applybtn").text("请稍候正在生成二维码...");
        $.post('/guest/getMinute.php?macid='+ mac, {}, function(data){
            if(data.success){

                $("#applybtn").attr('disabled', 'disabled');
                window.location.href = "qr.php";
            }else{
				$("#applybtn").attr('disabled', 'disabled');
				$("#applybtn").text("你无权使用WIFI网络");	
				//setInterval("reg()", 1000);
				$("#regbtn").show();	
			 }
        }, 'json');
    }
	
	function r_apply(){
		document.location.href = "/guest/r/index.php";
		// $.post('/guest/r/index.php', function(data){
            // if(data.success){
                // location.hash = "openwechat";               
                // location.reload();
            // }
        // }, 'json');		
	}
	
	
    function reload(){
        window.location.hash = "pc-open";
        window.location.reload();
    }


    window.onload = function(){
        if(location.hash == "#pc-open"){
            window.location.href = "/guest/s/default/qr.php";

        }
    }
</script>
</html>