<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::where(function($query) use($request){
            
            $query->when($request->input('genre'), function($query) use ($request){
                $query->getBookByGenre($request->input('genre'));
            });

            $query->when($request->input('author'), function($query) use($request){
                $query->getBookByAuthor($request->input('author'));
            });

        })
        ->withCount(['copies' => function($query){
            $query->getAvailable();
        }])
        ->get();

        return $books->isNotEmpty() ? BookResource::collection($books): new JsonResponse(null, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        //
        $book = Book::create($request->all());
        $book->genres()->attach($request->input('genres'));

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //

        return new BookResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
