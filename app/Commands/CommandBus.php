<?php

namespace App\Commands;

use Exception;
use App\Commands\ICommand;
use App\Commands\ICommandHandler;
use Illuminate\Support\Facades\DB;
use App\Commands\Products\CreateProductCommand;
use App\Commands\Products\CreateProductHandler;

class CommandBus
{
    protected static $commands = [
        CreateProductCommand::class => CreateProductHandler::class
    ];

    public static function run(ICommand $command)
    {
        DB::transaction(function () use (&$command) {
            $handler = self::getCommandHandler($command);

            $handler->run();
        });
    }

    private static function getCommandHandler(ICommand $command): ICommandHandler
    {
        $handler = self::$commands[get_class($command)] ?? null;
        if (is_null($handler)) {
            throw new Exception('Unhandled command class.');
        }

        return new $handler($command);
    }
}