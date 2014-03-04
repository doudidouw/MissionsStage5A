<div class="hr hr-18 dotted hr-double"></div>

<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">Mes affaires en cours</h3>

        <div class="table-responsive">
            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">
                            <label>
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>Code</th>
                        <th>Société</th>
                        <th>Contact</th>

                        <th>Intitulé</th>
                        <th class="hidden-480">Progiciel</th>

                        <th>Projet</th>
                        <th>Total HT</th>
                        <th>CA restant</th>
                        <th>Reste à facturer HT</th>
                        <th>Restant dû TTC</th>
                    </tr>
                </thead>

                <tbody id="mesAffairesArrayBody">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="hr hr-18 dotted hr-double"></div>

<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">Mes sociétés</h3>

        <div class="table-responsive">
            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">
                            <label>
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>Raison Sociale</th>
                        <th>Trigramme commercial</th>
                        <th>Trigramme comptable</th>

                        <th>Pays</th>
                        <th>Continent</th>

                        <th>Devise par défaut</th>
                        <th>Origine</th>
                    </tr>
                </thead>

                <tbody id="mesSocietesArrayBody">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $.getScript('conf/conf.js');

    var req = $.ajax({
            url: EASICRMDB_OPERATIONS,
            data: {
                method: GET_ONGOING_OPPORTUN
            }
    });


    req.done(function(res) {
        res = $.parseJSON(res);
        if (res != null) {
            var htmlArrayContent = "";
            var projet = "";
            
            for(var i=0; i < res.length; i++){
                if(res[i]['XProjet'] == null){
                    projet = "Néant";
                } else {
                    projet = res[i]['XProjet'];
                }
                htmlArrayContent = htmlArrayContent  
                  +  "<tr>"
                  +      "<td class=\"center\">"
                  +          "<label>"
                  +              "<input type=\"checkbox\" class=\"ace\" />"
                  +              "<span class=\"lbl\"></span>"
                  +          "</label>"
                  +      "</td>"

                  +      "<td>"
                  +          "<a href=\"#\">" +res[i]['XCode']+ "</a>"
                  +      "</td>"
                  +      "<td>" +res[i]['XIddelas']+ "</td>"
                  +      "<td>" +res[i]['XIdConta']+ "</td>"
                  +      "<td>" +res[i]['XLibell']+ "</td>"

                  +      "<td class=\"hidden-480\">"
                  +          "<span class=\"label label-sm label-warning\">" +res[i]['XProgici']+ "</span>"
                  +      "</td>"
                        
                  +      "<td>" +projet+ "</td>"
                  +      "<th>" +res[i]['XTotalHT'].toFixed(2)+ "</th>"
                  +      "<th>" +res[i]['XCAresta'].toFixed(2)+ "</th>"
                  +      "<th>" +res[i]['XRestefa'].toFixed(2)+ "</th>"
                  +      "<th>" +res[i]['XRestant'].toFixed(2)+ "</th>"

                  +  "</tr>";
            }

            document.getElementById("mesAffairesArrayBody").innerHTML = htmlArrayContent;

        } 
    });
    
    req = $.ajax({
            url: EASICRMDB_OPERATIONS,
            data: {
                method: GET_MY_COMPANIES
            }
    });


    req.done(function(res) {
        res = $.parseJSON(res);
        if (res != null) {
            var htmlArrayContent = "";
            var devise = "";
            
            for(var i=0; i < res.length; i++){
                if(res[i]['XDevisep'] == null){
                    devise = "";
                } else {
                    devise = res[i]['XDevisep'];
                }
                htmlArrayContent = htmlArrayContent  
                  +  "<tr>"
                  +      "<td class=\"center\">"
                  +          "<label>"
                  +              "<input type=\"checkbox\" class=\"ace\" />"
                  +              "<span class=\"lbl\"></span>"
                  +          "</label>"
                  +      "</td>"

                  +      "<td>"
                  +          "<a href=\"#\">" +res[i]['XSocit']+ "</a>"
                  +      "</td>"
                  +      "<td>" +res[i]['XTrigram']+ "</td>"
                  +      "<td>" +res[i]['XTrigra2']+ "</td>"
                  +      "<td>" +res[i]['XPays']+ "</td>"

                  +      "<td class=\"hidden-480\">"
                  +          "<span class=\"label label-sm label-warning\">" +res[i]['XContine']+ "</span>"
                  +      "</td>"
                        
                  +      "<th>" +devise+ "</th>"
                  +      "<th>" +res[i]['XOrigine']+ "</th>"

                  +  "</tr>";
            }

            document.getElementById("mesSocietesArrayBody").innerHTML = htmlArrayContent;

        } 
    });



</script>