<!--bootstrap-colorpickersliders-->
<script src="<?=URLHelper::getResource('resource/backend/js/bootstrap-colorpickersliders/dist/tinycolor.min.js')?>" type="text/javascript"></script>
<script src="<?=URLHelper::getResource('resource/backend/js/bootstrap-colorpickersliders/dist/bootstrap.colorpickersliders.js')?>" type="text/javascript"></script>
<link href="<?=URLHelper::getResource('resource/backend/js/bootstrap-colorpickersliders/dist/bootstrap.colorpickersliders.css')?>" rel="stylesheet" type="text/css">
<script type="text/javascript">
    $("input.ColorPickerSliders").ColorPickerSliders({
        color: '#fff',
        size: 'sm',
        placement: 'right',
        sliders: true,
        hsvpanel: true,
        customswatches: false,
        order: {
            opacity: 1,
            hsl: 2,
            preview: 3
        }
    });
</script>