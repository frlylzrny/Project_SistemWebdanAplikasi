<?php

namespace App\Contracts;




/**
 * Contract Detail Novel
 */
interface NovelDetailContract
{
    public function getDetail(string $novelId): ApiResponseContract;
}