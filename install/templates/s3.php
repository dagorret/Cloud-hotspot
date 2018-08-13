<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title><?php echo $Title; ?> - <?php echo $Powered; ?></title>
<link rel="stylesheet" href="./css/install.css?v=9.0" />
</head>
<body>
<div class="wrap">
  <?php require './templates/header.php';?>
  <section class="section">
    <div class="step">
      <ul>
        <li class="on"><em>1</em><?php echo $dictionary['environment'];?></li>
        <li class="current"><em>2</em><?php echo $dictionary['server'];?></li>
        <li><em>3</em><?php echo $dictionary['installation'];?></li>
      </ul>
    </div>
    <form id="J_install_form" action="index.php?step=4" method="post">
      <input type="hidden" name="force" value="0" />
      <div class="server">
        <table width="100%">
          <tr>
            <td class="td1" width="100"><?php echo $dictionary['database'];?></td>
            <td class="td1" width="200">&nbsp;</td>
            <td class="td1">&nbsp;</td>
          </tr>
		  <tr>
            <td class="tar"><?php echo $dictionary['mysql_server'];?>：</td>
            <td><input type="text" name="dbhost" id="dbhost" value="localhost" class="input"></td>
            <td><div id="J_install_tip_dbhost"><span class="gray">数据库服务器地址，一般为localhost</span></div></td>
          </tr>

		  <tr>
            <td class="tar"><?php echo $dictionary['mysql_port'];?>：</td>
            <td><input type="text" name="dbport" id="dbport" value="3306" class="input"></td>
            <td><div id="J_install_tip_dbport"><span class="gray">数据库服务器端口，一般为3306</span></div></td>
          </tr>

            <tr>
                <td class="tar"><?php echo $dictionary['database_name'];?>：</td>
                <td><input type="text" name="dbname" id="dbname" value="youtu" class="input"></td>
                <td><div id="J_install_tip_dbname"></div></td>
            </tr>


            <tr>
                <td class="tar"><?php echo $dictionary['db_prefix'];?>：</td>
                <td><input type="text" name="dbprefix" id="dbprefix" value="zh_" class="input"></td>
                <td><div id="J_install_tip_dbprefix"><span class="gray">建议使用默认，同一数据库安装多个优思软件时需修改</span></div></td>
            </tr>


          <tr>
            <td class="tar"><?php echo $dictionary['db_user'];?>：</td>
            <td><input type="text" name="dbuser" id="dbuser" value="root" class="input"></td>
            <td><div id="J_install_tip_dbuser"></div></td>
          </tr>
          <tr>
            <td class="tar"><?php echo $dictionary['db_pass'];?>：</td>
            <td><input type="text" name="dbpw" id="dbpw" value="" class="input" autoComplete="off" onblur="TestDbPwd()"></td>
            <td><div id="J_install_tip_dbpw"></div></td>
          </tr>

        </table>
	
        <table width="100%">
          <tr>
            <td class="td1" width="100"><?php echo $dictionary['user_info'];?></td>
            <td class="td1" width="200">&nbsp;</td>
            <td class="td1">&nbsp;</td>
          </tr>
          <tr>
            <td class="tar"><?php echo $dictionary['administrator'];?>：</td>
            <td><input type="text" name="manager" value="admin" class="input"></td>
            <td><div id="J_install_tip_manager"></div></td>
          </tr>
          <tr>
            <td class="tar"><?php echo $dictionary['ad_password'];?>：</td>
            <td><input type="text" name="manager_pwd" id="J_manager_pwd" class="input" autoComplete="off"></td>
            <td><div id="J_install_tip_manager_pwd"></div></td>
          </tr>
          <tr>
            <td class="tar"><?php echo $dictionary['ad_confirm'];?>：</td>
            <td><input type="text" name="manager_ckpwd" class="input" autoComplete="off"></td>
            <td><div id="J_install_tip_manager_ckpwd"></div></td>
          </tr>
          <tr>
            <td class="tar"><?php echo $dictionary['ad_email'];?>：</td>
            <td><input type="text" name="manager_email" class="input" value=""></td>
            <td><div id="J_install_tip_manager_email"></div></td>
          </tr>
        </table>
        <div id="J_response_tips" style="display:none;"></div>
      </div>
      <div class="bottom tac"> <a href="./index.php?step=2" class="btn"><?php echo $dictionary['previous'];?></a>
        <button type="submit" class="btn btn_submit J_install_btn"><?php echo $dictionary['submit'];?></button>
      </div>
    </form>
  </section>
  <div  style="width:0;height:0;overflow:hidden;"> <img src="./images/install/pop_loading.gif"> </div>
  <script src="./js/jquery.js?v=9.0"></script> 
  <script src="./js/validate.js?v=9.0"></script> 
  <script src="./js/ajaxForm.js?v=9.0"></script> 
  <script>
  function TestDbPwd()
    {

        var dbHost = $('#dbhost').val();
        var dbUser = $('#dbuser').val();
        var dbPwd = $('#dbpw').val();
        var dbName = $('#dbname').val();
        var dbPort = $('#dbport').val();
        data={'dbHost':dbHost,'dbUser':dbUser,'dbPwd':dbPwd,'dbName':dbName,'dbPort':dbPort};
        var url =  "./index.php?step=3&testdbpwd=1";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            beforeSend:function(){				 
            },
            success: function(msg){
                if(msg){
                    
                }else{
				    $('#dbpw').val("");
                    $('#J_install_tip_dbpw').html('<span for="dbname" generated="true" class="tips_error" style="">数据库链接配置失败</span>');	
                }
            },
            complete:function(){
            },
            error:function(){
                $('#J_install_tip_dbpw').html('<span for="dbname" generated="true" class="tips_error" style="">数据库链接配置失败</span>');		
				$('#dbpw').val("");
            }
        });
    }
