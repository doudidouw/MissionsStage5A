<div class="sidebar" id="sidebar">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="icon-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="icon-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="icon-group"></i>
            </button>

            <button class="btn btn-danger">
                <i class="icon-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- #sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="active">
            <a href="index.php">
                <i class="icon-home"></i>
                <span class="menu-text"> Accueil </span>
            </a>
        </li>

        <li>
        <a href="#" class="dropdown-toggle">
                <i class="icon-file-alt"></i>
                <span class="menu-text">
                    Mes applications
                </span>
                <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a href="#" id="goToVdocTODO">
                    <i class="icon-folder-open-alt"></i>
                    <span class="menu-text"> Mes TODO listes </span>
                </a>
            </li>
            
            <li>
                <a href="#" id="goToVdocNotesDeFrais">
                    <i class="icon-folder-open-alt"></i>
                    <span class="menu-text"> Mes notes de frais </span>
                </a>
            </li>

            <li>
                <a href="#" id="goToKelio">
                    <i class="icon-calendar"></i>
                    <span class="menu-text"> Mes absences </span>
                </a>
            </li>

            <li>
                <a href="#" id="goToEasi">
                    <i class="icon-bar-chart"></i>
                    <span class="menu-text"> Mes affaires </span>
                </a>
            </li>
            
            <li>
                <a href="#" id="goToEasi">
                    <i class="icon-bar-chart"></i>
                    <span class="menu-text"> Mes contacts affaires </span>
                </a>
            </li>

            <li>
                <a href="#" id="goToSIRH">
                    <i class="icon-envelope"></i>
                    <span class="menu-text"> Mes dossiers du personnel </span>
                </a>
            </li>
            
            <li>
                <a href="#" id="goToOutlook">
                    <i class="icon-envelope"></i>
                    <span class="menu-text"> Mes mails &amp; calendriers </span>
                </a>
            </li>

            <li>
                <a href="#" id="goToSciforma" onclick="$('#sciformaModal').modal('show');">
                    <i class="icon-info-sign"></i>
                    <span class="menu-text"> Mes projets </span>
                </a>
            </li>

            <li>
                <a href="#" onclick="$('#ifrWebsiteModal').modal('show');">
                    <i class="icon-calendar"></i>
                    <span class="menu-text">ifrSKEYES.com</span>
                </a>
            </li>
            
            <li>
                <a href="organigrammesIFR.php" id="goToOrganigrammes">
                    <i class="icon-group"></i>
                    <span class="menu-text"> Mes organigrammes </span>
                </a>
            </li>
        </ul>
        </li>
    </ul><!-- /.nav-list -->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
    </div>

    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>

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
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
<script src="assets/js/jquery.sparkline.min.js"></script>
<script src="assets/js/flot/jquery.flot.min.js"></script>
<script src="assets/js/flot/jquery.flot.pie.min.js"></script>
<script src="assets/js/flot/jquery.flot.resize.min.js"></script>

<!-- ace scripts -->

<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- other scripts -->

<script src="conf/conf.js"></script>

<script type="text/javascript">
    $.getScript('conf/conf.js');

    $('#goToOutlook').click(function(event){
        event.preventDefault();
        console.log("Clicked outlook!");

        document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">Outlook</li>";
        document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"https://mail.ifrskeyes.com/owa/auth/logon.aspx\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        
    });

    $('#goToKelio').click(function(event){
        event.preventDefault();
        console.log("Clicked KELIO!");
        document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">Mes absences</li>";
        if(checkIfMobile() == false){
            console.log("No mobile KELIO!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srvkelio:8089/open/login?ACTION=ACTION_VALIDER_LOGIN&j_username=msi&j_password=ifrmsi9\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";


        } else if(checkIfMobile() == true){
            console.log("Mobile KELIO!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://webapp.ifrskeyes.com/open/mobile/login\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        } 
    });

    $('#goToVdocTODO').click(function(event){
        event.preventDefault();
        console.log("Clicked VDoc TODO listes!");
        window.open ('pageEnCours.php','_self',false);
        /*document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">Mes TODO Listes</li>";
        if(checkIfMobile() == false){
            console.log("No mobile VDoc!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"about:blank\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";

        } else if(checkIfMobile() == true){
            console.log("Mobile VDoc!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"about:blank\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        }*/ 
    });     
    
    $('#goToVdocNotesDeFrais').click(function(event){
        event.preventDefault();
        console.log("Clicked VDoc Notes de frais!");
        window.open ('pageEnCours.php','_self',false);
        /*document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">Mes Notes de frais</li>";
        if(checkIfMobile() == false){
            console.log("No mobile VDoc!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"about:blank\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";

        } else if(checkIfMobile() == true){
            console.log("Mobile VDoc!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"about:blank\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        }*/ 
    });     
    
    $('#goToSIRH').click(function(event){
        event.preventDefault();
        console.log("Clicked mes dossiers du personnel!");
        window.open ('pageEnCours.php','_self',false);
        /*document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">Mes dossier du personnel</li>";
        if(checkIfMobile() == false){
            console.log("No mobile SI RH!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"about:blank\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";

        } else if(checkIfMobile() == true){
            console.log("Mobile SI RH!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"about:blank\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        }*/ 
    });    

    $('#goToEasi').click(function(event){
        event.preventDefault();
        console.log("Clicked EasiCRM!");
        document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">EasiCRM</li>";
        if(checkIfMobile() == false){
            console.log("No mobile EasiCRM!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srveasicrm.ifrfrance.com/ifr/\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";

        } else if(checkIfMobile() == true){
            console.log("Mobile EasiCRM!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"about:blank\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        } 
    });  

    /*
    $('#goToSciforma').click(function(event){
        event.preventDefault();
        console.log("Clicked Sciforma!");
        document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">Sciforma/PSNext</li>";
        if(checkIfMobile() == false){
            console.log("No mobile Sciforma!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srvsciforma01:8080/sciformaprod/main.html#Login\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
            
            //create popup window
            var domain = 'http://srvsciforma01:8080';
            var iframe = document.getElementById('iframe').contentWindow;
            
            window.addEventListener('message',function(event) {
                if(event.origin !== 'http://srvsciforma01:8080') return;
                console.log('received response:  ',event.data);
            },false);

        } else if(checkIfMobile() == true){
            console.log("Mobile Sciforma!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srvsciforma01:8080/sciformaprod/main.html#Login\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        } 
    });
    */  
            
            
</script>