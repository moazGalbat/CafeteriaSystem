

<?php 

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login.php');
}
if ($_SESSION['is_admin']!=1){
    die ("Access Denied");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="../css/test.css" /> -->
    <link rel="stylesheet" href="../css/manualOrder.css" />
    <link rel="stylesheet" href="../css/adminNav.css" />

    <title>Manual Order</title>
</head>

<body>

    <?php include('adminNav.html') ?>

    <!-- ********************* -->
    <div class="main">
            <form id="form" class="order-data">
                <div  class="order">
                    <p>Manual Order</p>
                    <hr>
                    <div class='order-details'>Order Details :</div>
                    <div id="list"></div>
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
                <hr>
                <div class="notes">
                    <label id="notes" for="notes">Notes:</label>
                    <textarea name="notes" id="notes" rows="4" cols="50">
                    </textarea>
                </div>
                <div class="room">
                    <label for="room">Room</label>
                    <select name="room" id="room">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class='footer'>
                <div id="orderFooter" class="orderFooter">
                <hr>
                    <span id=total>Total: 0 L.E</span><br>
                    <hr>                    
                </div>
                <button class="confirm" type="submit">Confirm</button>


                </div>                
            </form>

        <div class="product-list-addUser">

            <?php
            include '../config.php';
            //select user
            $query = "SELECT user_id,username FROM `user`";
            $stmt = $db->query($query);
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            echo"<div class='select-user'>
            <div class='user-title'>Select User: </div>           
            <select name='user' id='user'>
            ";
            while ($ele = $stmt->fetch()) {
               echo" <option value='{$ele['user_id']}'>{$ele['username']}</option>";
            }
            echo"</select>
            </div> ";
            //show all products
            $query = "SELECT product_id,name,price,pic FROM product";
            $stmt = $db->query($query);

            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            echo "<div class='products-list'><div class='produts-list-title'>Available Products</div>";
            echo "<div class='search-bar'><input type='text' placeholder='find product' name='search' id='search'></div>";
            echo "<div class='items-list'>";
            while ($ele = $stmt->fetch()) {
                echo ("<div class='item'>
                <img class='item-img' data-price={$ele['price']} data-name={$ele['name']} data-id={$ele['product_id']} src={$ele['pic']}  />
                <div>{$ele['name']}</div>
                <div>{$ele['price']} L.E</div>
            </div>");
            }
            echo "</div>";
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

    <!-- <div class="footer">
        <p>Footer</p>
    </div> -->

    <script src="../js/manualOrder.js"></script>
</body>

</html>