<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\phpStudy\WWW\md\public/../application/index\view\p\login.html";i:1529570467;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="__CSS__/style.css" />
		<link rel="stylesheet" href="__CSS__/bootstrap.min.css" />
        <script type="text/javascript" src = "__JS__/jquery-1.11.0.js"> </script>
        <script type="text/javascript" src = "__JS__/jquery.validate.js"> </script>
        <script type="text/javascript" src = "__JS__/tpl.js"> </script>
		<style>
			body{
				width: 100%;
				height: 100%;
				background: url(__IMG__/log.png) no-repeat left top;
			}
		</style>

        <script type="text/javascript">
        var cnmsg = {
            required: '请 选择 / 填写',
            remote: '请修正该字段',
            email: '请输入正确格式的电子邮件',
            url: '请输入合法的网址',
            date: '请输入合法的日期',
            dateISO: '请输入合法的日期 (ISO).',
            number: '请输入合法的数字',
            digits: '只能输入整数',
            creditcard: '请输入合法的信用卡号',
            equalTo: '请再次输入相同的值',
            accept: '请输入拥有合法后缀名的字符串',
            maxlength: jQuery.format('请输入一个长度最多是 {0} 的字符串'),
            minlength: jQuery.format('请输入一个长度最少是 {0} 的字符串'),
            rangelength: jQuery.format('请输入一个长度介于 {0} 和 {1} 之间的字符串'),
            range: jQuery.format('请输入一个介于 {0} 和 {1} 之间的值'),
            max: jQuery.format('请输入一个最大为 {0} 的值'),
            min: jQuery.format('请输入一个最小为 {0} 的值')
        };
        jQuery.extend(jQuery.validator.messages, cnmsg);

        $.validator.addMethod("ttz", function(value, element, params) {
              var doubles = /^1[34578]\d{9}$/;
              return this.optional(element) || (doubles.test(value));
          }, "手机号不正确");
        </script>
	</head>
	<body>
        <form   method="post">


                   <div class="logdiv">
                       <div class="loga">
                          <div class="loglogo">
                            <img src="__IMG__/loglogo_03.png" />
                          </div>
                          <div class="logt">天泉生态人文纪念公园业务管理系统 </div>
                       </div>
                       <div class="login">
                           <div class="logb">
                             <label>用户名：</label>
                             <input type="text" name="account" class="logc"/>
                             <span>xx</span>
                           </div>
                           <div class="logd">
                             <label>密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
                             <input type="password" name="pwd" class="loge"/>
                           </div>
                           <button class="logbtn" type="submit">登录</button>
                       </div>
                   </div>
        </form>


        <script type="text/javascript">


        $("form").validate({
            rules:{
                account:{
                    required:true,
                     ttz: true,
                },
                pwd:{
                    required:true,
                    rangelength:[6,20],
                },


            },
            errorClass: "help-inline",
            errorElement: "div",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            },
            ignore : "",

        });

        </script>



	</body>
</html>



<style media="screen">
.help-inline{
    font-size: 16px;
    color: red;
    display: block;
    position: absolute;
    left: 30%;
}
</style>
