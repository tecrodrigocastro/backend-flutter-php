<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Product
{
    private $table = 'products';

    public $id;
    public $seller_id;
    public $name;
    public $image;
    public $price_per_kg;
    public $description;
    public $interaction_count;

    //construct
    public function __construct()
    {
    }

    // validating if params exists or not
    public function validate_params($value)
    {
        return (!empty($value));
    }

    public function add_product()
    {
        global $database;

        $this->seller_id = trim(htmlspecialchars(strip_tags($this->seller_id)));
        $this->name = trim(htmlspecialchars(strip_tags($this->name)));
        $this->image = trim(htmlspecialchars(strip_tags($this->image)));
        $this->price_per_kg = trim(htmlspecialchars(strip_tags($this->price_per_kg)));
        $this->description = trim(htmlspecialchars(strip_tags($this->description)));


        $sql = "INSERT INTO $this->table (seller_id, name, image, price_per_kg, description) VALUES (
            '" . $database->escape_value($this->seller_id) . "',
            '" . $database->escape_value($this->name) . "',
            '" . $database->escape_value($this->image) . "',
            '" . $database->escape_value($this->price_per_kg) . "',
            '" . $database->escape_value($this->description) . "'
            )";

        $result = $database->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function get_products_per_saller()
    {
        global $database;

        $this->seller_id = trim(htmlspecialchars(strip_tags($this->seller_id)));

        $sql = "SELECT * FROM $this->table WHERE seller_id =  '" . $database->escape_value($this->seller_id) . "'";

        $result = $database->query($sql);

        return $database->fetch_array($result);
    }


    public function delete_product_per_id(){
        global $database;

        $this->product_id = trim(htmlspecialchars(strip_tags($this->product_id)));

        $sql = "DELETE FROM $this->table WHERE id = '" . $database->escape_value($this->product_id) . "' ";

        $result = $database->query(($sql));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
}

$product = new Product();
