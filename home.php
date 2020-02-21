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

    <div class="row">
        <div class="column side" style="background-color:#aaa;">
            <form id="form" action="insertOrder.php" method="post">
                <div id="list" class="order">
                    <!-- <div class="list_element" id="tea_element">
                    <span>tea</span>
                    <div>
                        <button class="minus">-</button>
                    <input name="quantity" type="text" value="1" data-price="5">
                    <button class="plus">+</button>
                    </div>
                    <span>5</span>
                    <button class="deleteBtn">X</button>
                </div> -->
                </div>
                <label id="notes" for="notes">Notes:</label>
                <textarea name="notes" id="notes" rows="4" cols="50">
                </textarea>
                <label for="room">Room</label>
                <select name="room" id="room">
                    <option value="ttttt">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <hr>
                <div id="orderFooter" class="orderFooter">
                    <span id=total></span><br>
                    <button type="submit">Confirm</button>
                </div>
            </form>
        </div>

        <div class="column middle" style="background-color:#bbb;">


            <?php
            include 'config.php';
            //latest order
            $user_id=$_SESSION['id'];

            $query="SELECT p.name , o.quantity ,p.pic FROM order_product o,product p 
            WHERE p.product_id=o.product_id 
            AND order_id=(SELECT order_id FROM orders WHERE user_id=$user_id ORDER by date DESC limit 1 )";
            $stmt = $db->query($query);
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            echo "<div class='latestOrder'><span>Latest Order</span>";
            while ($ele = $stmt->fetch()) {
                echo ("<div>
                <img width='200px' src={$ele['pic']}  />
                <p>{$ele['name']}::quantity={$ele['quantity']}</p>
            </div>");
            } 
            echo "</div>";

            //show all products
            $query = "SELECT product_id,name,price,pic FROM product";
            $stmt = $db->query($query);

            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            echo "<div class='availableProducts'><span>Available Products</span>";

            while ($ele = $stmt->fetch()) {
                echo ("<div>
                <img class='item' width='200px' data-price={$ele['price']} data-name={$ele['name']} data-id={$ele['product_id']} src={$ele['pic']}  />
                <p>{$ele['price']} EPG</p>
            </div>");
            }
            echo "</div>";
            $db = null;
            ?>
            <!-- <div>
                <img class="item" data-price="7" data-name="tea" id="tea" src="images/image.jpg" alt="" />
                <p>price</p>
            </div>
            <div>
                <img class="item" data-price="7" data-name="coffe" id="coffe" src="images/image.jpg" alt="" />
                <p>price</p>
            </div>
            <div>
                <img class="item" data-price="7" data-name="cola" id="cola" src="images/image.jpg" alt="" />
                <p>price</p>
            </div> -->
        </div>
    </div>

    <div class="footer">
        <p>Footer</p>
    </div>

    <script src="home.js"></script>
</body>

</html>