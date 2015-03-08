

<table class="table table-striped table-bordered" id="pvpstats">
	<thead>
		<tr>
			<th>Player Killed</th>
			<th>Weapons used</th>
			<th>Amount Killed</th>
		</tr>
	</thead>
	<tbody>
		<?php $pvp_stats = pvp_stats($player->playerId,$mysqli,$config[$serverId]["mysql"]["stats"]["table_prefix"]); ?>
		<?php if (!empty($pvp_stats)): ?>
		<?php foreach ($pvp_stats as $id => $value) :?>
		<?php
			$killed = getPlayersName($value["killed"],$mysqli,$config[$serverId]["mysql"]["stats"]["table_prefix"]);
			$image_killed_url = player_face($killed,$config[$serverId]["faces"]["pvp"]["size"],$config[$serverId]["faces"]["pvp"]["url"]);
		?>
		<tr>
			<td>
				<a href="<?=$BlueStats->makePlayerUrl($value["killed"])?>">
				<?='<img class="player-head-player_page" src="'.$image_killed_url.'" alt=""/> '.$killed; ?></a>
			</td>
			<td><?=$value["weapon"];?></td>
			<td><?=$value["amount"];?></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
<script>
	$(document).ready(function() {
		$('#pvpstats').dataTable({
			responsive: true
		});
	} );
</script>
