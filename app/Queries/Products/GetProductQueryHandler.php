<?php

namespace App\Queries\Products;

use App\Models\Product;
use App\Queries\IQueryHandler;

class GetProductQueryHandler implements IQueryHandler
{
    protected GetProductQuery $query;

    public function __construct(GetProductQuery $query)
    {
        $this->query = $query;
    }

    public function run(): Product
    {
        return Product::findOrFail($this->query->getId());
    }
}