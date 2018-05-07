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