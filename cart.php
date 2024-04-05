<?php
include "connect.php";
?>
<html>

<head>
    <title>Add To Cart</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
            <h1>Add To Cart in PHP</h1>
            <hr>
            <?php
            $sql = "select * from products";
            $res = $conn->query($sql);
            if ($res->num_rows > 0) {

                while ($row = $res->fetch_assoc()) {              // to retreive records from database
                    echo '
    <div class="col-sm-4 col-lg-3 col-md-3 text-center">         

<img src="Images/' . $row['pic'] . '" alt="" class="img-responsive" >  
<p><strong><a href="#">' . $row['pname'] . '</a></strong></p>

<h4 class="text-danger"> Rs.' . $row['price'] . '</h4>

<p><a href="view.php?id=' . $row['pid'] . '" class="btn btn-success">View Details</a></p>

</div> ';
                }
            }
            ?>


        </div>
    </div>


</body>

</html>