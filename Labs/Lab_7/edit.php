<?php

    session_start();

    include "functions.php";
    
    $conn = getDatabaseConnection("ottermart");
    
    seedHead();
    
    seedNav();
    
    echo "<main>";
    unset($_POST['edit']);
    
    if(isset($_SESSION['user']))
    {
        if(empty($_POST))
        {
            echo "<h1>";
            echo "The following catlog items can be edited: ";
            echo "</h1>";
            echo "<br /><br />";
            $everything = getCodeResults("SELECT * FROM om_product NATURAL JOIN om_category;", $conn);
            echo "<table>";
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
                echo "<input type='text' name='productName' value='";
                echo $value['productName'];
                echo "' />";
                echo "</td>";
                
                echo "<td>";
                echo "<input type='text' name='productDescription' value='";
                echo $value['productDescription'];
                echo "' />";
                echo "</td>";
                
                echo "<td>";
                echo "<input type='text' name='productImage' value='";
                echo $value['productImage'];
                echo "' />";
                echo "</td>";
                
                echo "<td>";
                echo "<input type='text' name='price' value='";
                echo $value['price'];
                echo "' />";
                echo "</td>";
                
                echo "<td>";
                echo "<select name='catId'>";
                foreach(getCodeResults("SELECT * FROM om_category;", $conn) as $cat_value)
                {
                    echo "<option value='" . $cat_value['catId'];
                    echo "' ";
                    if($value['catId'] == $cat_value['catId'])
                    {
                        echo "selected";
                    }
                    echo " >";
                    echo $cat_value['catName'];
                    echo "</option>";
                }
                echo "</select>";
                echo "</td>";
                
                echo "<td>";
                echo "<input type='submit' value='Edit Item' />";
                echo "</td>";
                echo "</tr>";
                echo "</form>";
            }
            echo "</table>";
        }
        else
        {
            $code = "UPDATE om_product SET ";
            $i = 0;
            
            foreach($_POST as $key => $value)
            {
                if($key != 'productId')
                {
                    if(($i != count($_POST) - 1) && ($i != 0))
                    {
                        $code .= ", ";
                    }
                    
                    $code .= $key . " = ";
                    
                    if(in_array($key, array("productName", "productDescription", "productImage")))
                    {
                        if($value == "")
                        {
                            $code .= "'N/A'";
                        }
                        else
                        {
                            $code .= "'" . $value . "'";
                        }
                    }
                    else
                    {
                        if($value == "")
                        {
                            $code .= 0;
                        }
                        else
                        {
                            $code .= $value;
                        }
                    }
                    $i++;
                }
            }
            
            $code .= " WHERE productId = " . $_POST['productId'] . ";";
            
            echo $code;
            
            runCode($code, $conn);
            
            echo "Successfully Added";
            echo "<form method='post' action='edit.php'>";
            echo "<button name='edit' value='true'>";
            echo "Edit Another";
            echo "</button>";
            echo "</form>";
            $_POST = array();
        }
    }
    else
    {
        echo "<h1 style='color: red;'>You must be logged in to add items</h1>";
    }
    echo "</main>";

?>