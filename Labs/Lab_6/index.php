<?php

    function getDatabaseConnection($dbName) 
    {
        //checks whether the URL contains "herokuapp" (using Heroku)
        if(strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
           $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
           $host = $url["host"];
           $dbname = substr($url["path"], 1);
           $username = $url["user"];
           $password = $url["pass"];
        }
        
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $dbConn;
    
    }
    
    function seedTagsWithCategory($tagType, $database)
    {
        $code = "SELECT catName FROM `om_category` WHERE 1 ORDER BY catName;";
        $alpha = $database->prepare($code);
        $alpha->execute();
        $result = $alpha->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($result as $value)
        {
            echo "<" . $tagType . ">";
            echo $value['catName'];
            echo "</" . $tagType . ">";
        }
        
    }
    
    function displayResults()
    {
        $code .= "SELECT * 
                    FROM om_product 
                    INNER JOIN om_category 
                    ON om_product.catId = om_category.catId";
        
        if(!isset($_GET['purchase_history']))
        {
            $code .= " WHERE " ;
        }
        if(isset($_GET['category']))
        {
            $code .= "catName = \"" . $_GET['category'] . "\"";
        }
        
        if(isset($_GET['search_term']) && ($_GET['search_term'] != "none") && ($_GET['search_term'] != ""))
        {
            addend($code);
            $code .= "productName LIKE \"%" . $_GET['search_term'] . "%\" AND ";
            $code .= "productDescription LIKE \"%" . $_GET['search_term'] . "%\"";
        }
        
        if(isset($_GET['max']) && ($_GET['max'] != ""))
        {
            addend($code);
            $code .= "price ";
            if(isset($_GET['min']) && ($_GET['min'] != ""))
            {
                $code .= "BETWEEN " . $_GET['min'] . " AND " . $_GET['max'];
            }
            else
            {
                $code .= "<= " . $_GET['max'];
            }
        }
        else if(isset($_GET['min']) && ($_GET['min'] != ""))
        {
            
            addend($code);
            $code .= "price >= " . $_GET['min'];
        }
        
        if(isset($_GET['order_by']))
        {
            $code .= " ORDER BY ";
            if($_GET['order_by'] == "product_name")
            {
                $code .= "productName ASC";
            }
            else
            {
                $code .= "price ASC";
            }
        }
        
        $code .= ";";
        
        $database = getDatabaseConnection("ottermart");
        $alpha = $database->prepare($code);
        $alpha->execute();
        $alpha = $alpha->fetchAll(PDO::FETCH_ASSOC);
        
        if(!isset($_GET['purchase_history']))
        {
            echo "<table>";
        
            foreach($alpha as $value)
            {
                echo "<tr>";
                echo "<form>";
                echo "<input type='hidden' name='purchase_history' value='" . $value['productName'] . "'/>";
                echo "<td>";
                echo "<strong>Product Name: </strong><br />";
                echo "<input type='submit' id='name' value='" . $value['productName'] . "' />";
                echo "</td>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<strong>Description: </strong><br />";
                echo $value['productDescription'];
                echo "</td>";
                echo "<td>";
                echo "<strong>Price: </strong><br />$";
                echo $value['price'];
                echo "</td>";
                if(isset($_GET['order_by']))
                {
                    echo "<td>";
                    echo $value['display_images'];
                    echo "</td>";
                }
                echo "<td>";
                echo "<img src='" . $value['productImage'] . "' />";
                echo "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
        }
        else
        {
            $code = "SELECT * 
                FROM om_purchase 
                INNER JOIN om_user 
                ON om_purchase.user_id = om_user.userId 
                INNER JOIN om_product 
                ON om_purchase.productId = om_product.productId
                ORDER BY purchaseDate;";
                
            $beta = $database->prepare($code);
            $beta->execute();
            $beta = $beta->fetchAll(PDO::FETCH_ASSOC);
            
            $fixed = str_replace("+", " ", $_GET['purchase_history']);
            
            echo "<h2>Displaying purchase history for: " . $_GET['purchase_history'] . "</h2>";
            
            echo "<div>";
            
            foreach($alpha as $value)
            {
                if($value['productName'] == $fixed)
                {
                    echo "<img src='" . $value['productImage'] . "' />";
                }
            }
            
            echo "</div>";
            
            $empty = true;
            
            echo "<table>";
            
            foreach($beta as $value)
            {
                if($value['productName'] == $fixed)
                {
                    $empty = false;
                    echo "<tr>";
                    echo "<td>";
                    echo "Purchase Date: ";
                    echo "<br />";
                    echo $value['purchaseDate'];
                    echo "</td>";
                    echo "<td>";
                    echo "Customer: ";
                    echo "<br />";
                    echo $value['firstName'];
                    echo " ";
                    echo $value['lastName'];
                    echo "</td>";
                    echo "<td>";
                    echo "Quantity: ";
                    echo "<br />";
                    echo $value['quantity'];
                    echo "</td>";
                    echo "<td>";
                    echo "Unit Price: ";
                    echo "<br />";
                    echo "$";
                    echo $value['unitPrice'];
                    echo "</td>";
                    echo "<td>";
                    echo "Total Spent: ";
                    echo "<br />";
                    echo "$";
                    echo $value['unitPrice'] * $value['quantity'];
                    echo "</td>";
                    echo "</tr>";
                }
            }
            
            if($empty)
            {
                echo "<tr>";
                echo "<td>";
                echo "<strong>";
                echo "No purchases of this product have been made.";
                echo "</strong>";
                echo "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
            
            
            
        }
    }
    
    function addend(&$code)
    {
        $compare = substr($code, (strlen($code) - 5), strlen($code));
        if($compare != "AND ")
        {
            $code .= " AND ";
        }
    }
    
    $otterMartDb = getDatabaseConnection("ottermart");
    
    

?>

<!DOCTYPE html>
<html>
    <head>
        <title> OtterMart </title>
        <style type="text/css">
            @import url("styles.css");
        </style>
    </head>
    <body>
        
        <header>
            <h1>
                <strong>
                    OtterMart
                </strong>
            </h1>
        </header>
        
        <main>
            <form method='get'>
                <span><strong>Product:</strong></span>
                <input type="text" name="search_term" value="none"/>
                <br /><br />
                <span><strong>Category: </strong></span>
                <select name="category">
                    <?php seedTagsWithCategory("option", $otterMartDb); ?>
                </select>
                <br /><br />
                <span><strong>Price: </strong>From $</span>
                <input type="text" name="min" value=0.00 />
                <span>To $</span>
                <input type="text" name="max" value=9999.99 />
                <br /><br />
                <span><strong>Order Results By: </strong></span>
                <div style="float:left;">
                    <input type="radio" name="order_by" value="product_name">Product Name</input>
                    <br />
                    <input type="radio" name="order_by" value="price" />Price</input>
                </div>
                <br /><br />
                <input type="checkbox" name="display_images" value="true">Display Product Pictures</input>
                <br /><br />
                <input type="submit" value="Search"/>
            </form>
            
            <?php
            
                if(!empty($_GET))
                {
                    displayResults();
                }
                
            ?>
        </main>

    </body>
</html>