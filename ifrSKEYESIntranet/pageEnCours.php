<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Page en construction</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />

		<!-- ace styles -->

		<link rel="stylesheet" href="assets/css/uncompressed/ace.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
        
        <script src="js/checkIfMobileScript.js"></script>
	</head>

	<body>
        <?php include("modals.php"); ?>
        <?php include("navbar.php"); ?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

                <?php include("navlist.php"); ?>

				<div class="main-content">
                    
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb" id="context-nav-bar">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="#">Portail</a>
							</li>
							<li class="active">Page en construction</li>
						</ul><!-- .breadcrumb -->

						<?php include("navsearch.php"); ?>
					</div>

					<div class="page-content" id="page-content">
						<div class="page-header" id="page-header">
							<h1>
								Page en construction
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                            <div class="space-6"></div>
                            
							<div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->

                                <div class="error-container">
									<div class="well">
										<h1 class="grey lighter smaller">
											<span class="blue bigger-125">
												<i class="icon-random"></i>
												Vous êtes-vous perdu?
											</span>
										</h1>

										<hr />
										<h3 class="lighter smaller">
											Cette page est
											<i class="icon-wrench icon-animated-wrench bigger-125"></i>
											en construction!
										</h3>

										<div class="space"></div>

										<div>
											<h4 class="lighter smaller">Ne vous inquiétez pas, nous mettons tout en oeuvre pour qu'elle soit mise en ligne dès que possible.</h4>
										</div>

										<hr />
										<div class="space"></div>

										<div class="center">
											<a href="index.php" class="btn btn-primary">
												<i class="icon-arrow-left"></i>
												Retour à l'accueil
											</a>
										</div>
									</div>
								</div>
                                
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->

				<!--?php include("ace-settings.php");?--> 
                
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
        
        

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
            $.getScript('conf/conf.js');
            
           
            
		</script>
	</body>
</html>
