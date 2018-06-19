<?php 
	//get album
	$albumList = AlbumExt::getAlbumList();
	$videoList = VideoExt::getVideoList();
?>

<div class="widget_content gallery">
	<h3 class="title">Hình ảnh và video tại trung tâm kbe fitness</h3>
	<?php 
		TemplateHelper::getTemplate('common/tabs.php', array(
			'1' => array('id' => 'image', 'name' => 'Hình ảnh', 'active' => 'Y'),
			'2' => array('id' => 'video', 'name' => 'Video'),
		));
	?>
	<div class="clear"></div>
	
	<div class="tab-content no-space">
		<div class="tab-pane tab_image active" id="tab_image">
			<?php 
				$col = 3;
				$limit = Registry::getSetting('album_limit');
				$i = 0;
				foreach ($albumList as $v){
					$i++;
					$addClass = ($i > $limit) ? 'hide' : '';
			?>
			<div class="col-md-4 gallery_item image_item <?=$addClass?>">
				<a href="<?=URLHelper::getUrl("home/album&albumId=".$v->albumId)?>" title="<?=$v->name?>" class="link_image popup_auto">
					<img src="<?=URLHelper::getImagePath($v->image, 'large')?>" title="<?=$v->name?>" alt="<?=$v->name?>">
				</a>
				<a href="<?=URLHelper::getUrl("home/album&albumId=".$v->albumId)?>" title="<?=$v->name?>" class="link_title popup_auto">
					<?=$v->name?>
				</a>
			</div>
			<?php if($i % $col == 0) echo '<div class="clear"></div>'?>
			<?php }?>
			<div class="clear"></div>
			
			<?php if(count($albumList) > $limit){?>
			<div class="btn btn-primary center image_more">Xem thêm</div>
			<?php }?>
		</div>
		<div class="tab-pane tab_video" id="tab_video">
			<?php 
				$col = 3;
				$limit = Registry::getSetting('video_limit');
				$i = 0;
				foreach ($videoList as $v){
					$i++;
					$addClass = ($i > $limit) ? 'hide' : '';
			?>
			<div class="col-md-4 gallery_item video_item <?=$addClass?>">
				<a class="video popup" href="<?=$v->videoPath?>?autoplay=1">
					<img src="http://img.youtube.com/vi/<?=$v->videoId?>/hqdefault.jpg" title="<?=$v->name?>" alt="<?=$v->name?>">
				</a>
				<h4><?=$v->name?></h4>
			</div>
			<?php if($i % $col == 0) echo '<div class="clear"></div>'?>
			<?php }?>
			<div class="clear"></div>
			
			<?php if(count($videoList) > $limit){?>
			<div class="btn btn-primary center video_more">Xem thêm</div>
			<?php }?>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="gallery_control">
		<h4>Hãy tham gia cùng chúng tôi</h4>
		<div class="button_group">
			<button class="button button_blue register_button register_gallery" title="Đăng ký ngay">Đăng ký ngay</button>
			<div class="line line_blue"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".image_more").click(function() {
		$('.image_item').removeClass('hide').fadeIn(3000);
		$(this).remove();
	});

	$(".video_more").click(function() {
		$('.video_item').removeClass('hide').fadeIn(3000);
		$(this).remove();
	});
</script>