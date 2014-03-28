<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Accueil</title>

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
							<li class="active">Accueil</li>
						</ul><!-- .breadcrumb -->

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

                                    <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>

                                        <i class="icon-ok green"></i>

                                        Bienvenue sur la nouvelle version de votre Intranet
                                        <strong class="blue">
                                            ifrSKEYES
                                        </strong>
                                        , plus facile d'utilisation et d'accès.
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
                                                En cours de chargement...
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

                                            <div class="center">
                                                <i class="icon-comments-alt icon-2x green"></i>

                                                &nbsp;
                                                <a href="actualites.php">
                                                    Toutes les actualités&nbsp;
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-6" style="heigh:10px; display:inline-block"></div>
                                    
                                    <div class="hr hr-18 dotted hr-double"></div>
                                    
                                    <div class="col-sm-6" >
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
                                        
                                    <div class="col-sm-5" >
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-flat widget-header-small">
                                            <h5>
                                                <i class="icon-globe"></i>
                                                Twitter ifrSKEYES
                                            </h5>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <a class="twitter-timeline" href="https://twitter.com/ifrSKEYES" data-widget-id="441845273191387136">Tweets de @ifrSKEYES</a>
                                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                            </div><!-- /widget-main -->
                                        </div><!-- /widget-body -->
                                    </div><!-- /widget-box -->
                                </div>
                                    
								</div><!-- /row -->
                                
                                <?php include("easiPreview.php"); ?>
                                
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

		<script type="text/javascript">
            $.getScript('conf/conf.js');
            $.getScript('js/getUserPicAndFirstName.js');
            
            
            /*-------------------------------------------
            ----------------  START On page loading functions  ----------------
            --------------------------------------------*/
            
            $('#accueil').addClass('active');
            
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
                if (res != null) {
                    var htmlNewsContent = "<div class=\"itemdiv commentdiv\">"

                                          + "        <div class=\"body\">"
                                          + "             <div class=\"name\">"
                                          + "                 <a href=\"#\" id=\"newsTitle\">" 
                                                        + res[0]["DIGEST"]+ "</a>"
                                          + "             </div>"

                                          + "             <div class=\"time\">"
                                          + "                 <i class=\"icon-time\"></i>"
                                          + "                 <span class=\"green\" id=\"newsDate\">" 
                                                        + res[0]["PUBLISHING_DATE_CONVERTED"]+ "</span>"
                                          + "             </div>"

                                          + "             <div class=\"text\" id=\"article\">"
                                          + "                 <i class=\"icon-quote-left\"></i>" 
                                                        + res[0]["CONTENT"]
                                          + "             </div>"
                                          + "         </div>"
                                          + "     </div>";
                    
                    document.getElementById("vdocNewsSection").innerHTML = htmlNewsContent;
                    
                } 
            });
            
//            var reqProfilePic = $.ajax({
//                    url: VDOCDB_OPERATIONS,
//                    data: {
//                        method: GET_PROFILE_PIC,
//                        login : sessionStorage.getItem("login")
//                    } 
//            });
//            
//            reqProfilePic.done(function(res) {
//                res = $.parseJSON(res);
//                var htmlProfileBoxContent = "<img class=\"nav-user-photo\" src=\""+ res["PHOTO"] + "\" alt=\"avatar\" />"
//                                               + "<span class=\"user-info\">"
//                                               +     "<small>Bonjour,</small>"
//                                               +     res["FIRSTNAME"]
//                                               + "</span>"
//
//                                               + "<i class=\"icon-caret-down\"></i>";
//                
//                document.getElementById("profileBox").innerHTML = htmlProfileBoxContent;
//            });
            
            
            
            /*-------------------------------------------
            ----------------  END On page loading functions  ----------------
            --------------------------------------------*/ 
            
            
            
            
		</script>
	</body>
</html>
