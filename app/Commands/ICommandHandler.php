<?php

namespace App\Commands;

interface ICommandHandler
{
    function run(): void;
}