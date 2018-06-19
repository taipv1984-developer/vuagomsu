<?php
$messages = SessionMessage::getSessionMessages();
if (!empty($messages)) {
    foreach ($messages as $k => $mess) {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {

                toastr.options = {
                    closeButton: true,
                    debug: false,
                    positionClass: 'toast-top-right',
                    onclick: null
                };
                toastr.options.showDuration = '1000';
                toastr.options.hideDuration = '1000';
                toastr.options.timeOut = '5000';
                toastr.options.extendedTimeOut = '1000';
                toastr.options.showEasing = 'swing';
                toastr.options.hideEasing = 'linear';
                toastr.options.showMethod = 'fadeIn';
                toastr.options.hideMethod = 'fadeOut';
                toastr['<?=strtolower($k)?>']('<?=$mess[0]?>', '<?=strtoupper($k)?>');
            });
        </script>
    <?php }
} ?>