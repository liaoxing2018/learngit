<?php defined('IN_IA') or exit('Access Denied');?><script type="text/javascript">
    <!--开关按钮的赋值-->
    $('.js-switch').each(function () {
        if ($(this).attr("data-value") != "-1") {
            $(this).attr("checked", "checked")
        }
    });
    /* 多选按钮的赋值*/
    $(".ui-radio").each(function () {
        var mjob = this;
        var data_value = $(this).attr("data-value").split(',');
        var value = $(this).attr("value");
        $.each(data_value, function (n, val) {
            if (value == val) {
                $(mjob).prop("checked", "checked");
            }
        })
    });

/*下拉选择组件的选中赋值*/
    $("select").each(function () {
        if($(this).attr("data-select")!=""){
            $(this).val($(this).attr("data-select"));
        }
    })


</script>