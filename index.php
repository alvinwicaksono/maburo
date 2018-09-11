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
			$url = "https://www.els.co.id/?category=&s=".$_POST['keyword']."&search_posttype=product&search_sku=1";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			/* //JIKA POST
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS,
            "postvar1=value1&postvar2=value2&postvar3=value3");
            */

            /* //JIKA PAKAI COOKIE
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: test=cookie"));
			curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
            */


			$output = curl_exec($ch);
			curl_close($ch);

			$dom = new DOMDocument();
			$dom->loadHTML($output);
			$xpath = new DOMXpath($dom);
			$results = $xpath->query('//ul[@id="loop-products"]/li/div/div/div[@class="item-content"]');

			echo "<h3>Hasil Pencarian untuk kata ' ".$_POST['keyword']." '</h3>";
			foreach($results as $result){
				echo $result->childNodes[1]->nodeValue." - ".$result->childNodes[9]->nodeValue."<br>";
			}
		}
		
 	?>

</body>
</html>

