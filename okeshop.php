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
			$url = "http://www.oke.com/search?controller=search&orderby=position&orderway=desc&search_query=".$_POST['keyword']."&submit_search=Search";

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



			$results = $xpath->query('//ul[@id="product_list"]/li/div/div[@class="product_info_container small-8 medium-12 large-12 columns"]');
			

			echo "<h3>Hasil Pencarian untuk HP ' ".$_POST['keyword']." '</h3>";
			foreach($results as $result){
				echo $result->childNodes[0]->nodeValue." - ".$result->childNodes[1]->nodeValue."<br>";
			}
		}
		
 	?>

</body>
</html>

