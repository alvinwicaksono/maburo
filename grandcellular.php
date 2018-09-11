<!DOCTYPE html>
<html>
<head>
	<title>HP</title>
</head>
<body>
	<br><br>
	<form action="" method="post">
		<input type="text" name="keyword" placeholder="Keyword" />
		<input type="submit" value="Cari !"/>
	</form>
	<br>

	<?php 
		ini_set('display_errors', 'off');

		if (isset($_POST['keyword'])) {
			$url = "http://grandcellular.co.id/index.php?route=product/search&search=".$_POST['keyword'];

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output = curl_exec($ch);
			curl_close($ch);

			/* //JIKA POST
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS,
            "postvar1=value1&postvar2=value2&postvar3=value3");
            */

            /* //JIKA PAKAI COOKIE
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: test=cookie"));
			curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
            */

			$dom = new DOMDocument();
			$dom->loadHTML($output);
			$xpath = new DOMXpath($dom);

			$results = $xpath->query('//div[@id="content"]/div[@class="row"]/div/div[@class="product-thumb"]/div/div[@class="caption"]');
			

			echo "<h3>Hasil Pencarian untuk HP ' ".$_POST['keyword']." '</h3>";
			foreach($results as $result){
				echo $result->childNodes[1]->nodeValue." - ".$result->childNodes[5]->nodeValue."<br>";
			}
		}
		
 	?>

</body>
</html>

