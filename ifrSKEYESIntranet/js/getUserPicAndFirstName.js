var htmlProfileBoxContent = "<img class=\"nav-user-photo\" src=\""+ localStorage.getItem("profilePic") + "\" alt=\"avatar\" />"
                                   + "<span class=\"user-info\">"
                                   +     "<small>Bonjour,</small>"
                                   +     localStorage.getItem("firstName")
                                   + "</span>"

                                   + "<i class=\"icon-caret-down\"></i>";

document.getElementById("profileBox").innerHTML = htmlProfileBoxContent;