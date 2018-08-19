<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<link rel="stylesheet" type="text/css" href="/addons/<?php  echo $_GPC['m'];?>/resource/css/style.css"/>
<link rel="stylesheet" type="text/css" href="/addons/<?php  echo $_GPC['m'];?>/resource/swal/dist/sweetalert2.css"/>

<ul class="we7-page-tab">


    <li class="active">公司简介—<span id="xtitle"></span></li>

</ul>


<div class="main">
    <div class="btn-group" id="templist">
    </div>
    <form action="<?php  echo $this->createWebUrl($_GPC['do'], array('op'=>'save'));?>" method="post"
          class="form-horizontal form" id="form">
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">名称</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="xc[name]" class="form-control" value="公司简介"/>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">Banner</label>
                    <div class="col-xs-12 col-sm-8">
                        <?php  echo tpl_form_field_image('xc[banner]',$xc['contents']['banner']);?>
                        <p>建议尺寸1920x810</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">首页内容</label>
                    <div class="col-xs-12 col-sm-8">
                        <?php  echo tpl_ueditor('xc[fmcontent]',$xc['contents']['fmcontent']);?>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">状态</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="checkbox" class="js-switch" value="1" name="xc[status]"
                               data-value="<?php  echo $xc['status'];?>" data-field="status">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">内容</label>
                    <div class="col-xs-12 col-sm-8">
                        <?php  echo tpl_ueditor('xc[content]',$xc['contents']['content']);?>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 col-sm-offset-3 col-md-offset-2 col-lg-offset-2">
                        <input type="hidden" name="id" value="<?php  echo $xc['id'];?>"/>
                        <input name="submit" type="submit" value="提交" class="btn btn-primary"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/xcfootex', TEMPLATE_INCLUDEPATH)) : (include template('common/xcfootex', TEMPLATE_INCLUDEPATH));?>
<script>
    <!--标题名称的修改-->
    if ($("[name='id']").val() == "0" || $("[name='id']").val() == "") {
        $("#xtitle").html("增加")
    }
    else {
        $("#xtitle").html("修改")
    }

    require(["../addons/<?php  echo $_GPC['m']?>/resource/swal/dist/sweetalert2.min.js", "../addons/<?php  echo $_GPC['m']?>/resource/validate/jquery.validate.min.js"], function () {
        var xpagecss = {
            xload: function () {
                swal({
                    title: "操作中",
                    text: "",
                    imageUrl: "../addons/<?php  echo $_GPC['m']?>/resource/images/xload1.gif",
                    showConfirmButton: false,
                    allowOutsideClick: true
                });
            },
            close: function () {
                swal.close();
            }
        }
        $.validator.setDefaults({
            highlight: function (e) {
                $(e).closest(".col-xs-12").removeClass("has-success").addClass("has-error")
            }, success: function (e) {
                e.closest(".col-xs-12").removeClass("has-error").addClass("has-success")
            }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none"
        }), $().ready(function () {
            var e = "<i class='fa fa-times-circle'></i> ";
/* 表单验证部分的 内容 */
            var vlidp = {
                rules: {
                    "xc[mobanid]": {required: !0},
                    "xc[img]": {url: false},
                    "xc[banner]": {url: false}
                },
                messages: {
                    "xc[mobanid]": {required: e + "请选择模版"}
                },
                submitHandler: function (form) {
                    xajaxfrom(form);
                    return false;
                }
            }
            $("#form").validate(vlidp);
        });

        var replyrdata = {};
        replyrdata[1] = "success";
        replyrdata[-1] = "error";
        replyrdata[2] = "warning";
        replyrdata[3] = "info";
        replyrdata[4] = "question";
/*  message函数 反馈数据提交互后的信息（swal插件）*/
        function message(data) {
            $mesoption = {};
            if (data["status"] === 1) {

                if ($('[name="id"]').val() == "") {
                    form.reset();
                }
                $mesoption["timer"] = 1000;
            }
            $mesoption["type"] = replyrdata[data["status"]];
            $mesoption["title"] = data["message"];
            $mesoption["text"] = data["message"];
            swal($mesoption);

        }


        function xajaxfrom(form) {
            $actfrom = $(form);
            var $postdate = $actfrom.serialize();
            $('#form [type="checkbox"]:not(":checked")').each(function () {
                $postdate = $postdate + "&" + $(this).attr("name") + "=-1";

            })
            xpagecss.xload();
            $.ajax({
                type: $(form).attr("method"),
                url: $(form).attr("action"),
                dataType: "json",
                data: $postdate,
                success: function (msg) {
                    message(msg)


                }

            });
        }

    })

</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>