<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Intranet ifrSKEYES - Erreur 500</title>

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
                            <li class="active">Erreur interne</li>
                        </ul>

                    </div><!-- .breadcrumbs -->

                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="error-container">
                                    <div class="well">
                                        <h1 class="grey lighter smaller">
                                            <span class="blue bigger-125">
                                                <i class="icon-random"></i>
                                                500
                                            </span>
                                            Le serveur a rencontré une erreur
                                        </h1>

                                        <hr />
                                        <h3 class="lighter smaller">
                                            Nous essayons actuellement de la résoudre!
                                            <i class="icon-wrench icon-animated-wrench bigger-125"></i>
                                        </h3>

                                        <div class="space"></div>

                                        <div>
                                            <h4 class="lighter smaller">Nous vous suggérons de :</h4>

                                            <ul class="list-unstyled spaced inline bigger-110 margin-15">
                                                <li>
                                                    <i class="icon-hand-right blue"></i>
                                                    Réessayer plus tard
                                                </li>

                                                <li>
                                                    <i class="icon-hand-right blue"></i>
                                                    Faire part au SI du contexte dans lequel l'erreur s'est produite, si votre problème persiste
                                                </li>
                                            </ul>
                                        </div>

                                        <hr />
                                        <div class="space"></div>

                                        <div class="center">
                                            <a href="#index.php" class="btn btn-grey">
                                                <i class="icon-arrow-left"></i>
                                                Retour à l'accueil
                                            </a>
                                        </div>
                                    </div>
                                </div>
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
        </script>
    </body>
</html>
