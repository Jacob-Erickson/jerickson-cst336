<?php

    session_start();

    include "functions.php";
    
    $conn = getDatabaseConnection("ottermart");
    
    seedHead();
    
    seedNav();
    
    echo "<main>";
    unset($_POST['delete']);
    
    if(isset($_SESSION['user']))
    {
        echo "<h1>";
        echo "The following catlog items can be deleted: ";
        echo "</h1>";
        echo "<br /><br />";
        if(empty($_POST))
        {
            $everything = getCodeResults("SELECT * FROM om_product NATURAL JOIN om_category;", $conn);
            echo "<table id='removal'>";
            echo "<tr>";
            echo "<th>";
            echo "Product Name";
            echo "</th>";
            echo "<th>";
            echo "Product Description";
            echo "</th>";
            echo "<th>";
            echo "Product Image URL";
            echo "</th>";
            echo "<th>";
            echo "Price";
            echo "</th>";
            echo "<th>";
            echo "Category";
            echo "</th>";
            echo "</tr>";
            foreach($everything as $value)
            {
                echo "<tr>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='productId' value='";
                echo $value['productId'];
                echo "' />";
                echo "<td>";
                echo "<input type='hidden' name='productName' value='";
                echo $value['productName'];
                echo "' />";
                echo $value['productName'];
                echo "</td>";
                
                echo "<td>";
                echo $value['productDescription'];
                echo "</td>";
                
                echo "<td>";
                echo $value['productImage'];
                echo "</td>";
                
                echo "<td>";
                echo $value['price'];
                echo "</td>";
                
                echo "<td>";
                echo $value['catName'];
                echo "</td>";
                
                echo "<td>";
                echo "<input type='submit' value='Delete Item' />";
                echo "</td>";
                echo "</tr>";
                echo "</form>";
            }
            echo "</table>";
        }
        else
        {
            if($_POST['confirm'] != 'Yes')
            {
                echo "Are you sure you want to delete \"" . $_POST['productName'] . "\"?";
                
                echo "<br />";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='productId' value='";
                echo $_POST['productId'];
                echo "' />";
                
                echo "<input type='hidden' name='productName' value='";
                echo $_POST['productName'];
                echo "' />";
                
                echo "<input type='submit' name='confirm' value='Yes' />";
                echo "</form>";
                
                echo "<form method='post' action='delete.php'>";
                
                echo "<input type='hidden' name='productName' value='";
                echo $_POST['productName'];
                echo "' />";
                
                echo "<input type='submit' name='confirm' value='No' />";
                echo "</form>";
            }
            else
            {
                $code = "DELETE FROM om_product WHERE productId = " . $_POST['productId'] . ";";
                
                echo $code;
                
                runCode($code, $conn);
                
                echo "Successfully Deleted \"" . $_POST['productName'] . "\"";
                echo "<br />";
                echo "<form method='post' action='delete.php'>";
                echo "<button name='delete' value='true'>";
                echo "Delete Another";
                echo "</button>";
                echo "</form>";
                $_POST = array();
            }
        }
    }
    else
    {
        echo "<h1 style='color: red;'>You must be logged in to add items</h1>";
    }
    echo "</main>";

?>