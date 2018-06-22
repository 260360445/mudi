<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\phpStudy\WWW\md\public/../application/index\view\p\upload.html";i:1529380646;}*/ ?>
<form action="" enctype="multipart/form-data" method="post">
<input type="file" id = "file" name="image" /> <br>
<input type="hidden" name="z" value="1" /> <br>
<input type="submit" value="上传" />
</form>

<script type="text/javascript" src = "__JS__/jquery-1.11.0.js"> </script>
<script>
    $('#file').change(function( ){
        $('form').submit();
    });

    var src = "<?php echo $src; ?>";

    if (src) {
        window.parent.new_img( '/uploads/' + src);
    }
</script>
