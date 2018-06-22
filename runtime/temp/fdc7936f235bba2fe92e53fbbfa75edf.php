<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"D:\phpStudy\WWW\md\public/../application/index\view\tomb\sale.html";i:1529396636;s:63:"D:\phpStudy\WWW\md\public/../application/index\view\layout.html";i:1529393625;}*/ ?>
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
    <form class="add_row">
        <fieldset>
            <legend>墓位预订</legend>

           <div class="conta">
              <p>选择墓园</p>
              <p>选择墓区</p>
              <p>选择墓排</p>
              <p>墓位样式</p>
              <p>墓位状态</p>

           </div>
           <div class="contb">
               <select name="cem_id" class="cem_id">
                  <option value="">请选择</option>
                  <?php foreach($cem_list as $k => $vo): ?>
                       <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
                  <?php endforeach; ?>
               </select>



                   <select name="cem_area_id" class="cem_area_id">
                      <option value="0">请选择</option>
                   </select>



                   <select name="cem_row_id" class="cem_row_id">
                      <option value="0">请选择</option>

                   </select>
                       <select class="style_id">
                   <?php foreach($cem_style as $k => $vo): ?>
                        <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
                   <?php endforeach; ?>
                      </select>
                <select class="status_id">
                    <?php foreach($cem_status as $k => $vo): ?>
                         <option value="<?php echo $vo['id']; ?>"><?php echo $vo['title']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="button" class="contc show_all">显示全部</button>

                <div class="contc">退出</div>
           </div>
        </fieldset>

    </form>
    <div class="ding wlist">


    </div>
</div>
</div>




    <script type="text/javascript">
        $(document).on('click', '.all_btn', function(){
            $('.wlist input').prop('checked', $(this).prop('checked'));
        });
        // $('.wlist ').on('click', 'tr', function(){
        //     $(".add_row .cem_id").val($(this).find('.row_cem_id').attr('val'));
        //     get_area($(".add_row .cem_id"), $(this).find('.row_cem_area_id').attr('val') );
        //     // $(".add_row .row_cem_area_id").val($(this).find('.row_cem_area_id').attr('val'));
        //     $(".add_row .row_title").val($(this).find('.row_title').text());
        //     $(".add_row .row_id").val($(this).attr('row_id'));
        // });

        $('.all_btn_z').click(function(){
            $('.all_btn_z').parents('.mwtxribbot').find('input').prop('checked', $(this).prop('checked'));
        });

        $('.sbmt').click(function(){
            if ($(this).hasClass('del') && confirm('确认删除?'))  {
                $('.add_row').attr('action', $(this).attr('url')).submit();
            } else {
                $('.add_row').attr('action', $(this).attr('url')).submit();
            }

        });

        $(document).on('click', '.del', function(){
            var ids = [];
            $('.wlist input').each(function(){
                if ($(this).prop('checked')) {
                    ids.push($(this).val());
                }

            });
            if (!ids.length) {
                return alt('请先选择要删除的墓位');
            }

            $.ajax({
                type        : 'GET',
                url         : '<?php echo url('info_del'); ?>',
                dataType    : 'json',
                data        : {
                    ids : ids
                },
                success     : function(e){
                    if (e.status) {
                        for (let i in ids) {
                            $('.tr_' + ids[i]).remove();
                        }
                    }
                },
                error       : function () {

                },
            });

        });
    </script>


    <script type="text/javascript">
        function get_row (_this, _select_id) {
            // var _select_id = _select_id ? _select_id : 0;
            let cem_area_id = _this.val();
            let form = _this.parents('form');
            if (cem_area_id) {
                $.ajax({
                    type        : 'GET',
                    url         : '<?php echo url('Cem/row_wlist'); ?>',
                    dataType    : 'json',
                    data        : {
                        cem_area_id : cem_area_id
                    },
                    success     : function(e){
                        let html = '<option value = "0">请选择</option>';
                        for (i in e) {
                            html += '<option ';
                            if (_select_id == e[i]['id']) {
                                html += 'selected';
                            }
                            html += ' value="'+e[i]['id']+'">'+e[i]['title']+'</option>';
                        }
                        form.find('.cem_row_id').html(html);
                    },
                    error       : function () {

                    },
                });
            }
        }



        function get_area (_this, _select_id) {
            // var _select_id = _select_id ? _select_id : 0;
            let cem_id = _this.val();
            let form = _this.parents('form');
            if (cem_id) {
                $.ajax({
                    type        : 'GET',
                    url         : '<?php echo url('Cem/area_wlist'); ?>',
                    dataType    : 'json',
                    data        : {
                        cem_id : cem_id
                    },
                    success     : function(e){
                        let html = '<option value = "0">请选择</option>';
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

        $('.cem_area_id').change(function(){
            get_row($(this), '-1');
        });
    </script>
    <script>
        $('.show_all').click(function(){
            var cem_id = $('.add_row').find('.cem_id').val();
            var cem_area_id = $('.add_row').find('.cem_area_id').val();
            var cem_row_id = $('.add_row').find('.cem_row_id').val();
            var status_id = $('.add_row').find('.status_id').val();
            var style_id = $('.add_row').find('.style_id').val();

            $.ajax({
                type        : 'POST',
                url         : '<?php echo url('Cem/info_wlist_html'); ?>',

                data        : {
                    cem_id : cem_id,
                    cem_area_id : cem_area_id,
                    cem_row_id : cem_row_id,
                    status_id : status_id,
                    style_id : style_id,
                    mb:1,
                },
                success     : function(e){
                    $('.wlist').html(e);
                },
                error       : function () {

                },
            });

        });
    </script>



<script type="text/javascript">
    $(".add_row").validate({
        rules:{
            price:{
                number:true,
                required:true,
            },
            length:{
                number:true,
                required:true,
            },
            width:{
                number:true,
                required:true,
            },
            acreage:{
                number:true,
                required:true,
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
