<?php

namespace App\Domain;

class Sale{
    public $id;
    public $created_at;

    public function __construct(int $id, string $created_at)
    {
        $this->id = $id;
        $this->created_at = $created_at;
    }
}