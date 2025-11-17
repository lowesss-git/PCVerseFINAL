<?php

function addToCart($productId, $productName, $price, $image, $quantity = 1) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = [
            'name' => $productName,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        ];
    }
    return true;
}

function getCartCount() {
    $count = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $count += $item['quantity'];
        }
    }
    return $count;
}

function getCartTotal() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}

function removeFromCart($productId) {
    if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$productId])) {
        // Remove the product entry entirely
        unset($_SESSION['cart'][$productId]); 
    }
    return true;
}
?>