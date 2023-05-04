<?php

namespace App\Infrastructure\Repository;

use App\Domain\Product;
use App\Infrastructure\Database\DatabaseConnectionInterface;

class ProductRepositoy implements ProductRepositoryInterface
{
    private $connection;

    public function __construct(DatabaseConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $result = [];
        $query = $this->connection->query('select * from product');

         while ($row = pg_fetch_array($query)) {
            $result[] =  new Product((int) $row['id'], $row['name'], $row['value'], $row['type_product_id']);
         }

         return $result;
    }

     public function create(array $data): bool
     {
         try{
             $name = $data['name'];
             $value = $data['value'];
             $type_product_id = $data['type_product_id'];

             $sql = "INSERT INTO product (name, value, type_product_id) VALUES ('$name', $value, $type_product_id)";
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
             $value = $data['value'];
             $type_product_id = $data['type_product_id'];

             $sql = "UPDATE product set name = '$name', value = $value, type_product_id = $type_product_id where id = {$id}";
             $query = $this->connection->query($sql);

             if($query)
                return true;
             else
                return false;
         }catch (\Exception $e){
            return false;
         }
     }

     public function find(int $id): Product
     {
         $query = $this->connection->query("select * from product where id = {$id}");
         $row = pg_fetch_array($query);

         return new Product((int) $row['id'], $row['name'], $row['value'], $row['type_product_id']);
     }

     public function delete(int $id): bool
     {

     }
}