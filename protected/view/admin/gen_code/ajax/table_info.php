<?php 
	$tableInfo = $params['tableInfo'];
 ?>

 <table class="table table-striped table-bordered table-hover dataTable no-footer">
    <thead>
		<tr role="row" class="heading">
			<th><?=e('Field')?></th>
			<th><?=e('Type')?></th>
			<th><?=e('Null')?></th>
			<th><?=e('Key')?></th>
			<th><?=e('Default')?></th>
			<th><?=e('Extra')?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($tableInfo as $v){?>
			<tr>
				<td><?=$v['Field']?></td>
				<td><?=$v['Type']?></td>
				<td><?=$v['Null']?></td>
				<td><?=$v['Key']?></td>
				<td><?=$v['Default']?></td>
				<td><?=$v['Extra']?></td>
			</tr>
		<?php }?>
	</tbody>
</table>

<?php //var_dump($tableInfo)?>