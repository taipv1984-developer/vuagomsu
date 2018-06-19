<?php 
	$url = isset($params['url'])? $params['url'] : 'index.php?r=home/address_ajax';
	$country = $params['country'];
	$state = $params['state'];
	$city = $params['city'];
	$district = $params['district'];
?>
<?php
	TemplateHelper::getTemplate('common/input/select_row.php',array(
		'label'=> e('Country'),
		'id' => $country['id'],
		'name' => $country['name'],
		'options'=> AddressHelper::getAllCountry(),
		'value' => $country['value'],
		'rows' => 2,
		'class' => $country['class'],
		'attr' => $country['attr'],
	));
	echo "<div id=\"country_ajax_zone_{$country['id']}\">";
	TemplateHelper::getTemplate('common/input/select_row.php',array(
		'label'=> e('State'),
		'id' => $state['id'],
		'name' => $state['name'],
		'options'=> AddressHelper::getAllState($country['value']),
		'value' => $state['value'],
		'rows' => 2,
		'class' => $state['class'],
		'attr' => $state['attr'],
	));
	echo "<div id=\"state_ajax_zone_{$state['id']}\">";
	TemplateHelper::getTemplate('common/input/select_row.php',array(
		'label'=> e('City'),
		'id' => $city['id'],
		'name' => $city['name'],
		'options'=> AddressHelper::getAllCity($country['value'], $state['value']),
		'value' => $city['value'],
		'rows' => 2,
		'class' => $city['class'],
		'attr' => $city['attr'],
	));
	echo "<div id=\"city_ajax_zone_{$city['id']}\">";
	TemplateHelper::getTemplate('common/input/select_row.php',array(
		'label'=> e('District'),
		'id' => $district['id'],
		'name' => $district['name'],
		'options'=> AddressHelper::getAllDistrict($country['value'], $state['value'], $city['value']),
		'value' => $district['value'],
		'rows' => 2,
		'class' => $district['class'],
		'attr' => $district['attr'],
	));
	echo "</div>";	echo "<!-- end #city_ajax_zone -->";
	echo "</div>";	echo "<!-- end #state_ajax_zone -->";
	echo "</div>";	echo "<!-- end #country_ajax_zone -->";
?>

<script type="text/javascript">
	$('<?="#".$country['id'] ?>').change(function(){
		var object = '<?=$country['id'] ?>';
		var districtValue = $('<?="#".$district['id']?>').val();
	    var cityValue = $('<?="#".$city['id']?>').val();
	    var stateValue = $('<?="#".$state['id']?>').val();
	    var countryValue = $('<?="#".$country['id']?>').val();
	    console.log('coutry click ...<?=$url ?>');
	    $.ajax({
	        url: '<?=$url ?>',
	        type: 'post',
	        data:{'object': object, 
                'url': '<?=$url ?>',
                'countryId': '<?=$country['id']?>', 'countryName': '<?=$country['name']?>', 'countryValue': countryValue,
                'stateId': '<?=$state['id']?>', 'stateName': '<?=$state['name']?>', 'stateValue': stateValue,
                'cityId': '<?=$city['id']?>', 'cityName': '<?=$city['name']?>', 'cityValue': cityValue,
                'districtId': '<?=$district['id']?>', 'districtName': '<?=$district['name']?>', 'districtValue': districtValue,
               },
	        success: function(data){
	        	 console.log(data);
	            $('#country_ajax_zone_<?=$country['id'] ?>').html(data);
	       },
	        error: function(xhr, desc, err){
	            console.log(xhr + "\n" + err);
	       }
	   });
	});
	$('<?="#".$state['id'] ?>').change(function(){
		var object = '<?=$state['id']?>';
		var districtValue = $('<?="#".$district['id']?>').val();
	    var cityValue = $('<?="#".$city['id']?>').val();
	    var stateValue = $('<?="#".$state['id']?>').val();
	    var countryValue = $('<?="#".$country['id']?>').val();
	    $.ajax({
	    	url: '<?=$url ?>',
	        type: 'post',
	        data:{'object': object, 
                'url': '<?=$url ?>',
                'countryId': '<?=$country['id']?>', 'countryName': '<?=$country['name']?>', 'countryValue': countryValue,
                'stateId': '<?=$state['id']?>', 'stateName': '<?=$state['name']?>', 'stateValue': stateValue,
                'cityId': '<?=$city['id']?>', 'cityName': '<?=$city['name']?>', 'cityValue': cityValue,
                'districtId': '<?=$district['id']?>', 'districtName': '<?=$district['name']?>', 'districtValue': districtValue,
               },
	        cache: false,
	        success: function(data){
	            $('#state_ajax_zone_<?=$state['id'] ?>').html(data);
	       },
	        error: function(xhr, desc, err){
	            console.log(xhr + "\n" + err);
	       }
	   });
	});
    $('<?="#".$city['id'] ?>').change(function(){
    	var object = '<?=$city['id']?>';
	    var districtValue = $('<?="#".$district['id']?>').val();
	    var cityValue = $('<?="#".$city['id']?>').val();
	    var stateValue = $('<?="#".$state['id']?>').val();
	    var countryValue = $('<?="#".$country['id']?>').val();
        $.ajax({
        	url: '<?=$url ?>',
            type: 'post',
            data:{'object': object, 
                'url': '<?=$url ?>',
                'countryId': '<?=$country['id']?>', 'countryName': '<?=$country['name']?>', 'countryValue': countryValue,
                'stateId': '<?=$state['id']?>', 'stateName': '<?=$state['name']?>', 'stateValue': stateValue,
                'cityId': '<?=$city['id']?>', 'cityName': '<?=$city['name']?>', 'cityValue': cityValue,
                'districtId': '<?=$district['id']?>', 'districtName': '<?=$district['name']?>', 'districtValue': districtValue,
               },
            cache: false,
            success: function(data){
                $('#city_ajax_zone_<?=$city['id'] ?>').html(data);
           },
            error: function(xhr, desc, err){
                console.log(xhr + "\n" + err);
           }
       });
   });
</script>