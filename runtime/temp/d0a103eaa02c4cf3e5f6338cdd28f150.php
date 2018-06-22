<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"D:\phpStudy\WWW\md\public/../application/index\view\gset\gset.html";i:1529636312;s:63:"D:\phpStudy\WWW\md\public/../application/index\view\layout.html";i:1529393625;}*/ ?>
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
                         <div class="cont">
          <div class="wptj">
            <form action="<?php echo url('gset_add'); ?>" class="add_row" method="post">
              <fieldset>
                <legend>物品信息添加</legend>
                <div class="wptja">
                  <p>物品编号</p>
                  <input type="text" name="sn" maxlength="10"/>
                </div>
                <div class="wptjb">
                  <p>物品名称</p>
                  <input type="text" name="title" maxlength="50"/>
                </div>
                <div class="wptja">
                  <p>物品单价</p>
                  <input type="text" name="price" maxlength="10"/>
                  <i>¥</i>
                </div>
                <div class="wptjb">
                  <p>物品单位名称</p>
                  <input type="text" name="type" maxlength="10"/>
                </div>
                <div class="wptjc">
                  <p>物品简介</p>
                  <input type="text" name="cont" maxlength="50" />
                </div>
                <div class="wptjd">
                  <button class="wptjda" type="submit"> 添加</button>
                </div>
              </fieldset>
            </form>
          </div>
          <div class="wptjbiao">
            <table class="table table-bordered">
             
              <thead>
                <tr>
                  <th>物品编号</th>
                  <th>物品名称</th>
                  <th>物品价格</th>
                  <th>物品单位</th>
                  <th>物品简介</th>
                </tr>
              </thead>
              <tbody class="wlist">
                 <?php foreach($glist as  $vo): ?>
                      <tr class="tr_<?php echo $vo['id']; ?>" row_id = "<?php echo $vo['id']; ?>">
                        <td class = "row_sn"><?php echo $vo['sn']; ?></td>
                        <td class = "row_title"><?php echo $vo['title']; ?></td>
                        <td class = "row_price"><?php echo $vo['price']; ?></td>
                        <td class = "row_type"><?php echo $vo['type']; ?></td>
                        <td class = "row_cont"><?php echo $vo['cont']; ?></td>
                      </tr>
                  <?php endforeach; ?>         
              </tbody>
            </table>
          </div>
          <div class="wptj">
            <form  method="post" action="<?php echo url('gset_edit'); ?>" class="edit_row">
              <fieldset>
                <legend>物品信息添加</legend>
                <div class="wptja">
                  <p>物品编号</p> 
                  <input type="text" name="sn" maxlength="10" class = "row_sn"/>
                </div>
                <div class="wptjb">
                  <p>物品名称</p>
                  <input type="text" name="title" maxlength="50" class="row_title" />
                </div>
                <div class="wptja">
                  <p>物品单价</p>
                  <input type="text" name="price" maxlength="10" class = "row_price"/>
                  <input type="hidden" name="id" class="row_id" />
                  <i>¥</i>
                </div>
                <div class="wptjb">
                  <p>物品单位名称</p>
                  <input type="text" name="type" maxlength="10" class = "row_type"/>
                </div>
                <div class="wptjc">
                  <p>物品简介</p>
                  <input type="text" name="cont" maxlength="50" class = "row_cont"/>
                </div>
                <div class="wptje">
                  <button class="wptjea" type="submit">修改</button>
                  <button class="wptjeb row_del" type="button">删除</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
 <script type="text/javascript">
  $('.wlist tr').click(function(){
      let tr = $(this);
      $('.edit_row').find('.row_title').val(tr.find('.row_title').text());
      $('.edit_row').find('.row_sn').val(tr.find('.row_sn').text());
      $('.edit_row').find('.row_price').val(tr.find('.row_price').text());
      $('.edit_row').find('.row_type').val(tr.find('.row_type').text());
      $('.edit_row').find('.row_cont').val(tr.find('.row_cont').text());
      $('.edit_row').find('.row_id').val(tr.attr('row_id'));
  });
  $('.row_del').click(function(){
  var row_id = $(".edit_row .row_id").val();
  if (row_id && confirm('确认删除?')) {
      $.ajax({
          type        : 'GET',
          url         : '<?php echo url('gset_del'); ?>',
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
