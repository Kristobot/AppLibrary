<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCopyRequest;
use App\Http\Resources\CopyCollection;
use App\Http\Resources\CopyResource;
use App\Models\Copy;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CopyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Copy::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $copies = Copy::with(['book','status'])->get();
        return new CopyCollection($copies);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCopyRequest $request)
    {
        //
        $copy = Copy::create($request->validated())
                    ->load(['book','status']);
        $copy->refresh();
        return new CopyResource($copy);
    }

    /**
     * Display the specified resource.
     */
    public function show(Copy $copy)
    {
        //
        $copy->load(['book','status']);
        return new CopyResource($copy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Copy $copy)
    {
        //
        $copy->delete();
        return response()->json(['Success' => 'Recurso Eliminado Existosamente'], Response::HTTP_OK);
    }
}
