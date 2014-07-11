<script src="conf/conf.js"></script>

<script type="text/javascript">

    $('#goToOutlook').click(function(event){
        event.preventDefault();
        $('.el').removeClass('active');
        $('#mesMailsCalendriers').addClass('active');

        document.getElementById("context-nav-bar").innerHTML = "<li>" 
        + "<i class=\"icon-home home-icon\"></i>"
        + "<a href=\"#\">Portail</a>"
        + "</li>"
        + "<li class=\"active\">Outlook</li>";
        document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"https://mail.ifrskeyes.com/owa/auth/logon.aspx\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";

    });

    $('#goToKelio').click(function(event){
        event.preventDefault();
        $('.el').removeClass('active');
        document.getElementById('menuAbsences').style.display = 'block';
        $('#accesDirectKelio').addClass('active');
        document.getElementById("context-nav-bar").innerHTML = "<li>" 
        + "<i class=\"icon-home home-icon\"></i>"
        + "<a href=\"#\">Portail</a>"
        + "</li>"
        + "<li class=\"active\">Accès direct à Kelio</li>";
        if(checkIfMobile() == false){
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srvkelio:8089/open/login\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";


        } else if(checkIfMobile() == true){
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://webapp.ifrskeyes.com/open/mobile/login\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        } 
    });    


    $('#goToEasi').click(function(event){
        event.preventDefault();
        $('.el').removeClass('active');
        document.getElementById('menuAffaires').style.display = 'block';
        $('#accesDirectEasiCRM').addClass('active');
        document.getElementById("context-nav-bar").innerHTML = "<li>" 
        + "<i class=\"icon-home home-icon\"></i>"
        + "<a href=\"#\">Portail</a>"
        + "</li>"
        + "<li class=\"active\">EasiCRM</li>";
        if(checkIfMobile() == false){
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srveasicrm.ifrfrance.com/ifr/\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";

        } else if(checkIfMobile() == true){
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srveasicrm.ifrfrance.com/ifr/\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        } 
    });  




</script>
