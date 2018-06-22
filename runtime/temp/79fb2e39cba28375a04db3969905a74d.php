<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"D:\phpStudy\WWW\md\public/../application/index\view\role\wlist.html";i:1529380646;s:63:"D:\phpStudy\WWW\md\public/../application/index\view\layout.html";i:1529393625;}*/ ?>
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
                         <div class="usercon">
    <div class="userconle">
        <form method="post" action="<?php echo url('add'); ?>" class="add_row">
            <fieldset>
                <legend>用户角色设置一添加</legend>
                <div class="usersz">
                    <div class="usersza">
                        <p>用户角色名称</p>
                        <input type="text" name="title"/>
                    </div>
                    <div class="userszb">
                        <p>销售折扣权限</p>
                        <input type="text" name="discount"/>
                    </div>
                    <button class="userszc" type="submit">添加</button>
                </div>

            </fieldset>
        </form>
        <div class="userbiao">
            <table class="table table-bordered">
              <!--<caption>边框表格布局</caption>-->
              <thead>
                <tr>
                  <th>用户角色名称</th>
                  <th>销售折扣权限(两位小数)</th>
                  <th>角色编号</th>

                </tr>
              </thead>
              <tbody class="wlist">
                    <?php foreach($list as $vo): ?>
                        <tr row_id  = "<?php echo $vo['id']; ?>">
                          <td class = "row_title"><?php echo $vo['title']; ?></td>
                          <td class = "row_discount"><?php echo $vo['discount']; ?></td>
                          <td class = "row_sn"><?php echo $vo['sn']; ?></td>
                        </tr>
                    <?php endforeach; ?>
              </tbody>
            </table>
        </div>

    </div>
    <div class="userconri">
        <form method="post" action="<?php echo url('edit'); ?>" class="edit_row">
            <fieldset>
                <legend>角色设置</legend>
                <div class="userxg">
                    <div class="userxga">
                        <p>用户角色编号</p>
                        <input type="text" name="sn" class="row_sn"/>
                    </div>
                    <div class="userxga">
                        <p>用户角色名称</p>
                        <input type="text"  name="title" class="row_title" />
                    </div>
                    <div class="userxga">
                        <p>销售折扣权限</p>
                        <input type="text" name="discount" class="row_discount" />
                    </div>

                    <input type="hidden" name="id" class="row_id" />

                    <div class="usermenu">
                        <p>用户菜单选择</p>
                        <div class="usermenud">
                            <!--menu-->
                            <div class="zTreeDemoBackground left">
                                <ul id="treeDemo" class="ztree"></ul>
                            </div>
                        </div>
                    </div>
                    <button class="userbao" type="submit">保存用户菜单</button>
                </div>

            </fieldset>
        </form>
    </div>
</div>

<script type="text/javascript">


$(".edit_row").validate({
    rules:{
        title:{
            required:true,
        },
        id:{
            required:true,
        },
        discount: {
            required:true,
            max:1,
            min:0.001,
            number:true,
        }

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

$(".add_row").validate({
    rules:{
        title:{
            required:true,
        },
        id:{
            required:true,
        },
        discount: {
            required:true,
            max:1,
            min:0.001,
            number:true,
        }
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


<script type="text/javascript">
    $(document).on('click', '.wlist tr', function(){
        let tr = $(this);
        let row_id = tr.attr('row_id');
        $('.edit_row').find('.row_title').val(tr.find('.row_title').text());
        $('.edit_row').find('.row_sn').val(tr.find('.row_sn').text());
        $('.edit_row').find('.row_discount').val(tr.find('.row_discount').text());
        $('.edit_row').find('.row_id').val(tr.attr('row_id'));


        $.ajax({
            type        : 'GET',
            url         : '<?php echo url('get_auth'); ?>',
            dataType    : 'json',
            data        : {
                id : row_id
            },
            success     : function(e){
                $('.usermenud input').each(function(){
                    if (in_array($(this).val(), e)) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
            },
            error       : function () {

            },
        });

    });
</script>


<SCRIPT type="text/javascript">
<!--
var setting = {
    check: {
        enable: true
    },
    data: {
        simpleData: {
            enable: true
        }
    }
};

</script>
<script>
var zNodes =[

];

<?php foreach($node_list as $vo): ?>
    zNodes.push({
        id:<?php echo $vo['id']; ?>,
        pId:<?php echo $vo['pid']; ?>,
        name:'<?php echo $vo['name']; ?>',
    });
<?php endforeach; ?>
</script>
<script>

var code;

function setCheck() {
    var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
    py = $("#py").attr("checked")? "p":"",
    sy = $("#sy").attr("checked")? "s":"",
    pn = $("#pn").attr("checked")? "p":"",
    sn = $("#sn").attr("checked")? "s":"",
    type = { "Y":py + sy, "N":pn + sn};
    zTree.setting.check.chkboxType = type;
    showCode('setting.check.chkboxType = { "Y" : "' + type.Y + '", "N" : "' + type.N + '" };');
}
function showCode(str) {
    if (!code) code = $("#code");
    code.empty();
    code.append("<li>"+str+"</li>");
}

$(document).ready(function(){
    var aauth = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    aauth.expandAll(true);
    setCheck();
    $("#py").bind("change", setCheck);
    $("#sy").bind("change", setCheck);
    $("#pn").bind("change", setCheck);
    $("#sn").bind("change", setCheck);
});
//-->
</SCRIPT>

<script type="text/javascript">
    $(document).on('click', '.level0 input:first', function() {
        $(this).parents('li').find('input').prop('checked', $(this).prop('checked'));
    });
    $(document).on('click', '.level1 input', function() {
        if ($(this).prop('checked')) {
            $(this).parents('.level0').find('input').eq(0).prop('checked', true);
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
