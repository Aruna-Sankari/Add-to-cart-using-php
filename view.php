<?php
include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <h1>Add To Cart In PHP</h1>
            <hr>
            <?php
            if (isset($_POST["addCart"])) {
                if (isset($_SESSION["cart"])) {
                    $pid_array = array_column($_SESSION["cart"], "pid");
                    if (!in_array($_GET["id"], $pid_array)) {
                        $index = count($_SESSION["cart"]);
                        $item = array(
                            'pid' => $_GET["id"],
                            'pname' => $_POST["pname"],
                            'price' => $_POST["price"],
                            'qty' => $_POST["qty"]
                        );
                        $_SESSION["cart"][$index] = $item;
                        echo "<script>alert('Product Added..')</script>";
                        header("location:viewCart.php");
                    } else {
                        echo "<script>alert('Already Added..');</script>";
                    }
                } else {
                    $item = array(
                        'pid' => $_GET["id"],
                        'pname' => $_POST["pname"],
                        'price' => $_POST["price"],
                        'qty' => $_POST["qty"]
                    );
                    $_SESSION["cart"][0] = $item;
                    echo "<script>alert('Product Added..')</script>";
                    header("location:viewCart.php");
                }
            }
            $sql = "select * from products where pid='{$_GET["id"]}'";
            $res = $conn->query($sql);
            if ($res->num_rows > 0) {
                echo '<form action="' . $_SERVER["REQUEST_URI"] . '" method="post">';
                if ($row = $res->fetch_assoc()) {
                    echo '
   <div class="col-sm-4 col-lg-3 col-md-3 text-center">    
     <img src="images/' . $row['pic'] . '" alt="" class="img-responsive" >
     <p><strong><a href="#">' . $row['pname'] . '</a></strong></p>
     <h4 class="text-danger"> Rs.' . $row['price'] . '</h4>
     <p>Display : ' . $row['display'] . ' </p>
     <p>Brand : ' . $row['brname'] . '</p>
     <p>RAM : ' . $row['RAM'] . ' GB</p>
     <p>Storage : ' . $row['storage'] . ' GB </p>
	<p><input type="text"  placeholder="Enter Qty" name="qty"  class="form-control"></p>
	<p><input type="hidden"  name="pname" value="' . $row['pname'] . '" class="form-control"></p>
	<p><input type="hidden"  name="price" value="' . $row['price'] . '" class="form-control"></p>
	<p><input type="submit" name="addCart" class="btn btn-success" value="Add to Cart"></p>
   </div>
   ';
                }
                echo '</form>';
            }
            ?>
        </div>
    </div>

</body>

</html>