<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        Bookmark::create([
            'user_id'   => auth()->id(),
            'book_id'   => $request->book_id,
            'title'     => $request->title,
            'author'    => $request->author,
            'thumbnail' => $request->thumbnail,
        ]);

        return redirect()->back()->with('success', 'Berhasil disimpan ke favorit');
    }

    public function index()
    {
        $bookmarks = Bookmark::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('bookmarks.index', compact('bookmarks'));
    }

    public function destroy($id)
    {
        Bookmark::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return redirect()->back()->with('success', 'Bookmark dihapus');
    }
}