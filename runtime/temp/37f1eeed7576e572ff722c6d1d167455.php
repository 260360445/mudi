<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\phpStudy\WWW\md\public/../application/index\view\system\syslx.html";i:1529632400;s:63:"D:\phpStudy\WWW\md\public/../application/index\view\layout.html";i:1529393625;}*/ ?>
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
                                   <div class="ghsz">
            <form  action="<?php echo url('syslx_add'); ?>" class="add_row" method="post">
              <fieldset>
                <legend>骨灰盒设置</legend>
                <div class="ghszm">
                  <div class="ghszma">
                    <div class="ghszmaa">
                      <p>骨灰盒名称</p>
                      <input type="text" name="title"/>
                    </div>
                    <div class="ghszmab">
                      <p>骨灰盒长</p>
                      <input type="text" name="cd"/>
                      <i>mm</i>
                    </div>
                    <div class="ghszmab">
                      <p>骨灰盒宽</p>
                      <input type="text" name="wd"/>
                      <i>mm</i>
                    </div>
                    <div class="ghszmab">
                      <p>骨灰盒高</p>
                      <input type="text" name="hd"/>
                      <i>mm</i>
                    </div>
                  </div>
                  <div class="ghszmb">
                    <div class="ghszmba">
                      <p>骨灰盒价格</p>
                      <input type="text" name="price"/>
                      <i>¥</i>
                    </div>
                    <div class="ghszmbb">
                      <p>选择材质</p>
                      <select name="sysysid">
                        <option value="">请选择</option>
                         <?php foreach($sysys as  $vo): ?>
                            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                    <button class="ghszmbc" type="submit"> 添加</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
          <div class="ghszbiao">
            <table class="table table-bordered">
             
              <thead>
                <tr>
                  <th>骨灰盒名称</th>
                  <th>材质名称</th>
                  <th>长</th>
                  <th>宽</th>
                  <th>高</th>
                  <th>价格</th>
                  
                </tr>
              </thead>
              <tbody class="wlist">
                   <?php foreach($sysls as  $vo): ?>
                        <tr class="tr_<?php echo $vo['id']; ?>" row_id = "<?php echo $vo['id']; ?>">
                          <td class = "row_title"><?php echo $vo['title']; ?></td>
                          <td class = "row_cem_id"  val = "<?php echo $vo['sysysid']; ?>"><?php echo $sysyst[$vo['sysysid']]['title']; ?></td>
                          <td ><font class = "row_cd"><?php echo $vo['cd']; ?></font>mm</td>
                          <td ><font class = "row_wd"><?php echo $vo['wd']; ?></font>mm</td>
                          <td ><font class = "row_hd"><?php echo $vo['hd']; ?></font>mm</td>
                          <td class = "row_price"><?php echo $vo['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="ghsz">
            <form  action="<?php echo url('syslx_edit'); ?>" method="post" class="edit_row">
              <fieldset>
                <legend>骨灰盒设置</legend>
                <div class="ghszm">
                  <div class="ghszma">
                    <div class="ghszmaa">
                      <p>骨灰盒名称</p>
                      <input type="text" name="title" class="ro_title"/>
                    </div>
                    <div class="ghszmab">
                      <p>骨灰盒长</p>
                      <input type="text" name="cd" class="ro_cd"/>
                      <i>mm</i>
                    </div>
                    <div class="ghszmab">
                      <p>骨灰盒宽</p>
                      <input type="text" name="wd" class="ro_wd"/>
                      <i>mm</i>
                    </div>
                    <div class="ghszmab">
                      <p>骨灰盒高</p>
                      <input type="text" name="hd" class="ro_hd"/>
                      <i>mm</i>
                    </div>
                  </div>
                  <div class="ghszmb">
                    <div class="ghszmba">
                      <p>骨灰盒价格</p>
                      <input type="text" name="price" class="ro_price"/>
                      <input type="hidden" name="id" class="row_id" />
                      <i>¥</i>
                    </div>
                    <div class="ghszmbb">
                      <p>选择材质</p>
                      <select name="sysysid" class="cem_id">
                         <option value="">请选择</option>
                         <?php foreach($sysys as  $vo): ?>
                            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                     <button type="submit" class="ghszmbc">修改</button>
                      <button type="button" class="ghszmbcs row_del">删除</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
<script>
  $('.wlist tr').click(function(){
      $(".edit_row .cem_id").val($(this).find('.row_cem_id').attr('val'));
      $(".edit_row .ro_title").val($(this).find('.row_title').text());
      $(".edit_row .ro_cd").val($(this).find('.row_cd').text());
      $(".edit_row .ro_wd").val($(this).find('.row_wd').text());
      $(".edit_row .ro_hd").val($(this).find('.row_hd').text());
      $(".edit_row .ro_price").val($(this).find('.row_price').text());
      $(".edit_row .row_id").val($(this).attr('row_id'));
  });
  $('.row_del').click(function(){
    var row_id = $(".edit_row .row_id").val();
    if (row_id && confirm('确认删除?')) {
        $.ajax({
            type        : 'GET',
            url         : '<?php echo url('syslx_del'); ?>',
            dataType    : 'json',
            data        : {
                id : row_id
            },
            success     : function(e){
                if (e.status) {
                    $('.tr_' + row_id).remove();
                } else {
                    alt(e.msg);
                }


            },
            error       : function () {

            },
        });
    }
});
</script>
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
