<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"D:\phpStudy\WWW\md\public/../application/index\view\system\sysjc.html";i:1529660960;s:63:"D:\phpStudy\WWW\md\public/../application/index\view\layout.html";i:1529393625;}*/ ?>
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
          <li class="navon"><a href="<?php echo url('System/sysjc'); ?>">寄存厅设置</a></li>
          <li><a href="<?php echo url('System/sysjct'); ?>">寄存室设置</a></li>
          <li><a href="<?php echo url('System/sysjcc'); ?>">寄存层设置</a></li>
          <li><a href="<?php echo url('System/sysjcw'); ?>">寄存位设置</a></li>
        </ul>
      </div>
    <div class="mwmain">
      <div class="mwd">
        <div class="mwda">
          <form class="add_row" action="<?php echo url('add'); ?>" method="post" enctype="multipart/form-data">
            <fieldset>
              <legend>寄存厅设置</legend>
              <div class="mwdale">
                <div class="mwdtop">
                  <div class="mwdlea">
                      <p>寄存厅名称</p>
                      <p>寄存厅简介</p>
                   </div>
                   <div class="mwdleb">
                        <input type="hidden" name="id" class="row_id" />
                        <input type="text" name="title" class="row_title" />
                        <input type="text" name="cont"  class="row_desc"  />
                  </div>
                </div>
                  <div class="mwdlec">
                    <button type="button" class="mwdcontc row_add"  >添加</button>
                    <button type="button" class="mwdcontc row_edit"  >修改</button>
                    <button type="button" class="mwdcontc row_del"  >删除</button>
                    <!-- <div class="mwdcontc">保存</div> -->
                    <!-- <div class="mwdcontc">取消</div>  -->                           
                  </div>
              </div>                      
              <div class="mwdari">
                    <div class="mwdaria">
                         <!--  <img class="row_img"  alt = '未选择' />
                          <input type="hidden" name="thumb" class="row_thumb" /> -->
                          
                          <div id="dd1" style=" width:120px;height:90px;"><img class="row_img"  style=" width:120px;height:90px;"/></div>
                    </div>
                   <!--  <button type="button" class="mwdcontcs slimg">选择图片</button> -->
                   <input class="uploading" type="file" name="img" id="doc1" multiple="multiple"  style="width:148px;" onchange="javascript:setImagePreviews1();" accept="image/*" /> 
              </div>                   
            </fieldset>                   
          </form>
        </div>
        <div class="mwdb">
          <table class="table table-bordered">
            
            <thead>
              <tr>
                <th>寄存厅名称</th>
                <th>寄存厅介绍</th>
                
              </tr>
            </thead>
            <tbody class="wlist">
              <?php foreach($sys_list as $k=>$vo): ?>
                <tr row_id = "<?php echo $vo['id']; ?>" class="tr_<?php echo $vo['id']; ?>">
                  <td class="row_images" style="display:none;" row_imgs="<?php echo $vo['img']; ?>"></td>
                  <td class="title"><?php echo $vo['title']; ?></td>
                  <td class="desc"> <?php echo $vo['cont']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- <iframe id = "iframeSon" style = "display:none;" src = "<?php echo url('p/upload'); ?>"> </iframe> -->
  </div>
<script>
//下面用于多图片上传预览功能
function setImagePreviews1(avalue1) {
  var docObj1 = document.getElementById("doc1");
  var dd1 = document.getElementById("dd1");
  dd1.innerHTML = "";
  var fileList = docObj1.files;
  for (var i = 0; i < fileList.length; i++) {           
    dd1.innerHTML += "<div style='float:left' > <img id='img" + i + "'  /> </div>";
    var imgObjPreview = document.getElementById("img"+i); 
    if (docObj1.files && docObj1.files[i]) {
      //火狐下，直接设img属性
      imgObjPreview.style.display = 'block';
      imgObjPreview.style.width = '120px';
      imgObjPreview.style.height = '900px';
      //imgObjPreview.src = docObj1.files[0].getAsDataURL();
      //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
      imgObjPreview.src = window.URL.createObjectURL(docObj1.files[i]);
    }
    else {
      //IE下，使用滤镜
      docObj1.select();
      var imgSrc = document.selection.createRange().text;
      alert(imgSrc)
      var localImagId = document.getElementById("img" + i);
      //必须设置初始大小
      localImagId.style.width = "120px";
      localImagId.style.height = "90px";
      //图片异常的捕捉，防止用户修改后缀来伪造图片
      try {
          localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
          localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
      }
      catch (e) {
          alert("您上传的图片格式不正确，请重新选择!");
          return false;
      }
      imgObjPreview.style.display = 'none';
      document.selection.empty();
    }
  }  
  return true;
}
</script>
<script type="text/javascript">
    $('.wlist tr').click(function(){
        $(".add_row .row_img").attr('src', $(this).find('.row_images').attr('row_imgs'));
        $(".add_row .row_id").val($(this).attr('row_id'));
        $(".add_row .row_title").val($(this).find('.title').text());
        $(".add_row .row_desc").val($(this).find('.desc').text());
    });
</script>
<script type="text/javascript">
/*$('.slimg').click(function(){
   $( "#iframeSon" ).contents().find("#file").click();
});*/
/*function new_img (src) {
    $('.row_img').attr('src', src);
    $('.row_thumb').val(src);
}*/
$('.row_add').click(function(){
    $('.add_row').attr('action', "<?php echo url('sysjc_add'); ?>").submit();

});

$('.row_edit').click(function(){
    $('.add_row').attr('action', "<?php echo url('sysjc_edit'); ?>").submit();
});

$('.row_del').click(function(){
    var row_id = $(".add_row .row_id").val();
    if (row_id && confirm('确认删除?')) {
        $.ajax({
            type        : 'GET',
            url         : '<?php echo url('sysjc_del'); ?>',
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
