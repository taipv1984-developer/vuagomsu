<!-- scrolltop -->
<script language="javascript">
    function scrolltop(){
        var id_button = '.scrollToTop';

        // Kéo xuống khoảng cách 220px thì xuất hiện button
        var offset = 220;

        // THời gian di trượt là 0.5 giây
        var duration = 1000;

        // Thêm vào sự kiện scroll của window, nghĩa là lúc trượt sẽ
        // kiểm tra sự ẩn hiện của button
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > offset) {
                jQuery(id_button).fadeIn(duration);
            } else {
                jQuery(id_button).fadeOut(duration);
            }
        });

        // Thêm sự kiện click vào button để khi click là trượt lên top
        jQuery(id_button).click(function(event) {
            event.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, duration);
            return false;
        });
    }

    // Thực hiện
    $(document).ready(function(){
        scrolltop();
    });
</script>
<style type="text/css">
    .scrollToTop {
        background: #373C43;
        position: fixed;
        line-height: 50px;
        width: 50px;
        right: 30px;
        bottom: 50px;
        height: 50px;
        color: #f8f8f8;
        text-align: center;
        font-size: 22px;
        display: none;
        z-index: 999999999999;
        padding: 0;
        border: none;
        cursor: pointer;
        border-radius: 50%;
    }
</style>
<div class="scrollToTop" title="Lên đầu trang">
    <i class="fa fa-arrow-up" aria-hidden="true"></i>
</div>