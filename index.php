<!DOCTYPE html>
<html>
<head>
	<title>TUKUO</title>
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

		//Grand Celluler -------------------------------------

			$urlGC = "http://grandcellular.co.id/index.php?route=product/search&search=".$_POST['keyword'];

			$chGC = curl_init();
			curl_setopt($chGC, CURLOPT_URL, $urlGC);
			curl_setopt($chGC, CURLOPT_RETURNTRANSFER, true);
			$outputGC = curl_exec($chGC);
			curl_close($chGC);

			$domGC = new DOMDocument();
			$domGC->loadHTML($outputGC);
			$xpathGC = new DOMXpath($domGC);

			$resultsGC = $xpathGC->query('//div[@id="content"]/div[@class="row"]/div/div[@class="product-thumb"]/div/div[@class="caption"]');

		//OkeShop ---------------------------------------------

			$urlOke = "http://www.oke.com/search?controller=search&orderby=position&orderway=desc&search_query=".$_POST['keyword']."&submit_search=Search";

			$chOke = curl_init();
			curl_setopt($chOke, CURLOPT_URL, $urlOke);
			curl_setopt($chOke, CURLOPT_RETURNTRANSFER, true);
			$outputOke = curl_exec($chOke);
			curl_close($chOke);

			$domOke = new DOMDocument();
			$domOke->loadHTML($outputOke);
			$xpathOke = new DOMXpath($domOke);

			$resultsOke = $xpathOke->query('//ul[@id="product_list"]/li/div/div[@class="product_info_container small-8 medium-12 large-12 columns"]');
			$resultsOkeImg = $xpathOke->query('//ul[@id="product_list"]/li/div/span[@class="product_image_container small-4 medium-12 large-12 columns"]/a');

		//Erafone -----------------------------------------------

			$urlEra = "https://erafone.com/catalogsearch/result/?q=".$_POST['keyword'];
			$chEra = curl_init();
			curl_setopt($chEra, CURLOPT_URL, $urlEra);
			curl_setopt($chEra, CURLOPT_RETURNTRANSFER, true);
			$outputEra = curl_exec($chEra);
			curl_close($chEra);

			$domEra = new DOMDocument();
			$domEra->loadHTML($outputEra);
			$xpathEra = new DOMXpath($domEra);
			$resultsEra = $xpathEra->query('//ol[@class="products list items product-items"]/li/div/div[@class="product details product-item-details"]');
		}
		?>

		
		<table>
			<tr>
				<?php
					//CETAK HASIL -------------------------------------------	
					echo "<h3>Hasil Pencarian untuk HP ' ".$_POST['keyword']." '</h3>";	
				?>
			</tr>
			<tr>
				<td>Grand Cellular</td>
				<td>OkeShop</td>
				<td>Erafone</td>
			</tr>
			<tr>
				<td>
				<?php	
					foreach($resultsGC as $resultGC){
						echo $resultGC->childNodes[1]->nodeValue." - ".$resultGC->childNodes[5]->nodeValue."<br>";
					}
				?>
				</td>
				<td>
				<?php
					foreach ($resultsOkeImg as $resultOkeImg){
						echo $resultOkeImg->childNodes[1]->nodeValue."<br>";
					}
					foreach($resultsOke as $resultOke){
						echo $resultOke->childNodes[0]->nodeValue." - ".$resultOke->childNodes[1]->nodeValue."<br>";
					}
				?>
				</td>
				<td>
				<?php
					foreach($resultsEra as $resultEra){
					echo $resultEra->childNodes[1]->nodeValue." - ".$resultEra->childNodes[3]->nodeValue."<br>";
					}
				?>
				</td>
			</tr>
		</table>
	
	</body>
</html>