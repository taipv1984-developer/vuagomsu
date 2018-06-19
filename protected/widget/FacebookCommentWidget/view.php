<div class='widget_content facebook_comment_widget <?=$setting['class']?>'>
	<?php if($setting['show_title']){?>
		<h3 class='text_widget_title facebook_comment_widget_title'>
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>
	
	<div class='facebook_comment_widget_content'>
        <div id="fb-root"></div>
        <script type="text/javascript">(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=<?= Registry::getSetting('facebook_app_id')?>";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
			
		<div class="fb-comments" data-href="<?=$setting['url']?>" 
			data-width="<?=$setting['width'] ?>" 
			data-numposts="<?=$setting['num_posts']?>" 
			data-order-by="<?=$setting['order_by']?>">
		</div>
	</div>
</div>