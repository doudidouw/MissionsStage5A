<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Badgeuse virtuelle</title>

		<meta name="description" content="3 styles with inline editable feature" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<?php include("basicScriptsAndStyles.php"); ?>

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
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
							<li class="active">Badgeuse virtuelle</li>
						</ul><!-- .breadcrumb -->

					</div>

					<div class="page-content" id="page-content">
						<div class="page-header">
							<h1>
								Badgeuse virtuelle
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="clearfix">
									<div class="pull-left alert alert-success no-margin">
										<button type="button" class="close" data-dismiss="alert">
											<i class="icon-remove"></i>
										</button>

										<i class="icon-edit bigger-120 blue"></i>
										Cliquez sur l'une des images pour badger.
									</div>
								</div>

								<div class="hr dotted"></div>

								<div>
									<div id="" class="row">
										<div class="col-xs-12 col-sm-4 center">
											<div>
                                                <a href="#" id="sortie">
                                                    <span class="profile-picture">
                                                        <img href="#" alt="Sortie" src="assets/images/plumpy_cafe.png" />
                                                    </span>
                                                </a>

												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label" >
															<i class="icon-coffee light-green middle"></i>
															&nbsp;
															<span class="white">Je vais manger / Je m'en vais</span>
														</a>
													</div>
												</div>
											</div>
                                            
                                            </div>

                                            <div class="col-xs-12 col-sm-4 center">
                                            <div>
                                                <a href="#" id="entree">
                                                    <span class="profile-picture">
                                                        <img alt="Entrée" src="assets/images/plumpy_rentre.png" />
                                                    </span>
                                                </a>

												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed-right arrowed-in">
													<div class="inline position-relative">
														<a href="#" class="user-title-label" >
															<i class="icon-laptop light-green middle"></i>
															&nbsp;
															<span class="white">Je retourne à mon poste</span>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->
                
                <div id="dialog-confirm" class="hide">
                    <div class="alert alert-info bigger-110">
                        Vous êtes sur le point de badger.
                    </div>

                    <div class="space-6"></div>

                    <p class="bigger-110 bolder center grey">
                        <i class="icon-hand-right blue bigger-120"></i>
                        Etes-vous sûr?
                    </p>
                </div><!-- #dialog-confirm -->
                
                
                <div id="dialog-success" class="hide">
                    <div class="alert alert-success bigger-110">
                        Votre badgeage a été enregistré avec succès!
                    </div>
                </div><!-- #dialog-success -->

				<!--?php include("ace-settings.php");?-->
            
			</div><!-- /.main-container-inner -->
            
            

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		      

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->



		<!-- inline scripts related to this page -->
    
        <?php include("scriptGoTo.php"); ?>

		<script type="text/javascript">
            $.getScript('conf/conf.js');
            $.getScript('js/getUserPicAndFirstName.js');
            
            document.getElementById('menuAbsences').style.display = 'block';
            $('#badgeuse').addClass('active');
            
            jQuery(function($) {
            
                //override dialog's title function to allow for HTML titles
				$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
					_title: function(title) {
						var $title = this.options.title || '&nbsp;'
						if( ("title_html" in this.options) && this.options.title_html == true )
							title.html($title);
						else title.text($title);
					}
				}));
            
                //Entree : 1, Sortie : 2
                
                $( "#sortie" ).on('click', function(e) {
                    e.preventDefault();

                    $( "#dialog-confirm" ).removeClass('hide').dialog({
                        resizable: false,
                        modal: true,
                        title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i> Badger une sortie?</h4></div>",
                        title_html: true,
                        buttons: [
                            {
                                html: "<i class='icon-trash bigger-110'></i>&nbsp; Badger",
                                "class" : "btn btn-danger btn-xs",
                                click: function() {
                                    $( this ).dialog( "close" );
                                    var req = $.ajax({
                                        url: KELIOWS_OPERATIONS,
                                        data: {
                                            method: SET_CLOCKING,
                                            firstname : localStorage.getItem("firstName"),
                                            lastname : localStorage.getItem("lastName"),
                                            inOut : 2
                                        }
                                    });


                                    req.done(function(res) {
                                        res = $.parseJSON(res);
                                        if ((res != null) && (res == 1)) {
                                            $( "#dialog-success" ).removeClass('hide').dialog({
                                                resizable: false,
                                                modal: true,
                                                title: "<div class='widget-header'><h4 class='smaller'><i class='icon-check green'></i>Badgeage effectué</h4></div>",
                                                title_html: true,
                                                buttons: [
                                                    {
                                                        html: "<i class='icon-thumbs-up bigger-110'></i>&nbsp; OK",
                                                        "class" : "btn btn-danger btn-xs",
                                                        click: function() {
                                                            $( this ).dialog( "close" );
                                                        }
                                                    }
                                                ]
                                            });
                                        } 
                                    });
                                    
                                }
                            }
                            ,
                            {
                                html: "<i class='icon-remove bigger-110'></i>&nbsp; Annuler",
                                "class" : "btn btn-xs",
                                click: function() {
                                    $( this ).dialog( "close" );
                                    
                                }
                            }
                        ]
                    });
                });
                
                
                $( "#entree" ).on('click', function(e) {
                    e.preventDefault();

                    $( "#dialog-confirm" ).removeClass('hide').dialog({
                        resizable: false,
                        modal: true,
                        title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i> Badger une entrée?         </h4></div>",
                        title_html: true,
                        buttons: [
                            {
                                html: "<i class='icon-trash bigger-110'></i>&nbsp; Badger",
                                "class" : "btn btn-danger btn-xs",
                                click: function() {
                                    $( this ).dialog( "close" );
                                    var req = $.ajax({
                                        url: KELIOWS_OPERATIONS,
                                        data: {
                                            method: SET_CLOCKING,
                                            firstname : localStorage.getItem("firstName"),
                                            lastname : localStorage.getItem("lastName"),
                                            inOut : 1
                                        }
                                    });


                                    req.done(function(res) {
                                        res = $.parseJSON(res);
                                        if ((res != null) && (res == 1)) {
                                            $( "#dialog-success" ).removeClass('hide').dialog({
                                                resizable: false,
                                                modal: true,
                                                title: "<div class='widget-header'><h4 class='smaller'><i class='icon-check green'></i>Badgeage effectué</h4></div>",
                                                title_html: true,
                                                buttons: [
                                                    {
                                                        html: "<i class='icon-thumbs-up bigger-110'></i>&nbsp; OK",
                                                        "class" : "btn btn-danger btn-xs",
                                                        click: function() {
                                                            $( this ).dialog( "close" );
                                                        }
                                                    }
                                                ]
                                            });
                                        } 
                                    });
                                }
                            }
                            ,
                            {
                                html: "<i class='icon-remove bigger-110'></i>&nbsp; Annuler",
                                "class" : "btn btn-xs",
                                click: function() {
                                    $( this ).dialog( "close" );
                                }
                            }
                        ]
                    });
                });
                
                
            });
            
        </script>
	</body>
</html>
