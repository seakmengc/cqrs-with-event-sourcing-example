<?php

namespace App\Queries;

interface IQueryHandler
{
    function run(): mixed;
}