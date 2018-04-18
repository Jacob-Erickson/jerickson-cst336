<?php

    session_start();

    include "functions.php";
    
    $conn = getDatabaseConnection("ottermart");
    
    seedHead();
    
    seedNav();
    
    echo "<main>";
    unset($_POST['add']);
    
    if(isset($_SESSION['user']))
    {
        echo "<h1>";
        echo "Add a product to the catalog: ";
        echo "</h1><hr />";
        if(empty($_POST))
        {
            echo "<form method='post'>";
            echo "<span>Category:</span><select id='add_select' name='catId'>";
            foreach(getCodeResults("SELECT * FROM om_category;", $conn) as $value)
            {
                echo "<option value='" . $value['catId'];
                echo "' >";
                echo $value['catName'];
                echo "</option>";
            }
            echo "</select>";
            echo "<br /><hr />";
            
            echo "<span>Product Name:</span> <input id='add' type='text' name='productName' />";
            echo "<br /><hr />";
            
            echo "<span>Product Description:</span><input id='add' type='text' name='productDescription' />";
            echo "<br /><hr />";
            
            echo "<span>Product Image URL:</span> <input id='add' type='text' name='productImage' />";
            echo "<br /><hr />";
            
            echo "<span>Product Price:</span><input id='add' type='text' name='price' />";
            echo "<br /><hr />";
            echo "<br />";
            
            echo "<input id='submit' type='submit' value='Add to Catalog' />";
            echo "</form>";
        }
        else
        {
            $code_pt_1 = "INSERT INTO om_product (";
            $code_pt_2 = ") VALUES (";
            $i = 0;
            
            foreach($_POST as $key => $value)
            {
                $code_pt_1 .= $key;
            
                if($i != count($_POST) - 1)
                {
                    $code_pt_1 .= ",";
                }
                if(in_array($key, array("productName", "productDescription", "productImage")))
                {
                    if($value == "")
                    {
                        $code_pt_2 .= "'N/A'";
                    }
                    else
                    {
                        $code_pt_2 .= "'" . $value . "'";
                    }
                }
                else
                {
                    if($value == "")
                    {
                        $code_pt_2 .= 0;
                    }
                    else
                    {
                        $code_pt_2 .= $value;
                    }
                }
                if($i != count($_POST) - 1)
                {
                    $code_pt_2 .= ",";
                }
                $i++;
            }
            
            $code = $code_pt_1 . $code_pt_2 . ");";
            
            runCode($code, $conn);
            
            echo "Successfully Added";
            echo "<form method='post' action='add.php'>";
            echo "<button name='add' value='true'>";
            echo "Add Another";
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