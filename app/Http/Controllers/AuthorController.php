<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkStoreAuthorRequest;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $authors = Author::when($request->country, function($query) use($request){
            $query->getByCountry($request->country);
        })
        ->with(['country'])
        ->when($request->includeBooks, function($query){
            $query->with('books');
        })
        ->get();

        return AuthorResource::collection($authors);
    }

    public function bulkStore(BulkStoreAuthorRequest $request)
    {
        Author::insert($request->validated());
        return response()->json(['Success Insert']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());
        $author->load('country');
        return new AuthorResource($author);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
        $author->load('country');
        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        //
        $author->update($request->validated());

        return new AuthorResource($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
        $author->delete();
        return response()->json(['Success' => 'Recurso Eliminado Existosamente'], Response::HTTP_OK);
    }
}
