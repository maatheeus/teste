<?php

namespace App\Infrastructure\Repository;

use App\Domain\TaxTypeProduct;
use App\Infrastructure\Database\DatabaseConnectionInterface;

class SaleRepository implements SaleRepositoryInterface
{
    private $connection;

    public function __construct(DatabaseConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $result = [];
        $query = $this->connection->query('select * from tax_type_product');

         while ($row = pg_fetch_array($query)) {
            $result[] =  new TaxTypeProduct((int) $row['id'], $row['name'], $row['percentage'], $row['type_product_id']);
         }

         return $result;
    }

     public function create(array $data): bool
     {
         try{
             $now = date('Y-m-d H:i:s');
             $sql = "INSERT INTO sale (created_at) VALUES ('$now') RETURNING id";
             $query = $this->connection->query($sql);
             $saleId = pg_fetch_assoc($query)['id'];

             foreach ($data as $product) {
                 $productId = $product['productId'];
                 $taxValue = $product['taxValue'];
                 $quantity = $product['quantity'];
                 $valueWithTaxDiscount = $product['valueWithTaxDiscount'];
                 $valueTotal = $product['valueTotal'];

                  $sql = "INSERT INTO sale_product (product_id, tax_value, value_with_tax_discount, value_total, sale_id, quantity) VALUES ($productId, $taxValue, $valueWithTaxDiscount, $valueTotal, $saleId, $quantity)";

                 $query = $this->connection->query($sql);
             }

             if($query)
                return true;
             else
                return false;
         }catch (\Exception $e){
            return false;
         }
     }
}