<?php

namespace App\Contracts;


/**
 * Contract User Authentication
 */
interface AuthContract
{
    public function register(array $data): ApiResponseContract;

    public function login(array $credentials): ApiResponseContract;

    public function logout(): ApiResponseContract;
}