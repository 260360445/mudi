<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"D:\phpStudy\WWW\md\public/../application/index\view\system\sysjcc.html";i:1529643899;s:63:"D:\phpStudy\WWW\md\public/../application/index\view\layout.html";i:1529393625;}*/ ?>
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
                         <div class="mwshezhi">
     <div class="mwnav">
        <ul>
         <li ><a href="<?php echo url('System/sysjc'); ?>">寄存厅设置</a></li>
          <li><a href="<?php echo url('System/sysjct'); ?>">寄存室设置</a></li>
          <li class="navon"><a href="<?php echo url('System/sysjcc'); ?>">寄存层设置</a></li>
          <li><a href="<?php echo url('System/sysjcw'); ?>">寄存位设置</a></li>
        </ul>
      </div>
    <div class="mwmain">
      <div class="mwd">
                <div class="mwdba">
                  <form  method="post" action="<?php echo url('sysjcc_add'); ?>" class="add_row">
                    <fieldset>
                      <legend>寄存层设置一添加</legend>
                      <div class="mqsz">
                        <div class="mqsza">
                           <div class="mqszaa">
                               <p>选择寄存厅</p>
                               <select name="sysid" class="cem_id" >
                                  <option >请选择</option>
                                  <?php foreach($sys_list as $k => $vo): ?>
                                       <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
                                  <?php endforeach; ?>
                               </select>
                           </div>
                           <div class="mqszab">
                               <p>选择寄存室</p>
                               <select name="sysid_s" class="cem_area_id" id="cem_area_id_s">
                                  <option >请选择</option>
                               </select>
                           </div>
                        </div>
                        <div class="mqszb">
                          <div class="mqszba">
                              <input type="radio" name="type"  value="many" />批量处理
                           </div>
                           <div class="mqszbb">
                              <input type="radio" name="type"  checked value="one" />单条处理
                           </div>
                        </div>
                       <div class="mqszc">
                           <p>寄存层开始编号</p>
                           <input type="text" name="many_start" />
                           <input type="text" name="title" />
                       </div>
                       <div class="mqszd">
                           <p>寄存层数量</p>
                           <input type="text"  name="num" />
                           <h1>请填写单个寄存层号（数字）</h1>
                       </div>
                       <button  type="submit" class="mqsze">添加</button>
                      </div>
                    </fieldset>
                  </form>
                </div>
                <div class="mwdbb">
                  <div class="mwdbble">
                    <table class="table table-bordered">                      
                      <thead>
                        <tr>
                           <th>寄存厅名称</th>
                           <th>寄存室名称</th>
                           <th>寄存层名称</th>
                        </tr>
                      </thead>
                      <tbody class="wlist">
                        <tr>
                           <?php foreach($sysjcc as $k=>$vo): ?>
                                <tr class="tr_<?php echo $vo['id']; ?>" row_id = "<?php echo $vo['id']; ?>">
                                   <td class="row_cem_id"        val = "<?php echo $vo['sysid']; ?>"       ><?php echo $sys_list[$vo['sysid']]['title']; ?></td>
                                   <td class="row_cem_area_id"   val = "<?php echo $vo['sysid_s']; ?>"  ><?php echo $sys_list_s[$vo['sysid_s']]['title']; ?></td>
                                   <td class="row_title"> <?php echo $vo['title']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tr>                      
                      </tbody>
                    </table>
                  </div>
                  <div class="mwdbbri">
                    <form action="<?php echo url('sysjcc_edit'); ?>" method="post" class="edit_row">
                         <fieldset>
                             <legend>寄存层设置一修改</legend>
                             <div class="mqxg">
                                 <div class="mqxga">
                                     <p>寄存厅</p>
                                     <select name="sysid" class="cem_id">
                                         <option >请选择</option>
                                         <?php foreach($sys_list as $k => $vo): ?>
                                             <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                 </div>
                                 <div class="mqxga">
                                     <p>寄存室</p>
                                     <select name="sysid_s" class="cem_area_id">
                                        <option >请选择</option>

                                     </select>
                                 </div>
                                 <div class="mqxga">
                                     <p>寄存层名称</p>
                                     <input type="text" class="row_title" name="title" />
                                         <input type="hidden" name="id" class="row_id" />
                                 </div>
                                 <div class="mqxgb">
                                     <button type="submit" class="mqxgcontc">修改</button>
                                     <button type="button" class="mqxgcontcs row_del">删除</button>
                                 </div>
                             </div>
                         </fieldset>
                     </form>
                  </div>
                </div>
              </div>
    </div>
    <iframe id = "iframeSon" style = "display:none;" src = "<?php echo url('p/upload'); ?>"> </iframe>
  </div>
<script type="text/javascript">
            $('.mqszb input').click(function(){
                if ($(this).val() == 'one') {
                    $('.add_row').addClass('one_form');
                    $('.add_row').removeClass('many_form');
                } else {
                    $('.add_row').removeClass('one_form');
                    $('.add_row').addClass('many_form');
                }
            })
            $('.wlist tr').click(function(){
                $(".edit_row .cem_id").val($(this).find('.row_cem_id').attr('val'));
                get_area($(".edit_row .cem_id"), $(this).find('.row_cem_area_id').attr('val') );
                // $(".edit_row .row_cem_area_id").val($(this).find('.row_cem_area_id').attr('val'));
                $(".edit_row .row_title").val($(this).find('.row_title').text());
                $(".edit_row .row_id").val($(this).attr('row_id'));
            });
        </script>
<script type="text/javascript">
    function get_area (_this, _select_id) {
        // var _select_id = _select_id ? _select_id : 0;
        let cem_id = _this.val();
        let form = _this.parents('form');
        if (cem_id) {
            $.ajax({
                type        : 'GET',
                url         : '<?php echo url('sysjcc_wlist'); ?>',
                dataType    : 'json',
                data        : {
                    cem_id : cem_id
                },
                success     : function(e){
                    let html = '<option >请选择</option>';
                    for (i in e) {
                        html += '<option ';
                        if (_select_id == e[i]['id']) {
                            html += 'selected';
                        }
                        html += ' value="'+e[i]['id']+'">'+e[i]['title']+'</option>';
                    }
                    form.find('.cem_area_id').html(html);
                },
                error       : function () {

                },
            });
        }
    }
    $('.cem_id').change(function(){
        get_area($(this), '-1');
    });
</script>

<script type="text/javascript">
$('.slimg').click(function(){
   $( "#iframeSon" ).contents().find("#file").click();
});
function new_img (src) {
    $('.row_img').attr('src', src);
    $('.row_thumb').val(src);
}
$('.row_add').click(function(){
    $('.add_row').attr('action', "<?php echo url('sysjc_add'); ?>").submit();

});

$('.row_edit').click(function(){
    $('.add_row').attr('action', "<?php echo url('sysjc_edit'); ?>").submit();
});

$('.row_del').click(function(){
    var row_id = $(".edit_row .row_id").val();
    if (row_id && confirm('确认删除?')) {
        $.ajax({
            type        : 'GET',
            url         : '<?php echo url('sysjcc_del'); ?>',
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
