<?php
include('koneksi.php');
$produk = mysqli_query($koneksi,"SELECT * FROM tb_recovery");
while($row = mysqli_fetch_array($produk)){
	$nama_produk[] = $row['nama_negara'];
	
	$query = mysqli_query($koneksi,"SELECT sum(total_cases) AS jumlah FROM tb_recovery WHERE id_negara='".$row['id_negara']."'");
	$row = $query->fetch_array();
	$jumlah_produk[] = $row['jumlah'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Total Cases</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($nama_produk); ?>,
				datasets: [{
					label: 'Grafik Angka Total Cases Penderita Covid-19',
					data: <?php echo json_encode($jumlah_produk); ?>,
					backgroundColor: 'rgba(127, 255, 0, 1)',
					borderColor: 'rgba(124, 207, 0, 1)',
					borderWidth: 1
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