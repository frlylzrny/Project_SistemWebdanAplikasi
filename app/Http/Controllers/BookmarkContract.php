<?php

namespace App\Contracts;



/**
 * Contract Bookmark Novel
 */
interface BookmarkContract
{
    /**
     * Menambahkan novel ke bookmark
     */
    public function addBookmark(
        int $userId,
        string $novelId
    ): ApiResponseContract;


    /**
     * Menghapus bookmark
     */
    public function removeBookmark(
        int $userId,
        string $novelId
    ): ApiResponseContract;


    /**
     * Menampilkan daftar bookmark user
     */
    public function getBookmarks(
        int $userId
    ): ApiResponseContract;
}