<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Membuat Webservice Dengan Menggunakan Flickr</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</head>
	
<body>

	<div class="jumbotron text-center">
		<h1>Project Web Service</h1>
		<h2>Galeri Foto Menggunakan Flickr</h2>
		<h2>ADHI PRASETYO - 14.01.55.0029</h2>
	</div>
  
	<div class="container">
	  <div class="row">
				<div class="col-sm-3">
					<h3>Kategori Mobil</h3>
					<h4>- Honda</h4>
					<ul>
							<li>
								<a href="index.php?mobil=mobilio">Mobilio</a>
							</li>
							<li>
								<a href="index.php?mobil=agya">Agya</a>
							</li>
							<li>
								<a href="index.php?mobil=brv">BR-V</a>
							</li>
						</ul>
					<h4>- Mitsubishi</h4>
					<ul>
							<li>
								<a href="index.php?mobil=pajero">Pajero Sport</a>
							</li>
							<li>
								<a href="index.php?mobil=outlander">Outlander Sport</a>
							</li>
							<li>
								<a href="index.php?mobil=xpander">Xpander</a>
							</li>
				
						</ul>
				</div>
		<div class="col-sm-9">
		  <h3>Gambar</h3>        
		  <?php
		if(isset($_REQUEST['mobil'])){
			$mobil = $_REQUEST['mobil'];
		}
		else {
			$mobil = 'honda';
		}
		
		$url='https://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=d377226e22763800bbe356999c5f88f9&text='.$mobil;
		
		$url = file_get_contents($url);
		$xml = simplexml_load_string($url);
		$numOfCols = 4;
		$rowCount = 0;
		$bootstrapColWidth = 12 / $numOfCols;
		?>
			<div class="row">

			<?php
			//print_r($xml);
			foreach($xml->photos->photo as $foto){
			?>  
				<div class="col-sm-<?php echo $bootstrapColWidth; ?>">
				<?php
				echo $foto['title'];
				$alamat = 'https://farm' . $foto['farm'] . '.staticflickr.com/' . 
				$foto['server'] . '/' .
				$foto['id'] . '_' .
				$foto['secret'] . '.jpg'
				;
				echo '<br>';
				echo "<img src='$alamat' class='img-thumbnail'>";
				
				?>
				</div>
				<?php
				$rowCount++;
				if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
			}
		?>
			</div>
		</div>
	  </div>
	</div>

</body>
</html>
