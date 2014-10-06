
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

	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-theme.min.css">
	<script src="/assets/bootstrap/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Game', 'Player PTS', 'Team PTS'],
				<?
				// I hate this - let's try to extract from the table itself if we have time
				$data = [];
				foreach( $Player->Games as $Game ):

					$data[] = "['{$Game->date}', {$Game->pts}, {$Game->teamPts}]";

				endforeach;

				echo implode(",", $data);
				?>
			]);

			var options = {
				title: 'Player Performance by Game'
			};

			var chart = new google.visualization.LineChart(document.getElementById('playerChart'));

			chart.draw(data, options);
		}
	</script>

</head>

<body>

<!-- Begin page content -->
<div class="container">
	<div class="page-header">
		<h1><?=$Player->name ?> <small><?=$Player->teamName ?></small></h1>
	</div>

	<div id="playerChart" style="margin-bottom:30px;"></div>

	<table class="table table-bordered">
		<thead>
		<tr>
			<th>Date</th>
			<th>Opponent</th>
			<th>Player PTS</th>
			<th>Team PTS</th>
			<th>Result</th>
		</tr>
		</thead>
		<tbody>
		<? foreach( $Player->Games as $Game ): ?>
		<tr>
			<td><?=$Game->date ?></td>
			<td><?=$Game->opponent ?></td>
			<td><?=$Game->pts ?></td>
			<td><?=$Game->teamPts ?></td>
			<td><?=$Game->result ?></td>
		</tr>
		<? endforeach; ?>
		</tbody>
	</table>



</div>


</body>
</html>
