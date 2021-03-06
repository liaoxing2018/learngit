<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template($style.'/common/head')?>
<title><?php  echo $webset['name'];?>-联系我们</title>
<?php  include $this->template($style.'/common/header')?>
<style type="text/css">
    @media (min-width: 768px){
        .contactCont .address .text{
            width: 400px;
        }
    }
    @media (max-width: 767px){
        .sideCont{
            display: none;
        }
    }
</style>
<!--top end-->
<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=DC8d761cc261695bc50a66e14b0fdd6d"></script>
<!--banner-->
<div class="otherBanner">
    <img src="<?php  echo tomedia($contact['banner'])?>">
</div>
<!--banner end-->

<!--contain-->
<div class="contactCont clearfix">

    <div class="address">
        <div class="title">
            联系我们 <span class="sp1">/CONTACT</span>
        </div>
        <div class="border"></div>
        <div class="text">
<?php  echo $contact['content'];?>
        </div>
        <div class="qr">
            <img src="<?php  echo tomedia($contact['img'])?>">
            <p>官方微信公众号</p>
        </div>
    </div>

    <div class="map" id="map">

    </div>

</div>

<div class="sideCont">
    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $contact['qq'];?>&site=qq&menu=yes"><img src="/addons/<?php  echo $m;?>/resource/style2/images/side_img01.png" alt="QQ咨询" title="QQ咨询"></a>
    <div id="goTop"><img src="/addons/<?php  echo $m;?>/resource/style2/images/side_img02.png"></div>
</div>

<!--contain end-->
<script>
    $(function () {
        var uited = 5;
        $('.topNav li').each(function () {
            var uit = $(this).attr("data-uit");
            if (uit == uited) {
                $(this).addClass('curr');
            } else {
                $(this).removeClass('curr');
            }
        });


        var map=new BMap.Map("map");
        //创建地图中心坐标点
        var point=new BMap.Point(<?php  echo $contact['lng'];?>,<?php  echo $contact['lat'];?>);
        //设定中心点在地图中显示和地图的放大倍数(1-18,18最大，1最小)
        map.centerAndZoom(point,14);
        var marker = new BMap.Marker(point);        // 创建标注
        map.addOverlay(marker);

        $(window).scroll(function(){

            if ($(this).scrollTop() > 500) {
                $('#goTop').fadeIn();
            } else {
                $('#goTop').fadeOut();
            }
        });

        $('#goTop').click(function(){
            $('html, body').animate({scrollTop : 0},500);
            return false;
        });


    })
</script>
<!--bottom-->
<?php  include $this->template($style.'/common/footer')?>