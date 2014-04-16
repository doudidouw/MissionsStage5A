<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Actualités</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <?php include("basicScriptsAndStyles.php"); ?>
        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="assets/css/jquery.gritter.css" />
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
								Mes actualités
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
                                            
                                            <div class="space-6" style="heigh:10px; display:inline-block"></div>
                                            
                                            <div id="loading" class="alert alert-block alert-warning">

                                                <i class="icon-retweet yellow"></i>
                                                Chargement en cours...
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
    
        <?php include("scriptGoTo.php"); ?>
        <script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/jquery.gritter.min.js"></script>

		<script type="text/javascript">
            $.getScript('conf/conf.js');
            $.getScript('js/getUserPicAndFirstName.js');
            
            /*-------------------------------------------
            ----------------  START On page loading functions  ----------------
            --------------------------------------------*/
            
            $('#mesActualites').addClass('active');
            
            var req = $.ajax({
                url: VDOCDB_OPERATIONS,
                data: {
                    method: GET_NEWS
                },
                beforeSend:function(){
                    $("#loading").show();
                },
                success:function(){
                    $("#loading").hide();
                }                
            });

            
            req.done(function(res) {
                res = $.parseJSON(res);
                var htmlNewsContent = "";
                if (res != null) {
                    
                    
                    for(var i=0; i < res.length; i++){
                        htmlNewsContent = htmlNewsContent + "<div class=\"itemdiv commentdiv\">"

                                          + "        <div class=\"body\">"
                                          + "             <div class=\"name\">"
                                          + "                 <a href=\"#\" id=\"newsTitle\">" 
                                                        + res[i]["DIGEST"]+ "</a>"
                                          + "             </div>"

                                          + "             <div class=\"time\">"
                                          + "                 <i class=\"icon-time\"></i>"
                                          + "                 <span class=\"green\" id=\"newsDate\">" 
                                                        + res[i]["PUBLISHING_DATE_CONVERTED"]+ "</span>"
                                          + "             </div>"

                                          + "             <div class=\"text\" id=\"article\">"
                                          + "                 <i class=\"icon-quote-left\"></i>" 
                                                        + res[i]["CONTENT"]
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
