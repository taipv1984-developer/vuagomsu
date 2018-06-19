<?php 
	//ordersStatistics
	$ordersStatistics = $params['ordersStatistics'];
	$totalOrdersByYear = $ordersStatistics['totalOrdersByYear'];
	$totalOrdersByMonth = $ordersStatistics['totalOrdersByMonth'];
	$totalOrdersByDay = $ordersStatistics['totalOrdersByDay'];
	$minYear = $ordersStatistics['minYear'];
	$maxYear = $ordersStatistics['maxYear'];

	$statisticMode = $params['statisticMode'];
	$curentYear = ($params['year']) ? $params['year'] : DateHelper::getCurentYear();
	$curentMonth = ($params['month']) ? $params['month'] : DateHelper::getCurentMonth();
	
	$statisticStep = Registry::getSetting('orders_statistic_step');
?>

<div class="statistic_container">
	<div id="placeholder" class="demo-placeholder"></div>
</div>

<script type="text/javascript">
	$(function () {
		//get optionsYear
		<?php $statisticData = $totalOrdersByYear ?>
		var optionsYear = {
			series: {
				lines: { show: true },
				points: { show: true }
			},
			xaxis: {
				<?php
					// ticks: [2015, 2016, 2017, 2018, 2019]
				$ticks = array ();
				foreach ( $statisticData as $k => $v ) {
					$ticks [] = $k;
				}
				echo "ticks: [" . join ( ', ', $ticks ) . "]";
				?>,
				tickDecimals: 0
			},
			yaxis: {
				<?php
				// ticks: [0, 50, 100, 150, 200, 250]
				$ticks = array (0);
				$i = 0;
				while($i < max($statisticData)){
					$i += $statisticStep;
					$ticks [] = $i;
				}
				echo "ticks: [" . join ( ', ', $ticks ) . "]";
				?>,
				tickDecimals: 0
			},
			grid: {
				backgroundColor: { colors: [ "#fff", "#eee" ] },
				borderWidth: {
					top: 1,
					right: 1,
					bottom: 2,
					left: 2
				},
				hoverable: true,
				clickable: true
			}
		};
		//get dataYear
		var dataYear = [];
		<?php 
			//dataYear.push([x, y]);
			foreach ($totalOrdersByYear as $k => $v){
				echo "dataYear.push([$k, $v]);\n";
			}
		?>

		//get optionsMonth
		<?php $statisticData = $totalOrdersByMonth[$curentYear]; ?>
		var optionsMonth = {
			series: {
				lines: { show: true },
				points: { show: true }
			},
			xaxis: {
				<?php
					// ticks: [1...12]
				$ticks = array ();
				for($i = 1; $i <= 12; $i++) {
					$ticks [] = $i;
				}
				echo "ticks: [" . join ( ', ', $ticks ) . "]";
				?>,
				tickDecimals: 0
			},
			yaxis: {
				<?php
				// ticks: [0, 50, 100, 150, 200, 250]
				$ticks = array (0);
				$i = 0;
				while($i < max($statisticData)){
					$i += $statisticStep;
					$ticks [] = $i;
				}
				echo "ticks: [" . join ( ', ', $ticks ) . "]";
				?>,
				tickDecimals: 0
			},
			grid: {
				backgroundColor: { colors: [ "#fff", "#eee" ] },
				borderWidth: {
					top: 1,
					right: 1,
					bottom: 2,
					left: 2
				},
				hoverable: true,
				clickable: true
			}
		};
		//get dataMonth		
		var dataMonth = [];
		<?php 
			//dataMonth.push([x, y]);
			foreach ($statisticData as $k => $v){
				echo "dataMonth.push([$k, $v]);\n";
			}
		?>

		//get optionsDay
		<?php $statisticData = $totalOrdersByDay[$curentYear][$curentMonth]; ?>
		var optionsDay = {
			series: {
				lines: { show: true },
				points: { show: true }
			},
			xaxis: {
				<?php
					// ticks: [1...31]
				$ticks = array ();
				for($i = 1; $i <= 31; $i++) {
					$ticks [] = $i;
				}
				echo "ticks: [" . join ( ', ', $ticks ) . "]";
				?>,
				tickDecimals: 0
			},
			yaxis: {
				<?php
				// ticks: [0, 50, 100, 150, 200, 250]
				$ticks = array (0);
				$i = 0;
				while($i < max($statisticData)){
					$i += $statisticStep;
					$ticks [] = $i;
				}
				echo "ticks: [" . join ( ', ', $ticks ) . "]";
				?>,
				tickDecimals: 0
			},
			grid: {
				backgroundColor: { colors: [ "#fff", "#eee" ] },
				borderWidth: {
					top: 1,
					right: 1,
					bottom: 2,
					left: 2
				},
				hoverable: true,
				clickable: true
			}
		};
		//get dataDay		
		var dataDay = [];
		<?php 
			//dataDay.push([x, y]);
			foreach ($statisticData as $k => $v){
				echo "dataDay.push([$k, $v]);\n";
			}
		?>

		//show statistic
		<?php if($statisticMode == 'year'){?>
		$.plot("#placeholder", [{ label: "<?=e('Orders total by month')?>", data: dataMonth, color: "#4db3a4",}], optionsMonth);
		<?php } else {//default?>
		$.plot("#placeholder", [{ label: "<?=e('Orders total by day')?>", data: dataDay, color: "#1E91CF",}], optionsDay);
		<?php }?>
		
		//tooltip
		$("<div id='tooltip'></div>").css({
			position: "absolute",
			display: "none",
			border: "1px solid #fdd",
			padding: "2px",
			"background-color": "#fee",
			opacity: 0.9
		}).appendTo("body");

		$("#placeholder").bind("plothover", function (event, pos, item) {
			if (item) {
				var x = item.datapoint[0].toFixed(0),
					y = item.datapoint[1].toFixed(2);
				//console.log(`x = ${x} ... y = ${y}`);
				$("#tooltip").html(item.series.label + " of " + x + " = <b>" + y + '</b>')
					.css({top: item.pageY+5, left: item.pageX+5})
					.fadeIn(200);
			} else {
				$("#tooltip").hide();
			}
		});

		//statistic_by_year click event
		$(document).on('click','.statistic_by_year', function() {
			//message
			show_notice('Statistic by year success');
		
			//update plot
			$.plot("#placeholder", [{ label: "<?=e('Orders total by year')?>", data: dataYear, color: "#069",}], optionsYear);
		});
	});
</script>