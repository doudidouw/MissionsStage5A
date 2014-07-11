<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Intranet ifrSKEYES - Mon dossier personnel</title>

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
                            <li class="active">Mon dossier personnel</li>
                        </ul>

                    </div><!-- .breadcrumbs -->

                    <div class="page-content" id="page-content">
                        <div class="page-header">
                            <h1>
                                Mon dossier personnel
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-xs-12">

                                <div class="alert alert-block alert-success">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="icon-remove"></i>
                                    </button>
                                    <i class="icon-ok green"></i>
                                    Les données sur cette page étant obtenues via les Web Services de Kelio, il est possible qu'elles mettent quelques secondes à s'afficher. 
                                </div><!-- /.alert-block info -->

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

                                        </div><!-- /.col-xs-12 col-sm-3 center -->

                                        <div class="col-xs-12 col-sm-9">

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
                                                    <div class="profile-info-name"> Date de situation </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="dateSituationFamiliale">-</span>
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

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> N° de Sécurité Sociale </div>

                                            <div class="profile-info-value">
                                                <span class="editable" id="numSecuriteSociale">-</span>
                                            </div>
                                        </div>

                                    </div>

                                </div><!-- /.col -->
                            </div><!-- /.user-profile-1 -->
                        </div>

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
    $('#monDossierPersonnel').addClass('active');

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
            document.getElementById("dateSituationFamiliale").innerHTML = checkIfNotNull(res['familyStatusDate']);
            document.getElementById("nombreEnfants").innerHTML = checkIfNotNull(res['childCount']);
            document.getElementById("mutuelle").innerHTML = checkIfNotNull(res['mutualInsuranceCompany']);
            document.getElementById("numSecuriteSociale").innerHTML = checkIfNotNull(res['nationalInsuranceNumber']);
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


        } 
    });


</script>
</body>
</html>
