// 公用js

function go_to (url) {
    window.location.href = url;
}


function show_error (str) {

    $.gritter.add({
        title:	'操作失败',
        text:	str,
        sticky: false
    });

}

function show_success (str) {
    $.gritter.add({
        title:	'操作成功',
        text:	str,
        sticky: false
    });

}

function digitOnly ($this) {
    var n = $($this);
    var r = /^\+?[1-9][0-9]*$/;
    if (!r.test(n.val())) {
        n.val("");
    }
}

function in_array(value, arr){
    for (let i in arr) {
        if (arr[i] == value) {
            return true;
        }
    }
    return false;
}


function alt (x) {
    alert(x);
}
