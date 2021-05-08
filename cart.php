<?php

// Start Session
session_start();

// Application library ( with ShopingCart class )
require __DIR__ . '\library.php';

$app = new ShopingCart();

if(isset($_POST['add_to_cart']))
{
    $app->addToCart($_POST['product_id']);
}

if (isset($_GET['id_to_remove']) && isset($_GET['id_to_remove']) != '') {
    $app->removeProductFromCart($_GET['id_to_remove']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    
</head>
<body>

    <div class="container">

       <?php include("menu.php"); ?>


       <div class="card">
        <h5 class="card-header">My Cart</h5>
            <div class="card-body">

                <?php
                    if(isset($_SESSION['shopping_cart']) && count($_SESSION['shopping_cart']) > 0)
                    {
                        $products = $_SESSION['shopping_cart'];

                        echo '
                                <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col" width="100">Action</th>
                                    </tr>
                                </thead>';

                        $item_number = 1;        
                        $total = 0;
                        foreach ($products as $product) {
                        echo '
                                <tbody>
                                    <tr>
                                    <th scope="row">'. $item_number .'</th>
                                    <td>' . $product['name'] . '</td>
                                    <td>'.$product['quantity'].'</td>
                                    <td>$ '. $product['price']. '</td>
                                    <td>
                                        <a href="cart.php?id_to_remove=' . $item_number . '" class="btn btn-danger btn-sm">X</a>
                                    </td>
                                    </tr>
                                </tbody>
                           ';
                           $total += ($product['price'] * $product['quantity']);
                            $item_number++;    
                        }

                        echo '
                                <tr>
                                    <th colspan="4" align="right">
                                        Total:
                                    </th>
                                    <td>
                                        $ '. $total .'
                                    </td>
                                </tr>
                                </table>';
                            
                    }
                    else {
                        echo '<div class="alert alert-primary" role="alert">
                              Shopping cart is empty, visit <a href="index.php" class="alert-link">products</a> page to add product into shopping cart.
                            </div>';
                    }
                ?>
                
            </div>
             <div class="card-footer">
               <a href="new.html"> <button class="btn btn-danger float-right">Shop Now</button></a>
            </div>
        </div>

    </div>

    <?php include("script.php"); ?>
</body>
</html>