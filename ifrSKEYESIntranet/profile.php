<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Profil</title>

		<meta name="description" content="3 styles with inline editable feature" />
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
							<li class="active">Profil</li>
						</ul><!-- .breadcrumb -->

					</div>

					<div class="page-content" id="page-content">
						<div class="page-header">
							<h1>
								Profil
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<!--<div class="clearfix">
									<div class="pull-left alert alert-success no-margin">
										<button type="button" class="close" data-dismiss="alert">
											<i class="icon-remove"></i>
										</button>

										<i class="icon-edit bigger-120 blue"></i>
										Cliquez sur 'Editer' pour modifier vos informations. 
									</div>
								</div>-->

								<div class="hr dotted"></div>

								<div>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<span class="profile-picture" id="profilePic">
													<img id="avatar" class="editable img-responsive" alt="Photo de profil" src="" />
												</span>

												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label" >
															<i class="icon-circle light-green middle"></i>
															&nbsp;
															<span class="white" id="nomPrenom">-</span>
														</a>
													</div>
												</div>
											</div>

											<div class="space-6"></div>

											<div class="hr hr12 dotted"></div>
										</div>

										<div class="col-xs-12 col-sm-9">

											<div class="space-12"></div>

											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Identifiant </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="identifiant">-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Lieu de résidence </div>
                                                    
													<div class="profile-info-value">
														<i class="icon-map-marker light-orange bigger-110"></i>
														<span class="editable" id="pays">-</span>
														<span class="editable" id="ville">-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Email </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="email">-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Date d'activation du compte </div>

													<div class="profile-info-value">
														<span class="editable" id="dateArrivee">-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Dernière connexion </div>

													<div class="profile-info-value">
														<span class="editable" id="derniereConnexion">-</span></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Type de contrat </div>

													<div class="profile-info-value">
														<span class="editable" id="contrat">-</span>
													</div>
												</div>
											</div>

											<div class="space-20"></div>

											<div class="hr hr2 hr-double"></div>

											<div class="space-6"></div>

											<!--<div class="center">
												<a href="#" class="btn btn-sm btn-primary">
													<i class="icon-rss bigger-150 middle"></i>
													<span class="bigger-110" id="editProfile">Editer</span>

													<i class="icon-on-right icon-arrow-right"></i>
												</a>
											</div>-->
										</div>
									</div>
								</div>

								<div class="hide">
									<div id="user-profile-3" class="user-profile row">
										<div class="col-sm-offset-1 col-sm-10">
											<!--<div class="well well-sm">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												&nbsp;
												<div class="inline middle blue bigger-110"> Votre profil est complet à 70%</div>

												&nbsp; &nbsp; &nbsp;
												<div style="width:200px;" data-percent="70%" class="inline middle no-margin progress progress-striped active">
													<div class="progress-bar progress-bar-success" style="width:70%"></div>
												</div>
											</div><!-- /well -->

											<div class="space"></div>

											<form class="form-horizontal">
												<div class="tabbable">
													<ul class="nav nav-tabs padding-16">
														<li class="active">
															<a data-toggle="tab" href="#edit-basic">
																<i class="green icon-edit bigger-125"></i>
																Informations générales
															</a>
														</li>

														<li>
															<a data-toggle="tab" href="#edit-settings">
																<i class="purple icon-cog bigger-125"></i>
																Paramètres
															</a>
														</li>

														<li>
															<a data-toggle="tab" href="#edit-password">
																<i class="blue icon-key bigger-125"></i>
																Mot de passe
															</a>
														</li>
													</ul>

													<div class="tab-content profile-edit-tab-content">
														<div id="edit-basic" class="tab-pane in active">
															<h4 class="header blue bolder smaller">Général</h4>

															<div class="row">

																<div class="col-xs-12 col-sm-8">
																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username">Identifiant</label>

																		<div class="col-sm-8">
																			<input class="col-xs-12 col-sm-10" type="text" id="form-field-username" placeholder="Username" value="" />
																		</div>
																	</div>

																	<div class="space-4"></div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-first">Nom</label>

																		<div class="col-sm-8">
																			<input class="input-small" type="text" id="form-field-first" placeholder="Prénom" value="" />
																			<input class="input-small" type="text" id="form-field-last" placeholder="Nom" value="" />
																		</div>
																	</div>
																</div>
															</div>

															<hr />
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-date">Date de naissance</label>

																<div class="col-sm-9">
																	<div class="input-medium">
																		<div class="input-group">
																			<input class="input-medium date-picker" id="form-field-date" type="text" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" />
																			<span class="input-group-addon">
																				<i class="icon-calendar"></i>
																			</span>
																		</div>
																	</div>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right">Sexe</label>

																<div class="col-sm-9">
																	<label class="inline">
																		<input name="form-field-radio" type="radio" class="ace" />
																		<span class="lbl"> Homme</span>
																	</label>

																	&nbsp; &nbsp; &nbsp;
																	<label class="inline">
																		<input name="form-field-radio" type="radio" class="ace" />
																		<span class="lbl"> Femme</span>
																	</label>
																</div>
															</div>
                                                            
															<h4 class="header blue bolder smaller">Contact</h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-email">Email</label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input type="email" id="form-field-email" value="cherifidounia@gmail.com" />
																		<i class="icon-envelope"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-phone">Téléphone</label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input class="input-medium input-mask-phone" type="text" id="form-field-phone" />
																		<i class="icon-phone icon-flip-horizontal"></i>
																	</span>
																</div>
															</div>

														</div>

														<div id="edit-settings" class="tab-pane">

															<div class="space-8"></div>

															<div>
																<label class="inline">
																	<input type="checkbox" name="form-field-checkbox" class="ace" />
																	<span class="lbl"> M'envoyer un mail à la réception d'une nouvelle tâche</span>
																</label>
															</div>
														</div>

														<div id="edit-password" class="tab-pane">
															<div class="space-10"></div>

                                                            <div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">Ancien mot de passe</label>

																<div class="col-sm-9">
																	<input type="password" id="form-field-pass1" />
																</div>
															</div>
                                                            
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">Nouveau mot de passe</label>

																<div class="col-sm-9">
																	<input type="password" id="form-field-pass1" />
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">Confirmer votre nouveau mot de passe</label>

																<div class="col-sm-9">
																	<input type="password" id="form-field-pass2" />
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">
														<button class="btn btn-info" type="button" href="#edit-basic">
															<i class="icon-ok bigger-110" id="saveProfile"></i>
															Enregistrer
														</button>

														&nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="icon-undo bigger-110"></i>
															Réinitialiser
														</button>
													</div>
												</div>
											</form>
										</div><!-- /span -->
									</div><!-- /user-profile -->
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

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.gritter.min.js"></script>
		<script src="assets/js/bootbox.min.js"></script>
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="assets/js/jquery.hotkeys.min.js"></script>
		<script src="assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="assets/js/select2.min.js"></script>
		<script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="assets/js/x-editable/bootstrap-editable.min.js"></script>
		<script src="assets/js/x-editable/ace-editable.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>


		<!-- inline scripts related to this page -->
    
        <?php include("scriptGoTo.php"); ?>

		<script type="text/javascript">
            $.getScript('conf/conf.js');
            $.getScript('js/getUserPicAndFirstName.js');
            
            var reqProfile = $.ajax({
                    url: VDOCDB_OPERATIONS,
                    data: {
                        method: GET_PROFILE,
                        login : localStorage.getItem("login")
                    } 
            });

            reqProfile.done(function(res) {
                res = $.parseJSON(res);  
            
                document.getElementById("profilePic").innerHTML = "<img id=\"avatar\" class=\"editable img-responsive\" alt=\"Photo de                                              profil\" src=\"" + localStorage.getItem("profilePic") + "\" />";
                document.getElementById("identifiant").innerHTML = localStorage.getItem("login");
                document.getElementById("email").innerHTML = res['EMAIL'];
                document.getElementById("derniereConnexion").innerHTML = res['LAST_VISIT_CONVERTED'];
                document.getElementById("ville").innerHTML = res['CITY'];
                document.getElementById("pays").innerHTML = res['COUNTRY'];
                document.getElementById("contrat").innerHTML = res['CONTRACT_TYPE'];
                document.getElementById("dateArrivee").innerHTML = res['ACTIVATION_DATE_CONVERTED'];
                document.getElementById("nomPrenom").innerHTML = res['LASTNAME'] + " " + res['FIRSTNAME'];
            });
            
			jQuery(function($) {
				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';    
				
				//editables 
			    $('#username').editable({
					type: 'text',
					name: 'username'
			    });
			
			
				$('#signup').editable({
					type: 'date',
					format: 'yyyy-mm-dd',
					viewformat: 'dd/mm/yyyy',
					datepicker: {
						weekStart: 1
					}
				});
			
				
				//var $range = document.createElement("INPUT");
				//$range.type = 'range';
			    $('#login').editable({
			        type: 'slider',//$range.type == 'range' ? 'range' : 'slider',
					name : 'login',
					slider : {
						min : 1, max:50, width:100
					},
					success: function(response, newValue) {
						if(parseInt(newValue) == 1)
							$(this).html(newValue + " hour ago");
						else $(this).html(newValue + " hours ago");
					}
				});

			
							
				
			
			  
				///////////////////////////////////////////
			
				//show the user info on right or left depending on its position
				$('#user-profile-2 .memberdiv').on('mouseenter', function(){
					var $this = $(this);
					var $parent = $this.closest('.tab-pane');
			
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $this.offset();
					var w2 = $this.width();
			
					var place = 'left';
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) place = 'right';
					
					$this.find('.popover').removeClass('right left').addClass(place);
				}).on('click', function() {
					return false;
				});
			
			
				////////////////////
				//change profile view
				$('[data-toggle="buttons"] .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					$('.user-profile').parent().addClass('hide');
					$('#user-profile-'+which).parent().removeClass('hide');
				});
                
                
                ////////////////////
				//edit profile (user-profile-1)
				$('#editProfile').on('click', function(e){
					$('#user-profile-1').parent().addClass('hide');
					$('#user-profile-3').parent().removeClass('hide');
				});
                
                });
		</script>
	</body>
</html>
