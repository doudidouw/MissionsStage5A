<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Intranet ifrSKEYES - Mes sociétés</title>

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
                            <li class="active">Mes sociétés</li>
                        </ul>
                    </div><!-- .breadcrumbs -->

                    <div class="page-content" id="page-content">
                        <div class="page-header" id="page-header">
                            <h1>
                                Mes sociétés
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
                                    Retrouvez sur cette page toutes vos sociétés.
                                </div>

                                <?php include("tableauMesSocietes.php"); ?>
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

            document.getElementById('menuAffaires').style.display = 'block';
            $('#mesSocietes').addClass('active');


        </script>
    </body>
</html>
