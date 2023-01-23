<?php

namespace App\Http\Controllers;

use App\Commands\CommandBus;
use App\Commands\Products\CreateProductCommand;
use App\Queries\Products\GetProductQuery;
use App\Queries\QueryBus;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:products']
        ]);

        $command = new CreateProductCommand();
        $command->setName($request->get('name'));

        CommandBus::run($command);

        return response()->json();
    }

    public function show(int $id)
    {
        $query = new GetProductQuery();
        $query->setId($id);

        $product = QueryBus::run($query);

        return response()->json($product);
    }
}