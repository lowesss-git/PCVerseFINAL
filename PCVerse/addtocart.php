<?php
session_start();
include 'includes/cart_functions.php';
 $cart_count = getCartCount();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the product data from the form
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $price = floatval($_POST['price']);
    $image = $_POST['image'];
    
    // Uses the function to add to cart
    addToCart($productId, $productName, $price, $image);
    
    // Redirect back to the page they came from
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Redirect to home if someone tries to access directly
    header("Location: Home.html");
    exit();
}
?>