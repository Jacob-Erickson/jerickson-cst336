function seedBlankSelects(selectID, fieldType, info)
{
    $.ajax({
            
                type: "GET",
                url: "APIs/catalogAPI.php",
                dataType: "JSON",
                data: { "method": fieldType },
                success: function(data,status) {
                    
                    if(info)//for if there is a descriptive field
                    {
                        $(selectID).html("<option value=''>Select One</option>");
                        $("#" + fieldType + "Info").html("");
                        
                        if(fieldType == "demo")
                        {
                            for(var i = 0; i < data.length; i++)
                            {
                                $(selectID).append("<option value='" + data[i].demoName + "'>" + data[i].demoName + "</option>");
                                $("#" + fieldType + "Info").append("<div id='" + data[i].demoName + "Info'>" + data[i].orientation + "</div>");
                                $("#" + data[i].demoName + "Info").hide();
                            }
                        }
                        else
                        {
                            for(var i = 0; i < data.length; i++)
                            {
                                $(selectID).append("<option value='" + data[i].name + "'>" + data[i].name + "</option>");
                                $("#" + fieldType + "Info").append("<div id='" + data[i].name + "Info'>" + data[i].genreDescription + "</div>");
                                $("#" + data[i].name + "Info").hide();
                            }
                        }
                    }
                    else
                    {
                        $(selectID).html("<option value=''>Select One</option>");
                    
                        if(fieldType == "demo")
                        {
                            for(var i = 0; i < data.length; i++)
                            {
                                $(selectID).append("<option value='" + data[i].demoName + "'>" + data[i].demoName + "</option>");
                            }
                        }
                        else
                        {
                            for(var i = 0; i < data.length; i++)
                            {
                                $(selectID).append("<option value='" + data[i].name + "'>" + data[i].name + "</option>");
                            }
                        }
                    }
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
            
            return true;
}
function addCartItem(name)
{
    alert(name);
    return false;
}
function displayTable()
{
    $.ajax({
            
                type: "GET",
                url: "APIs/catalogAPI.php",
                dataType: "JSON",
                data: { "method": "all" },
                success: function(data,status) {
                    
                    var htmlstr = "<table id='all'><tr><th>title</th><th>author</th><th>description</th><th>price</th><th>demographic</th><th>genres</th></tr>";
                    
                    for(var i = 0; i < data.length; i++)
                    {
                        htmlstr += "<tr>";
                        htmlstr += "<td class='listing left' style='width: 180px;'><img src='" + data[i].itemImage + "' style='display: block; width: 180px; height: auto;'/></td>";
                        htmlstr += "<td class='listing'><span style='margin-left: 2%;'>" + data[i].title + "</td>";
                        htmlstr += "<td class='listing'><span>" + data[i].firstName + " " + data[i].lastName + "</td>";
                        htmlstr += "<td class='listing' style='overflow: hidden;'><span>" + data[i].description + "</td>";
                        htmlstr += "<td class='listing'><span>$" + data[i].price + "</td>";
                        htmlstr += "<td class='listing'><span>" + data[i].demoName + "</td>";
                        htmlstr += "<td class='listing'><span>" + data[i].genre_1 + "<br />" + data[i].genre_2 + "<br />" + data[i].genre_3 + "<br />" + "</td>";
                        htmlstr += "<td class='listing right' style='width: 10%;'><form onsubmit='return addCartItem('" + data[i].title.split(' ').join('+') + "')'>";
                        htmlstr += "<input type='hidden' name='item' value='" + data[i].title + "' id='" + data[i].title.split(' ').join('+') + "' />";
                        htmlstr += "<input id='addCart" + data[i].title.split(' ').join('+') + "' class='btn' type='submit' value='Add to Cart' /></form>";
                        htmlstr += "</tr>";
                    }
                    
                    htmlstr += "</table>";
                    
                    $("#fullCatalog").append(htmlstr);
                    
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
            
            return true;
}
function docReady()
{
        var current = window.location.href.split('/').pop();
        current = current.split('?')[0];
        
            if(current == $("#homeLink").attr('href'))
            {
                $("#homeLink").addClass("active");
                seedBlankSelects("#demographics", "demo", true);
                seedBlankSelects("#genre", "genre", true);
                $("#home").addClass("active");
                displayTable();
                
                $("#demographics").change(function (){
                    
                    $("#demoInfo").children().hide();
                    $("#" + $("#demographics").val() + "Info").show();
                    
                });
                
                $("#genre").change(function (){
                    
                    $("#genreInfo").children().hide();
                    $("#" + $("#genre").val() + "Info").show();
                    
                });
            }
            else if(current == $("#addLink").attr('href'))
            {
                $("#adminLink").addClass("active");
                $("#addLink").addClass("active");
            }/*
            else if(current == $("#aboutLink").attr('href'))
            {
                $("#about").addClass("active");
            }
            */
            
            
            //for modal showing
            $("#log_in").click(function(){//start link
        
                $('#logInModal').modal("show");
                
            });//end link
}
function logIn()
{
    var result = false;
    
    $("#error").html("");
    
    if(($("#username").val() == "") || ($("#password").val() == ""))
    {
        $("#error").append("*cannot log in, one or more fields are blank");
    }
    else
    {
        $.ajax({//start ajax
            type: "POST",
            url: "APIs/loginProcessAPI.php",
            dataType: "JSON",
            data: { "username": $("#username").val(),
                    "password": $("#password").val() },
            success: function(data,status) {
                
                if(!data)
                {
                    $("#error").append("*cannot log in, one or more fields are incorrect");
                }
                else
                {//sends user to the same page minus any submittals
                    var current = window.location.href.split('/').pop();
                    current = current.split('#')[0];
                    current = current.split('?')[0];
                    
                    window.location.href = current;
                }
                
            },
            complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                
            }
        
        });//end ajax
    }
    
    return result;
}