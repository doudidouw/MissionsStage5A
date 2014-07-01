<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Quality Gate</title>

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
							<li class="active">Quality Gate</li>
						</ul><!-- .breadcrumb -->

					</div>

					<div class="page-content" id="page-content">
						<div class="page-header" id="page-header">
							<h1>
								Quality Gate
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
                                            Retrouvez ici votre espace Qualité.
                                    </div>

                                    <div class="row">
                                        
                                        <div class="space-6"></div>

                                        <div class="col-xs-12">

                                            <div class="widget-box">
                                                <div class="widget-header widget-header-flat widget-header-small">
                                                    <h5>
                                                        <i class="icon-globe"></i>
                                                        Process Mapping
                                                    </h5>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <iframe width="950" height="900" frameborder="0" scrolling="no" style="overflow-y:hidden;" src="https://magic.piktochart.com/embed/2168971-quality-gate"></iframe>
                                                    </div><!-- /widget-main -->
                                                </div><!-- /widget-body -->
                                            </div><!-- /widget-box -->

                                        </div>

                                        <div class="space-6" style="heigh:10px; display:inline-block"></div>

                                        <div class="hr hr-18 dotted hr-double"></div>
                                    
                                    
								    </div><!-- /row -->
                                
                                    <div class="row">
                                        <div class="space-6"></div>

                                        <div class="col-xs-12">

                                            <div class="widget-box">
                                                <div class="widget-header widget-header-flat widget-header-small">
                                                    <h5>
                                                        <i class="icon-globe"></i>
                                                        Pyramide of Documents
                                                    </h5>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <center><iframe width="800" height="620" frameborder="0" scrolling="no" style="overflow-y:hidden;" src="https://magic.piktochart.com/embed/2169412-pyramide-of-documents"></iframe></center>
                                                    </div><!-- /widget-main -->
                                                </div><!-- /widget-body -->
                                            </div><!-- /widget-box -->

                                        </div>

                                        <div class="space-6" style="heigh:10px; display:inline-block"></div>

                                        <div class="hr hr-18 dotted hr-double"></div>
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
            
            
            /*-------------------------------------------
            ----------------  START On page loading functions  ----------------
            --------------------------------------------*/
            
            $('#quality').addClass('active');
            
            
		</script>
	</body>
</html>
