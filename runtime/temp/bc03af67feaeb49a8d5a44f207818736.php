<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\WWW\md\public/../application/index\view\tomb\info_sale_html_list.html";i:1529380646;}*/ ?>

<?php foreach($list as $k=>$vo): ?>

    <div class="dinga"  class="tr_<?php echo $vo['id']; ?>" row_id = "<?php echo $vo['id']; ?>">
        <div class="dingimg">
           <img src="__IMG__/ding_03.png" />
        </div>
        <p><?php echo $vo['long_title']; ?></p>
    </div>
 
<?php endforeach; ?>
