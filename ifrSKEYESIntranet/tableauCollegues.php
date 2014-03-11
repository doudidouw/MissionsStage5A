<div class="col-xs-12">
    <h3 class="header smaller lighter blue">Mes collègues</h3>

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
                    <th>Trigramme</th>
                    <th>
                        <i class="icon-user bigger-110"></i>
                        Nom
                    </th>
                    <th>
                        <i class="icon-envelope-alt bigger-110"></i>
                        Email
                    </th>
                </tr>
            </thead>

            <tbody id="mesColleguesArrayBody">

            </tbody>
        </table>
    </div>
</div>

<script src="conf/conf.js"></script>

<script type="text/javascript">
            $.getScript('conf/conf.js');

    /*-------------------------------------------
    ----------------  START On page loading functions  ----------------
    --------------------------------------------*/


    var req = $.ajax({
            url: VDOCDB_OPERATIONS,
            data: {
                method: GET_CONTACTS
            }
    });

    req.done(function(res) {
        res = $.parseJSON(res);
        var htmlArrayContent = "";
        if (res != null) {
            for(var i=0; i < res.length; i++){
                htmlArrayContent = htmlArrayContent  
              +  "<tr>"
              +      "<td class=\"center\">"
              +          "<label>"
              +              "<input type=\"checkbox\" class=\"ace\" />"
              +              "<span class=\"lbl\"></span>"
              +          "</label>"
              +      "</td>"

              +      "<td>"
              +          "<a href=\"#\">" +res[i]['login']+ "</a>"
              +      "</td>"
              +      "<td>" +res[i]['first_name']+ " " + res[i]['last_name'] +  "</td>"
              +      "<td>" +res[i]['email']+ "</td>"
              +  "</tr>";
            }

            document.getElementById("mesColleguesArrayBody").innerHTML = htmlArrayContent;

        } 
    });

    /*-------------------------------------------
    ----------------  END On page loading functions  ----------------
    --------------------------------------------*/ 


</script>