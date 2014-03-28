<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Intranet ifrSKEYES - Mon dossier personnel</title>

		<meta name="description" content="3 styles with inline editable feature" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="assets/css/jquery.gritter.css" />
		<link rel="stylesheet" href="assets/css/select2.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-editable.css" />

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
	</head>

	<body>
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

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="#">Portail</a>
							</li>
							<li class="active">Mon dossier personnel</li>
						</ul><!-- .breadcrumb -->

					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								Mon dossier personnel
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
										Cliquez sur 'Editer' pour modifier vos informations. 
									</div>
								</div>

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
													<div class="profile-info-name"> Titre </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="titre">-</span>
													</div>
												</div>
                                                
												<div class="profile-info-row">
													<div class="profile-info-name"> Date de début de prise en compte </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="dateDebutPriseEnCompte">-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Date et lieu de naissance </div>
                                                    
													<div class="profile-info-value">
														<i class="icon-map-marker light-orange bigger-110"></i>
														<span class="editable" id="dateNaissance">-</span>
														<span class="editable" id="lieuNaissance">-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Situation familiale </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="situationFamiliale">-</span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Nombre d'enfants </div>
                                                    
													<div class="profile-info-value">
														<span class="editable" id="nombreEnfants">-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Date d'arrivée </div>

													<div class="profile-info-value">
														<span class="editable" id="dateArrivee">-</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Code postal </div>

													<div class="profile-info-value">
														<span class="editable" id="codePostal">-</span></span>
													</div>
												</div>
                                            
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Ville </div>

													<div class="profile-info-value">
														<span class="editable" id="ville">-</span></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Email privé </div>

													<div class="profile-info-value">
														<span class="editable" id="emailPrive">-</span>
													</div>
												</div>
                                            
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Téléphone privé </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="telephonePrive">-</span>
                                                    </div>
                                                </div>
                                            
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Téléphone privé N°2</div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="telephonePrive2">-</span>
                                                    </div>
                                                </div>
                                        
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Ligne directe </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="telephoneProfessionnel">-</span>
                                                    </div>
                                                </div>
                                        
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Contact d'urgence </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="contactUrgence">-</span>
                                                    </div>
                                                </div>
                                            
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Sexe </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="sexe">-</span>
                                                    </div>
                                                </div>
                                        
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Assurance </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="assurance">-</span>
                                                    </div>
                                                </div>
                                        
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Mutuelle </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="mutuelle">-</span>
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

		<!-- ace scripts -->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
    
        <?php include("scriptGoTo.php"); ?>

		<script type="text/javascript">
            $.getScript('conf/conf.js');
            $.getScript('js/getUserPicAndFirstName.js');
            
            function checkIfNotNull(variable){
                if(variable == null){
                    return "-";
                } else {
                    return variable;   
                }
            }
            
            document.getElementById("profilePic").innerHTML = "<img id=\"avatar\" class=\"editable img-responsive\" alt=\"Photo de                                              profil\" src=\"" + localStorage.getItem("profilePic") + "\" />";
            document.getElementById("nomPrenom").innerHTML = localStorage.getItem("lastName") + " " + localStorage.getItem("firstName");
            
            var req = $.ajax({
                    url: KELIOWS_OPERATIONS,
                    data: {
                        method: GET_EMPLOYEE_DATA,
                        firstname : localStorage.getItem("firstName"),
                        lastname : localStorage.getItem("lastName")
                    }
            });

            
            req.done(function(res) {
                res = $.parseJSON(res);
                if (res != null) {
                    document.getElementById("lieuNaissance").innerHTML = checkIfNotNull(res['birthCountryDescription']);
                    document.getElementById("dateNaissance").innerHTML = checkIfNotNull(res['birthDate']);
                    document.getElementById("dateDebutPriseEnCompte").innerHTML = checkIfNotNull(res['takenIntoAccountPeriodStartDate']);
                    document.getElementById("contactUrgence").innerHTML = checkIfNotNull(res['emergencyContact']);
                    document.getElementById("situationFamiliale").innerHTML = checkIfNotNull(res['familyStatusDescription']);
                    document.getElementById("nombreEnfants").innerHTML = checkIfNotNull(res['childCount']);
                    document.getElementById("mutuelle").innerHTML = checkIfNotNull(res['mutualInsuranceCompany']);
                    document.getElementById("assurance").innerHTML = checkIfNotNull(res['nationalInsuranceCenter']);
                    document.getElementById("codePostal").innerHTML = checkIfNotNull(res['postcode']);
                    document.getElementById("emailPrive").innerHTML = checkIfNotNull(res['privateEmail']);
                    document.getElementById("telephonePrive").innerHTML = checkIfNotNull(res['privatePhoneNumber1']);
                    document.getElementById("telephonePrive2").innerHTML = checkIfNotNull(res['privatePhoneNumber2']);
                    if(res['sex'] == 0) {
                        document.getElementById("sexe").innerHTML = "Homme";
                    } else {
                        document.getElementById("sexe").innerHTML = "Femme";
                    }
                    document.getElementById("titre").innerHTML = checkIfNotNull(res['titleDescription']);
                    document.getElementById("ville").innerHTML = checkIfNotNull(res['town']);
                    document.getElementById("telephoneProfessionnel").innerHTML = checkIfNotNull(res['professionalPhoneNumber1']);
                    
                    //res['photo'];
                    
                } 
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
				
				
				// *** editable avatar *** //
				try {//ie8 throws some harmless exception, so let's catch it
			
					//it seems that editable plugin calls appendChild, and as Image doesn't have it, it causes errors on IE at unpredicted points
					//so let's have a fake appendChild for it!
					if( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ) Image.prototype.appendChild = function(el){}
			
					var last_gritter
					$('#avatar').editable({
						type: 'image',
						name: 'avatar',
						value: null,
						image: {
							//specify ace file input plugin's options here
							btn_choose: 'Change Avatar',
							droppable: true,
							/**
							//this will override the default before_change that only accepts image files
							before_change: function(files, dropped) {
								return true;
							},
							*/
			
							//and a few extra ones here
							name: 'avatar',//put the field name here as well, will be used inside the custom plugin
							max_size: 110000,//~100Kb
							on_error : function(code) {//on_error function will be called when the selected file has a problem
								if(last_gritter) $.gritter.remove(last_gritter);
								if(code == 1) {//file format error
									last_gritter = $.gritter.add({
										title: 'File is not an image!',
										text: 'Please choose a jpg|gif|png image!',
										class_name: 'gritter-error gritter-center'
									});
								} else if(code == 2) {//file size rror
									last_gritter = $.gritter.add({
										title: 'File too big!',
										text: 'Image size should not exceed 100Kb!',
										class_name: 'gritter-error gritter-center'
									});
								}
								else {//other error
								}
							},
							on_success : function() {
								$.gritter.removeAll();
							}
						},
					    url: function(params) {
							// ***UPDATE AVATAR HERE*** //
							//You can replace the contents of this function with examples/profile-avatar-update.js for actual upload
			
			
							var deferred = new $.Deferred
			
							//if value is empty, means no valid files were selected
							//but it may still be submitted by the plugin, because "" (empty string) is different from previous non-empty value whatever it was
							//so we return just here to prevent problems
							var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
							if(!value || value.length == 0) {
								deferred.resolve();
								return deferred.promise();
							}
			
			
							//dummy upload
							setTimeout(function(){
								if("FileReader" in window) {
									//for browsers that have a thumbnail of selected image
									var thumb = $('#avatar').next().find('img').data('thumb');
									if(thumb) $('#avatar').get(0).src = thumb;
								}
								
								deferred.resolve({'status':'OK'});
			
								if(last_gritter) $.gritter.remove(last_gritter);
								last_gritter = $.gritter.add({
									title: 'Avatar Updated!',
									text: 'Uploading to server can be easily implemented. A working example is included with the template.',
									class_name: 'gritter-info gritter-center'
								});
								
							 } , parseInt(Math.random() * 800 + 800))
			
							return deferred.promise();
						},
						
						success: function(response, newValue) {
						}
					})
				}catch(e) {}
				
				
			
				//another option is using modals
				$('#avatar2').on('click', function(){
					var modal = 
					'<div class="modal hide fade">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="blue">Change Avatar</h4>\
						</div>\
						\
						<form class="no-margin">\
						<div class="modal-body">\
							<div class="space-4"></div>\
							<div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
						</div>\
						\
						<div class="modal-footer center">\
							<button type="submit" class="btn btn-small btn-success"><i class="icon-ok"></i> Submit</button>\
							<button type="button" class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancel</button>\
						</div>\
						</form>\
					</div>';
					
					
					var modal = $(modal);
					modal.modal("show").on("hidden", function(){
						modal.remove();
					});
			
					var working = false;
			
					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);
					file.ace_file_input({
						style:'well',
						btn_choose:'Click to choose new avatar',
						btn_change:null,
						no_icon:'icon-picture',
						thumbnail:'small',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						before_change: function(files, dropped) {
							var file = files[0];
							if(typeof file === "string") {
								//file is just a file name here (in browsers that don't support FileReader API)
								if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
							}
							else {//file is a File object
								var type = $.trim(file.type);
								if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
										|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
									) return false;
			
								if( file.size > 110000 ) {//~100Kb
									return false;
								}
							}
			
							return true;
						}
					});
			
					form.on('submit', function(){
						if(!file.data('ace_input_files')) return false;
						
						file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='icon-spinner icon-spin bigger-150 orange'></i></div>");
						
						var deferred = new $.Deferred;
						working = true;
						deferred.done(function() {
							form.find('button').removeAttr('disabled');
							form.find('input[type=file]').ace_file_input('enable');
							form.find('.modal-body > :last-child').remove();
							
							modal.modal("hide");
			
							var thumb = file.next().find('img').data('thumb');
							if(thumb) $('#avatar2').get(0).src = thumb;
			
							working = false;
						});
						
						
						setTimeout(function(){
							deferred.resolve();
						} , parseInt(Math.random() * 800 + 800));
			
						return false;
					});
							
				});
							
			});
		</script>
	</body>
</html>
