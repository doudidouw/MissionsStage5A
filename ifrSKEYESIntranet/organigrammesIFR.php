<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Intranet ifrSKEYES - Organigrammes</title>

        <meta name="description" content="responsive photo gallery using colorbox" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <?php include("basicScriptsAndStyles.php"); ?>

        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="assets/css/colorbox.css" />


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
                                <a href="#">Accueil</a>
                            </li>
                            <li class="active">Mes organigrammes</li>
                        </ul>

                    </div><!-- .breadcrumbs -->

                    <div class="page-content" id="page-content">
                        <div class="page-header" id="page-header">
                            <h1>
                                Mes organigrammes
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="space-6"></div>

                            <div class="col-xs-12">

                                <div class="alert alert-block alert-info">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="icon-remove"></i>
                                    </button>

                                    <i class="icon-info-sign blue"></i>

                                    Retrouvez ici les équipes d'IFRSkeyes.
                                </div><!-- alert info -->

                                <div class="row">
                                    <div class="space-6"></div>
                                    <div class="col-xs-12">
                                        <div class="widget-box transparent" id="recent-box">
                                            <div class="widget-header">
                                                <h4 class="lighter smaller">
                                                    <i class="icon-group orange"></i>
                                                    Organigrammes
                                                </h4>
                                            </div>
                                            <div class="hr hr8"></div>
                                        </div>
                                    </div><!-- col-xs-12 -->
                                </div><!-- row -->

                                <div class="vspace-sm"></div>

                                <div class="row-fluid">

                                    <!--                LISTE D'ORGANIGRAMMES                        -->


                                    <ul class="ace-thumbnails">
                                        <li>
                                            <a href="assets/images/gallery/Organigrammes/direction.png" title="Direction" data-rel="colorbox">
                                                <img alt="150x150" src="assets/images/gallery/Organigrammes/thumbs/direction.png" />
                                                <div class="text">
                                                    <div class="inner">Agrandir</div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="assets/images/gallery/Organigrammes/d%C3%A9partementInnovationQualit%C3%A9SI.png" title="Département Innovation, Qualité &amp SI" data-rel="colorbox">
                                                <img alt="150x150" src="assets/images/gallery/Organigrammes/thumbs/d%C3%A9partementInnovationQualit%C3%A9SI.png" />
                                                <div class="text">
                                                    <div class="inner">Agrandir</div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="assets/images/gallery/Organigrammes/d%C3%A9partementProduitsSupport.png" title="Département Produits &amp Support" data-rel="colorbox">
                                                <img alt="150x150" src="assets/images/gallery/Organigrammes/thumbs/d%C3%A9partementProduitsSupport.png" />
                                                <div class="text">
                                                    <div class="inner">Agrandir</div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="assets/images/gallery/Organigrammes/d%C3%A9partementMarketing.png" title="Département Marketing" data-rel="colorbox">
                                                <img alt="150x150" src="assets/images/gallery/Organigrammes/thumbs/d%C3%A9partementMarketing.png" />
                                                <div class="text">
                                                    <div class="inner">Agrandir</div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="assets/images/gallery/Organigrammes/d%C3%A9partementAdministrationFinancesRH.png" title="Département Administration, Finances &amp RH" data-rel="colorbox">
                                                <img alt="150x150" src="assets/images/gallery/Organigrammes/thumbs/d%C3%A9partementAdministrationFinancesRH.png" />
                                                <div class="text">
                                                    <div class="inner">Agrandir</div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="assets/images/gallery/Organigrammes/d%C3%A9partementProfessionalServices.jpg" title="Département Professional Services" data-rel="colorbox">
                                                <img alt="150x150" src="assets/images/gallery/Organigrammes/thumbs/d%C3%A9partementProfessionalServices.png" />
                                                <div class="text">
                                                    <div class="inner">Agrandir</div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="assets/images/gallery/Organigrammes/d%C3%A9partementVentesContrats.png" title="Département Ventes &amp Contrats" data-rel="colorbox">
                                                <img alt="150x150" src="assets/images/gallery/Organigrammes/thumbs/d%C3%A9partementVentesContrats.png" />
                                                <div class="text">
                                                    <div class="inner">Agrandir</div>
                                                </div>
                                            </a>
                                        </li>

                                        <!--  CHAMPS A CHANGER : href, title et src

<li>
<a href="assets/images/gallery/Organigrammes/d%C3%A9partementProduitsSupport.png" title="Département Ventes &amp Contrats" data-rel="colorbox">
<img alt="150x150" src="assets/images/gallery/Organigrammes/thumbs/direction.png" />
<div class="text">
<div class="inner">Agrandir</div>
</div>
</a>
</li>
-->
                                    </ul>

                                    <!--                FIN LISTE D'ORGANIGRAMMES                        -->


                                </div><!-- row-fluid -->
                            </div><!-- /.col -->
                        </div><!-- /row -->
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

<!-- page specific plugin scripts -->

<script src="assets/js/jquery.colorbox-min.js"></script>

<!-- inline scripts related to this page -->

<?php include("scriptGoTo.php"); ?>

<script type="text/javascript">
    $.getScript('conf/conf.js');
    $.getScript('js/getUserPicAndFirstName.js');

    $('#mesOrganigrammes').addClass('active');

    jQuery(function($) {
        var colorbox_params = {
            reposition:true,
            scalePhotos:true,
            scrolling:false,
            previous:'<i class="icon-arrow-left"></i>',
            next:'<i class="icon-arrow-right"></i>',
            close:'&times;',
            current:'{current} of {total}',
            maxWidth:'100%',
            maxHeight:'100%',
            onOpen:function(){
                document.body.style.overflow = 'hidden';
            },
            onClosed:function(){
                document.body.style.overflow = 'auto';
            },
            onComplete:function(){
                $.colorbox.resize();
            }
        };

        $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
        //let's add a custom loading icon
        $("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");
    })

</script>
</body>
</html>
