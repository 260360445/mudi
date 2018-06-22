<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\phpStudy\WWW\md\public/../application/index\view\deposit\dep_wh.html";i:1529665339;s:63:"D:\phpStudy\WWW\md\public/../application/index\view\layout.html";i:1529663047;}*/ ?>
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
        <script type="text/javascript" src="__JS__/layer/layer.js" ></script>


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
                         <form class="add_row">
    <fieldset>
        <legend>寄存位查询</legend>                          
       <div class="conta">
          <p>选择寄存厅</p>
          <p>选择寄存室</p>
          <p>选择寄存层</p>
          <p>寄存位样式</p>
       
         
       </div>
       <div class="contb">
           <select name="sysid" class="cem_id" >
                <option >请选择</option>
                  <?php foreach($sys_list as $k => $vo): ?>
                      <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
                  <?php endforeach; ?>
                </select>
           <select name="sysid_s" class="cem_area_id" id="cem_area_id_s">
                  <option >请选择</option>
            </select>
           <select name="sysid_c" class="cem_area_id_c" id="cem_area_id_c">
                  <option >请选择</option>
            </select>
            <select name="sysysid" class="sysysid">
              <option value="">请选择</option>
               <?php foreach($sysys as  $vo): ?>
                  <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="button" class=" contc show_all">显示全部</button>
            <div class="contc">退出</div>
       </div>
    </fieldset>
    <div class="ding wlist">
      <?php foreach($sysjcw as $k=>$vo): ?>
            <div class="dinga"  class="tr_<?php echo $vo['id']; ?>" row_id = "<?php echo $vo['id']; ?>">
              <a href="javascript:open('<?php echo $vo['id']; ?>');">
                <div class="dingimg">
                   <img src="__UPLAD__<?php echo $sys_list[$vo['sysid']]['img']; ?>" style="width:42px;height:42px;"/>
                </div>
                <p><?php echo $vo['long_title']; ?></p>
              </a>
            </div>
        <?php endforeach; ?>
    </div>
</form>
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
