
<?php
require('util/main.php');

require('model/database.php');
require('model/product_db.php');

/*********************************************
 * Select some products
 **********************************************/

// Guitars category
$cat_id = 1;
$products = get_products_by_category($cat_id);

/*********************************************
 * Delete a product
 **********************************************/

$product_name = 'Fender Telecaster';
$delete_message = 'No rows were deleted.';

$product = get_product_by_name($product_name);

if ($product) {
    $product_id = $product['productID'];
    $deleted = delete_product($product_id);

    if ($deleted) {
        $delete_message = 'Product "' . $product_name .
                          '" was deleted.';
    } else {
        $delete_message = 'Product "' . $product_name .
                          '" was not deleted.';
    }
} else {
    $delete_message = 'Product "' . $product_name .
                      '" was not found.';
}

/*********************************************
 * Insert a product
 **********************************************/

$category_id = 1;
$code = 'tele';
$name = 'Fender Telecaster';
$description = 'NA';
$price = 949.99;
$discount_percent = 0;

$insert_message = 'No rows were inserted.';

try {
    $product_id = add_product(
        $category_id,
        $code,
        $name,
        $description,
        $price,
        $discount_percent
    );

    if ($product_id) {
        $insert_message = 'Product "' . $name .
                          '" was inserted.';
    } else {
        $insert_message = 'Product "' . $name .
                          '" was not inserted.';
    }
} catch (PDOException $e) {
    $insert_message = 'Product could not be inserted. ' .
                      'The product code may already exist.';
}

include 'home.php';
?>
