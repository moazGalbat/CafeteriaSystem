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
    <link rel="stylesheet" href="home.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>Document</title>
</head>

<body>
    <div class="header">
        <h2>Header</h2>
        <a href="logout.php">Logout</a>
    </div>

    <div class="row">
        <div class="column side" style="background-color:#aaa;">
            <form action="insertOrder.php" method="post">
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

                <div id="orderFooter" class="orderFooter">
                    <span id=total></span>
                    <button type="submit">Confirm</button>
                </div>
            </form>
        </div>

        <div class="column middle" style="background-color:#bbb;">


            <?php
            include 'config.php';

            $query = "SELECT product_id,name,price,pic FROM product";
            $stmt = $db->query($query);

            $res = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while ($ele = $stmt->fetch()) {
                echo ("<div>
                <img class='item' width='200px' data-price={$ele['price']} data-name={$ele['name']} data-id={$ele['product_id']} src={$ele['pic']}  />
                <p>{$ele['price'] } EPG</p>
            </div>");
            }
            $db=null;
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