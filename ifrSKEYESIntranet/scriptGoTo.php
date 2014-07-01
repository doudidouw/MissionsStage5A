<script src="conf/conf.js"></script>

<script type="text/javascript">
    
    $('#goToOutlook').click(function(event){
        event.preventDefault();
        $('#mesMailsCalendriers').addClass('active');
        //console.log("Clicked outlook!");

        document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">Outlook</li>";
        document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"https://mail.ifrskeyes.com/owa/auth/logon.aspx\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        
    });

    $('#goToKelio').click(function(event){
        event.preventDefault();
        document.getElementById('menuAbsences').style.display = 'block';
        $('#accesDirectKelio').addClass('active');
        //console.log("Clicked KELIO!");
        document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">Accès direct à Kelio</li>";
        if(checkIfMobile() == false){
            //console.log("No mobile KELIO!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srvkelio:8089/open/login\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";


        } else if(checkIfMobile() == true){
            //console.log("Mobile KELIO!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://webapp.ifrskeyes.com/open/mobile/login\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        } 
    });    
    

    
    
    $('#goToSIRH').click(function(event){
        event.preventDefault();
        //console.log("Clicked mes dossiers du personnel!");
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
        document.getElementById('menuAffaires').style.display = 'block';
        $('#accesDirectEasiCRM').addClass('active');
        //console.log("Clicked EasiCRM!");
        document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">EasiCRM</li>";
        if(checkIfMobile() == false){
            //console.log("No mobile EasiCRM!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srveasicrm.ifrfrance.com/ifr/\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";

        } else if(checkIfMobile() == true){
            //console.log("Mobile EasiCRM!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"about:blank\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        } 
    });  
    
    $('#goToSciforma').click(function(event){
        event.preventDefault();
        //console.log("Clicked Sciforma!");
        document.getElementById("context-nav-bar").innerHTML = "<li>" 
                + "<i class=\"icon-home home-icon\"></i>"
                + "<a href=\"#\">Portail</a>"
                + "</li>"
                + "<li class=\"active\">Sciforma/PSNext</li>";
        if(checkIfMobile() == false){
            //console.log("No mobile Sciforma!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srvsciforma01:8080/sciformaprod/main.html#Login\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
            
            //create popup window
            var domain = 'http://srvsciforma01:8080';
            var iframe = document.getElementById('iframe').contentWindow;
            
            window.addEventListener('message',function(event) {
                if(event.origin !== 'http://srvsciforma01:8080') return;
                //console.log('received response:  ',event.data);
            },false);

        } else if(checkIfMobile() == true){
            //console.log("Mobile Sciforma!");
            document.getElementById("page-content").innerHTML = "<iframe style=\"top:0;left:0;float:left;z-index:1;\" width=\"100%\" height=\"2000px\"src=\"http://srvsciforma01:8080/sciformaprod/main.html#Login\" name=\"iframe\" frameBorder=\"0\" id=\"iframe\"></iframe>";
        } 
    });
      
            
            
</script>
