<!DOCTYPE html>
<html>
<head>
	<title>PWL4</title>
</head>
<body>
	<br><br>
	<form action="" method="post">
		<input type="text" name="keyword"/>
		<input type="submit" value="Cari !"/>
	</form>
	<br>

	<?php 
		ini_set('display_errors', 'off');

		if (isset($_POST['keyword'])) {
			$url = "https://erafone.com/catalogsearch/result/?q=".$_POST['keyword'];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($ch);
			curl_close($ch);

			/*
			JIKA POST :

			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "postvar.......");
			*/

			$dom = new DOMDocument();
			$dom->loadHTML($output);
			$xpath = new DOMXpath($dom);
			$results = $xpath->query('//ol[@class="products list items product-items"]/li/div/div[@class="product details product-item-details"]');
			$gambar = $xpath->query('//div[@class="product-item-info"]/a/span/span[@class="product-image-wrapper"]');

			echo "<h3>Hasil Pencarian untuk kata ' ".$_POST['keyword']." '</h3>";
			foreach($results as $result){
				echo $result->childNodes[1]->nodeValue." - ".$result->childNodes[3]->nodeValue."<br>";
			}

			foreach ($gambar as $gambars) {
				echo '<img src=" $gambar->childNodes[1]->nodeValue"/>';
			}
		}
		
 	?>

</body>
</html>

