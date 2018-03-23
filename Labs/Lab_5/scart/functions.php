<?php

    function displayResults()
    {
        global $items;
        
        echo "<table class='table'>";
        if(isset($items))
        {
            foreach($items as $item)
            {
                
                //Item information
                echo "<tr>";
                
                echo "<td>";
                $picture = $item['thumbnailImage'];
                echo "<img src='$picture'>";
                echo "</td>";
                
                echo "<td>";
                echo "<h4>";
                $name = $item['name'];
                echo $name;
                echo "</h4>";
                echo "</td>";
                
                echo "<td>";
                echo "<h4>$";
                $price = $item['salePrice'];
                echo $price;
                echo "</h4>";
                echo "</td>";
                
                //Button for adding to cart
                echo "<form method='post'>";
                echo "<input type='hidden' name='itemName' value='$name'>";
                echo "<input type='hidden' name='itemPrice' value='$price'>";
                echo "<input type='hidden' name='itemImage' value='$picture'>";
                echo "<input type='hidden' name='itemId' value='" . $item['itemId'] . "'>";
                
                if($_POST['itemId'] == $item['itemId'])
                {
                    echo "<td><button class='btn btn-success'>Added</button></td>";
                }
                else
                {
                    echo "<td><button class='btn btn-warning'>Add</button></td>";
                }
                
                echo "</form>";
                
                echo "</tr>";
            }
        }
        echo "</table>";
    }
    
    function displayCart()
    {
        if(isset($_SESSION['cart']))
        {
            echo "<table class='table'>";
            
            foreach($_SESSION['cart'] as $item)
            {
                echo "<tr>";
                
                echo "<td>";
                echo "<h4>";
                echo $item['name'];
                echo "</h4>";
                echo "</td>";
                
                echo "<td>";
                echo "<h4>";
                echo "$";
                echo $item['price'];
                echo "</h4>";
                echo "</td>";
                
                echo "<td>";
                echo "<h4>";
                echo "<img src='";
                echo $item['image'];
                echo "'>";
                echo "</h4>";
                echo "</td>";
                
                echo "<form method='post' >";
                echo "<input type='hidden' name='itemId' value='";
                echo $item['id'];
                echo "'>";
                echo "<td>";
                echo "<input type='text' name='update' class='form-control' placeHolder='";
                echo $item['quantity'];
                echo "'>";
                echo "</td>";
                echo "<td>";
                echo "<button class='btn btn-danger'>Update</button>";
                echo "</td>";
                echo "</form>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='removeId' value='" . $item['id'] . "'>";
                echo "<td><button class='btn btn-danger'>Remove</button></td>";
                echo "</form>";
                
                echo "</tr>";
            }
            
            echo "</table>";
        }
    }
    
    function displayCartCount()
    {
        $quantity = 0;
        
        if(isset($_SESSION['cart']))
        {
            foreach($_SESSION['cart'] as $item)
            {
                $quantity += $item['quantity'];
            }
        }
        
        echo "(" . $quantity . ")";
        
    }

?>