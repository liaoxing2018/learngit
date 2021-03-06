<?php defined('IN_IA') or exit('Access Denied');?>


    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />

    <link type="text/css" rel="stylesheet" href="../addons/<?php  echo $_GPC['m'];?>/resource/style2/css/reset.css">
    <link href="https://cdn.bootcss.com/Swiper/3.4.2/css/swiper.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://cdn.bootcss.com/layer/3.1.0/mobile/need/layer.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../addons/<?php  echo $_GPC['m'];?>/resource/style2/css/style.css">

    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/Swiper/3.4.2/js/swiper.min.js"></script>
    <script src="https://cdn.bootcss.com/layer/3.1.0/mobile/layer.js"></script>

<style type="text/css">
    .topNav li{
        border-bottom: none;

    }
</style>

</head>


<body <?php  if($do == 'index') { ?> style="height: 100%;"<?php  } else if($do == 'news' && $op == 'newsdet') { ?>style="min-height: 100%; position: relative; background-color: #f0f0f0;"<?php  } else { ?>style="min-height: 100%; position: relative;"<?php  } ?>>

<!--top-->

<div class="top flex-display flex-alignC" >
    <div class="logo"><a href="<?php  echo $this->createMobileUrl('index',array('op'=>'index'))?>"><img src="<?php  echo tomedia($webset['logo'])?>" ></a></div>
    <div class="flex-flex1"></div>
    <div class="topNav clearfix">
        <ul>
            <li ><a href="<?php  echo $this->createMobileUrl('index',array('op'=>'index'))?>">首页<div class="sub">HOME</div></a></li>
            <li><a href="<?php  echo $this->createMobileUrl('about',array('op'=>'about'))?>">关于我们<div class="sub">ABOUT</div></a></li>
            <li><a href="<?php  echo $this->createMobileUrl('news',array('op'=>'news'))?>">新闻资讯<div class="sub">NEWS</div></a></li>
            <li><a href="<?php  echo $this->createMobileUrl('product',array('op'=>'pro'))?>">案例展示<div class="sub">CASE</div></a></li>
            <li><a href="<?php  echo $this->createMobileUrl('mess',array('op'=>'mess'))?>">在线咨询<div class="sub">Q&A</div></a></li>
            <li><a href="<?php  echo $this->createMobileUrl('contact',array('op'=>'contact'))?>">联系我们<div class="sub">CONTACT</div></a></li>
        </ul>
    </div>
    <div class="topBar">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
</div>
<?php  if($do == 'index') { ?>
<div class="topBlank"></div>
<?php  } ?>
<div class="topMenu">
    <div class="closeBtn">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>

    <ul>
        <li><a href="<?php  echo $this->createMobileUrl('index',array('op'=>'index'))?>">首页</a></li>
        <li><a href="<?php  echo $this->createMobileUrl('about',array('op'=>'about'))?>">关于我们</a></li>
        <li class="menuNews flex-display flex-alignC">
            <div class="name flex-flex1">新闻资讯</div>
            <i class="fa fa-plus" aria-hidden="true"></i>
            <i class="fa fa-minus" aria-hidden="true"></i>
        </li>
        <li class="subNews">
            <dl>
                <?php  if(is_array($nav_news_class)) { foreach($nav_news_class as $nnindex => $nnc) { ?>
                <dd><a href="<?php  echo $this->createMobileUrl('news',array('op'=>'news','cid'=>$nnc['id']))?>"><?php  echo $nnc['contents'];?></a></dd>
                <?php  } } ?>
            </dl>
        </li>
        <li><a href="<?php  echo $this->createMobileUrl('product',array('op'=>'pro'))?>">案例展示</a></li>
        <li><a href="<?php  echo $this->createMobileUrl('mess',array('op'=>'mess'))?>">在线咨询</a></li>
        <li><a href="<?php  echo $this->createMobileUrl('contact',array('op'=>'contact'))?>">联系我们</a></li>
    </ul>
    <div class="qr">
        <img src="<?php  echo tomedia($nav_contact['img'])?>">
        <p>官方微信公众号</p>
    </div>
    <div class="info">
        <?php  echo $webset['copyright'];?>

    </div>
</div>
<!--top end-->



<script>

    jQuery(document).ready(function (e) {

        $(".topBar").click(function () {
            $(".topMenu").show();
        });

        $(".topMenu .closeBtn i").click(function () {
            $(".topMenu").hide();
        });

        $(".topMenu .menuNews").click(function () {
            if($(this).hasClass("curr"))
            {
                $(this).removeClass("curr");
                $(".topMenu .subNews").slideUp();
            }
            else
            {
                $(this).addClass("curr");
                $(".topMenu .subNews").slideDown();
            }
        });


        $(".topNav li").each(function (index) {
            $(this).attr('data-uit',index);

        })



    });

</script>