$(function(){

	//聚焦时默认提示
	var focus_tips = {
		dbhost : '数据库服务器地址，一般为localhost',
		dbport : '数据库服务器端口，一般为3306',
		dbuser : '',
		dbpw : '',
		dbname : '',
		dbprefix : '建议使用默认，同一数据库安装多个时需修改',
		manager : '<?php echo $dictionary['manager'];?>',
		manager_pwd : '',
		manager_ckpwd : '',
		sitename : '',
		siteurl : '若你的程序安装在目录下，请增加目录名。不加'/'结尾',
		sitekeywords : '',
		siteinfo : '',
		manager_email : ''
	};


	var install_form = $("#J_install_form"),
			reg_username = $('#J_reg_username'),						//用户名表单
			reg_password = $('#J_reg_password'),						//密码表单
			reg_tip_password = $('#J_reg_tip_password'),		//密码提示区
			response_tips = $('#J_response_tips');				//后端返回提示

	//validate插件修改了remote ajax验证返回的response处理方式；增加密码强度提示 passwordRank
	install_form.validate({
		//debug : true,
		//onsubmit : false,
		errorPlacement: function(error, element) {
			//错误提示容器
			$('#J_install_tip_'+ element[0].name).html(error);
		},
		errorElement: 'span',
		//invalidHandler : , 未验证通过 回调
		//ignore : '.ignore' 忽略验证
		//onkeyup : true,
		errorClass : 'tips_error',
		validClass		: 'tips_error',
		onkeyup : false,
		focusInvalid : false,
		rules: {
			dbhost: {
				required	: true
			},
			dbport:{
			    required	: true
			},
			dbuser: {
				required	: true
			},
			/* dbpw: {
				required	: true
			}, */
			dbname: {
				required	: true
			},
			dbprefix : {
				required	: true
			},
			manager: {
				required	: true
			},
			manager_pwd: {
				required	: true
			},
			manager_ckpwd: {
				required	: true,
				equalTo : '#J_manager_pwd'
			},
			manager_email: {
				required	: true,
				email : true
			}
		},
		highlight	: false,
		unhighlight	: function(element, errorClass, validClass) {
			var tip_elem = $('#J_install_tip_'+ element.name);

				tip_elem.html('<span class="'+ validClass +'" data-text="text"><span>');

		},
		onfocusin	: function(element){
			var name = element.name;
			$('#J_install_tip_'+ name).html('<span data-text="text">'+ focus_tips[name] +'</span>');
			$(element).parents('tr').addClass('current');
		},
		onfocusout	:  function(element){
			var _this = this;
			$(element).parents('tr').removeClass('current');
			
			if(element.name === 'email') {
				//邮箱匹配点击后，延时处理
				setTimeout(function(){
					_this.element(element);
				}, 150);
			}else{
			
				_this.element(element);
				
			}
			
		},
		messages: {
			dbhost: {
				required	: '数据库服务器地址不能为空'
			},
			dbport:{
			    required	: '数据库服务器端口不能为空'
			},
			dbuser: {
				required	: '数据库用户名不能为空'
			},
			dbpw: {
				required	: '数据库密码不能为空'
			},
			dbname: {
				required	: '数据库名不能为空'
			},
			dbprefix : {
				required	: '数据库表前缀不能为空'
			},
			manager: {
				required	: '<?php echo $dictionary['user_tips'];?>'
			},
			manager_pwd: {
				required	: '<?php echo $dictionary['pass_tips'];?>'
			},
			manager_ckpwd: {
				required	:'<?php echo $dictionary['confirm_tips'];?>',
				equalTo : '<?php echo $dictionary['wrong_pass_t'];?>'
			},
			manager_email: {
				required	: '<?php echo $dictionary['email_tips'];?>',
				email : '<?php echo $dictionary['wrong_email_t'];?>'
			}
		},
		submitHandler:function(form) {
			form.submit();
			return true;
		}
	});


	var _data = {};
});
</script> 
</div>
<?php require './templates/footer.php';?>
</body>
</html>