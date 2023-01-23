<?php

namespace App\Commands\Products;

use App\Models\Product;
use App\Commands\ICommandHandler;
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
        Product::create([
            'uuid' => Str::uuid()->toString(),
            'name' => $this->command->getName(),
        ]);
    }
}