<?php
    $isMobile = Session::getSession('isMobile');
    if($isMobile){
        include 'mobile.php';
    }
    else {
        include 'desktop.php';
    }
?>

<script type="text/javascript">
    function goBackFromCat() {
        window.history.go(-1);
    }
</script>