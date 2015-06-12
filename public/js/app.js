$(function () {
    //文件上传

    var opts = {
        url: "/upload",
        type: "POST",
        beforeSend: function () {
        },
        success: function (result, status, xhr) {
            console.log(result);

            if (result.status == 0) {
                alert(result.info);
                return false;
            }
            $('#logo').val(result.info);
            console.log(result.info);
            $('#brand_logo_img').attr('src', result.info).show();
        },
        error: function (result, status, errorThrown) {
            // alert(errorThrown)
            $("#loading").attr('class', 'am-icon-cloud-upload');
            alert('文件上传失败');
        }
    }
    $('#doc-form-file').fileUpload(opts);
});
