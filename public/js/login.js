/**
 * Created by Auser on 2015/6/17.
 */
$(function () {
    $(".btn").click(function () {
        var info = "";
        var error = 0;
        if ($("#inputGroupSuccess3").val() == "") {
            info += "帐号不能为空！<br>"
            error++;
        }
        if ($("#inputGroupSuccess2").val() == "") {
            info += "密码不能为空！<br>"
            error++;
        }
        if (error > 0) {
            $(".alert").html(info).show();
            return false;
        }
    })
    $(".form-control").focus(function () {
        $(".alert").hide();
    })
})
