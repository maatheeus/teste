<?php

namespace App\Infrastructure\Repository;

use App\Domain\TaxTypeProduct;
use App\Infrastructure\Database\DatabaseConnectionInterface;

class TaxTypeProductRepository implements TaxTypeProductRepositoryInterface
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
             $name = $data['name'];
             $percentage = $data['percentage'];
             $type_product_id = $data['type_product_id'];

             $sql = "INSERT INTO tax_type_product (name, percentage, type_product_id) VALUES ('$name', $percentage, $type_product_id)";
             $query = $this->connection->query($sql);

             if($query)
                return true;
             else
                return false;
         }catch (\Exception $e){
            return false;
         }
     }

     public function update(int $id, array $data): bool
     {
         try{
             $name = $data['name'];
             $percentage = $data['percentage'];
             $type_product_id = $data['type_product_id'];

             $sql = "UPDATE tax_type_product set name = '$name', percentage = $percentage, type_product_id = $type_product_id where id = {$id}";
             $query = $this->connection->query($sql);

             if($query)
                return true;
             else
                return false;
         }catch (\Exception $e){
            return false;
         }
     }


     public function getTaxProduct(int $typeProductId)
     {
         $result = [];
         $query = $this->connection->query("select * from tax_type_product  where type_product_id = $typeProductId");

         while ($row = pg_fetch_array($query)) {
            $result[] =  new TaxTypeProduct((int) $row['id'], $row['name'], $row['percentage'], $row['type_product_id']);
         }

         return $result;
     }

     public function find(int $id): TaxTypeProduct
     {
         $query = $this->connection->query("select * from tax_type_product where id = {$id}");
         $row = pg_fetch_array($query);

         return new TaxTypeProduct((int) $row['id'], $row['name'], $row['percentage'], $row['type_product_id']);
     }

     public function delete(int $id): bool
     {

     }
}