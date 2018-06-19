<div class="widget_content lop_hoc lop_nhóm">
	<h1>Lịch học lớp nhóm</h1>
	<div class="col-md-6">
		<div class="block_content">
			<h2>Số lượng</h2>
			<ul>
				<li>5 - 7 người trong một nhóm</li>
			</ul>
		</div>
		<div class="block_content">
			<h2>Thời gian</h2>
			<ul>
				<li>Tập theo khung giờ cố định</li>
				<li>Bạn hãy chọn giờ, chúng tôi sẽ ghép lớp</li>
			</ul>
		</div>
		<div class="block_content">
			<h2>Quyền lợi</h2>
			<ul>
				<li>3 buổi tập với HLV trong 1 tuần</li>
				<li>Các buổi còn lại sinh hoạt thoải mái tại phòng tập</li>
				<li>Được giao lưu với các học viên khác tại phòng tập</li>
				<li>Sử dụng mọi thiết bị khác của phòng tập</li>
			</ul>
		</div>
		<div class="block_content block_content_last">
			<h2>Tác dụng</h2>
			<ul>
				<li>Học viên được trang bị các kiến thức cơ bản về môn học</li>
				<li>Tăng cường sức khỏe</li>
				<li>Nâng cao khả năng tự vệ</li>
				<li>Tăng khả năng hòa đồng, làm việc tập thể</li>
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
		<div class="col-md-15 block_price">
			<h3>Muay Thái</h3>
			<h4>1.500.000 Đ/tháng/người</h4>
		</div>
		<div class="col-md-15 block_price">
			<h3>Võ Gậy Arnis</h3>
			<h4>1.500.000 Đ/tháng/người</h4>
		</div>
		<div class="col-md-15 block_price">
			<h3>Boxing</h3>
			<h4>1.000.000 Đ/tháng/người</h4>
		</div>
		<div class="col-md-15 block_price">
			<h3>Kickboxing</h3>
			<h4>1.000.000 Đ/tháng/người</h4>
		</div>
		<div class="col-md-15 block_price">
			<h3>Kickfit</h3>
			<h4>1.000.000 Đ/tháng/người</h4>
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