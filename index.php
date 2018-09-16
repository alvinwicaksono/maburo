<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/tukuo.png" type="image/png">

        <title>TUKUO</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="vendors/animate-css/animate.css">
        <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css"> 
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
	<!--================Header Menu Area =================-->
        <header class="header_area">
           	<div class="top_menu row m0">
           		<div class="container">
					<div class="float-left">
						<a href="#">tukuo@gmail.com</a>
						<a href="#">Welcome to Tukuo</a>
					</div>
					<div class="float-right">
						<ul class="header_social">
							<li><a href="https://web.facebook.com/abed.petraprasetya"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com/AbednegoPetra"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://www.instagram.com/bebedsky_/"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
           		</div>	
           	</div>	
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light main_box">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav ml-auto">
								<li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li> 
								<li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
								<li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class="nav-item"><a class="nav-link" href="#">Login</a></li>
							</ul>
						</div> 
					</div>
            	</nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->

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
			$resultsEra = $xpathEra->query('//ol[@class="products list items product-items"]/li/div[@class="product-item-info"]');
			
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

						//OKE SHOP ================================>>
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

        <!--================ start footer Area  =================-->	
        <footer class="footer-area">
            <div class="container">
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <div class="col-lg-12 footer-text text-center">
                        <h6 class="footer_title">About Us</h6>
                        <p>Rasah kakean fafifu wes langsung gaske wae.</p>
                    </div>
                </div>						
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-12 footer-text text-center"> Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
                </div>
            </div>
        </footer>
		<!--================ End footer Area  =================-->


        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/stellar.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="vendors/isotope/isotope-min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="vendors/flipclock/timer.js"></script>
        <script src="vendors/counter-up/jquery.counterup.js"></script>
        <script src="js/mail-script.js"></script>
        <script src="js/theme.js"></script>

	
	</body>
</html>