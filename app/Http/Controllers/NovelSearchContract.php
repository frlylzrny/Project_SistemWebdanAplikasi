<?php

namespace App\Contracts;



/**
 * Contract Search Novel
 */
interface NovelSearchContract
{
    /**
     * Mencari novel berdasarkan keyword
     */
    public function search(string $keyword): ApiResponseContract;
}
