<?php

namespace App\Contracts;


/**
 * Contract Response API
 */
interface ApiResponseContract
{
    public function success(): bool;

    public function message(): string;

    public function data(): mixed;
}