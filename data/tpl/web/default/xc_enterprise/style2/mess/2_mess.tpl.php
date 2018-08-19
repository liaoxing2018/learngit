<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template($style.'/common/head')?>
<title><?php  echo $webset['name'];?>-在线咨询</title>
<?php  include $this->template($style.'/common/header')?>
<link rel="stylesheet" href="../addons/<?php  echo $_GPC['m'];?>/resource/swal/dist/sweetalert2.css"/>

<script src="../addons/<?php  echo $_GPC['m'];?>/resource/swal/dist/sweetalert2.min.js"></script>

<script src="https://cdn.bootcss.com/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<!--banner-->
<div class="otherBanner">
    <img src="<?php  echo tomedia($messset['banner'])?>">
</div>
<!--banner end-->

<!--contain-->
<div class="qaCont">
    <div class="form">
        <form id="signupForm">
        <div class="inputBlock">
            <input type="text" placeholder="公司名称*" name="xc[company]">
        </div>
        <div class="inputBlock">
            <input type="text" placeholder="联系人*" name="xc[people]">
        </div>
        <div class="inputBlock">
            <input type="number" placeholder="电话*" name="xc[tel]">
        </div>
        <div class="inputBlock">
            <input type="number" placeholder="手机" name="xc[phone]">
        </div>
        <div class="inputBlock">
            <input type="email" placeholder="邮箱*" name="xc[email]">
        </div>
        <div class="inputBlock">
            <textarea placeholder="咨询内容*" name="xc[contents]"></textarea>
        </div>
        <div class="btns">
            <button class="submitBtn" type="submit">提交</button>

        </div>
        </form>
    </div>
</div>
<!--contain end-->

<!--bottom-->

<script>

    $().ready(function() {

        var uited = 4;
        $('.topNav li').each(function () {
            var uit = $(this).attr("data-uit");
            if (uit == uited) {
                $(this).addClass('curr');
            } else {
                $(this).removeClass('curr');
            }
        });


        $("#signupForm").validate({
            rules: {
                "xc[company]": "required",
                "xc[people]": "required",
                "xc[tel]": "required",
                "xc[contents]": "required",
                "xc[email]":{required:true,
                email:true}
            },
            messages: {
                "xc[company]": "请输入公司名称",
                "xc[people]": "请输入联系人",
                "xc[tel]": "请输入电话号码",
                "xc[contents]": "请输入咨询内容",
                "xc[email]":{required:'请输入邮箱',
                email:'请输入真确的邮箱地址'}
            },
            submitHandler: function (form) {

                xajaxfrom(form);

                return false;
            }
        });

        var replyrdata = {};
        replyrdata[1] = "success";
        replyrdata[-1] = "error";
        replyrdata[2] = "warning";
        replyrdata[3] = "info";
        replyrdata[4] = "question";
        function message(data) {

            $mesoption = {};
            if (data["status"] === 1) {
                $("#signupForm")[0].reset();
            }
            $mesoption["timer"] = 1000;
            $mesoption["type"] = replyrdata[data["status"]];
            $mesoption["title"] = data["message"];
            $mesoption["text"] = data["message"];
            swal($mesoption);
        }
        function xajaxfrom(form) {

            swal({
                title: "操作中",
                text: "",
                imageUrl: "../addons/<?php  echo $_GPC['m']?>/resource/images/xload1.gif",
                showConfirmButton: false,
                allowOutsideClick: true
            });
            $.ajax("<?php  echo $this->createMobileUrl($do,array('op'=>'save'));?>", {
                type: 'post',
                data: $(form).serialize(),
                dataType: 'json'
            }).done(function (res) {
                message(res);
            })
        }
    })

</script>

<?php  include $this->template($style.'/common/footer')?>