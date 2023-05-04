<?php

namespace App\Domain;

class SaleProduct{
    public $id;
    public $product_id;
    public $tax_value;
    public $value_with_tax_discount;
    public $value_total;
    public $sale_id;

    public function __construct(int $id,int $product_id, float $tax_value, float $value_with_tax_discount, float $value_total, float $sale_id)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->tax_value = $tax_value;
        $this->value_with_tax_discount = $value_with_tax_discount;
        $this->value_total = $value_total;
        $this->sale_id = $sale_id;
    }
}