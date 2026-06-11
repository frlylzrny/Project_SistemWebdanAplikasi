<?php

namespace App\Contracts;




/**
 * Contract Riwayat Pencarian
 */
interface SearchHistoryContract
{
    /**
     * Menyimpan keyword pencarian
     */
    public function saveHistory(
        int $userId,
        string $keyword
    ): ApiResponseContract;


    /**
     * Mengambil history pencarian
     */
    public function getHistory(
        int $userId
    ): ApiResponseContract;


    /**
     * Menghapus history
     */
    public function deleteHistory(
        int $historyId
    ): ApiResponseContract;
}