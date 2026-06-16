<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleBooksService
{
    // API search OpenLibrary
    protected string $searchUrl = 'https://openlibrary.org/search.json';

    /**
     * SEARCH NOVEL
     */
    public function search(string $query)
    {
        try {
            $response = Http::timeout(15)
                ->retry(3, 200)
                ->get($this->searchUrl, [
                    'q' => $query,
                    'limit' => 20,
                ]);

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'docs' => []
            ];

        } catch (\Exception $e) {
            return [
                'docs' => []
            ];
        }
    }

    /**
     * GET DETAIL NOVEL
     * contoh key: /works/OL12345W
     */
    public function getBook(string $workKey)
    {
        try {
            // pastikan format key benar
            $workKey = urldecode($workKey);

            $response = Http::timeout(15)
                ->retry(3, 200)
                ->get('https://openlibrary.org' . $workKey . '.json');

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'title' => 'Data tidak ditemukan',
                'description' => 'API tidak merespon data'
            ];

        } catch (\Exception $e) {
            return [
                'title' => 'Error',
                'description' => 'Gagal mengambil data dari server'
            ];
        }
    }
}