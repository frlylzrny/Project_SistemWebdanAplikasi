<?php

namespace App\Http\Controllers;

use App\Services\GoogleBooksService;
use App\Models\SearchHistory;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    protected GoogleBooksService $googleBooksService;

    public function __construct(GoogleBooksService $googleBooksService)
    {
        $this->googleBooksService = $googleBooksService;
    }

    public function test()
    {
        return response()->json([
            'message' => 'GoogleBooksService berhasil diinject',
        ]);
    }

    public function search(Request $request)
    {
        $books = ['docs' => []];

        if ($request->filled('q')) {

            $result = $this->googleBooksService->search($request->q);

            $books = is_array($result) ? $result : ['docs' => []];

            if (auth()->check()) {
                SearchHistory::create([
                    'user_id' => auth()->id(),
                    'keyword' => $request->q,
                ]);
            }
        }

        return view('novels.search', compact('books'));
    }

    public function detail(Request $request)
    {
        $id = urldecode($request->id ?? '');

        $book = $this->googleBooksService->getBook($id);

        return view('novels.detail', compact('book'));
    }

    public function history()
    {
        $histories = SearchHistory::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('history.index', compact('histories'));
    }
}