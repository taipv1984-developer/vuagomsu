<button type="button" class="btn  btn-success-haze btn-circle submit"
    <?=(isset($params['js'])) ? "onclick='{$params['js']}'" : ''?>>
    <i class="<?= (isset($params['icon'])) ? $params['icon'] : 'fa fa-check' ?>"></i>
	<?= (isset($params['title'])) ? $params['title'] : 'Save';?>
</button>