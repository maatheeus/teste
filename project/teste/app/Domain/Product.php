<?php

namespace App\Domain;

class Product{
    public $id;
    public $name;
    public $value;
    public $type_product_id;

    public function __construct(int $id, string $name, float $value, int $type_product_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->type_product_id = $type_product_id;
    }
}