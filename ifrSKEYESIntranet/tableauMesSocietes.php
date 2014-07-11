<div class="hr hr-18 dotted hr-double"></div>

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

        <table id="grid-table-societes"></table>

        <div id="grid-pager-societes"></div>
        
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div>

<script src="conf/conf.js"></script>

<script type="text/javascript">
    $.getScript('conf/conf.js');

    var req = $.ajax({
        url: EASICRMDB_OPERATIONS,
        data: {
            method: GET_MY_COMPANIES,
            firstname : localStorage.getItem("firstName"),
            lastname : localStorage.getItem("lastName") 
        }
    });

    var mesSocietesGrid = new Array();  


    req.done(function(res) {
        res = $.parseJSON(res);
        var devise = "";
        if (res != null) {
            for(var i=0; i < res.length; i++){
                if(res[i]['XDevisep'] == null){
                    devise = "";
                } else {
                    devise = res[i]['XDevisep'];
                }

                mesSocietesGrid[i] = {raison:res[i]['XSocit'], trigrammeCommer:res[i]['XTrigram'], trigrammeCompt:res[i]['XTrigra2'], pays:res[i]['XPays'], continent:res[i]['XContine'], devise:devise, origine:res[i]['XOrigine']};
            }

        }

        jQuery(function($) {
            var grid_selector = "#grid-table-societes";
            var pager_selector = "#grid-pager-societes";

            jQuery(grid_selector).jqGrid({

                data: mesSocietesGrid,
                datatype: "local",
                height: 250,
                colNames:['Raison Sociale','Trigramme <br />commercial','Trigramme <br />comptable', 'Pays', 'Continent', 'Devise par <br />défaut', 'Origine'],
                colModel:[
                    {name:'raison',index:'raison', width:70, editable: true},
                    {name:'trigrammeCommer',index:'trigrammeCommer',width:50, editable:true},
                    {name:'trigrammeCompt',index:'trigrammeCompt', width:50, editable: true},
                    {name:'pays',index:'pays', width:90, editable: true},
                    {name:'continent',index:'continent', width:60, editable: true},
                    {name:'devise',index:'devise', width:60, editable: true},
                    {name:'origine',index:'origine', width:100, editable: true}
                ], 

                viewrecords : true,
                rowNum:10,
                rowList:[10,20,30],
                pager : pager_selector,
                altRows: true,
                //toppager: true,

                multiselect: true,
                //multikey: "ctrlKey",
                multiboxonly: true,

                loadComplete : function() {
                    var table = this;
                    setTimeout(function(){
                        styleCheckbox(table);

                        updateActionIcons(table);
                        updatePagerIcons(table);
                        enableTooltips(table);
                    }, 0);
                },

                editurl: $path_base+"/dummy.html",//nothing is saved
                caption: "Mes sociétés",
                autowidth: true

            });

            //enable search/filter toolbar
            //jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch:true,stringResult:true})

            //switch element when editing inline
            function aceSwitch( cellvalue, options, cell ) {
                setTimeout(function(){
                    $(cell) .find('input[type=checkbox]')
                    .wrap('<label class="inline" />')
                    .addClass('ace ace-switch ace-switch-5')
                    .after('<span class="lbl"></span>');
                }, 0);
            }

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
                                             multipleSearch: true,
                                             /**
                    multipleGroup:true,
                    showQuery: true
                    */
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