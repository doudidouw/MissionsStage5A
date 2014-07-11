<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">

        <div class="navbar-header pull-left">
            <div class="carousel slide pull-left" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active"> 
                        <img alt="" src="assets/images/gallery/HeaderCarousel/Flight.png"/>
                    </div>
                    <div class="item">
                        <img alt="" src="assets/images/gallery/HeaderCarousel/Helicopter.png"/>
                    </div>
                    <div class="item">
                        <img alt="" src="assets/images/gallery/HeaderCarousel/TakeOff.png"/>
                    </div>
                </div>
            </div>

            <a href="index.php" class="navbar-brand">
                <i class="icon-lock orange"></i>
                <small id="Intranet">                    
                    Portail 
                </small>
                <small id="ifrSKEYES">
                    ifrSKEYES 
                </small>

            </a><!-- /.brand -->

        </div><!-- /.navbar-header left-->

        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-orange">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle" id="profileBox">
                        <img class="nav-user-photo" src="" alt="avatar" />
                        <span class="user-info">
                            <small>Bonjour</small>

                        </span>

                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="profile.php">
                                <i class="icon-user"></i>
                                Profil
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="login.php" onclick="localStorage.clear();">
                                <i class="icon-off"></i>
                                Déconnexion
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->

        </div><!-- /.navbar-header right-->
    </div><!-- /.navbar-container -->
</div><!-- /.navbar navbar-default -->


