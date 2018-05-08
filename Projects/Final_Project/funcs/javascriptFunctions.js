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
                    
                    var htmlstr = "<table><tr><th>title</th><th>author</th><th>description</th><th>price</th><th>demographic</th><th>genres</th></tr>";
                    
                    for(var i = 0; i < data.length; i++)
                    {
                        htmlstr += "<tr>";
                        htmlstr += "<td class='listing left'><span>" + data[i].title + "</td>";
                        htmlstr += "<td class='listing'><span>" + data[i].firstName + " " + data[i].lastName + "</td>";
                        htmlstr += "<td class='listing'><span>" + data[i].description + "</td>";
                        htmlstr += "<td class='listing'><span>$" + data[i].price + "</td>";
                        htmlstr += "<td class='listing'><span>" + data[i].demoName + "</td>";
                        htmlstr += "<td class='listing'><span>" + data[i].genre_1 + "<br />" + data[i].genre_2 + "<br />" + data[i].genre_3 + "<br />" + "</td>";
                        htmlstr += "<td class='listing'><img src='" + data[i].itemImage + "' /></td>";
                        htmlstr += "<td class='listing right'><form><input type='hidden' name='item' value='" + data[i].title + "' ></input><input id='addCart" + data[i].title.split(' ').join('+') + "' class='btn' type='submit' value='Add to Cart' /></form>";
                        htmlstr += "</tr>";
                    }
                    
                    $("#fullCatalog").append(htmlstr);
                    
                    $("#fullCatalog").append("</table>");
                    
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
            
            return true;
}
function docReady()
{
    /*
        var current = window.location.href.split('/').pop();
        current = current.split('?')[0];
        */
            if(/*current == $("#homeLink").attr('href')*/true)
            {
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
            else if(current == $("#adoptLink").attr('href'))
            {
                $("#adopt").addClass("active");
            }
            else if(current == $("#aboutLink").attr('href'))
            {
                $("#about").addClass("active");
            }
}
function addCartItem()
{
    
}