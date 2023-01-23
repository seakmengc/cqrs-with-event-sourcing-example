<?php

namespace App\Queries;

use App\Queries\Products\GetProductQuery;
use App\Queries\Products\GetProductQueryHandler;
use Exception;

class QueryBus
{
    protected static $queries = [
        GetProductQuery::class => GetProductQueryHandler::class
    ];

    public static function run(IQuery $command): mixed
    {
        $handler = self::getQueryHandler($command);

        return $handler->run();
    }

    private static function getQueryHandler(IQuery $query): IQueryHandler
    {
        $handler = self::$queries[get_class($query)] ?? null;
        if (is_null($handler)) {
            throw new Exception('Unhandled query class.');
        }

        return new $handler($query);
    }
}