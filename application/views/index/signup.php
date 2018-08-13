<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{sign_up}} - Cloud Hotspot</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="icon" href="/favicon.ico?t=20160511" type="image/x-icon" />

    <link href="/Public/global.min.css" rel="stylesheet">

    <script src="//cdn.bootcss.com/jquery/2.2.2/jquery.min.js"></script>

    <style type="text/css">
    #switch_form{height: 40px;line-height: 40px;}
    #switch_form ul li{height: 40px;margin-right: 118px;text-align: center;
      cursor: pointer;}
    #switch_form ul li h3{
      text-align: center;
    font-size: 18px;
    font-weight: 400;
    color: #0c94de;
    }

    .header .logo{float:left;}
    .header ul {float: right;width: 60%;border: 1px solid white;height:100%;margin: 0px;}
    .header ul li{display: inline-block;width: 80px;height: 100%;line-height: 80px;}
    .menu{height: 80px;border-bottom:1px solid #ccc;overflow: hidden;position: fixed;top: 0px;z-index: 1000;width: 100%;}

   .menu__content{position:relative;margin:20px auto;width:80%;height:40px}
   .menu__content img{
    height: 68px;
    position: relative;
    top: -14px;
    }
  .menu__title{float:left;margin-top:-5px}
  .menu__link{display:block}
  .menu__logo{width:232px;height:46px}
  .menu .btn_home,.menu .btn_language{display:block;float:right;margin-left:27px;line-height:40px;text-decoration:none}
 /* .menu .btn_share{width:120px;height:40px;line-height:40px;background:#31c27c;border-radius:20px;text-align:center}body{background:#fff;color:#000}*/
  .btn_language{/*border: 1px solid silver; */clear: both;text-align: center;}
  .btn_language img{float: left;width: 38px;height: 24px;position:initial;margin-top: 8px;}
  select{height:40px;width:76px;line-height:40px;text-align: center;align-content: center;padding-left: 8px; border: none;float: right;}
  select option{text-align: center;}
  .getEmail{
    width: 88px;
    height: 35px;
    line-height: 35px;
    position: absolute;
    text-align: center;
    right: 142px;
    float: right;
    color: white;
    cursor: pointer;
    background-color: #47B347;
  }
  i.email{
  clear: both;
/*   position: relative;
top: -46px;
right: -54px;
float: right; */
  font-size: 12px;
  
  }
  i.pwd{font-size-adjust:12px;}

    </style>
  </head>
  
<body style="overflow: hidden;">


<div class="header">

     <div class="menu">
    <div class="menu__content">
        <img src="/Public/cloud-hotspot.png">
         <div role="button" class="btn_language">
          <img src="/Public/images/{% if clang=='en' %}english.png {% elseif clang=='zh' %}chinese.png{% endif %}">
          <select id="language">
            <option value='en' {% if clang == 'en' %} selected="selected" {% endif %}>English</option>
            <option value='zh' {% if clang == 'zh' %} selected="selected" {% endif %}>中文</option>
          </select>   
        </div>
    </div>
  </div>

</div>

<div class="main signin">
  <div class="center-content special-content">



    <div class="block special-block">
      
      <form method="POST" id="sigup" class="login-form" action="?" onsubmit="return check(this)">
        
         <div id="switch_form">
          <ul class="inline" style="height: 40px;">
            <li><a href="/user/signin"><h3>{{sign_in}}</h3></a></li>
            <li><a href="/user/signup"><h3>{{sign_up}}</a></h3></li>
          </ul>
        </div>
        <input type="hidden" name="goto" value="">
        <div style="position: static;">
          <input type="text" name="account" id="account" placeholder="{{account_fill}}" value="">      
          <i class="email"></i> 
        </div>
        
        <div style="position: static;">
            <input type="text" name="code" id="code" placeholder="{{verify_code_fill}}">
            <span class="getEmail" id="vcode">{{verify_code}}</span> 
            <i class="emailCode"></i> 
            <input type="hidden" id="auth_salt" name="auth_salt" value="">
        </div>
       
        <input type="password" name="password" id="password" placeholder="{{password_fill}}">
        <i class="pwd"></i>
                    
        <input type="password" name="confirm" id="confirm" placeholder="{{re_password_fill}}">
        <i class="conf"></i>         
        <div class="align-center line">
          <button class="btn login" id="submit" type="button">{{sign_up}}</button>
         
        </div>
      </form>
    </div>
   
  </div>
</div>
<div class="footer">
    <div class="center-content">

        <div class="main-footer">    
            <ul class="inline links">
              <li>Copyright © 2014-{{ "now"|date("Y") }}  Power by Cloud Hotspot</li>                      
            </ul>
        </div>


    </div>
</div>

<link href="//cdn.bootcss.com/toastr.js/2.0.3/css/toastr.min.css" rel="stylesheet">
<script src="//cdn.bootcss.com/toastr.js/2.0.3/js/toastr.min.js"></script>

<div id="box-bg" class="box-bg"></div>
<script type="text/javascript">

 toastr.options = {
  "closeButton": true,
  "debug": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "3000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
  
  $(function(){
    
    $("#account").blur(function(event) {
      var account = $(this).val();
      if(account=='') return false;      

      var p =Object.create(check);
      var flag = false;
      flag = p.mail(account);
      if(!flag) flag = p.phone(account);

      if(!flag){
        $(event.target).siblings('i.email').html("<i style='color:red'>{{wrong_email}}</i>");
        return false;
      }
      $.ajax({
        url: "/component/ajax/sigup",
        type: 'POST',
        dataType: 'json',
        data: {'account':account},
      })
      .done(function(ret) {
        if(ret.status=='ok'){
          $(event.target).siblings('i.email').html("<i style='color:green'>{{ok}}</i>");
        
        }else if(ret.status=='message'){          
          $(event.target).siblings('i.email').html("<i style='color:red'>{{taken}}</i>");          
        }else{
          
          $(event.target).siblings('i.email').html("<i style='color:red'>"+ret.message+"</i>");          
        }
      });
    });

    $("#account").focus(function(event) {
      $(this).siblings('i.email').html('');
      
    });

    $("#language").change(function(event) {   
      let lang = $(this).children('option:selected').val();
      window.location.href="?lang="+lang;      
    });

    $("#code").blur(function(event) {
      var code = $(this).val();
      if(code==''){
        return false;
      }
      var account = $("#account").val();

    
      $.ajax({
        url: "/component/verifyEmail/auth",
        type: 'POST',
        dataType: 'json',
        data: {'code': code,'account':account},
      })
      .done(function(ret) {
          //alert(ret.status);
          if(ret.status=='success'){
            $("#auth_salt").val(ret.auth_salt);
            $('i.emailCode').html("<i class='fa fa-check' style='color:green'>√</i>");
           
          }else{
             $('i.emailCode').html("<i class='fa fa-check' style='color:red;'>X</i>");
            
          }
      });
    });

    $("#code").focus(function(event) {
      $(".emailCode").html('');
    });

    $("#password").blur(function(event) {
      /* Act on the event */
      var password = $(this).val();
      if(password==''){
        return false;
      }

      if(password.length<6){
        $(event.target).siblings('i.pwd').html("<i style='color:red'>{{password_wrong}}</i>");     
        return false;
      }else{
        $(event.target).siblings('i.pwd').html("<i class='fa fa-check' style='color:green'>√</i>");
      }
    });

  
    $("#confirm").blur(function(event) {
      /* Act on the event */
      var password = $(this).val();
      if(password==''){
        return false;
      }


      var confirm = $("#password").val();
    
      if(password!=confirm){
        $(event.target).siblings('i.conf').html("<i style='color:red'>{{wrong_pass_t}}</i>");
        return false;
      }else{
        $(event.target).siblings('i.conf').html("<i class='fa fa-check' style='color:green'>√</i>");       

      }
    });

    $("#confirm").focus(function(event) {
      $(this).siblings('i.conf').html('');
      $(this).siblings('i.conf').html('');
    });

    $("#submit").click(function(event) {    
      let account = $("#account").val();
      let verify = $("#code").val();
      let password = $("#password").val();
      let confirm = $("#confirm").val();
      let flag = false;
      let p =Object.create(check);
      flag = p.mail(account);   
      if(!flag) flag = p.phone(account);  
      if(!flag){
        $("#account").focus();
        toastr.warning("{{wrong_email}}");  
        return false;
      }

      if(verify==''){
        $("#code").focus();     
        toastr.warning("{{verify_code_fill}}"); 
        return false;
      }

      if(password==''){
        $("#password").focus();     
        toastr.warning("{{pass_tips}}!"); 
        return false;
      }

      if(password!=confirm){
        $("#confirm").siblings('i.conf').html("<i style='color:red'>{{wrong_pass_t}}!</i>"); 
              
        return false;
      }else{
        $("#confirm").siblings('i.conf').html("<i class='fa fa-check' style='color:green'>√</i>");       

      }


      $.ajax({
        url: '/component/register',
        type: 'POST',
        dataType: 'json',
        data: {'account':account,'verify':verify,'password':password,'confirm':confirm},
      })
      .done(function(ret) {
        if(ret.status=='success'){
            
          {% if from=='auth' and salt is not null %}
              window.location.href="/manage/index?from=auth&salt={{salt}}";
          {% else %}
              window.location.href="/manage/index";
          {% endif %}
         
                 
        }else if(ret.status=='false'){
          toastr.warning(ret.message); 
        }
      });
      
    });

    $("#vcode").click(function(){
      let account = $("#account").val();
      let p =Object.create(check);
      let flag = false;
      flag = p.mail(account);
      if(!flag) flag = p.phone(account);

      if(!flag){
        toastr.warning("{{wrong_email}}");  
        $("#account").focus();
        return false;
      }
      sms(account);
    });

  });

  var check = {
    mail:function(mail){
      let reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
      if(!reg.test(mail)) return false;
      return true;
    },
    phone:function(phone){
      let myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1}))+\d{8})$/; 
      if(!myreg.test(phone)) return false;
      return true;
    },
  }


  var TC = {
    EndTime:60,
    intvalue:0,
    controll:'vcode',
    cont:null,
    startShow:function(){   
      this.intvalue ++;
      document.getElementById(this.controll).innerHTML="&nbsp;" + ((this.EndTime-this.intvalue)%60).toString()+"s";
      if(this.intvalue>=this.EndTime){
        document.getElementById(this.controll).innerHTML="{{verify_code}}";
        this.endShow();
      }
    },
    endShow:function(){
      window.clearTimeout(this.cont);
      this.intvalue=0;
      this.cont=null;
    },
    

  }

  var c =Object.create(TC);
  function sms(account){
    if(c.cont==null){        
      $.ajax({
        url: '/component/verifyCode/get',
        type: 'POST',
        dataType: 'json',
        data: {'account': account},
      })
      .done(function(ret) {
        if(ret.status=='success'){
          c.cont = window.setInterval("c.startShow()",1000);
          toastr.success("{{code_has_been_sent}}");
        }else{
          toastr.warning(ret.message);  
        }
      });

    } 
  }

 function testEmail(str){
    var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    if(reg.test(str)){
      return true;
    }else{
      return false;
    }
 }

</script>
</body>
</html>