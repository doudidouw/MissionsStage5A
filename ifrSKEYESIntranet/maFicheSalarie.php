<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Ma fiche salarié</title>

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
							<li class="active">Ma fiche salarié</li>
						</ul><!-- .breadcrumb -->

					</div>

					<div class="page-content" id="page-content">
						<div class="page-header">
							<h1>
								Ma fiche salarié
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                <div class="alert alert-block alert-success">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="icon-remove"></i>
                                        </button>
                                        <i class="icon-ok green"></i>
                                        Les données affichées sur cette page étant obtenues via les Web Services de Kelio, il est possible qu'elles mettent quelques secondes à apparaître. 
                                </div>

								<div>
									<div id="user-profile-1" class="user-profile row">

										<div class="col-xs-12 col-sm-9">

											<div class="space-12"></div>

											<div class="profile-user-info profile-user-info-striped">
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Abrégé </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="abrege">-</span>
													</div>
												</div>
                                                
												<div class="profile-info-row">
													<div class="profile-info-name"> Date d'entrée dans l'entreprise </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="dateEntree">-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Début ancienneté </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="debutAnciennete">-</span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Coefficient </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="coefficient">-</span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Depuis le </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="aCeCoefficientDepuisLe">-</span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Poste actuel </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="posteActuel">-</span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Depuis le </div>

													<div class="profile-info-value">
														<span class="editable" id="aCePosteDepuisLe">-</span></span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Statut catégoriel </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="statutCategoriel">-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Contrat horaire </div>

													<div class="profile-info-value">
														<span class="editable" id="contratHoraire">-</span>
													</div>
												</div>
                                            
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Type de contrat </div>

													<div class="profile-info-value">
														<span class="editable" id="typeContrat">-</span>
													</div>
												</div>
                                            
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Statut professionnel </div>

													<div class="profile-info-value">
														<span class="editable" id="statutProfessionnel">-</span></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Qualification </div>

													<div class="profile-info-value">
														<span class="editable" id="qualification">-</span>
													</div>
												</div>
                                            
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Service </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="service">-</span>
                                                    </div>
                                                </div>
                                            
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Depuis le</div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="aCeServiceDepuis">-</span>
                                                    </div>
                                                </div>
                                        
											</div>

											<div class="space-20"></div>

											<div class="hr hr2 hr-double"></div>

											<div class="space-6"></div>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->

				<?php include("ace-settings.php");?>
            
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
            
            document.getElementById('menuPersonnel').style.display = 'block';
            $('#maFicheSalarie').addClass('active');
            
            function checkIfNotNull(variable){
                if(variable == null){
                    return "-";
                } else {
                    return variable;   
                }
            }
            
            var req = $.ajax({
                    url: KELIOWS_OPERATIONS,
                    data: {
                        method: GET_EMPLOYEE_PROFESSIONAL_DATA,
                        firstname : localStorage.getItem("firstName"),
                        lastname : localStorage.getItem("lastName")
                    }
            });

            
            req.done(function(res) {
                res = $.parseJSON(res);
                if (res != null) {
                    document.getElementById("abrege").innerHTML = checkIfNotNull(res['employeeAbbreviation']);
                    document.getElementById("dateEntree").innerHTML = checkIfNotNull(res['arrivalInCompanyDate']);
                    document.getElementById("debutAnciennete").innerHTML = checkIfNotNull(res['seniorityStartDate']);
                    document.getElementById("contratHoraire").innerHTML = checkIfNotNull(res['currentTimeContractDescription']);
                    document.getElementById("typeContrat").innerHTML = checkIfNotNull(res['currentTimeContractTypeDescription']);
                    document.getElementById("coefficient").innerHTML = checkIfNotNull(res['currentCoefficientDescription']);
                    document.getElementById("aCeCoefficientDepuisLe").innerHTML = checkIfNotNull(res['currentCoefficientApplicationDate']);
                    document.getElementById("posteActuel").innerHTML = checkIfNotNull(res['currentJobDescription']);
                    document.getElementById("statutCategoriel").innerHTML = checkIfNotNull(res['currentJobPositionDescription']);
                    document.getElementById("aCePosteDepuisLe").innerHTML = checkIfNotNull(res['currentJobApplicationDate']);
                    document.getElementById("statutProfessionnel").innerHTML = checkIfNotNull(res['currentProfessionalStatusDescription']);
                    document.getElementById("qualification").innerHTML = checkIfNotNull(res['currentQualificationDescription']);
                    document.getElementById("service").innerHTML = checkIfNotNull(res['currentSectionFullDescription']);
                    document.getElementById("aCeServiceDepuis").innerHTML = checkIfNotNull(res['currentSectionAssigningDate']);
                    
                    
                } 
            });
                    
            
		</script>
	</body>
</html>
