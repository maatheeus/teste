<?php

namespace App\Infrastructure\Repository;

use App\Domain\TypeProduct;
use App\Infrastructure\Database\DatabaseConnectionInterface;

class TypeProductRepository implements TypeProductRepositoryInterface
{
    private $connection;

    public function __construct(DatabaseConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $result = [];
        $query = $this->connection->query('select * from type_product');

         while ($row = pg_fetch_array($query)) {
            $result[] =  new TypeProduct((int) $row['id'], $row['name']);;
         }

         return $result;
    }

     public function create(array $data): bool
     {
         try{
             $name = $data['name'];
             $sql = "INSERT INTO type_product (name) VALUES ('$name')";
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
             $sql = "UPDATE type_product set name = '$name' where id = {$id}";
             $query = $this->connection->query($sql);

             if($query)
                return true;
             else
                return false;
         }catch (\Exception $e){
            return false;
         }
     }

     public function find(int $id): TypeProduct
     {
         $query = $this->connection->query("select * from type_product where id = {$id}");
         $row = pg_fetch_array($query);

         return new TypeProduct((int) $row['id'], $row['name']);
     }

     public function delete(int $id): bool
     {

     }
}