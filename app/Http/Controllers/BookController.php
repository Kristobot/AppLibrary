<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $books = Book::filterByGenreAndAuthor($request->author, $request->genre)
        ->with(['author', 'genres'])
        ->withCount(['copies' => function($query){
            $query->available();
        }])
        ->get();
        return BookResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        //
        $book = Book::create($request->validated());
        $book->genres()->attach($request->genres);
        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
        $book->load(['author','genres'])
            ->loadCount(['copies' => function($query){
                $query->available();
            }]);
        
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
        $book->update($request->validated());
        $book->load(['author','genres']);
        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return response()->json(['Success' => 'Recurso Eliminado Existosamente'], Response::HTTP_OK);
    }
}
