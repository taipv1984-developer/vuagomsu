<div class="widget_content lop_hoc lop_ca_nhan">
	<h1>Lớp cá nhân</h1>
	<div class="col-md-6">
		<div class="block_content">
			<h2>Số lượng</h2>
			<ul>
				<li>Tập 1-1 với Huấn Luyện Viên</li>
			</ul>
		</div>
		<div class="block_content">
			<h2>Thời gian</h2>
			<ul>
				<li>Linh động về thời gian</li>
			</ul>
		</div>
		<div class="block_content">
			<h2>Quyền lợi</h2>
			<ul>
				<li>Giáo trình tập luyện riêng biệt</li>
				<li>Được tư vấn về chế độ dinh dưỡng</li>
				<li>Được bảo hiểm, giúp đỡ trong quá trình tập luyện</li>
			</ul>
		</div>
		<div class="block_content block_content_last">
			<h2>Kết quả</h2>
			<ul>
				<li>Trang bị các kiến thức cơ bản và chuyên sâu về bộ môn tập luyện</li>
				<li>Nâng cao sức khỏe</li>
				<li>Tăng cường khả năng tự vệ</li>
				<li>Đạt mục tiêu thay đổi hình thể</li>
			</ul>
		</div>
		<div class="button_group2">
			<a class="button button_blue register_button register_lop_ca_nhan left" title="Đăng ký ngay" href="<?=URLHelper::getUrl('home/contact')?>">Đăng ký ngay</a>
			<div class="clear"></div>
			<div class="line line_blue"></div>	
		</div>
	</div>
	<div class="col-md-6">
		<div class="description">
			Kickfit, Muay Thái, Võ gậy Arnis trong những năn gần đây đã trở thành một trò lưu được đông đảo các bạn lựa chọn. Giúp bạn rèn luyện sức khỏe, tăng sức bên, đọ dẻo dai của co thể. Tăng khả nawngt ự vệ, phản xạ nhanh. Tăng cơ giảm mỡ, giảm béo, săn chắc cơ thể.<br>
			Bạn có thể tham gia ngay tại Kickboxing Entertainment Fitness<br>
			<p></p>
			<p></p>
			Bạn đã là thành viên của một câu lạc bộ thể thao và muốn tập luyện Kickfit tron gmooi trường thể thao của bạn?<br>
			Đó là  điều hoàn toàn có thể. Hãy đăng ký ngay lớp nhóm tại KBE FITNESS
		</div>
		<div class="button_group2">
			<a class="button button_blue register_button register_lop_ca_nhan left" title="Đăng ký ngay" href="<?=URLHelper::getUrl('home/contact')?>">Đăng ký ngay</a>
			<div class="clear"></div>
			<div class="line line_blue"></div>	
		</div>
		<div class="video">
			<iframe width="100%" height="300" frameborder="0"
				src="https://www.youtube.com/embed/B4ZVcE7fzOE">
			</iframe>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="price_detail">
		<div class="col-md-3 block_price">
			<h3>Dưới 10 buổi</h3>
			<h4>500.000 Đ/buổi</h4>
		</div>
		<div class="col-md-3 block_price">
			<h3>Từ 10 buổi đến 49 buổi</h3>
			<h4>400.000 Đ/buổi</h4>
		</div>
		<div class="col-md-3 block_price">
			<h3>Từ 50 buổi đến 99 buổi</h3>
			<h4>350.000 Đ/buổi</h4>
		</div>
		<div class="col-md-3 block_price">
			<h3>Từ 100 buổi trở lên</h3>
			<h4>300.000 Đ/buổi</h4>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var width = $('body').width();
		if(width < 768){
			$('.video iframe').attr('height', '360');
		}
		if(width < 500){
			$('.video iframe').attr('height', '220');
		}
	});
</script>