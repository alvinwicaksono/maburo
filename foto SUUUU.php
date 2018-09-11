<!DOCTYPE html>
<html>
<head>
	<title>PWL#</title>
</head>
<body>
	<form action="" method="post">
		<input type="text" name="tempat">
		<input type="submit" name="cari"><br>
	</form>
	
	<?php 
		if(isset($_POST['tempat'])){
			$url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=restaurant+in+".$_POST['tempat']."&key=AIzaSyBD_8cMyXJiVTxhZ-X8-6IUSbGYDY-hxzo";
			//inisialisasi CURL
			$ch = curl_init();

			//set URL-nya
			curl_setopt($ch, CURLOPT_URL, $url);
			
			//ini untuk mengambil isi body response-nya saja
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			//jalankan CURL-nya
			$result = curl_exec($ch);
			
			//tutup CURL-nya
			curl_close($ch);

			$jsonData = json_decode($result);
			if(count($jsonData->results) > 0) {
				for($i = 0; $i < count($jsonData->results); $i++) {
					echo "<img src=https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=".$jsonData->results[$i]->photos[0]->photo_reference."&key=AIzaSyBD_8cMyXJiVTxhZ-X8-6IUSbGYDY-hxzo>";
					echo $jsonData->results[$i]->name."<br>";
				}
			}
		}
	 ?>
</body>
</html>