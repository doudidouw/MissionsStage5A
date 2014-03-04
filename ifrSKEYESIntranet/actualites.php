<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Actualités</title>

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
								<a href="#">Accueil</a>
							</li>
                            <li class="active">Actualités</li>
						</ul><!-- .breadcrumb -->

						<?php include("navsearch.php"); ?>
					</div>

					<div class="page-content" id="page-content">
						<div class="page-header" id="page-header">
							<h1>
								Accueil
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                            <div class="space-6"></div>
                            
							<div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->

                                    <div class="alert alert-block alert-info">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>

                                        <i class="icon-info-sign blue"></i>

                                        Retrouvez ici toutes vos actualités.
                                    </div>

                                    <div class="row">
                                        
                                    <div class="space-6"></div>
                                        
                                    <div class="col-xs-12">

                                        <div class="widget-box transparent" id="recent-box">
                                            <div class="widget-header">
                                                <h4 class="lighter smaller">
                                                    <i class="icon-rss orange"></i>
                                                    Actualités
                                                </h4>
                                            </div>

                                            <div class="comments" id="vdocNewsSection">
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
                                            </div>
                                        </div>
                                    </div>

                                    <div class="vspace-sm"></div>
                                    
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
                var htmlNewsContent = "";
                if (res != null) {
                    
                    for(var i=0; i < res["newsList"].length; i++){
                        htmlNewsContent = htmlNewsContent + "<div class=\"itemdiv commentdiv\">"

                                          + "        <div class=\"body\">"
                                          + "             <div class=\"name\">"
                                          + "                 <a href=\"#\" id=\"newsTitle\">" 
                                                        + res["newsList"][i]["DIGEST"]+ "</a>"
                                          + "             </div>"

                                          + "             <div class=\"time\">"
                                          + "                 <i class=\"icon-time\"></i>"
                                          + "                 <span class=\"green\" id=\"newsDate\">" 
                                                        + res["newsList"][i]["PUBLISHING_DATE_CONVERTED"]+ "</span>"
                                          + "             </div>"

                                          + "             <div class=\"text\" id=\"article\">"
                                          + "                 <i class=\"icon-quote-left\"></i>" 
                                                        + res["newsList"][i]["CONTENT"]
                                          + "             </div>"
                                          + "         </div>"
                                          + "     </div>";
                    }
                    
                    document.getElementById("vdocNewsSection").innerHTML = htmlNewsContent;
                } 
            });
            
            /*-------------------------------------------
            ----------------  END On page loading functions  ----------------
            --------------------------------------------*/ 
            
            
		</script>
	</body>
</html>
