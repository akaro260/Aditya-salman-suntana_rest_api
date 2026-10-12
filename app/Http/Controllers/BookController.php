<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->select(['id', 'title', 'author', 'published_year'])
            ->orderBy('id')
            ->get();

        return response()->json(['data' => $books]);
    }
    public function show(string $id)
    {
        //
        $Books = Book::find($id);
        if(!$Books){
            return response()->json([
                'message'=> "buku nga ada"
            ],404);
            
        }
        return response()->json([
            'message'=> "Data buku",
            'data'=> $Books
        ],200);
    }

public function store(Request $request)
{
    
    $validated = $request->validate([
        'title' => 'required|string|max:150',
        'author' => 'required|string|max:100',
        'published_year' => 'required|integer|min:1',
    ]);

    
    $book = Book::create($validated);

    
    return response()->json([
        'message' => 'Book created successfully',
        'data' => $book
    ], 201);
}

}
