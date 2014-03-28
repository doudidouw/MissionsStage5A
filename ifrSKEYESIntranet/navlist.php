<div class="sidebar" id="sidebar">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <!--<button class="btn btn-success">
                <i class="icon-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="icon-pencil"></i>
            </button>
            
            <button class="btn btn-danger">
                <i class="icon-cogs"></i>
            </button>-->

            <button onclick="window.location.href='collegues.php'" class="btn btn-warning" title="Mes collègues">
                <i class="icon-group"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <!--<span class="btn btn-success"></span>

            <span class="btn btn-info"></span>
            
            <span class="btn btn-danger"></span>-->

            <span onclick="window.location.href='collegues.php'" class="btn btn-warning"></span>
        </div>
    </div><!-- #sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li id ="accueil">
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

        <ul class="submenu" id="menuApplications" style="display:block;">
        
            <li id ="mesActualites" >
                <a href="actualites.php" id="goToActualites">
                    <i class="icon-folder-open-alt"></i>
                    <span class="menu-text"> Mes actualités </span>
                </a>
            </li>
            
            <li id ="mesTODOListes" >
                <a href="#" id="goToVdocTODO">
                    <i class="icon-folder-open-alt"></i>
                    <span class="menu-text"> Mes TODO listes </span>
                </a>
            </li>
            
            <li id ="mesNotesDeFrais" >
                <a href="#" id="goToVdocNotesDeFrais">
                    <i class="icon-folder-open-alt"></i>
                    <span class="menu-text"> Mes notes de frais </span>
                </a>
            </li>
            
            <li id ="mesDepartsEnMissions" >
                <a href="#" id="goToVdocOM">
                    <i class="icon-folder-open-alt"></i>
                    <span class="menu-text"> Mes départs en missions </span>
                </a>
            </li>

            <li id ="mesAbsences" >
                <a href="#" id="goToKelio">
                    <i class="icon-calendar"></i>
                    <span class="menu-text"> Mes absences </span>
                </a>
            </li>
            
            <li id ="mesAbsences" >
                <a href="monDossierPersonnel.php" id="">
                    <i class="icon-calendar"></i>
                    <span class="menu-text"> Mon dossier personnel </span>
                </a>
            </li>

            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="menu-text"> Mes affaires </span>
                    <b class="arrow icon-angle-down"></b>
                </a>
                <ul class="submenu" id="menuAffaires">
                    <li id ="mesContactsAffaires" >
                        <a href="contactsAffaires.php" id="">
                            <i class="icon-group"></i>
                            <span class="menu-text"> Mes contacts affaires </span>
                        </a>
                    </li>
                    
                    <li id ="mesAffairesEnCours" >
                        <a href="affairesEnCours.php" id="">
                            <i class="icon-bar-chart"></i>
                            <span class="menu-text"> Mes affaires en cours</span>
                        </a>
                    </li>
                    
                    <li id ="mesSocietes" >
                        <a href="mesSocietes.php" id="">
                            <i class="icon-sitemap"></i>
                            <span class="menu-text"> Mes sociétés</span>
                        </a>
                    </li>
                    
                    <li id ="mesRelances" >
                        <a href="mesRelances.php" id="">
                            <i class="icon-exchange"></i>
                            <span class="menu-text"> Mes relances</span>
                        </a>
                    </li>
                    
                    <li id ="accesDirectEasiCRM" >
                        <a href="#" id="goToEasi">
                            <i class="icon-share"></i>
                            <span class="menu-text"> Accès direct à easiCRM</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li id ="mesDossiersDuPersonnel" >
                <a href="#" id="goToSIRH">
                    <i class="icon-user"></i>
                    <span class="menu-text"> Mes dossiers du personnel </span>
                </a>
            </li>
            
            <li id ="mesMailsCalendriers" >
                <a href="#" id="goToOutlook">
                    <i class="icon-envelope"></i>
                    <span class="menu-text"> Mes mails &amp calendriers </span>
                </a>
            </li>

            <li id ="mesProjets" >
                <a href="#" id="goToSciforma" onclick="$('#sciformaModal').modal('show');">
                    <i class="icon-info-sign"></i>
                    <span class="menu-text"> Mes projets </span>
                </a>
            </li>

            <li id ="siteIfrSKEYES" >
                <a href="#" onclick="$('#ifrWebsiteModal').modal('show');">
                    <i class="icon-calendar"></i>
                    <span class="menu-text">ifrSKEYES.com</span>
                </a>
            </li>
            
            <li id ="mesOrganigrammes" >
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

<!-- other scripts -->




