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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('admin/css/bootstrap.min.css'); ?>">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('public/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('public/css/font-awesome.min.css'); ?>" rel="stylesheet">


    <script type="text/javascript" src="<?php echo base_url('/admin/js/jquery-2.2.3.min.js'); ?>"></script>
    	
		<script type="text/javascript" src="<?php echo base_url('admin/assets/select2/js/select2.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/admin/js/bootstrap.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/admin/js/jquery-ui.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/admin/js/functions.js'); ?>"></script>

		<!-- Font Awesome -->
	  	<link rel="stylesheet" href="<?php echo base_url('admin/assets/cdnjs/font-awesome.min.css'); ?>">
	  	
		  <!-- Ionicons -->
	  	<link rel="stylesheet" href="<?php echo base_url('admin/assets/cdnjs/ionicons.min.css'); ?>">
	  	
  		<!-- Skin style -->
  		<link rel="stylesheet" type="text/css" href="<?php echo base_url('admin/css/skins/_all-skins.min.css'); ?>" media="screen">
      <!-- Theme style -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('admin/css/AdminLTE.css'); ?>" media="screen">


    <script type="text/javascript" src="<?php echo base_url('admin/assets/datatables-bootstrap/dataTables.bootstrap.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('admin/assets/datatables-bootstrap/jquery.dataTables.js'); ?>"></script>
	
	<script src="<?php echo base_url('/admin/js/app.min.js'); ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url('/admin/js/jquery.slimscroll.min.js'); ?>"></script>

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
    
  </head>

<body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
      	<div class="col-xs-6 col-sm-4">
      		<img src="<?php echo base_url('admin/images/abipraya.png'); ?>" width="60" height="60" class="img-responsive" alt="Responsive image" class="user-image">
      	</div>

      	<div class="col-xs-6 col-sm-4 centered">
      		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
          	</button>
	        <a class="navbar-collapse collapse" href="<?php echo base_url('index.php/public/pegawai')?>"><font color="white"><h4>Abipraya Test Programming</h4></font></a>
	        <!-- <h3>PEKAN OLAHRAGA NASIONAL XIX JAWA BARAT</h3> -->
	    </div> 

	    <div class="col-xs-6 col-sm-4">
	    	   
	        <div class="navbar-collapse collapse navbar-right">
	          <ul class="nav navbar-nav">
	            <ul class="nav navbar-nav">
	          	<li class="<?php echo strpos(current_url(), base_url('index.php/router/login')) !== false ? 'active' : '';?>"><a href="<?php echo base_url('index.php/router/login'); ?>">LOGIN</a></li>
	          </ul>
	          </ul>
	        </div><!--/.nav-collapse -->
	    </div>    
      </div>
    </div>

	<br/>
	<div class="container">
			<h3>Public View</h3>
	</div> <!-- /container -->
	
	<!-- *****************************************************************************************************************
	 TITLE & CONTENT
	 ***************************************************************************************************************** -->
	 
	<!-- *****************************************************************************************************************
	 CONTENT SECTION
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
                    <h4>Copyright</h4>
                    <div class="hline-w"></div>
                    <h5>
                        Copyright &copy; 2019 <a href="">Test Abipraya</a>.All rights reserved.
                    </h5>
                </div>
		 	
		 	</div>
	 	</div>
	 </div>

	 
	
  </body>
</html>

<div id="dialog"></div>