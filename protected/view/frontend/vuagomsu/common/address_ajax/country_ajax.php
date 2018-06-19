<?php 
	$url = $params['url'];
	$country = $params['country'];
	$state = $params['state'];
	$city = $params['city'];
	$district = $params['district'];
?>
<?php
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
?>
<script type="text/javascript">
	$('<?php echo "#".$state['id'] ?>').change(function(){
		var object = '<?php echo $state['id']?>';
		var districtValue = $('<?php echo "#".$district['id']?>').val();
	    var cityValue = $('<?php echo "#".$city['id']?>').val();
	    var stateValue = $('<?php echo "#".$state['id']?>').val();
	    var countryValue = $('<?php echo "#".$country['id']?>').val();
	    $.ajax({
	    	url: '<?php echo $url ?>',
	        type: 'post',
	        data:{'object': object, 
                'cityValue': cityValue, 'stateValue': stateValue, 'countryValue': countryValue,
                'url': '<?php echo $url ?>',
                'countryId': '<?php echo $country['id']?>', 'countryName': '<?php echo $country['name']?>', 'countryValue': countryValue,
                'stateId': '<?php echo $state['id']?>', 'stateName': '<?php echo $state['name']?>', 'stateValue': stateValue,
                'cityId': '<?php echo $city['id']?>', 'cityName': '<?php echo $city['name']?>', 'cityValue': cityValue,
                'districtId': '<?php echo $district['id']?>', 'districtName': '<?php echo $district['name']?>', 'districtValue': districtValue,
               },
	        cache: false,
	        success: function(data){
	            $('#state_ajax_zone_<?php echo $state['id'] ?>').html(data);
	       },
	        error: function(xhr, desc, err){
	            console.log(xhr + "\n" + err);
	       }
	   });
	});
    $('<?php echo "#".$city['id'] ?>').change(function(){
    	var object = '<?php echo $city['id']?>'; 
	    var districtValue = $('<?php echo "#".$district['id']?>').val();
	    var cityValue = $('<?php echo "#".$city['id']?>').val();
	    var stateValue = $('<?php echo "#".$state['id']?>').val();
	    var countryValue = $('<?php echo "#".$country['id']?>').val();
        $.ajax({
        	url: '<?php echo $url ?>',
            type: 'post',
            data:{'object': object, 
                'cityValue': cityValue, 'stateValue': stateValue, 'countryValue': countryValue,
                'url': '<?php echo $url ?>',
                'countryId': '<?php echo $country['id']?>', 'countryName': '<?php echo $country['name']?>', 'countryValue': countryValue,
                'stateId': '<?php echo $state['id']?>', 'stateName': '<?php echo $state['name']?>', 'stateValue': stateValue,
                'cityId': '<?php echo $city['id']?>', 'cityName': '<?php echo $city['name']?>', 'cityValue': cityValue,
                'districtId': '<?php echo $district['id']?>', 'districtName': '<?php echo $district['name']?>', 'districtValue': districtValue,
               },
            cache: false,
            success: function(data){
                $('#city_ajax_zone_<?php echo $city['id'] ?>').html(data);
           },
            error: function(xhr, desc, err){
                console.log(xhr + "\n" + err);
           }
       });
   });
</script>