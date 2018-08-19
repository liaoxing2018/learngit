<?php defined('IN_IA') or exit('Access Denied');?>﻿<?php  include $this->template($style.'/common/head')?>
<title><?php  echo $webset['name'];?>-关于我们</title>
<?php  include $this->template($style.'/common/header')?>
<!--banner-->
<div class="otherBanner">
    <img src="<?php  echo tomedia($about['banner'])?>">
</div>
<!--banner end-->

<!--contain-->
<div class="aboutCont">
    <?php  echo $about['content'];?>


</div>
<!--contain end-->
<script>
    $(function () {
        var uited =1;
        $(".topNav li").each(function () {

            var uit = $(this).attr('data-uit');

            if(uit == uited){

                $(this).addClass('curr');
            }else {
                $(this).removeClass('curr');
            }

        })
    })

</script>

<!--bottom-->
<?php  include $this->template($style . '/common/footer')?>
