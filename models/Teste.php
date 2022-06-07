<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;

require_once("{$base_dir}includes{$ds}Database.php");

class Teste
{
    private $table = 'teste';

    public $id;
    public $image;

    //construct
    public function __construct()
    {
    }

    // validating if params exists or not
    public function validate_params($value)
    {
        return (!empty($value));
    }

    public function add_teste()
    {
        global $database;

        $this->image = trim(htmlspecialchars(strip_tags($this->image)));
      

        $sql = "INSERT INTO $this->table (image) VALUES (
            '" . $database->escape_value($this->image) . "',
            )";

        $result = $database->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}

$product = new Teste();
