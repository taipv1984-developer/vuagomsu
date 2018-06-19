<?php
/**
 * left breadcrumb float left
 * center breadcrumb center (have image bg) https://vietnoithat.bizwebvietnam.net/noi-that-phong-khach
 */
    $breadcrumbStyle = 'center';
//    $breadcrumbStyle = 'left';

    //add link home at first breadcrumb
    $breadcrumb = $params;
    $breadcrumb[] = array(
        'title' => e('Home'),
        'link' => URLHelper::getUrl('home')
    );
    $breadcrumbCount = count($breadcrumb);
?>

<?php if($breadcrumbStyle == 'left'){?>
    <ul class='breadcrumb'>
    <?php
    for($i=$breadcrumbCount-1; $i>=0; $i--){
        if($breadcrumb[$i]['link'] != ''){
    ?>
        <li>
            <a href='<?=$breadcrumb[$i]['link']?>'><?=$breadcrumb[$i]['title']?></a>
        </li>
    <?php } else{ ?>
        <li>
            <span><?=$breadcrumb[$i]['title']?></span>
        </li>
    <?php
        }
    }
    ?>
    </ul>
<?php } else if($breadcrumbStyle == 'center') {?>
    <section class="bread-crumb">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="title-crumb" title="">
                        <?=$breadcrumb[0]['title']?>
                    </div>
                    <ul class="breadcrumb">
                        <?php for($i=$breadcrumbCount-1; $i>1; $i--){?>
                        <li class="home">
                            <a itemprop="url" href="<?=$breadcrumb[$i]['link']?>">
                                <span itemprop="title"><?=$breadcrumb[$i]['title']?></span>
                            </a>
                            <span><i class="fa fa-angle-double-right"></i></span>
                        </li>
                        <?php } ?>
                        <li>
                            <strong>
                                <a itemprop="url" href="<?=$breadcrumb[1]['link']?>">
                                    <span itemprop="title"><?=$breadcrumb[1]['title']?></span>
                                </a>
                            </strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php } else { //updating... ?>

<?php }?>