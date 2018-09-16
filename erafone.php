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

			$url = "https://www.gsmarena.com/";
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
			$results = $xpath->query('//div[@class="article_container"]/div[@class="article_body"]');
			$gambar = $xpath->query('//div[@class="article_body"]/p[@class="bordeaux-image-check"]/img[@class=" lazy-image lazy-image-loading lazyload optional-image"]//attribute::src');

			//foreach($results as $result){
				echo $output."<br>";
			//}

		
		
 	?>

</body>
</html>

