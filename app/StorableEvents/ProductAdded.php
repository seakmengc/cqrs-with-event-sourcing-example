<?php

namespace App\StorableEvents;

use App\Models\Product;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ProductAdded extends ShouldBeStored
{
    public string $name;

    public string $uuid;

    public function __construct(Product $product)
    {
        $this->uuid = $product->uuid;
        $this->name = $product->name;
    }
}