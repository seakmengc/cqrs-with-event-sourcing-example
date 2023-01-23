<?php

namespace App\Commands\Products;

use App\Models\Product;
use App\Commands\ICommandHandler;
use App\StorableEvents\ProductAdded;
use Illuminate\Support\Str;

class CreateProductHandler implements ICommandHandler
{
    protected CreateProductCommand $command;

    public function __construct(CreateProductCommand $command)
    {
        $this->command = $command;
    }

    public function run(): void
    {
        $product = Product::create([
            'uuid' => Str::uuid()->toString(),
            'name' => $this->command->getName(),
        ]);
        // dd($product);
        event(new ProductAdded($product));
    }
}