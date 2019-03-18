<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('admin/ico/favicon.ico'); ?>">

    <title><?php echo $site_title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('public/css/bootstrap.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('public/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('public/css/font-awesome.min.css'); ?>" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>';
    </script>
    <script src="<?php echo base_url('public/js/modernizr.js'); ?>"></script>
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="index.html">SOLID.</a> -->
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url('index.php/public/cabor/'); ?>">Cabor</a></li>
            <li><a href="<?php echo base_url('index.php/public/contingent/'); ?>">Contingent</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


	<!-- *****************************************************************************************************************
	 BLUE WRAP
	 ***************************************************************************************************************** -->
	<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>PEKAN OLAHRAGA NASIONAL XIX 2016</h3>
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /blue -->

	<!-- *****************************************************************************************************************
	 TITLE & CONTENT
	 ***************************************************************************************************************** -->

	 <!-- <div class="container mtb">
	 	<div class="row">
		 	<div class="col-lg-8 col-lg-offset-2 centered">
		 		<h2>We create awesome designs to standout your site or product. Check some of our latest works.</h2>
		 		<br>
		 		<div class="hline"></div>
		 	</div>
	 	</div>
	 </div> --><! --/container -->
	 
	<!-- *****************************************************************************************************************
	 PORTFOLIO SECTION
	 ***************************************************************************************************************** -->
     <section class="content">
     
     
	<?php echo count($content) > 0 ? $content[0][1] : '-'; ?>
     </section>
	<!-- *****************************************************************************************************************
	 FOOTER
	 ***************************************************************************************************************** -->
	 <div id="footerwrap">
	 	<div class="container">
		 	<div class="row">
		 		<div class="col-lg-4">
		 			<!-- <h4>About</h4>
		 			<div class="hline-w"></div>
		 			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p> -->
		 		</div>
		 		<div class="col-lg-4">
		 			<h4>Social Links</h4>
		 			<div class="hline-w"></div>
		 			<p>
		 				<a href="#"><i class="fa fa-dribbble"></i></a>
		 				<a href="#"><i class="fa fa-facebook"></i></a>
		 				<a href="#"><i class="fa fa-twitter"></i></a>
		 				<a href="#"><i class="fa fa-instagram"></i></a>
		 				<a href="#"><i class="fa fa-tumblr"></i></a>
		 			</p>
		 		</div>
		 		<div class="col-lg-4">
                    <h4>Copyright</h4>
                    <div class="hline-w"></div>
                    <p>
                        Copyright &copy; 2019 <a href="">Test Abipraya</a>.All rights reserved.
                    </p>
                </div>
		 	
		 	</div><! --/row -->
	 	</div><! --/container -->
	 </div><! --/footerwrap -->
	 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?php echo base_url('public/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/js/retina-1.1.0.js'); ?>"></script>
	<script src="<?php echo base_url('public/js/jquery.hoverdir.js'); ?>"></script>
	<script src="<?php echo base_url('public/js/jquery.hoverex.min.js'); ?>"></script>
	<script src="<?php echo base_url('public/js/jquery.prettyPhoto.js'); ?>"></script>
  	<script src="<?php echo base_url('public/js/jquery.isotope.min.js'); ?>"></script>
  	<script src="<?php echo base_url('public/js/custom.js'); ?>"></script>


    <script>
// Portfolio
(function($) {
	"use strict";
	var $container = $('.portfolio'),
		$items = $container.find('.portfolio-item'),
		portfolioLayout = 'fitRows';
		
		if( $container.hasClass('portfolio-centered') ) {
			portfolioLayout = 'masonry';
		}
				
		$container.isotope({
			filter: '*',
			animationEngine: 'best-available',
			layoutMode: portfolioLayout,
			animationOptions: {
			duration: 750,
			easing: 'linear',
			queue: false
		},
		masonry: {
		}
		}, refreshWaypoints());
		
		function refreshWaypoints() {
			setTimeout(function() {
			}, 1000);   
		}
				
		$('nav.portfolio-filter ul a').on('click', function() {
				var selector = $(this).attr('data-filter');
				$container.isotope({ filter: selector }, refreshWaypoints());
				$('nav.portfolio-filter ul a').removeClass('active');
				$(this).addClass('active');
				return false;
		});
		
		function getColumnNumber() { 
			var winWidth = $(window).width(), 
			columnNumber = 1;
		
			if (winWidth > 1200) {
				columnNumber = 5;
			} else if (winWidth > 950) {
				columnNumber = 4;
			} else if (winWidth > 600) {
				columnNumber = 3;
			} else if (winWidth > 400) {
				columnNumber = 2;
			} else if (winWidth > 250) {
				columnNumber = 1;
			}
				return columnNumber;
			}       
			
			function setColumns() {
				var winWidth = $(window).width(), 
				columnNumber = getColumnNumber(), 
				itemWidth = Math.floor(winWidth / columnNumber);
				
				$container.find('.portfolio-item').each(function() { 
					$(this).css( { 
					width : itemWidth + 'px' 
				});
			});
		}
		
		function setPortfolio() { 
			setColumns();
			$container.isotope('reLayout');
		}
			
		$container.imagesLoaded(function () { 
			setPortfolio();
		});
		
		$(window).on('resize', function () { 
		setPortfolio();          
	});
})(jQuery);
</script>
  </body>
</html>
