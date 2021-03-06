<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template($style.'/common/head')?>
<title><?php  echo $webset['name'];?>-首页</title>
<?php  include $this->template($style.'/common/header')?>

<!--contain-->

<style type="text/css">
    #map img{
        width: auto;
        height: auto;
    }

</style>
<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=DC8d761cc261695bc50a66e14b0fdd6d"></script>

<div class="indexCont swiper-container" id="sc1">
    <div class="swiper-wrapper" id="sw1">

        <div class="swiper-slide indexBlocks banner">
            <div class="swiper-container" id="sc2">
                <div class="swiper-wrapper">
                    <?php  if(is_array($imgs)) { foreach($imgs as $imgindex => $im) { ?>
                    <div class="swiper-slide"
                         style="background-image: url(<?php  echo tomedia($im['contents']['bimg'])?>)"></div>
                    <?php  } } ?>
                </div>
                <div class="swiper-pagination" id="sp2"></div>
                <div class="swiper-button-prev" id="sbp2"><img
                        src="../addons/<?php  echo $_GPC['m'];?>/resource/style2/images/index_arrow_l.png"></div>
                <div class="swiper-button-next" id="sbn2"><img
                        src="../addons/<?php  echo $_GPC['m'];?>/resource/style2/images/index_arrow_r.png"></div>
            </div>
            <div class="indexDown">
                <img src="../addons/<?php  echo $_GPC['m'];?>/resource/style2/images/index_arrow_d.png">
            </div>
        </div>

        <div class="swiper-slide indexBlocks indexCont2" <?php  if(!empty($fmset['contents']['about_bg'])) { ?>style="background: url(<?php  echo tomedia($fmset['contents']['about_bg'])?>);background-size: cover;position: relative;background-repeat: no-repeat;background-position: center;"<?php  } ?>>
            <div class="contentBlock">
                <div class="title1">关于我们</div>
                <div class="title2"><b></b>ABOUT<b></b></div>
                <div class="text">
                    <?php  echo $about['fmcontent'];?>
                </div>
                <a class="moreBtn" href="<?php  echo $this->createMobileUrl('about',array('op'=>'about'))?>">查看更多</a>
            </div>
            <div class="indexDown">
                <img src="../addons/<?php  echo $_GPC['m'];?>/resource/style2/images/index_arrow_d.png">
            </div>
        </div>

        <div class="swiper-slide indexBlocks indexCont3" <?php  if(!empty($fmset['contents']['product_bg'])) { ?>style="background: url(php echo tomedia({$fmset['contents']['product_bg'])});background-size: cover;position: relative;background-repeat: no-repeat;background-position: center;"<?php  } ?>>
            <div class="contentBlock">
                <div class="title1">案例展示</div>
                <div class="title2"><b></b>PROJECTS<b></b></div>
                <div class="nav" id="cidbtn">
                    <div class="navBox curr" data-id="0">全部</div>
                    <?php  if(is_array($product_class)) { foreach($product_class as $pcidnex => $pc) { ?>
                    <div class="navBox" data-id="<?php  echo $pc['id'];?>"><?php  echo $pc['contents']['firname'];?></div>
                    <?php  } } ?>

                </div>

                <div>

                    <div class="list" style="display: block;" id="case">

                    </div>
                </div>
            </div>
            <div class="indexDown">
                <img src="../addons/<?php  echo $_GPC['m'];?>/resource/style2/images/index_arrow_d.png">
            </div>
        </div>

        <div class="swiper-slide indexBlocks indexCont4" <?php  if(!empty($fmset['contents']['news_bg'])) { ?>style="background: url(<?php  echo tomedia($fmset['contents']['news_bg'])?>);background-size: cover;position: relative;background-repeat: no-repeat;background-position: center;"<?php  } ?>>
            <div class="contentBlock">
                <div class="title1">新闻资讯</div>
                <div class="title2"><b></b>NEWS<b></b></div>
                <div class="swiper-container" id="sc3">
                    <div class="swiper-wrapper">

                        <?php  if(is_array($news)) { foreach($news as $newindex => $ne) { ?>
                        <div class="swiper-slide">
                            <a class="listBox"
                               href="<?php  echo $this->createMobileUrl('news',array('op'=>'newsdet','id'=>$ne['id']))?>">
                                <div class="textBlock">
                                    <div class="title">
                                        <b><?php  echo date('m-d',strtotime($ne['createtime']))?> <span class="sp1"><?php  echo date('Y',strtotime($ne['createtime']))?></span></b>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </div>
                                    <h1><?php  echo $ne['title'];?></h1>
                                    <p><?php  echo $ne['about'];?></p>
                                </div>
                                <div class="imgBlock">
                                    <img src="<?php  echo tomedia($ne['img'])?>">
                                </div>
                            </a>
                        </div>
                        <?php  } } ?>

                    </div>
                    <div class="swiper-button-prev" id="sbp3"></div>
                    <div class="swiper-button-next" id="sbn3"></div>
                </div>
            </div>
            <div class="indexDown">
                <img src="../addons/<?php  echo $_GPC['m'];?>/resource/style2/images/index_arrow_d.png">
            </div>
        </div>

        <div class="swiper-slide indexBlocks indexCont5">

            <div class="map" id="map">

            </div>

            <div class="infoBlock"></div>
            <div class="info">
                <div class="title1">联系我们</div>
                <div class="title2">CONTACT</div>
                <div class="border"><b></b></div>
                <div class="address">
                    <?php  echo $contact['content'];?>
                </div>
            </div>


            <script>
                jQuery(document).ready(function (e) {
                    $title = '首页';
                    var mySwiper1 = new Swiper('#sc1', {
                        direction: 'vertical',
                        mousewheelControl: true
                    });
                    var mySwiper2 = new Swiper('#sc2', {
                        autoplay:5000,//可选选项，自动滑动
                        speed:1500,
                        loop: true,
                        pagination: '#sp2',
                        prevButton: '#sbp2',
                        nextButton: '#sbn2'
                    });
                    var mySwiper3 = new Swiper('#sc3', {
                        freeMode: true,
                        slidesPerView: "auto",
                        prevButton: '#sbp3',
                        nextButton: '#sbn3'
                    });



                    var map = new BMap.Map("map");
                    //创建地图中心坐标点
                    var point = new BMap.Point(<?php  echo $contact['lng'];?>, <?php  echo $contact['lat'];?>);
                    //设定中心点在地图中显示和地图的放大倍数(1-18,18最大，1最小)
                    map.centerAndZoom(point, 14);
                    var marker = new BMap.Marker(point);        // 创建标注
                    map.addOverlay(marker);



                    var uited = 0;
                    $('.topNav li').each(function () {
                        var uit = $(this).attr("data-uit");
                        if (uit == uited) {
                            $(this).addClass('curr');
                        } else {
                            $(this).removeClass('curr');
                        }
                    });

                });

            </script>
            <script>
                $(function () {
                    var _postdata = {};

                    function getdate() {

                        var html = '';
                        var url = "<?php  echo $this->createMobileUrl($do,array('op'=>'getjsondata'))?>";
                        $.ajax(url, {
                            type: 'post',
                            dataType: 'json',
                            data: _postdata
                        }).done(function (res) {
                            console.log(res);
                            for (var i = 0; i < res.length; i++) {
                                html += '<div class="listBox" style=" background-image: url(' + res[i]['simg'] + ')">' +
                                    '  <a href="' + "<?php  echo $this->createMobileUrl('product')?>" + "&op=prodet&id=" + res[i]['id'] + '">' +
                                    '<div class="textBlock">';
                                for (var j = 0; j < res[i]['attribute'].length; j++) {
                                    var resj = res[i]['attribute'][j];
                                    html += '<div class="textBox flex-display flex-alignC">' +
                                        '     <div class="name">' + resj['name'] + '：</div>' +
                                        ' <div class="text flex-flex1">' + resj['value'] + '</div>' +
                                        '           </div>';
                                }
                                html += ' </div> </a> </div>';
                            }

                            $("#case").append(html);
                        })

                    }

                    getdate();
                    $("#cidbtn .navBox").click(function () {
                        $(this).addClass("curr");
                        $(this).siblings().removeClass("curr");
                        var cid = $(this).attr('data-id');
                        _postdata['cid'] = cid;
                        $("#case").empty();
                        getdate();
                    })
                })
            </script>


            <?php  include $this->template($style.'/common/footer')?>