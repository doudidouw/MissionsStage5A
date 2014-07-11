<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Intranet ifrSKEYES - Mes départs en mission</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />



        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.full.min.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        <link rel="stylesheet" href="assets/css/ui.jqgrid.css" />

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
                            <li class="active">Mes départs en mission</li>
                        </ul>

                    </div><!-- .breadcrumbs -->

                    <div class="page-content" id="page-content">
                        <div class="page-header" id="page-header">
                            <h1>
                                Mes départs en mission
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="space-6"></div>

                            <div class="col-xs-10">

                                <div class="alert alert-block alert-success">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="icon-remove"></i>
                                    </button>

                                    <i class="icon-ok green"></i>
                                    Retrouvez rapidement les principaux détails de vos départs en mission.
                                </div><!-- alert info -->

                                <div class="space-6" style="heigh:10px; display:inline-block"></div>

                                <div id="loading" class="alert alert-block alert-warning">

                                    <i class="icon-retweet yellow"></i>
                                    Chargement en cours...
                                </div><!-- alert chargement -->

                                <div class="row">

                                    <div class="col-xs-12" id="vdocOMSection">
                                    </div>

                                </div><!-- /.row -->
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

            $('#mesDepartsEnMission').addClass('active');

            var req = $.ajax({
                url: VDOCXML_OPERATIONS,
                data: {
                    method: GET_OM,
                    sessionKey: localStorage.getItem("sessionKey")
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
                var htmlTabs = "<div class=\"tabbable\">"
                + "<ul class=\"nav nav-tabs\" id=\"myTab\">";
                +        "<li class=\"active\">"
                +            "<a data-toggle=\"tab\" href=\"#tab\">"
                +                "<i class=\"green icon-tasks bigger-110\"></i>"
                +                "Mes départs en mission"
                +            "</a>"
                +        "</li>"
                +    "</ul>";

                var htmlTabsContent = "<div class=\"tab-content\">"
                + "<div id=\"tab\" class=\"tab-pane in active\">";

                if (res != null) {
                    for(var k=0; k < res.length; k++){
                        htmlTabsContent = htmlTabsContent 
                        +"<p>"
                        +"<b>Titre : </b>" + res[k]['titre'] 
                        +"<br/><b>Intervenants : </b>" + res[k]['intervenants'] 
                        +"<br/><b>Etape : </b>" + res[k]['etape']      
                        +"<br/><b>Etat du document : </b>" + res[k]['etat']      
                        + "</p>";
                    }
                    htmlTabsContent = htmlTabsContent 
                    +"</div>"
                    +"</div>"
                    +"</div>";

                    document.getElementById("vdocOMSection").innerHTML = htmlTabs + htmlTabsContent;

                }
            });


        </script>
    </body>
</html>