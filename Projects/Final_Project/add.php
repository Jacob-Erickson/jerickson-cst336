<?php

    session_start();

    include "inc/header.php";
?>

    <main id="add">

<?php

    if(!isset($_SESSION['user']))
    {
        echo '<h1>You are not logged in.</h1>';
        echo '<h2>If you want to modify your account please first log in.</h2>';
    }
    else
    {

?>

    <h1>Add</h1>
    
    <br />
    
    <form method='get' id='authorForm'>
    <table>
        <tr>
            <th>
                First Name
            </th>
            <th>
                Last Name
            </th>
            <th>
                Gender
            </th>
            <th>
                Birth Date
            </th>
            <th>
                Bio
            </th>
            <th>
                Author Image
            </th>
        </tr>
        <tr>
            <td>
                <input type='input' name='firstName' form='authorForm'></input>
            </td>
            <td>
                <input type='input' name='lastName' form='authorForm'></input>
            </td>
            <td>
                <select name='gender' form='authorForm'>
                    <option value='F'>F</option>
                    <option value='M'>M</option>
                </select>
            </td>
            <td>
                <input type='date' name='date' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' value='' form='authorForm'/>
            </td>
            <td>
                <input type='text' name='bio' form='authorForm'/>
            </td>
            <td>
                <input type='text' name='imageURL' form='authorForm'/>
            </td>
            <td>
                <input class="btn btn-primary" type="submit" value="Add" form='authorForm'/>
            </td>
        </tr>
    </table>
    
    <br />
    <br />
    
    <h2>Change Username and/or Password</h2>
    
    <span style="color: red;">* at the moment you cannot change your username or password</span>
    
    <br />
    
    <form method='post' onsubmit="return false">
        New Username: <input id="username" type="text" name="username"/><br /><br />
        New Password: <input id="password" type="text" name="password"/><br /><br />
        <input class="btn btn-primary" type="submit" value="Change"/>
        <br />
        <span id="error" style="color: red;"></span>
        <br />
    </form>
    
    </main>

<?php

    }
    include "inc/footer.php";
    
?>