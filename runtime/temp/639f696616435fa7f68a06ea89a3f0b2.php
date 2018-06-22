<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\phpStudy\WWW\md\public/../application/index\view\index\index.html";i:1529380646;s:63:"D:\phpStudy\WWW\md\public/../application/index\view\layout.html";i:1529393625;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<link rel="stylesheet" href="__CSS__/bootstrap.min.css" />
		<link rel="stylesheet" href="__CSS__/style.css" />
        <script type="text/javascript" src = "__JS__/jquery-1.11.0.js"> </script>
        <script type="text/javascript" src = "__JS__/jquery.validate.js"> </script>
        <script type="text/javascript" src = "__JS__/tpl.js"> </script>


        <link rel="stylesheet" href="__CSS__/zTreeStyle.css" />
        <script type="text/javascript" src="__JS__/jquery.ztree.core.js" ></script>
        <script type="text/javascript" src="__JS__/jquery.ztree.excheck.js" ></script>


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
                    rangelength: jQuery.format('长度 {0} - {1} '),
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
		<div class="all">
			<div class="header">
				<div class="headle">
					<div class="headlea">
						<img src="__IMG__/logo_03.png" />
					</div>
					<div class="headleb">
						<img src="__IMG__/logo_04.png" />
					</div>
				</div>
				<div class="headri">
					<p>欢迎您，<?php echo session('nickname'); ?>【<a href="<?php echo url('p/out'); ?>"> 退出</a>】</p>
				</div>
			</div>
			<div class="nav">
				<ul>
                    <?php foreach($top_meun as $vo): ?>
		               <li
                            <?php if($vo['id'] == $path_info['pid']): ?>
                                class="diffli"
                            <?php endif; ?>
                       ><a href="<?php echo url($vo['client_path']); ?>"><?php echo $vo['name']; ?></a></li>
                    <?php endforeach; ?>
				</ul>
			</div>
			<div class="main">
				<div class="menu">
					<div>功能菜单</div>
					<ul>


                    <?php foreach($left_meun as $vo): ?>
   		                <li><a href="<?php echo url($vo['client_path']); ?>"><?php echo $vo['name']; ?></a></li>
                    <?php endforeach; ?>

					</ul>
				</div>
				<div class="cont">
                         <form>
    <fieldset>
        <legend>墓位范围</legend>

       <div class="conta">
          <p>选择墓园</p>
          <p>选择墓区</p>
          <p>选择墓排</p>


       </div>
       <div class="contb">
           <select>
                <option>天福园</option>
            </select>
            <select>
                <option>A区</option>
            </select>
            <select>
                <option>1排</option>
            </select>

            <div class="contc">显示全部墓位定购信息</div>

            <div class="contc">退出</div>
       </div>
    </fieldset>

</form>
<div class="conbiao">
    <table class="table table-bordered">
      <!--<caption>边框表格布局</caption>-->
      <thead>
        <tr>
          <th>墓位全称</th>
          <th>墓位状态</th>
          <th>购墓状态</th>
          <th>是否已付费</th>
          <th>购墓日期</th>
          <th>使用开始日期</th>
          <th>使用结束日期</th>
          <th>墓位原价</th>
          <th>实际墓位费</th>
          <th>预订金额</th>
          <th>定购应付总额</th>
          <th>年管理费</th>
          <th>管理费缴纳年数</th>
          <th>管理费缴纳总额</th>
          <th>联系人姓名</th>
          <th>故者关系名称</th>
          <th>性别</th>
          <th>身份证号</th>
          <th>联系电话</th>
          <th>手机</th>
          <th>邮政编码</th>
          <th>家庭住址</th>
          <th>工作单位</th>
          <th>电子邮件</th>
          <th>备注</th>
          <th>操作员</th>
          <th>操作员姓名</th>
          <th>业务员</th>
          <th>业务员姓名</th>
          <th>墓位号</th>
          <th>当日销售流水号</th>
          <th>合同编号</th>

        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Cem2017010812355</td>
          <td>天祥园A区1排0009号</td>
          <td>已下葬</td>
          <td>刘丛礼</td>
          <td>男</td>
          <td>2017-1-12</td>
          <td>已落葬</td>
          <td>购买家属</td>
           <td>Cem2017010812355</td>
          <td>天祥园A区1排0009号</td>
          <td>已下葬</td>
          <td>刘丛礼</td>
          <td>男</td>
          <td>2017-1-12</td>
          <td>已落葬</td>
          <td>购买家属</td>
           <td>Cem2017010812355</td>
          <td>天祥园A区1排0009号</td>
          <td>已下葬</td>
          <td>刘丛礼</td>
          <td>男</td>
          <td>2017-1-12</td>
          <td>已落葬</td>
          <td>购买家属</td>
           <td>Cem2017010812355</td>
          <td>天祥园A区1排0009号</td>
          <td>已下葬</td>
          <td>刘丛礼</td>
          <td>男</td>
         <td>天祥园A区1排0009号</td>
          <td>已下葬</td>
          <td>刘丛礼</td>
        </tr>

      </tbody>
    </table>
</div>

	             </div>
		    <div class="bota">
		    	<div class="botd">
		    		<p>当前预订墓位中，7天内将过期的有：<i>0个</i></p>
		    		<a>查看</a>
		    	</div>
		    	<div class="botd">
		    		<p>|已定购墓位中，管理费5天内将过期的有：<i>0个</i></p>
		    		<a>查看</a>
		    	</div>
		    	<div class="botd">
		    		<p>|已落葬墓位中，5天内需祭祀的有：<i>131个</i></p>
		    		<a>查看</a>
		    	</div>
		    </div>
		    <div class="botb">
		    	<div class="botba">
		    		<img src="__IMG__/botb_03.png" />
		    		<select></select>
		    		<p>当前登录用户：芙米科技 | 姓名：芙米科技 | 您的系统用户身份为：管理员</p>
		    		<img src="__IMG__/botb_05.png" />
		    		<select></select>
		    		<p>今天是：2018年4月16日&nbsp;&nbsp;当前时间：13:39:59</p>
		    		<img src="__IMG__/botb_07.png" />
		    		<select></select>
		    	</div>
		    </div>
		</div>
	</body>
</html>


<style media="screen">
.help-inline{
    /* font-size: 16px; */
    color: red;
    display: block;
    /* position: absolute; */
    left: 30%;

    font-size: 10px;
	color: red;
	/* position: absolute; */
	left: 80px;
	top: 24px;
	z-index: 10;

}
</style>
