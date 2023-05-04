<?php

namespace App\Infrastructure\Database;

interface DatabaseConnectionInterface
{
    public function connect();
    public function query(string $query);
    public function disconnect();
}