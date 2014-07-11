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
                                    </div>
                                </div>
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

    <script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>



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

    </script>
</body>
</html>
