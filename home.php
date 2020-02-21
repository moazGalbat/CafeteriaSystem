<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="home.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Home</title>
</head>

<body>
    <!-- TO DO getting all user info  -->
    <div class="nav-bar">
        <div class="left-nav">
            <a href="#"><i class="fa fa-fw fa-home"></i> Home</a>
            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Orders</a>
        </div>
        <div class="right-nav">
                <img class="user-pic" src="images/user.png">
                <a>username</a>
            <div class=log-out>
                <div>|</div>
                <a id="logOut" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
            </div>
        </div>
        <!-- <i class="fa fa-bars" aria-hidden="true"></i> -->

    </div>

    <div class="main">
            <form  class="order-data" id="form" action="insertOrder.php" method="post">
                <div id="list" class="order">
                    <div>Order</div>
                </div>
                <div class="notes">
                    <label id="notes" for="notes">Notes:</label>
                    <textarea name="notes" id="notes" rows="4" cols="50">
                    </textarea>
                </div>
                <div class="room">
                    <label for="room">Room</label>
                    <select name="room" id="room">
                        <option value="1001">1001</option>
                        <option value="1002">1002</option>
                        <option value="1003">1003</option>
                    </select>
                </div>
                <hr>
                <div id="orderFooter" class="orderFooter">
                    <span id=total></span><br>
                    <button type="submit">Confirm</button>
            </form>
        </div>
        <div class="product-list-last">

            <?php
            include 'config.php';
            //latest order
            $user_id=$_SESSION['id'];

            $query="SELECT p.name , o.quantity ,p.pic FROM order_product o,product p 
            WHERE p.product_id=o.product_id 
            AND order_id=(SELECT order_id FROM orders WHERE user_id=$user_id ORDER by date DESC limit 1 )";
            $stmt = $db->query($query);
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            echo "<div class='latest-order'><div class='latestOrder-title'>Latest Order</div>";
            while ($ele = $stmt->fetch()) {
                echo ("<div class='order-item'>
                <img class='item-img' src={$ele['pic']}  />
                <p>{$ele['name']}::quantity={$ele['quantity']}</p>
            </div>");
            } 
            echo "</div>";

            // show all products
            $query = "SELECT product_id,name,price,pic FROM product";
            $stmt = $db->query($query);

            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            echo "<div class='products-list'><div class='produts-list-title'>Available Products</div>";
            echo "<div class='items-list'>";
            while ($ele = $stmt->fetch()) {
                echo ("<div class=item>
                <img class='item-img'  data-price={$ele['price']} data-name={$ele['name']} data-id={$ele['product_id']} src={$ele['pic']}  />
                <div>{$ele['name']} </div>
                <div>{$ele['price']} L.E</div>

            </div>");
            }
            echo "</div>";
            echo "</div>";
            $db = null;
            ?>
        </div>
    </div>
    
    <!-- <div class="footer">
        <p>Footer</p>
    </div> -->


    <script src="home.js"></script>
</body>

</html>