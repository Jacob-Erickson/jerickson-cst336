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

function displayTable()
{
    $.ajax({
            
                type: "GET",
                url: "APIs/catalogAPI.php",
                dataType: "JSON",
                data: { "method": "all" },
                success: function(data,status) {
                    
                    $("#fullCatalog").append("<table>");
                    $("#fullCatalog").append("<tr><th>title</th><th>author</th><th>description</th><th>price</th><th>demographic</th><th>genres</th></tr>");
                    
                    for(var i = 0; i < data.length; i++)
                    {
                        $("#fullCatalog").append("<tr>");
                        $("#fullCatalog").append("<td class='listing left'>" + data[i].title + "</td>");
                        $("#fullCatalog").append("<td class='listing'>" + data[i].firstName + " " + data[i].lastName + "</td>");
                        $("#fullCatalog").append("<td class='listing'>" + data[i].description + "</td>");
                        $("#fullCatalog").append("<td class='listing'>" + data[i].price + "</td>");
                        $("#fullCatalog").append("<td class='listing'>" + data[i].demoName + "</td>");
                        $("#fullCatalog").append("<td class='listing'>" + data[i].genre_1 + "<br />" + data[i].genre_2 + "<br />" + data[i].genre_3 + "<br />" + "</td>");
                        $("#fullCatalog").append("<td class='listing'><img src='" + data[i].itemImage + "' /></td>");
                        $("#fullCatalog").append("<td class='listing right'><form method='post'><input type='hidden' value='" + data.title + "'/><button class= 'btn' type'submit'>Add to Cart</button></form>");
                        $("#fullCatalog").append("</tr>");
                    }
                    
                    $("#fullCatalog").append("</table>");
                    
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
            
            return true;
}