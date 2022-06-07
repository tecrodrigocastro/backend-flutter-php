<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');

include_once '../../models/Teste.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_images_folder = '../../assets/product_images/';

    if (!is_dir($product_images_folder)) {
        mkdir(($product_images_folder));
    }

    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $extension = end(explode('.', $file_name));

        $new_file_name = $product->seller_id . "_product_" . $product->name . "." . $extension;

        move_uploaded_file($file_tmp, $product_images_folder . "/" . $new_file_name);

        $product->image = 'product_images/' . $new_file_name;
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Photo is required'));
        die();
    }
    
    if ($product->add_teste()) {
        echo json_encode(array('success' => 1, 'message' => 'Product successfuly added!'));
    } else {
        http_response_code(500);
        echo json_encode(array('success' => 0, 'message' => 'Internal Server Error'));
    }
}else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
}
