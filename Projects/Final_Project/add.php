<?php

    session_start();

    include "inc/header.php";
?>


    <div class="jumbotron">
        
<?php

    if(!isset($_SESSION['user']))
    {
        echo '<h1>You are not logged in.</h1>';
        echo '<h2>If you want to add to the database please first log in.</h2>';
        echo '</div>';
    }
    else
    {

?>
      <h1>Add to Database</h1>
      <br />
      <h5><!--
        Add: 
        <select name='type' id='type'>
            <option>Select One</option>
            <option>Genre</option>
            <option>Demographic</option>
            <option>Product</option>
            <option>Author</option>
        </select>-->
      </h5>
    </div>
    
    <main id="add">

    <br />
    
    <div id="Author">
        <form method='get' id='authorForm' onsubmit='return addAuthor()'></form>
        <table>
            <tr>
                <th>
                    <h2>Add an Author</h2>
                </th>
            </tr>
            <tr>
                <td>
                    <strong>First Name</strong><br />
                    <input type='input' name='firstName' form='authorForm'></input>
                </td>
                <td>
                    <strong>Last Name</strong><br />
                    <input type='input' name='lastName' form='authorForm'></input>
                </td>
                <td>
                    <strong>Gender</strong><br />
                    <select name='gender' form='authorForm'>
                        <option value='M'>Male</option>
                        <option value='F'>Female</option>
                    </select>
                </td>
                <td>
                    <strong>Date of Birth</strong><br />
                    <input type='date' name='birth' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' value='' form='authorForm'/>
                </td>
                <td>
                    <strong>Bio</strong><br />
                    <input type='text' name='bio' form='authorForm'/>
                </td>
                <td>
                    <strong>Author Image</strong><br />
                    <input type='text' placeholder='http://www.example.com' name='authorImage' form='authorForm'/>
                </td>
                <td>
                    <br />
                    <input class="btn btn-primary" type="submit" value="Add" form='authorForm'/>
                </td>
            </tr>
        </table>
    </div>
    
    <br />
    <br />
    <!--
    <div id="Product">
        <form method='GET' id='productForm'></form>
        <table>
            <tr>
                <th>
                    <h2>Add a Product</h2>
                </th>
            </tr>
            <tr>
                <td>
                    <strong>Title</strong><br />
                    <input type='input' name='title' form='productForm' />
                </td>
                <td>
                    <strong>Description</strong><br />
                    <input type='input' name='description' form='productForm' />
                </td>
                <td>
                    <strong>Price</strong><br />
                    <input type='number' step='0.01' placeholder="00.00" name='price' form='productForm'/>
                </td>
                <td>
                    <strong>Author</strong><br />
                    <select class='author' name='authorId' form='productForm'>
                    </select>
                </td>
                <td>
                    <strong>Demographic</strong><br />
                    <select class='demo' name='demoId' form='productForm'>
                    </select>
                </td>
                <td>
                    <strong>Genre #1</strong><br />
                    <select class='genre' name='genre_1' form='productForm'>
                    </select>
                </td>
                <td>
                    <strong>Genre #2</strong><br />
                    <select class='genre' name='genre_2' form='productForm'>
                    </select>
                </td>
                <td>
                    <strong>Genre #3</strong><br />
                    <select class='genre' name='genre_3' form='productForm'>
                    </select>
                </td>
                <td>
                    <strong>Product Image</strong><br />
                    <input type='text' placeholder='http://www.example.com' name='itemImage' form='productForm'/>
                </td>
                <td>
                    <br />
                    <input class="btn btn-primary" type="submit" value="Add" form='productForm'/>
                </td>
            </tr>
        </table>
    </div>
    
    <br />
    <br />
    
    <div id="Demographic">
        <form method='get' id='demoForm'></form>
        <table>
            <tr>
                <th>
                    <h2>Add a Demographic</h2>
                </th>
            </tr>
            <tr>
                <td>
                    <strong>Name</strong><br />
                    <input type='input' name='demoName' form='demoForm'></input>
                </td>
                <td>
                    <strong>Geared Towards</strong><br />
                    <input type='input' name='orientation' form='demoForm'></input>
                </td>
                <td>
                    <br />
                    <input class="btn btn-primary" type="submit" value="Add" form='demoForm'/>
                </td>
            </tr>
        </table>
    </div>
    
    <br />
    <br />
    
    <div id="Genre">
        <form method='get' id='genreForm'></form>
        <table>
            <tr>
                <th>
                    <h2>Add a Genre</h2>
                </th>
            </tr>
            <tr>
                <td>
                    <strong>Name</strong><br />
                    <input type='input' name='genreName' form='genreForm'></input>
                </td>
                <td>
                    <strong>Description</strong><br />
                    <input type='text' placeholder='Works about x.' name='genreDescription' form='genreForm'/>
                </td>
                <td>
                    <br />
                    <input class="btn btn-primary" type="submit" value="Add" form='genreForm'/>
                </td>
            </tr>
        </table>
    </div>
    <br />
    <br />
    <div id="success">
        <h1>Success</h1>
    </div>
    <div id="failure">
        <h1>Failure</h1>
    </div>
    -->
    </main>

<?php

    }
    include "inc/footer.php";
    
?>