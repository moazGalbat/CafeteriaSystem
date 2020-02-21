<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
// if (!isset($_SESSION['loggedin'])) {
//     header('Location: login.php');
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="manualOrder.css" />

    <title>Document</title>
</head>

<body>
    <div class="header">
        <h2>Header</h2>
        <a href="/var/www/html/CafeteriaSystem/logout.php">Logout</a>
    </div>

    <div class="row">
        <div class="column side" style="background-color:#aaa;">
            <form id="form" >
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
                    <option value="1">1</option>
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
            include '/var/www/html/CafeteriaSystem/config.php';
            //select user
            $query = "SELECT user_id,username FROM `user`";
            $stmt = $db->query($query);
            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            echo"<div class='selectUser'>             
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

    <script src="manualOrder.js"></script>
</body>

</html>