<?php

namespace App\Contracts;


/**
 * Contract User Data
 */
interface UserContract
{
    public function id(): int;

    public function name(): string;

    public function email(): string;
}