<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Redirect</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <script type="text/javascript"> 
        function getCurrentLang(){
            var TestLang = navigator.languages && navigator.languages[0] ||
               navigator.language ||
               navigator.userLanguage;   
            var zh = {
                'title':'欢迎您',
                'message':'正在为您接入互联网',                
                'tips':'正在连接',                
            }
            var en = {
                'title':'Welcome You',
                'message':'It\'s connecting to the Internet',
                'tips':'Connecting',
            }
            var currentLang = {};
            var prefixLang = TestLang.substr(0, 2); 

            switch(prefixLang){
                case "en":
                    currentLang = en;
                    break;
                case "zh":
                    currentLang = zh;
                    break;
                default:
                    currentLang = en;
                    break;
            }          
            return currentLang;
        }
        var dictionary = getCurrentLang();
    </script>
    <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/js/app.min.js"></script>
    <script type="text/javascript" src="/Public/js/wifi.js"></script>
    <link rel="stylesheet" href="/Public/css/app.min.css">
    <link rel="stylesheet" href="/Public/css/ui.min.css">
    <style type="text/css">.weui-toast{margin-left: 0;}</style>
</head>
<body>


<div class="weui-msg" style="margin-top: 40px;">
    <div class="weui-msg__icon-area"><img src="data:image/jpeg;base64,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" style="width: 121px;height: 121px;"></div>
    <div class="weui-msg__text-area">
        <h2 class="weui-msg__title" id="tpl_title">欢迎您</h2>
        <p class="weui-msg__desc" id="tpl_message">正在为您接入互联网!</p>
    </div>

    <div class="weui-msg__extra-area">
        <div class="weui-footer">

            <p class="weui-footer__text">Copyright © 2014-2018 Power by Cloud Hotspot</p>
        </div>
    </div>
</div>

<div style="display: none;">

    <form name="redirect" action="/portal/index" method="get">
        <input type="hidden" name="mac" value="{{mac}}">
        <input type="hidden" name="ip" value="$(ip)">
        <input type="hidden" name="hostname" value="$(hostname)">
        <input type="hidden" name="username" value="$(username)">
        <input type="hidden" name="link-login" value="$(link-login)">
        <input type="hidden" name="link-orig" value="$(link-orig)">
        <input type="hidden" name="error" value="$(error)">
        <input type="hidden" name="chap-id" value="$(chap-id)">
        <input type="hidden" name="chap-challenge" value="$(chap-challenge)">
        <input type="hidden" name="link-login-only" value="$(link-login-only)">
        <input type="hidden" name="link-orig-esc" value="$(link-orig-esc)">
        <input type="hidden" name="mac-esc" value="$(mac-esc)">
        <input type="hidden" name="salt" value="{{salt}}">
        <input type="submit" value="continue">
    </form>
    <form name="sendin" action="$(link-login-only)" method="post" target="login_area">
        <input type="hidden" name="username" />
        <input type="hidden" name="password" />

        <input type="hidden" name="popup" value="false" />
    </form>

	<iframe src="" name="login_area"></iframe>  
</div>

<script type="text/javascript">
    <!--
    var $_GET = (function(){
        var url = window.document.location.href.toString();
        var u = url.split("?");
        if(typeof(u[1]) == "string"){
            u = u[1].split("&");
            var get = {};
            for(var i in u){
                var j = u[i].split("=");
                get[j[0]] = j[1];
            }
            return get;
        } else {
            return {};
        }
    })();
    window.onload =function(){
        $("#tpl_title").text(dictionary.title);
        $("#tpl_message").text(dictionary.message);
        if(typeof($_GET["auth_code"])=='string' && $_GET["auth_code"]!=''){
            $.showLoading(dictionary.tips);
            var Url = '/portal/TextTokenSalt';
            var PostData = {'accesskey': '{{salt}}','mac':'{{mac}}','auth_code':$_GET['auth_code']};
            var chapId = '';
            var chapChallenge = '';
          
            initTokenSalt(Url,PostData,chapId,chapChallenge);
            return false;
        }else{
            setTimeout(function() {
                document.redirect.submit();
            }, 2000);
            
        }
    }
    function initTokenSalt(Url,PostData,chapId,chapChallenge){
        $.ajax({
            url: Url,
            type: 'POST',
            dataType: 'json',
            data: PostData
        })
        .done(function(ret) {
            //解密
            //alert(JSON.stringify(ret));
            if(ret.brand=='mikrotik'){
                var userName  = CryptoJS.AES.decrypt(ret.username, ret.pass);
                var passWord  = CryptoJS.AES.decrypt(ret.password, ret.pass);
                userName = userName.toString(CryptoJS.enc.Utf8);
                passWord = passWord.toString(CryptoJS.enc.Utf8);
                /*document.sendin.dst.value = ret.url;*/
                document.sendin.username.value = userName;
                if(chapId!='' && chapChallenge!='' && chapChallenge!=null && chapId!=null){
                    document.sendin.password.value =  hexMD5(chapId + passWord + chapChallenge);
                }else{
                    document.sendin.password.value = passWord;
                }
                document.sendin.submit();
            }
        /*    console.log(ret);
            return false;*/
            redirectApp(ret);
            return false;
        });
    }
 
    //-->
    </script>
</body>
</html>
