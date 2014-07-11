<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Intranet ifrSKEYES - Mes TODO listes</title>

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
                            <li class="active">Mes TODO listes</li>
                        </ul><!-- .breadcrumb -->

                    </div>

                    <div class="page-content" id="page-content">
                        <div class="page-header" id="page-header">
                            <h1>
                                Mes TODO
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="space-6"></div>

                            <div class="col-xs-10">
                                <!-- PAGE CONTENT BEGINS -->

                                <div class="alert alert-block alert-success">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="icon-remove"></i>
                                    </button>

                                    <i class="icon-ok green"></i>
                                    Consultez en un clic toutes vos tâches à traiter.
                                </div>

                                <div class="space-6" style="heigh:10px; display:inline-block"></div>

                                <div id="loading" class="alert alert-block alert-warning">

                                    <i class="icon-retweet yellow"></i>
                                    Chargement en cours...
                                </div>

                                <div class="row">

                                    <div class="col-xs-12" id="vdocTODOSection">
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

            $('#mesTODOListes').addClass('active');

            var req = $.ajax({
                url: VDOCXML_OPERATIONS,
                data: {
                    method: GET_TODO,
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
                var htmlTabsContent = "<div class=\"tab-content\">";

                if (res != null) {
                    for(var i=0; i < res.length; i++){
                        htmlTabs = htmlTabs  
                        +"<li class=\"dropdown\">"
                        +"<a data-toggle=\"dropdown\" class=\"dropdown-toggle\" href=\"#\">"
                        + "<span class=\"badge badge-blue\"></span>"
                        + res[i]['Categorie']
                        +"<i class=\"icon-caret-down bigger-110 width-auto\"></i>"
                        +"</a>"

                        +"<ul class=\"dropdown-menu dropdown-info\">";
                        for(var j=0; j < res[i]['process'].length; j++){
                            htmlTabs = htmlTabs 
                            + "<li>"
                            +"<a data-toggle=\"tab\" href=\"#tab" + i + "-" + j + "\">" + res[i]['process'][j]['labelProcess'] + "</a>"
                            +"</li>";
                            htmlTabsContent = htmlTabsContent 
                            + "<div id=\"tab" + i + "-" + j + "\" class=\"tab-pane in active\">";
                            for(var k=0; k < res[i]['process'][j]['todo'].length; k++){
                                htmlTabsContent = htmlTabsContent 
                                +"<p>"
                                +"<b>Titre : </b>" + res[i]['process'][j]['todo'][k]['titre'] 
                                +"<br/><b>Référence : </b>" + res[i]['process'][j]['todo'][k]['ref'] 
                                +"<br/><b>Créateur du document : </b>" + res[i]['process'][j]['todo'][k]['creator']      
                                +"<br/><b>Date de création : </b>" + res[i]['process'][j]['todo'][k]['creationDate']      
                                + "</p>";
                            }
                            htmlTabsContent = htmlTabsContent 
                            +"</div>";
                        }
                        htmlTabs = htmlTabs     
                        +"</ul>"
                        +"</li>";


                    }

                    htmlTabs = htmlTabs + "</ul>"
                    + htmlTabsContent
                    +"</div>";

                    document.getElementById("vdocTODOSection").innerHTML = htmlTabs;

                }
            });






        </script>
    </body>
</html>