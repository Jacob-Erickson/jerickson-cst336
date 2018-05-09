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
                                $(selectID).append("<option value='" + data[i].demoId + "'>" + data[i].demoName + "</option>");
                                $("#" + fieldType + "Info").append("<div id='" + data[i].demoName + "Info'>" + data[i].orientation + "</div>");
                                $("#" + data[i].demoName + "Info").hide();
                            }
                        }
                        else
                        {
                            for(var i = 0; i < data.length; i++)
                            {
                                $(selectID).append("<option value='" + data[i].genreId + "'>" + data[i].genreName + "</option>");
                                $("#" + fieldType + "Info").append("<div id='" + data[i].genreId + "Info'>" + data[i].genreDescription + "</div>");
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
                                $(selectID).append("<option value='" + data[i].demoId + "'>" + data[i].demoName + "</option>");
                            }
                        }
                        else
                        {
                            for(var i = 0; i < data.length; i++)
                            {
                                $(selectID).append("<option value='" + data[i].genreId + "'>" + data[i].genreName + "</option>");
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
            else if(current == $("#userLink").attr('href'))
            {
                $("#adminLink").addClass("active");
                $("#userLink").addClass("active");
            }
            else if(current == $("#addLink").attr('href'))
            {
                $("#adminLink").addClass("active");
                $("#addLink").addClass("active");
                
                seedAddSelects();
                
                $("#type").change( function(){
                    
                    $("#add").children().hide();
                    
                    if($("#type").val() != "Select One")
                    {
                        $("#" + $("#type").val()).show();
                    }
                    
                    
                });
            }
            else if(current == $("#updateLink").attr('href'))
            {
                $("#adminLink").addClass("active");
                $("#updateLink").addClass("active");
                
                seedUpdate();
            }
            else if(current == $("#deleteLink").attr('href'))
            {
                $("#adminLink").addClass("active");
                $("#deleteLink").addClass("active");
                
                seedDelete();
            }
            
            
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
function seedAddSelects()
{
    var x = document.getElementsByClassName("demo");
    var y = document.getElementsByClassName("genre");
    var z = document.getElementsByClassName("author");
    
    $.ajax({//demographics
            
        type: "GET",
        url: "APIs/catalogAPI.php",
        dataType: "JSON",
        data: { "method": "demo" },
        success: function(data,status) {
            
            var a = "";
        
            for(var i = 0; i < data.length; i++)
            {
                a += "<option value='" + data[i].demoId + "'>" + data[i].demoName + "</option>";
            }
            
            for(var i = 0; i < x.length; i++)
            {
                x[i].innerHTML = a;
            }
                    
        },
        complete: function(data,status) { //optional, used for debugging purposes
        //alert(status);
        }
        
    });//ajax
    
    $.ajax({//genres
            
        type: "GET",
        url: "APIs/catalogAPI.php",
        dataType: "JSON",
        data: { "method": "genre" },
        success: function(data,status) {
            
            var a = "<option value='null'>Select One</option>";
        
            for(var i = 0; i < data.length; i++)
            {
                a += "<option value='" + data[i].genreId + "'>" + data[i].genreName + "</option>";
            }
            
            for(var i = 0; i < y.length; i++)
            {
                y[i].innerHTML = a;
            }
                    
        },
        complete: function(data,status) { //optional, used for debugging purposes
        //alert(status);
        }
        
    });//ajax
    
    $.ajax({//authors
            
        type: "GET",
        url: "APIs/catalogAPI.php",
        dataType: "JSON",
        data: { "method": "author" },
        success: function(data,status) {
            
            var a = "<option value='null'>Select One</option>";
        
            for(var i = 0; i < data.length; i++)
            {
                a += "<option value='" + data[i].authorId + "'>" + data[i].firstName + " " + data[i].lastName + "</option>";
            }
            
            for(var i = 0; i < z.length; i++)
            {
                z[i].innerHTML = a;
            }
                    
        },
        complete: function(data,status) { //optional, used for debugging purposes
        //alert(status);
        }
        
    });//ajax
}
function addAuthor()
{
    var x = document.getElementById("authorForm").elements;
    
    var formSub = {"method": "addAuthor"};
    
    for(var i = 0; i < x.length - 1; i++)
    {
        formSub[x[i].name] = x[i].value;
    }
    
    $.ajax({//authors
            
        type: "GET",
        url: "APIs/catalogAPI.php",
        dataType: "JSON",
        data: formSub,
        success: function(data,status) {
            
            alert("Successfully Added")
            
            var current = window.location.href.split('/').pop();
            current = current.split('#')[0];
            current = current.split('?')[0];
            
            window.location.href = current;
                    
        },
        complete: function(data,status) { //optional, used for debugging purposes
        console.log(data);
        alert(status);
        }
        
    });//ajax
    
    return false;
}
function seedUpdate()
{
    var tr = "<tr>\
                <form method='get' id='authorForm' onsubmit=\"return updateAuthor('authorForm')\"></form>\
                <td>\
                    <strong>First Name</strong><br />\
                    <input type='input' name='firstName' form='authorForm'></input>\
                </td>\
                <td>\
                    <strong>Last Name</strong><br />\
                    <input type='input' name='lastName' form='authorForm'></input>\
                </td>\
                <td>\
                    <strong>Gender</strong><br />\
                    <select name='gender' form='authorForm'>\
                        <option value='M'>Male</option>\
                        <option value='F'>Female</option>\
                    </select>\
                </td>\
                <td>\
                    <strong>Date of Birth</strong><br />\
                    <input type='date' name='birth' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' value='' form='authorForm'/>\
                </td>\
                <td>\
                    <strong>Bio</strong><br />\
                    <input type='text' name='bio' form='authorForm'/>\
                </td>\
                <td>\
                    <strong>Author Image</strong><br />\
                    <input type='text' placeholder='http://www.example.com' name='authorImage' form='authorForm'/>\
                </td>\
                <td>\
                    <br />\
                    <input type='hidden' value='' name='authorId' form='authorForm' />\
                    <input class='btn btn-primary' type='submit' value='Update' form='authorForm'/>\
                </td>\
            </tr>";
    var formSub = {"method": "getEverything"};
    
    $.ajax({//authors
            
        type: "GET",
        url: "APIs/catalogAPI.php",
        dataType: "JSON",
        data: formSub,
        success: function(data,status) {
            
            for(var y = 0; y < data[3].length; y++)
            {
                $("#authorTable").append(tr.split('authorForm').join(('authorForm' + y)));
                var x = document.getElementById("authorForm" + y).elements;
                for(var i = 0; i < x.length - 1; i++)
                {
                    x[i].value = data[3][y][x[i].name];
                }
            }
                    
        },
        complete: function(data,status) { //optional, used for debugging purposes
        //alert(status);
        }
        
    });//ajax
}
function seedDelete()
{
    var tr = "<tr id=''>\
                <td>\
                    <strong>First Name</strong><br />\
                    <span class='authorInfo' id='firstName'></span>\
                </td>\
                <td>\
                    <strong>Last Name</strong><br />\
                    <span class='authorInfo' id='lastName' form='authorForm'></span>\
                </td>\
                <td>\
                    <strong>Gender</strong><br />\
                    <span class='authorInfo' id='gender' form='authorForm'></span>\
                </td>\
                <td>\
                    <strong>Date of Birth</strong><br />\
                    <span class='authorInfo' id='birth' value='' form='authorForm'></span>\
                </td>\
                <td>\
                    <strong>Bio</strong><br />\
                    <span class='authorInfo' id='bio' form='authorForm'></span>\
                </td>\
                <td>\
                    <strong>Author Image</strong><br />\
                    <span class='authorInfo' id='authorImage' form='authorForm'></span>\
                </td>\
                <td>\
                    <br />\
                    <form method='get' id='authorForm' onsubmit=\"return deleteAuthor('authorForm')\"></form>\
                    <input type='hidden' value='' name='authorId' form='authorForm' />\
                    <input class='btn btn-primary' type='submit' value='Delete' form='authorForm'/>\
                </td>\
            </tr>";
    var formSub = {"method": "getEverything"};
    
    $.ajax({//authors
            
        type: "GET",
        url: "APIs/catalogAPI.php",
        dataType: "JSON",
        data: formSub,
        success: function(data,status) {
            
            for(var y = 0; y < data[3].length; y++)
            {
                $("#authorTable").append((tr.split('authorForm').join(('authorForm' + y)).split("id=''").join("id='rowNumber" + y + "'")));
                var x = document.getElementById("authorForm" + y).elements;
                var z = document.getElementById("rowNumber" + y).getElementsByTagName('span');
                for(var i = 0; i < x.length - 1; i++)
                {
                    x[i].value = data[3][y][x[i].name];
                }
                for(var i = 0; i < z.length; i++)
                {
                    z[i].innerHTML = data[3][y][z[i].id];
                }
            }
                    
        },
        complete: function(data,status) { //optional, used for debugging purposes
        //alert(status);
        }
        
    });//ajax
}
function updateAuthor(selection)
{
    var x = document.getElementById(selection).elements;
    
    var formSub = {"method": "updateAuthor"};
    
    for(var i = 0; i < x.length - 1; i++)
    {
        formSub[x[i].name] = x[i].value;
    }
    
    $.ajax({//authors
            
        type: "GET",
        url: "APIs/catalogAPI.php",
        dataType: "JSON",
        data: formSub,
        success: function(data,status) {
            
            alert("Successfully Updated")
            
            var current = window.location.href.split('/').pop();
            current = current.split('#')[0];
            current = current.split('?')[0];
            
            window.location.href = current;
                    
        },
        complete: function(data,status) { //optional, used for debugging purposes
        //alert(data);
        //alert(status);
        }
        
    });//ajax
    
    return false;
}
function deleteAuthor(selection)
{
    var x = document.getElementById(selection).elements;
    
    var formSub = {"method": "deleteAuthor"};
    
    for(var i = 0; i < x.length - 1; i++)
    {
        formSub[x[i].name] = x[i].value;
    }
    
    $.ajax({//authors
            
        type: "GET",
        url: "APIs/catalogAPI.php",
        dataType: "JSON",
        data: formSub,
        success: function(data,status) {
            
            alert("Successfully Deleted")
            
            var current = window.location.href.split('/').pop();
            current = current.split('#')[0];
            current = current.split('?')[0];
            
            window.location.href = current;
                    
        },
        complete: function(data,status) { //optional, used for debugging purposes
        //alert(data);
        //alert(status);
        }
        
    });//ajax
    
    return false;
}