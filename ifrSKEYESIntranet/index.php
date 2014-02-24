<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Accueil</title>

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

		<link rel="stylesheet" href="assets/css/ace.min.css" />
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
        <?php include("modal.php"); ?>
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
							<li class="active">Accueil</li>
						</ul><!-- .breadcrumb -->

						<?php include("navsearch.php"); ?>
					</div>

					<div class="page-content" id="page-content">
						<div class="page-header" id="page-header">
							<h1>
								Accueil
								<small>
									<i class="icon-double-angle-right"></i>
									Actualités
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                            <div class="space-6"></div>
                            
							<div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->

                                    <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>

                                        <i class="icon-ok green"></i>

                                        Bienvenue sur la nouvelle version de votre Intranet
                                        <strong class="blue">
                                            ifrSKEYES
                                        </strong>
                                        ,
                                        plus riche, plus facile d'utilisation et d'accès.
                                    </div>

                                    <div class="row">
                                        
                                    <div class="space-6"></div>
                                        
                                    <div class="col-sm-7">

                                        <div class="widget-box transparent" id="recent-box">
                                            <div class="widget-header">
                                                <h4 class="lighter smaller">
                                                    <i class="icon-rss orange"></i>
                                                    Actualités VDoc
                                                </h4>
                                            </div>

                                            <div class="comments">
                                                <div class="itemdiv commentdiv">

                                                    <div class="body">
                                                        <div class="name">
                                                            <a href="#" id="newsTitle"></a>
                                                        </div>

                                                        <div class="time">
                                                            <i class="icon-time"></i>
                                                            <span class="green" id="newsDate"></span>
                                                        </div>

                                                        <div class="text" id="article">
                                                            <i class="icon-quote-left"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- comments -->

                                            <div class="hr hr8"></div>

                                            <div class="center">
                                                <i class="icon-comments-alt icon-2x green"></i>

                                                &nbsp;
                                                <a href="#">
                                                    Toutes les news &nbsp;
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="vspace-sm"></div>
                                    
                                    <div class="col-sm-5" >
                                        <div class="widget-box">
                                            <div class="widget-header widget-header-flat widget-header-small">
                                                <h5>
                                                    <i class="icon-globe"></i>
                                                    Météo Locale
                                                </h5>
                                            </div>

                                            <div class="widget-body">
                                                <div class="widget-main">
    <a href="http://www.accuweather.com/fr/fr/toulouse/135244/weather-forecast/135244" class="aw-widget-legal">
<!--
By accessing and/or using this code snippet, you agree to AccuWeather’s terms and conditions (in English) which can be found at http://www.accuweather.com/en/free-weather-widgets/terms and AccuWeather’s Privacy Statement (in English) which can be found at http://www.accuweather.com/en/privacy.
-->
</a><div id="awcc1392978295160" class="aw-widget-current"  data-locationkey="" data-unit="c" data-language="fr" data-useip="true" data-uid="awcc1392978295160"></div><script type="text/javascript" src="http://oap.accuweather.com/launch.js"></script>
                                                </div><!-- /widget-main -->
                                            </div><!-- /widget-body -->
                                        </div><!-- /widget-box -->
                                    </div>
                                    
								</div><!-- /row -->
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
            
            /*-------------------------------------------
            ----------------  START On page loading functions  ----------------
            --------------------------------------------*/
            
            var req = $.ajax({
                    url: VDOCDB_OPERATIONS,
                    data: {
                        method: GET_NEWS
                    }
            });

            
            req.done(function(res) {
                res = $.parseJSON(res);
                if (res != null) {
                    document.getElementById("article").innerHTML = "<i class=\"icon-quote-left\"></i>" + res["CONTENT"];
                } 
            });
            
            /*-------------------------------------------
            ----------------  END On page loading functions  ----------------
            --------------------------------------------*/ 
            
            
		</script>
	</body>
</html>
