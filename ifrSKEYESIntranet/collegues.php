<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Intranet ifrSKEYES - Mes collègues</title>

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
                            <li class="active">Mes collègues</li>
                        </ul>

                    </div><!-- .breadcrumbs -->

                    <div class="page-content" id="page-content">
                        <div class="page-header" id="page-header">
                            <h1>
                                Mes collègues
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="space-6"></div>

                            <div class="col-xs-12">

                                <div class="alert alert-block alert-success">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="icon-remove"></i>
                                    </button>

                                    <i class="icon-ok green"></i>
                                    Retrouvez en un clic tous les employés IFR.
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <table id="grid-table"></table>
                                        <div id="grid-pager"></div>

                                        <script type="text/javascript">
                                            var $path_base = "/";//this will be used in gritter alerts containing images
                                        </script>

                                    </div><!-- /.col -->
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

            var req = $.ajax({
                url: VDOCDB_OPERATIONS,
                data: {
                    method: GET_CONTACTS
                }
            });

            var mesColleguesGrid = new Array();

            req.done(function(res) {
                res = $.parseJSON(res);
                if (res != null) {
                    for(var i=0; i < res.length; i++){
                        mesColleguesGrid[i] = {trigramme:res[i]['LOGIN'], nom:res[i]['LASTNAME'], prenom:res[i]['FIRSTNAME'], email:res[i]['EMAIL'], telephone:res[i]['MOBILE_PHONE_NUMBER']};
                    }

                }

                jQuery(function($) {
                    var grid_selector = "#grid-table";
                    var pager_selector = "#grid-pager";

                    jQuery(grid_selector).jqGrid({
                        data: mesColleguesGrid,
                        datatype: "local",
                        height: 250,
                        colNames:['Trigramme','Nom','Prénom', 'Email', 'Téléphone'],
                        colModel:[
                            {name:'trigramme',index:'trigramme', width:60, editable: true, hidden:true},
                            {name:'nom',index:'nom',width:90, editable:true},
                            {name:'prenom',index:'prenom', width:90, editable: true},
                            {name:'email',index:'email', width:90, editable: true},
                            {name:'telephone',index:'telephone', width:90, editable: true}
                        ], 

                        viewrecords : true,
                        rowNum:10,
                        rowList:[10,20,30],
                        pager : pager_selector,
                        altRows: true,
                        multiselect: true,
                        multiboxonly: true,

                        loadComplete : function() {
                            var table = this;
                            setTimeout(function(){
                                updatePagerIcons(table);
                                enableTooltips(table);
                            }, 0);
                        },

                        caption: "Mon annuaire",
                        autowidth: true

                    });

                    //navButtons
                    jQuery(grid_selector).jqGrid('navGrid',pager_selector,
                                                 { 	//navbar options
                                                     edit: false,
                                                     editicon : 'icon-pencil blue',
                                                     add: false,
                                                     addicon : 'icon-plus-sign purple',
                                                     del: false,
                                                     delicon : 'icon-trash red',
                                                     search: true,
                                                     searchicon : 'icon-search orange',
                                                     refresh: false,
                                                     refreshicon : 'icon-refresh green',
                                                     view: true,
                                                     viewicon : 'icon-zoom-in grey',
                                                 },
                                                 {
                                                     //edit record form
                                                     //closeAfterEdit: true,
                                                     recreateForm: true,
                                                     beforeShowForm : function(e) {
                                                         var form = $(e[0]);
                                                         form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                                                         style_edit_form(form);
                                                     }
                                                 },
                                                 {
                                                     //new record form
                                                     closeAfterAdd: true,
                                                     recreateForm: true,
                                                     viewPagerButtons: false,
                                                     beforeShowForm : function(e) {
                                                         var form = $(e[0]);
                                                         form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                                                         style_edit_form(form);
                                                     }
                                                 },
                                                 {
                                                     //delete record form
                                                     recreateForm: true,
                                                     beforeShowForm : function(e) {
                                                         var form = $(e[0]);
                                                         if(form.data('styled')) return false;

                                                         form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                                                         style_delete_form(form);

                                                         form.data('styled', true);
                                                     },
                                                     onClick : function(e) {
                                                         alert(1);
                                                     }
                                                 },
                                                 {
                                                     //search form
                                                     recreateForm: true,
                                                     afterShowSearch: function(e){
                                                         var form = $(e[0]);
                                                         form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                                                         style_search_form(form);
                                                     },
                                                     afterRedraw: function(){
                                                         style_search_filters($(this));
                                                     }
                                                     ,
                                                     multipleSearch: true
                                                 },
                                                 {
                                                     //view record form
                                                     recreateForm: true,
                                                     beforeShowForm: function(e){
                                                         var form = $(e[0]);
                                                         form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                                                     }
                                                 }
                                                )

                    function style_search_filters(form) {
                        form.find('.delete-rule').val('X');
                        form.find('.add-rule').addClass('btn btn-xs btn-primary');
                        form.find('.add-group').addClass('btn btn-xs btn-success');
                        form.find('.delete-group').addClass('btn btn-xs btn-danger');
                    }
                    function style_search_form(form) {
                        var dialog = form.closest('.ui-jqdialog');
                        var buttons = dialog.find('.EditTable')
                        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'icon-retweet');
                        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'icon-comment-alt');
                        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'icon-search');
                    }

                    function beforeDeleteCallback(e) {
                        var form = $(e[0]);
                        if(form.data('styled')) return false;

                        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                        style_delete_form(form);

                        form.data('styled', true);
                    }

                    function beforeEditCallback(e) {
                        var form = $(e[0]);
                        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                        style_edit_form(form);
                    }

                    //replace icons with FontAwesome icons like above
                    function updatePagerIcons(table) {
                        var replacement = 
                            {
                                'ui-icon-seek-first' : 'icon-double-angle-left bigger-140',
                                'ui-icon-seek-prev' : 'icon-angle-left bigger-140',
                                'ui-icon-seek-next' : 'icon-angle-right bigger-140',
                                'ui-icon-seek-end' : 'icon-double-angle-right bigger-140'
                            };
                        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
                            var icon = $(this);
                            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

                            if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
                        })
                    }

                    function enableTooltips(table) {
                        $('.navtable .ui-pg-button').tooltip({container:'body'});
                        $(table).find('.ui-pg-div').tooltip({container:'body'});
                    }

                });
            });

        </script>
    </body>
</html>