function build_input_old(attribute, value, append) {
    var html = "";
    //如果是唯一属性
    if (attribute.attr_type == 0) {
        switch (attribute.input_type) {
            //手工录入，单行文本
            case 0:
                html += '<div class="am-g form-group">' +
                    '<div class="col-sm-2 control-label text-nowrap">' + attribute.name + '</div>' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<div class="col-sm-3">' +
                    '<input type="text" class="form-control" id="exampleInputAmount" name="attr_value_list[]" value="' + value.attr_value + '">'
                    + '</div>'

                break;

            //列表
            default:
                var values = attribute.value.split("\r\n");
                var options = "<option value=''>请选择...</option>";
                $.each(values, function (k, v) {
                    options += '<option ';
                    if (v == value.attr_value) {
                        options += ' selected ';
                    }
                    options += 'value="' + v + '">' + v + '</option>';
                })
                html += '<div class="am-g form-group">' +
                    '<div class="col-sm-2 control-label text-nowrap">' + attribute.name + '</div>' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<div class="col-sm-10">' +
                    '<select class="att_select" name="attr_value_list[]">' +
                    options + '</select>'
                    + '</div>'
                break;
        }
        html += '<input type="hidden" value="NULL" class="am-input-sm money" name="attr_price_list[]" placeholder="属性价格">' + '</div>'
    } else {
        switch (attribute.input_type) {
            case 0:
                html += '<div class="am-g form-group th1">' + +'<div class="col-sm-2 control-label text-nowrap">' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<input type="text" class="form-control" id="exampleInputAmount" name="attr_value_list[]" value="' + value.attr_value + '>'
                    + '</div>'
                break;

            default:
                var values = attribute.value.split("\r\n");
                var options = "<option value=''>请选择...</option>";
                $.each(values, function (k, v) {
                    options += '<option ';
                    if (v == value.attr_value) {
                        options += ' selected ';
                    }
                    options += 'value="' + v + '">' + v + '</option>';
                })
                html += '<div class="am-g form-group">' +

                    '<div class="col-sm-2 control-label text-nowrap">' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<select class="att_select" name="attr_value_list[]">' +
                    options + '</select>'
                    + '</div>'
                break;
        }
        html += '<div>' +
            '<input type="text" class="col-sm-2 form-control money" name="attr_price_list[]"  style="width: 100px;" value="' + value.attr_price + '">' +
            '</div>';
        if (append == true) {
            html += '<div class="sec"><button type="button" class="btn btn-primary trash1">';
        } else {
            html += '<div class="sec"><button type="button" class="btn btn-primary trash0">';
        }
        html += ' 删除' +
            '</button>' +
            '</div>';
    }
    html += '</div>'
    return html;

};
function build_input(attribute, append) {
    var html = "";
    //如果是唯一属性
    if (attribute.attr_type == 0) {
        switch (attribute.input_type) {
            //手工录入，单行文本
            case 0:
                html += '<div class="am-g form-group">' +
                    '<div class="col-sm-2 control-label text-nowrap am-text-right">' + attribute.name + '</div>' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<div class="col-sm-3">' +
                    '<input type="text" class="form-control m-input-sm" id="exampleInputAmount" name="attr_value_list[]">'
                    + '</div>'

                break;

            //列表
            default:
                var values = attribute.value.split("\r\n");
                var options = "<option value=''>请选择...</option>";
                $.each(values, function (k, v) {
                    options += '<option value="' + v + '">' + v + '</option>';
                })
                html += '<div class="am-g form-group">' +
                    '<div class="col-sm-2 control-label text-nowrap">' + attribute.name + '</div>' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<div class="col-sm-10">' +
                    '<select class="att_select" name="attr_value_list[]">' +
                    options + '</select>'
                    + '</div>'
                break;
        }
        html += '<input type="hidden" value="NULL" class="am-input-sm money" name="attr_price_list[]" placeholder="属性价格">' + '</div>'
    } else {
        switch (attribute.input_type) {
            case 0:
                html += '<div class="am-g form-group th1">' + +'<div class="col-sm-2 control-label text-nowrap">' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<input type="text" class="form-control am-input-sm" id="exampleInputAmount" name="attr_value_list[]">'
                    + '</div>'
                break;

            default:
                var values = attribute.value.split("\r\n");
                var options = "<option value=''>请选择...</option>";
                $.each(values, function (k, v) {
                    options += '<option value="' + v + '">' + v + '</option>';
                })
                html += '<div class="am-g form-group">' +

                    '<div class="col-sm-2 control-label text-nowrap">' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<select class="att_select" name="attr_value_list[]">' +
                    options + '</select>'
                    + '</div>'
                break;
        }
        html += '<div>' +
            '<input type="text" class="col-sm-2 form-control money" name="attr_price_list[]"  style="width: 100px;">' +
            '</div>';
        if (append == true) {
            html += '<div class="sec"><button type="button" class="btn btn-primary trash1">';
        } else {
            html += '<div class="sec"><button type="button" class="btn btn-primary trash0">';
        }
        html += ' 删除' +
            '</button>' +
            '</div>';
    }
    html += '</div>'
    return html;
}
var type_key;
var attributes;
//生成完整表单
function build_form() {
    var html = "";
    var type_id = $("#select_type option:selected").val();
    //如果类型id等于当前商品的类型id，那么还是回到初始化的表单
    if (type_id == good_type_id) {
        build_form_old();
        return false;
    }
    type_key = $("#select_type option:selected").attr("data-type_key");
    if (type_key == "") {
        $("#attributes").html(html);
        return false;
    }

    attributes = types[type_key].attributes;
    $.each(attributes, function (k, attribute) {
        if (attribute.attr_type == 1) {
            //如果是单选
            html += '<div class="am-g form-group">' +
                '<div class="col-sm-2 control-label text-nowrap am-text-right">' + attribute.name + '</div>' +
                '<div class="col-sm-10">' +
                '<button type="button" class="btn btn-success am-round add_attribute" data-k="' + k + '">' + '<span class="am-icon-plus"> 新增</span>' +
                '</button>' +
                '</div>' +
                '</div>';
        }
        html += build_input(attribute);
    })
    $("#attributes").html(html);
};
//表单初始化，编辑用
function build_form_old() {
    var html = "";
    type_key = $("#select_type option:selected").attr("data-type_key");
    //如果类型id等于当前商品的类型id，那么还是回到初始化的表单
    console.log(type_key);
    if (type_key == "") {
        $("#attributes").html(html);
        return false;
    }
    attributes = types[type_key].attributes;
    $.each(attributes, function (k, attribute) {
        if (attribute.attr_type == 1) {
            //如果是单选
            html += '<div class="am-g form-group">' +
                '<div class="col-sm-2 control-label text-nowrap am-text-right">' + attribute.name + '</div>' +
                '<div class="col-sm-10">' +
                '<button type="button" class="btn btn-success am-round add_attribute" data-k="' + k + '">' + '<span class="am-icon-plus"> 新增</span>' +
                '</button>' +
                '</div>' +
                '</div>';
        }
        var index = 0;
        $.each(good_attrs, function (key, value) {
            console.log(index);
            if (value.attr_id == attribute.id) {
                if (index == 0) {
                    html += build_input_old(attribute, value);
                } else {
                    html += build_input_old(attribute, value, true);
                }
                index++;
            }
        })
    })
    $("#attributes").html(html);

}
$(function () {
    //打开页面就生成form
    build_form_old();

    //发生变化后，重新生成form
    $("#select_type").change(function () {

        build_form();
    });

    $(".trash1").click(function () {
        $(this).parents(".am-g").remove();
    });

    //增加属性
    $(document).on("click", ".add_attribute", function () {
        var k = $(this).attr('data-k');
        var html = build_input(attributes[k], true);
        $(this).parents(".am-g").next().after(html);
        //删除属性
        $(document).on("click", ".trash1", function () {
            $(this).parents(".am-g").remove();
        });
        $(document).on("click", ".trash0", function () {
            $(this).parents('.am-g').find('.money').val('');
        });
    })
});
