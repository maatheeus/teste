<?php

namespace App\Domain;

class TaxTypeProduct{
    public $id;
    public $name;
    public $percentage;
    public $type_product_id;

    public function __construct(int $id, string $name, float $percentage, int $type_product_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->percentage = $percentage;
        $this->type_product_id = $type_product_id;
    }
}