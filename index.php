<!DOCTYPE html>
<html>
<head>
	<?php 
		require "style.php";
	 ?>
</head>
<body>
		<?php 
			require "header.php";
		 ?>

        <!--================Home Banner Area =================-->
        <section class="home_banner_area">
            <div class="banner_inner d-flex align-items-center">
				<div class="container">
					<div class="banner_content row">
						<div class="col-lg-5">
							<h3>TUKUO !</h3>
							<p>Mencari harga Smartphone terbaik dari 3 website terkenal, yaitu erafone.com, oke.com dan grandcellular.com </p>
							<form action="" method="post">
								<input class="search_bg_btn" type="text" name="keyword" placeholder="Keyword" />
								<input class="white_bg_btn" type="submit" value="C A R I"/>
							</form>
						</div>
						<div class="col-lg-7">
							<div class="halemet_img">
								<img src="img/banner/hp.png" alt="">
							</div>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->

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

			$imagesGC = $xpathGC->query('//a/img[@class="img-responsive"]//attribute::src');

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

			$imagesOke = $xpathOke->query('//a[@class="product_img_link product_image"]/img//attribute::src');

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
			$resultsEra = $xpathEra->query('//ol[@class="products list items product-items"]/li/div[@class="product-item-info"]/div[@class="product details product-item-details"]');
			
			$imagesEra = $xpathEra->query('//span/img[@class="product-image-photo"]//attribute::src');

		}

		?>

	<?php 
		if (isset($_POST["keyword"])) {
	?>

		<!--================Feature Product Area =================-->
        <section class="feature_product_area">
        	<div class="main_box">
				<div class="container">
					<?php 
						echo "<h2 class='main_title'>Hasil Pencarian untuk ".$_POST['keyword']."</h2><br><br>";
					 ?>
					<div class="feature_product_inner">
						<div class="main_title">
							<h2>Grand Cellular</h2>
						</div>
						<div class="feature_p_slider owl-carousel">

						<?php 

						//GRAND CELLULAR ================================>>
						foreach($resultsGC as $indexGC => $resultGC){
						echo '<div class="item">
								<div class="f_p_item">
									<div class="f_p_img">
										<img class="img-fluid" src="'.$imagesGC[$indexGC]->nodeValue.'" alt="">
									</div>
									<a href="#"><h4>'.$resultGC->childNodes[1]->nodeValue.'</h4></a>
									<h5>'.$resultGC->childNodes[5]->nodeValue.'</h5>
								</div>
							</div>';
						}
						?>
						</div>
						<br>
						<div class="main_title">
							<h2>Oke Shop</h2>
						</div>
						<div class="feature_p_slider owl-carousel">

						<?php 

						//OKE SHOP ================================>>
						foreach($resultsOke as $indexOke => $resultOke){
						echo '<div class="item">
								<div class="f_p_item">
									<div class="f_p_img">
										<img class="img-fluid" src="'.$imagesOke[$indexOke]->nodeValue.'" alt="">
									</div>
									<a href="#"><h4>'.$resultOke->childNodes[0]->nodeValue.'</h4></a>
									<h5>'.$resultOke->childNodes[1]->nodeValue.'</h5>
								</div>
							</div>';
						}
						?>
						</div>
						<br>
						<div class="main_title">
							<h2>Erafone</h2>
						</div>
						<div class="feature_p_slider owl-carousel">

						<?php 

						//ERAFONE ================================>>
						foreach($resultsEra as $indexEra => $resultEra){
						echo '<div class="item">
								<div class="f_p_item">
									<div class="f_p_img">
										<img class="img-fluid" src="'.$imagesEra[$indexEra]->nodeValue.'" alt="">
									</div>
									<a href="#"><h4>'.$resultEra->childNodes[1]->nodeValue.'</h4></a>
									<h5>'.$resultEra->childNodes[3]->nodeValue.'</h5>
								</div>
							</div>';
						}
						?>
						</div>
					</div>
				</div>
        	</div>
        </section>
        <!--================End Feature Product Area =================-->
    <?php 
    	}
    ?>


    <!--================Clients Logo Area =================-->
        <section class="clients_logo_area">
        	<div class="container">
        		<div class="main_title">
        			<h2>Top Brand Masa Kini</h2>
        			<p>Daftar brand-brand terkenal dalam dunia persemartphonan.</p>
        		</div>
        		<div class="clients_slider owl-carousel">
        			<div class="item">
        				<img src="img/brands/xiaomi.png" alt="">
        			</div>
        			<div class="item">
        				<img src="img/brands/apple.png" alt="">
        			</div>
        			<div class="item">
        				<img src="img/brands/samsung.png" alt="">
        			</div>
        			<div class="item">
        				<img src="img/brands/asus.png" alt="">
        			</div>
        			<div class="item">
        				<img src="img/brands/oppo.png" alt="">
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Clients Logo Area =================-->


    	<!--================Latest Product Area =================-->
    <?php 
    	ini_set('display_errors', 'off');

    	//MAJALAH GSM ARENA

    	$urlGSM = "https://www.gsmarena.com/";

			$chGSM = curl_init();
			curl_setopt($chGSM, CURLOPT_URL, $urlGSM);
			curl_setopt($chGSM, CURLOPT_RETURNTRANSFER, true);
			$outputGSM = curl_exec($chGSM);
			curl_close($chGSM);

			$domGSM = new DOMDocument();
			$domGSM->loadHTML($outputGSM);
			$xpathGSM = new DOMXpath($domGSM);

			$resultsGSM = $xpathGSM->query('//div[@class="module module-phones module-instores"]/div/a[@class="module-phones-link"]');

			$imagesGSM = $xpathGSM->query('//div[@class="module module-phones module-instores"]/div/a[@class="module-phones-link"]/img//attribute::src');
     ?>
        <section class="feature_product_area latest_product_area">
        	<div class="main_box">
				<div class="container">
					<div class="feature_product_inner">
						<div class="main_title">
							<h2>Latest Products</h2>
							<p>Smartphone yang baru saja keluar versi Majalah GSM Arena.</p>
						</div>
						<div class="latest_product_inner row">
				<?php 
					foreach($resultsGSM as $indexGSM => $resultGSM){
						echo '<div class="col-lg-3 col-md-4 col-sm-6">
								<div class="f_p_item">
									<div class="f_p_img">
										<img class="img-fluid" src="'.$imagesGSM[$indexGSM]->nodeValue.'" alt="">
									</div>
									<a href="#"><h4>'.$resultGSM->nodeValue.'</h4></a>
								</div>
							</div>';
					}	
				 ?>	
						</div>
					</div>
				</div>
        	</div>
        </section>
        <!--================End Latest Product Area =================-->

       <?php 
       		require "footer.php";
       		require "java.php";
        ?>

	
	</body>
</html>
