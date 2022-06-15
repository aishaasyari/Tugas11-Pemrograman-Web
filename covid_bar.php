<?php
include("koneksi.php");
$sql = mysqli_query($koneksi,"SELECT * FROM tb_recovery");
while ($row = mysqli_fetch_array($sql)) {
	$country_name [] = $row['nama_negara'];
	
	$query = mysqli_query($koneksi,"SELECT new_cases, new_deaths, new_recovered, total_cases, total_deaths, total_recovered FROM tb_recovery WHERE id_negara='".$row['id_negara']."'");
	$row = $query->fetch_array();
    $new_cases[] = $row['new_cases'];
    $new_deaths[] = $row['new_deaths'];
    $new_recovered[] = $row['new_recovered'];
	$total_cases[] = $row['total_cases'];
    $total_deaths[] = $row['total_deaths'];
    $total_recovered[] = $row['total_recovered'];
    
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 1500px;height: 1500px">
		<canvas id="myChart"></canvas>
	</div>


	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($country_name); ?>,
                datasets: [{
                    label: 'New Cases',
                    data: <?php echo json_encode($new_cases); ?>,
                    backgroundColor: 'rgba(220, 20, 60, 1 )',
                    borderWidth: 5
                },
                {
                    label: 'New Death',
                    data: <?php echo json_encode($new_deaths); ?>,
                    backgroundColor: 'rgba(255, 127, 80, 1)',
                    borderWidth: 5
                },
                {
                    label: 'New Recovered',
                    data: <?php echo json_encode($new_recovered); ?>,
                    backgroundColor: 'rgba(0, 206, 209, 1 )',
                    borderWidth: 5
                },
                {
                    label: 'Total Cases',
                    data: <?php echo json_encode($total_cases); ?>,
                    backgroundColor: 'rgba(148, 0, 211, 1)',
                    borderWidth: 5
                },
                {
                    label: 'Total Death',
                    data: <?php echo json_encode($total_deaths); ?>,
                    backgroundColor: 'rgba(34, 139, 34, 1 )',
                    borderWidth: 5
                },
                {
                    label: 'Total Recovered',
                    data: <?php echo json_encode($total_recovered); ?>,
                    backgroundColor: 'rgba(255, 105, 180, 1)',
                    borderWidth: 5
                }]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>