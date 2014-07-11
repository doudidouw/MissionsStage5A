<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Page en construction</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<?php include("basicScriptsAndStyles.php"); ?>
        
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
											Cette page est en construction!
                                            <i class="icon-wrench icon-animated-wrench bigger-125"></i>
										</h3>

										<div class="space"></div>

										<div>
											<h4 class="lighter smaller">Ne vous inquiétez pas, elle sera mise en ligne prochainement.</h4>
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
                
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
        
        

		<!-- inline scripts related to this page -->
        <?php include("scriptGoTo.php"); ?>

		<script type="text/javascript">
            $.getScript('conf/conf.js');
            $.getScript('js/getUserPicAndFirstName.js');
            
           
            
		</script>
	</body>
</html>
