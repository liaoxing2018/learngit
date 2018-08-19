<?php defined('IN_IA') or exit('Access Denied');?><?php  include $this->template($style.'/common/head')?>
<title><?php  echo $webset['name'];?>-案例展示<?php  echo $xtitle;?></title>
<?php  include $this->template($style.'/common/header')?>
<!--top end-->

<!--banner-->
<div class="otherBanner">
    <img src="<?php  echo tomedia($productset['banner'])?>">
</div>
<!--banner end-->

<!--contain-->
<div class="caseCont">

    <div class="nav">
        <a class="navBox curr" data-id="0" href="<?php  echo $this->createMobileUrl('product',array('op'=>'pro'))?>">全部</a>
        <?php  if(is_array($product_class)) { foreach($product_class as $index => $pc) { ?>
        <a class="navBox" data-id="<?php  echo $pc['id'];?>" href="<?php  echo $this->createMobileUrl('product',array('op'=>'pro','cid'=>$pc['id']))?>"><?php  echo $pc['contents']['firname'];?></a>
        <?php  } } ?>
    </div>

    <div class="list">




    </div>

    <!--Pages-->
    <div class="pages" id="pages">

    </div>
    <!--Pages-->

</div>
<!--contain end-->

<!--bottom-->

<script>
    $(function () {
        var uited = 3;
        $('.topNav li').each(function () {
            var uit = $(this).attr("data-uit");
            if (uit == uited) {
                $(this).addClass('curr');
            } else {
                $(this).removeClass('curr');
            }
        });
        $(".nav a").each(function () {
            if ($(this).attr('data-id') == <?php  echo $cid;?>){
                $(this).addClass("curr");
            }else {
                $(this).removeClass("curr");
            }
        })
    })
</script>
<script>
    $(function () {
        var cid = <?php  echo $cid;?>;
        var psize = 6;
        var page = <?php  echo $page;?>;
        $.ajax("<?php  echo $this->createMobileUrl('product',array('op'=>'pro'))?>",{
            data:{psize:psize,page:page,cid:cid},
            type:"post",
            dataType:'json'
        }).done(function (res) {
console.log(res);
$('#pages').append(res.pages);

            var data = res['lists'];
          var html='';
        for ( var i=0 ;i<data.length;i++ ){
             html+='<div class="listBox" style=" background-image: url('+data[i].simg+')"> ' +
                '<a href="'+"<?php  echo $this->createMobileUrl('product')?>"+"&op=prodet&id="+data[i].id+'">'+

            '<div class="textBlock" > ' ;
            for (var j=0;j< data[i]['attribute'].length;j++){
                html+=
                    '<div class="textBox flex-display flex-alignC">' +
            '<div class="name">'+data[i]['attribute'][j]['name']+'：</div> ' +
            '<div class="text flex-flex1">'+data[i]['attribute'][j]['name']+'</div> ' +
            '</div> ';
                     }
                     html+='</div> </a> </div>';
        }

                $(".list").append(html);
        })
    })
</script>

<?php  include $this->template($style . '/common/footer')?>

