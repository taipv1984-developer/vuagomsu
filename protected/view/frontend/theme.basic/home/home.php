<!-- group 1-->
<div class="group1_row">
    <div class="container">
        <div class="widget_content group1">
            <h2>Lợi ích từ các khóa học tại kbe fitness</h2>
            <div class="clear"></div>

            <div class="col-md-4 item item_first">
                <h3>Đốt cháy năng lượng tối ưu:</h3>
                <div class="content">
                    1 tiếng tập kickboxing có thể đốt tới 800 calo, cao hơn gấp rưỡi so với các bài tập chạy bộ, đạp xe, bơi lội... đây là bài tập cực hữu hiệu để giảm mỡ và có thân hình chuẩn.
                </div>
                <h3>Tư thế hoàn hảo:</h3>
                <div class="content">
                    Các bài tập kickboxing giúp vận động toàn bộ các khối cơ trên cơ thể, các khối cơ sẽ phải hoạt động nhuần nhuyễn với nhau trong quá trình tập luyện, giúp cơ thể bạn có sự cân bằng nhất định. Đặc biệt có ích với những người phải ngồi trước bàn máy tính suốt ngày dài.
                </div>
                <h3>Giảm stress hiệu quả:</h3>
                <div class="content">
                    Với những động tác dồn lực mạnh, những cú ra đòn liên tiếp, kickboxing chính là phương pháp hữu hiệu giúp bạn mau chóng xả stress sau thời gian học tập hoặc làm việc căng thẳng.
                </div>
            </div>
            <div class="col-md-4 item item_second">
                <img src="upload/images/group1_400.png" title="" alt="">
                <div class="button_group">
                    <button class="button button_blue register_button register1" title="Đăng ký ngay">Đăng ký ngay</button>
                    <div class="line line_blue"></div>
                </div>
            </div>
            <div class="col-md-4 item item_third">
                <h3>Nâng cao thể lực:</h3>
                <div class="content">
                    Không chỉ là những động tác mạnh mẽ, kickboxing còn giúp bạn luôn dẻo dai và sung sức, giúp thể lực được nâng cao mỗi ngày.
                </div>
                <h3>Bảo vệ trái tim khỏe mạnh:</h3>
                <div class="content">
                    Các bài tập linh hoạt cùng phương pháp hít thở đúng cách giúp cơ thể lưu thông máu tốt hơn, tăng cường khả năng hoạt động của tim mạch và hệ tuần hoàn.
                </div>
                <h3>Cung cấp kỹ năng tự vệ cơ bản:</h3>
                <div class="content">
                    Học kickboxing giúp bạn biết thêm những kĩ năng tự vệ căn bản và tăng khả năng phản xạ trong những trường hợp nguy hiểm nhất.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- group 2-->
<div class="group2_row">
    <div class="widget_content group2">
        <fieldset class="group2_header">
            <legend>Đăng ký tập</legend>
            <h3>Hãy lựa chọn gói tập phù hợp với bạn</h3>
        </fieldset>
        <div class="option">
            <div class="option_item option_item1">
                <h4>Lớp nhóm</h4>
                <ul>
                    <li>Luyện tập không giới hạn thời gian</li>
                    <li>Huấn luyện viên chuyên nghiệp hướng dẫn từng buổi tập</li>
                    <li>Tập luyện đi kèm tư vấn chế độ dinh dưỡng</li>
                    <li>Giáo trình tập và lịch tập cụ thể cho từng tháng</li>
                </ul>
                <div class="option_footer register_button register2" title="Đăng ký ngay">Đăng ký ngay</div>
            </div>
            <div class="option_item option_item2">
                <h4>Lớp cá nhân</h4>
                <ul>
                    <li>Tập 1-1 với HLV cá nhân chuyên nghiệp theo sát trong từng buổi</li>
                    <li>Thời gian tập luyện hoàn toàn chủ động</li>
                    <li>Được tư vấn đặc biệt về chế độ dinh dưỡng và sức khỏe</li>
                    <li>Đảm bảo mục tiêu đầu ra</li>
                    <li>Có giáo án riêng</li>
                    <li>Có bảo hiểm giúp đỡ</li>
                </ul>
                <div class="option_footer register_button register2" title="Đăng ký ngay">Đăng ký ngay</div>
            </div>
        </div>
    </div>
</div>

<!-- group 3-->
<div class="group3_row">
    <?php
    $isMobile = Session::getSession('isMobile');
    if($isMobile){
        include 'component/home_content_group3_mobile.php';
    }
    else{
        include 'component/home_content_group3_desktop.php';
    }
    ?>
</div>

<!-- group 4-->
<div class="group4_row">
    <div class="container">
        <div class="widget_content group4">
            <div class="button_group">
                <button class="button button_blue register_button register4" title="Đăng ký ngay">Đăng ký ngay</button>
                <div class="line line_blue"></div>
            </div>
            <div class="clear"></div>

            <div class="group4_image">
                <div class="col-md-6">
                    <img src="upload/images/group41.jpg" title="" alt="">
                </div>
                <div class="col-md-6">
                    <img src="upload/images/group42.jpg" title="" alt="">
                </div>
            </div>
        </div>
    </div>
</div>