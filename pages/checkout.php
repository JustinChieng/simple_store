<?php

session_start();

require 'includes/functions.php';
require 'includes/class-products.php';
require 'includes/class-orders.php';
require 'includes/class-cart.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    //error check
    //make sure the cart is not empty
    if( empty($_SESSION['cart'])){
        $error = "Your cart is empty.";
    }

    //make sure the user is already logged in
    if (!isLoggedIn()) {
        $error = "you must be logged in to the checkout";
    }

    //only proceed if there are no error
    if (!isset ($error)) {
        $orders = new Orders();
        $cart = new Cart();

        //create new order
        $orders->createNewOrder(
            $_SESSION['user']['id'], //$user_id
            $cart->total(), //$total_amount
            $_SESSION['cart'] //$products_in_cart
        );

        //empty cart
        $cart->emptyCart();

        //redirect to orders page
        header('Location: /orders');
        exit;
    } 
    // else {
    //     //display error message if there is an error
    //     echo $error;
    // }
}

require 'parts/header.php';
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <?php if ( isset( $error ) ): ?>
                <div class="alert alert-danger mb-3">
                    <?php echo $error; ?>
                </div>
            <?php else : ?>
                <div class="alert alert-danger mb-3">
                    Something has went wrong
                </div>
            <?php endif; ?>
            <a href="/cart" class="btn btn-primary">Back to cart</a>
        </div>
    </div>
</div><!-- .container -->




<?php
require 'parts/footer.php';
