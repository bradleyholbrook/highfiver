
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>High Fiver</title>

	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap-theme.min.css">
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>

</head>

<body>

<!-- Begin page content -->
<div class="container">
	<div class="page-header">
		<h1>High Fiver!</h1>
	</div>

	<table class="table table-bordered">
		<thead>
		<tr>
			<th>Player</th>
		</tr>
		</thead>
		<tbody>
		<? foreach( $Leaderboard as $LeaderboardData ): ?>
		<tr>
			<td><a href="/index.php/highfiver/player/<?=$LeaderboardData->Player->id ?>"/><?=$LeaderboardData->Player->name ?></a></td>
		</tr>
		<? endforeach; ?>

		<? if( count( $Leaderboard ) == 0 ): ?>
		<tr>
			<td>
				Sorry! High Fiver doesn't have enough data to accurately display the top 5 players in Indiana!
			</td>
		</tr>
		<? endif; ?>

		</tbody>
	</table>

</div>


</body>
</html>
